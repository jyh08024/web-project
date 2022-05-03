//디버깅용 함수
const dd = console.log;
//로컬스토리지
const ls = localStorage;
//기본객체
const App = {
  init() {
    App.hook();

    if (window.location.href == "http://localhost/" || window.location.href.includes("index")) {
      BakerMap.init();
    }

    if (window.location.href.includes("stamp")) {
      Stamp.init();
    }
  },

  hook() {
    $(document)
      .on(`click`, ".popup_close", Modal.close)
  }
}
//지도 관리 객체
const BakerMap = {
  //상점 위치
  location: [],
  
  //지도 이미지 개수
  imgList: {
    1: 1,
    2: 4,
    3: 16,
  },

  async init() {
    BakerMap.location = await $.getJSON('../resources/json/store_location.json');

    BakerMap.mapInit();
  },

  async mapInit() {
    const arr = [
      [],
      [],
      [],
    ];

    for (let i = 1; i < 4; i++) {
      const forNum = BakerMap.imgList[i];

      for (let j = 1; j <= forNum; j++) {
        const imgList = await new Promise(res => {
          const img = new Image();
          img.src = `../resources/map/${i}/${i}${i == 1 ? "" : `-${j}`}.jpg`;

          res(img);
        })
        arr[i - 1].push(imgList);
      }
    }

    BakerMap.marker = await new Promise(res => {
      const img = new Image();
      img.src = `../resources/map/marker.png`;

      img.onload = (e) => {
        res(e.target);
      }
    });

    BakerMap.mapList = arr;
    BakerMap.hook();
  },

  hook() {
    $(document)
      .on(`click`, ".view_map", function(e) {
        //현재 선택한 빵집의 위치
          BakerMap.nowLoc = BakerMap.location.find(v => v.store == $(e.currentTarget).data('name'));
          //지도 확대
          BakerMap.zoom = 1;
          //지도 좌표
          BakerMap.pos = { x: 0, y: 0 };
          BakerMap.prev = { x: 0, y: 0 };
          //지도에 마우스 오버 여부
          BakerMap.hold = false;
          //줌 상태 체크
          BakerMap.zoomLast = false;
          BakerMap.nowZoom = false;

          const c = $(`#map_cv`)[0];
          c.getContext('2d').clearRect(0, 0, c.width, c.height);

          $(`#map_cv`).css('transform', 'scale(1)');
          $(`.now_mag_c`).html("100%");

          Modal.open('map_popup');
          BakerMap.drawMap();
      })
      .on(`mousewheel`, "#map_cv", function(e) {
        BakerMap.zoomCon(e, e.originalEvent.wheelDelta > 0 ? "up" : "down")
      })
      .on(`mousemove mouseup mousedown mouseleave`, "#map_cv", function(e) {
        BakerMap.moveMap(e, e.type);
      })
  },

  async drawMap(type = "") {
    const c = $(`#map_cv`)[0];
    const ctx = c.getContext('2d');

    const img = BakerMap.mapList[BakerMap.zoom - 1];
    const now = BakerMap.nowLoc;

    const per = Math.sqrt(img.length);
    const pinper = [4, 2, 1][BakerMap.zoom - 1];

    img.forEach((v, i) => {
      const posX = BakerMap.zoom == 1 ? (c.width * (i % per)) : (c.width * (i % per)) + BakerMap.pos.x;
      const posY = BakerMap.zoom == 1 ? (c.height * Math.floor(i / per)) : (c.height * Math.floor(i / per)) + BakerMap.pos.y;

      ctx.drawImage(v, posX, posY, c.width, c.height);
    });

    if (BakerMap.nowZoom) {
        BakerMap.nowZoom = false;
    }

    if (BakerMap.zoom >= 3 && type == "up") {
      BakerMap.zoomLast = true;
    }

    ctx.drawImage(BakerMap.marker, ((now.x * .63) / pinper) + BakerMap.pos.x, ((now.y * .63) / pinper) + BakerMap.pos.y, 80, 70);
  },

  zoomCon(e, type) {
    if (BakerMap.nowZoom || BakerMap.zoom == 3 && type == "up" || BakerMap.zoom == 1 && type == "down") {
      return;
    }

    BakerMap.nowZoom = true;
    this.zoom += type == "up" ? +1 : -1;
    this.zoom = this.zoom > 3 ? 3 : (this.zoom < 1 ? 1 : this.zoom);

    const dir = type == "up" ? 2 : .5;

    BakerMap.pos.x = e.offsetX * -dir + BakerMap.pos.x * dir + e.offsetX;
    BakerMap.pos.y = e.offsetY * -dir + BakerMap.pos.y * dir + e.offsetY;

    const mag = BakerMap.zoom == 3 ? 400 : BakerMap.zoom * 100;
    $(`.now_mag_c`).html(`${mag}%`);

    $(`#map_cv`).animate({
      [Math.random()]: .4
    }, {
      duration: 400,
      step: (now, fx) => {
        $(fx.elem).css({ transform: `scale(${1 + (type == "up" ? now : -now)})` });
      },
      complete: () => {
        $(`#map_cv`).css({transform: `scale(1)`});
      }
    });

    setTimeout(() => {
      BakerMap.drawMap(type);
    }, 400);
  },

  moveMap(e, type) {
    if (BakerMap.zoom == 1) {
      return;
    }

    const pos = [e.pageX, e.pageY];

    switch (type) {
      case "mousedown":
        BakerMap.hold = true;
        BakerMap.prev = pos;
        break;
      
      case "mouseup": 
        BakerMap.hold = false;
        break;
        
      case "mouseleave":
        BakerMap.hold = false;
        break;

      case "mousemove": 
        if (!BakerMap.hold) {
          return;
        }

        BakerMap.pos.x += (pos[0] - BakerMap.prev[0]);
        BakerMap.pos.y += (pos[1] - BakerMap.prev[1]);

        BakerMap.prev = pos;
        
        const maxPos = [
          0,
          -($(`#map_cv`).width()),
          -($(`#map_cv`).width() * 3),
        ][BakerMap.zoom - 1];

        if (BakerMap.pos.x > 0) {
          BakerMap.pos.x = 0;
        }

        if (BakerMap.pos.y > 0) {
          BakerMap.pos.y = 0;
        }

        if (BakerMap.pos.x < maxPos) {
          BakerMap.pos.x = maxPos;
        }

        if (BakerMap.pos.y < maxPos) {
          BakerMap.pos.y = maxPos;
        }

        BakerMap.drawMap();
        break;
    }
  }
}

const Stamp = {
  code: [],
  stamp: [],

  async init() {
    if (ls['stamp']) {
      Stamp.stamp = JSON.parse(ls['stamp']);
    }
    Stamp.code = await $.getJSON('../resources/json/code.json');
    Stamp.hook();

    Roulette.init();
  },

  hook() {
    $(document)
      .on(`click`, ".make_stamp", () => Modal.open('make_stamp'))
      .on(`click`, ".download", Stamp.downLoad)
      .on(`click`, ".stamp_btn", Stamp.codeCk)
      .on(`click`, ".sel_coupon", Stamp.fileUpdate)
      .on(`click`, ".file_input", Stamp.fileUpdate)
  },

  save() {
    ls['stamp'] = JSON.stringify(Stamp.stamp);
  },

  downLoad(e) {
    const name = $(`.card_name`).val();
    const overlap = Stamp.stamp.find(v => v.name == name);

    if (name.trim() == "") {
      return alert('이름을 입력해주세요');
    }

    if (overlap) {
      return alert('이미 사용중인 이름입니다.');
    }

    const image = new Image();
    image.src = `../resources/stamp/스탬프카드.png`;

    image.onload = (e) => {
      const c = $(`<canvas>`)[0];
      const ctx = c.getContext('2d');

      c.width = e.target.width;
      c.height = e.target.height;

      ctx.drawImage(e.target, 0, 0, c.width, c.height);

      ctx.fillStyle = "#fff";
      ctx.fillText(name, 365, 20);

      $(`<a href="${c.toDataURL()}" download="${name}.png"></a>`)[0].click();
    }
    
    Stamp.stamp.push({"name": name, "stamp": 0, "chance": 0, "use": 0});
    Stamp.save();
    Modal.close();
  },

  codeCk() {
    const code = $(`.code_input`).val();
    const codeCk = Stamp.code.find(v => v == code);

    $(`.code_input`).val('');

    if (!codeCk) {
      return alert('존재하지 않는 쿠폰 코드입니다');
    }
    
    Modal.open('stamp_get');
  },

  async fileUpdate(e) {
    e.preventDefault();

    Stamp.targetFile = (await window.showOpenFilePicker())[0];
    const type = $(e.target).data('type');

    if (!Stamp.targetFile) {
      return;
    }
    
    const realFile = await Stamp.targetFile.getFile();
    Stamp.nowData = Stamp.stamp.find(v => v.name == realFile.name.split(".")[0]);

    if (!Stamp.nowData) {
      return alert('존재하지 않는 쿠폰입니다.');
    }

    type == "roulette" ? ++Stamp.nowData.use : (++Stamp.nowData.chance, ++Stamp.nowData.stamp);

    if (type == "roulette" && Stamp.nowData.use > Stamp.nowData.chance) {
      return alert('참여가능한 횟수를 전부 소모했습니다.');
    }

    if (type == "stamp" && Stamp.nowData.stamp > 8) {
      return alert('더이상 스탬프를 찍을수 없습니다.');
    }

    const fr = new FileReader();
    const cvFr = new FileReader();

    fr.onload = async (e) => {
      const writeAble = await Stamp.targetFile.createWritable();

      await writeAble.write(e.target.result);
      await writeAble.close();

      Stamp.result(type);
    }

    cvFr.onload = async (e) => {
      fr.readAsArrayBuffer(await Stamp.drawStamp(e.target.result, type));
    }

    cvFr.readAsDataURL(realFile);
  },

  drawStamp(file, type) {
    return new Promise(res => {
      const card = new Image();
      card.src = file;

      card.onload = (e) => {
        const c = $(`<canvas>`)[0];
        const ctx = c.getContext('2d');

        c.width = e.target.width;
        c.height = e.target.height;

        ctx.drawImage(e.target, 0, 0, c.width, c.height);

        const stamp = new Image();
        stamp.src = `../resources/stamp/스탬프.png`;

        stamp.onload = (e) => {
          for (let i = 0; i <= Stamp.nowData.stamp; i++) {
            if (Stamp.nowData.stamp > i) {
              continue;
            }

            const x = 20 + (103 * (i - 1));
            ctx.drawImage(e.target, x > 329 ? x - 412 : x, Stamp.nowData.stamp > 4 ? 173 : 77);
          }

          for (let i = 1; i <= Stamp.nowData.chance; i++) {
            if (type != "roulette" && Stamp.nowData.chance > i) {
              continue;
            }

            ctx.beginPath();
            ctx.fillStyle = Stamp.nowData.use >= i ? "red" : "green";
            ctx.arc(163 + (15 * (i - 1)), 271, 3, 0, Math.PI * 2);
            ctx.fill();
            ctx.closePath();
          }

          c.toBlob(b => res(b));
        }
      }
    })
  },

  result(type) {
    Stamp.save();
    switch (type) {
      case "stamp":
        alert('스탬프를 찍었습니다.');
        Modal.close();
        break;
      
      case "roulette":
        Roulette.gamble();
        break;
    }
  }
}

const Roulette = {
  async init() {
    Roulette.pro = await $.getJSON('../resources/json/product.json');
    Roulette.drawRou();
  },

  drawRou() {
    const c = $(`#roulette`)[0];
    const ctx = c.getContext('2d');

    const color = ["#ffa500", "#0090ff", "#ffa500", "#0090ff", "#ffa500", "#0090ff", "#ffa500", "#0090ff", "#ffa500", "#0090ff"];
    const arc = Math.PI / (Roulette.pro.length / 2);

    ctx.font = "18px Sans-sarif";

    for (let i = 0; i < Roulette.pro.length; i++) {
      const angle = arc * i;

      ctx.fillStyle = color[i];
      ctx.beginPath();

      ctx.arc(300, 300, 250, angle, angle + arc);
      ctx.arc(300, 300, 0, angle + arc, angle);

      ctx.fill();
      ctx.save();

      ctx.fillStyle = "#000";

      const angleArc = angle + arc / 2;
      ctx.translate(300 + Math.cos(angleArc) * 200, 300 + Math.sin(angleArc) * 200);
      ctx.rotate(angleArc + Math.PI / 2);
      
      Roulette.pro[i].split(" ").forEach((text, j) => {
        ctx.fillText(text, -ctx.measureText(text).width / 2, 30 * j);
      });

      ctx.restore();
      ctx.closePath();
    }
  },

  gamble() {
    const rand = Math.floor(Math.random() * Roulette.pro.length);
    const randItem = Roulette.pro[rand];

    const rot = -108 + (-1440 - (36 * rand));

    $(`#roulette`).animate({
      [Math.random()]: rot
    }, {
      duration: 2000,
      step: (now, fx) => {
        $(fx.elem).css({transform: `rotate(${now}deg)`});
      }
    });

    setTimeout(() => {
      alert(`축하합니다, ${randItem}에 당첨되었습니다.`);
    }, 3000);
  }
}

const Modal = {
  open(target) {
    $(`.modal, #${target}`).addClass('open');
    $(`body`).css('overflow', 'hidden');
  },

  close() {
    $(`.popup`).find('input, select, textarea').val('');
    $(`.modal, .popup`).removeClass('open');
    $(`body`).css('overflow', 'auto');
  }
}

$(_ => {
  App.init();
});