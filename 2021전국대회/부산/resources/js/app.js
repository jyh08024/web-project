//디버깅용
const dd = console.log;
//로컬스토리지
const ls = localStorage;
//기본객체
const App = {
  async postData() {
    const baker = ls['store_worldCup'] ? JSON.parse(ls['store_worldCup']) : await $.getJSON('/resources/data/shop.json');
    const bread = await $.getJSON('/resources/data/bread.json');

    $.post(`/post/dbSet`, {bread: bread.bread, baker: baker}).done((e) => {
      App.init();
    })
  },

  init() {
    App.hook();

    if (location.pathname.includes("bakerPick")) {
      WorldCup.init();
    }

    if (location.pathname.includes("bakeryMap")) {
      BakeryMap.init();
    }
  },

  hook() {
    $(document)
      .on(`click`, ".popup_close", function() {
        Modal.close();
      })
  }
}

//월드컵 객체
const WorldCup = {
  breadData: [],
  bakerData: [],
  nowRound: [],
  result: [],
  nextRound: [],

  save(win, lose) {
    const wData = WorldCup.bakerData;

    const winner = wData.find(v => v.idx == win);
    const loser = wData.find(v => v.idx == lose);

    winner.w_score += 3;
    loser.w_score += 2;

    // ls['store_worldCup'] = JSON.stringify(wData);
  },

  resSave() {
    ls['store_worldCup'] = JSON.stringify(WorldCup.bakerData);

    $.post(`/post/worldcupResult`, {result: WorldCup.type == "store" ? WorldCup.nextRound[0] : [WorldCup.nextRound[0], WorldCup.result[0]], type: WorldCup.type});
  },

  async init() {
    WorldCup.hook();

    await WorldCup.getData();
    // WorldCup.drawTor();

    if (!$(`#setpick`).hasClass('open')) {
      Modal.open('setpick');
    }

    const pickType = $(`input[name='pick_type'][checked]`).data('type');

    WorldCup.setPick(pickType);
  },
  //데이터 얻어오기
  async getData() {
    $.ajaxSetup({
      cache: false,
    });

    const bread = await $.post("/data/worldCup/bread");
    const baker = await $.post("/data/worldCup/baker");

    WorldCup.breadData = bread.map(v => ({
      ...v,
      w_score: 0,
    }));
    
    // if (ls['store_worldCup']) {
      // WorldCup.bakerData = JSON.parse(ls['store_worldCup']);
    // } else {
      WorldCup.bakerData = baker.map(v => ({
        ...v,
        w_score: 0,
      }));
    // }

    if (location.pathname.includes("bakeryMap")) {
      if (ls['store_worldCup']) {
        const lsData = JSON.parse(ls['store_worldCup']);

        BakeryMap.bakerData = lsData.map(v => {
          delete v.round
          delete v.w_score

          return v
        })
        
        BakeryMap.breadData = bread;
        return;
      }

      BakeryMap.breadData = bread;
      BakeryMap.bakerData = baker;
    }
  },
  //월드컵 이벤트 관리
  hook() {
    $(document)
      //빵집, 빵 월드컵 종류 바꿀때
      .on(`change`, "input[name='pick_type']", function(e) {
        WorldCup.setPick($(e.target).data('type'));
      })
      //월드컵 시작 버튼 클릭
      .on(`click`, ".start_worldcup", function() {
        Modal.close();

        WorldCup.Round = WorldCup.nowData.length;
        $(`.now_round h1`).html(WorldCup.Round + "강");

        WorldCup.type = $(`input[name="pick_type"]:checked`).data('type');
        
        // DrawTor.init(WorldCup.type, WorldCup.nowData);
        WorldCup.startPick(WorldCup.type);
      })
      //후보 선택했을때
      .on(`click`, ".worldcup_item", WorldCup.pickItem)
  },
  //월드컵 정보 세팅
  setPick(type, change = "") {
    const length = $(`#candid_length`).val() * 1;

    const tmpData = WorldCup[`${(type == "store" ? "baker" : "bread")}Data`];
    // WorldCup.nowData = [...tmpData].splice((tmpData.length - Math.floor(random * tmpData.length)), length);
    WorldCup.nowData = [...tmpData].sort(_ => Math.random() - 0.5).splice(0, length);

    if (change == "") {
      $(`#candid_length`).html('');

      for (let i = 2; i <= tmpData.length; i++) {
        $(`#candid_length`).append(`<option value="${i}">${i}개</option>`);
      }
    }
  },
  //월드컵 생성
  startPick(type) {
    if (WorldCup.nowData.length < 2) {
      WorldCup.nowData = [...WorldCup.nextRound];
      WorldCup.nextRound = [];
      
      WorldCup.Round = WorldCup.nowData.length;
      $(`.now_round h1`).html(WorldCup.Round + "강");
    }

    if (WorldCup.nowData.length % 2 != 0) {
      const unearnd = WorldCup.nowData.splice(WorldCup.nowData.length - 1, 1)[0];
      WorldCup.nextRound.push(unearnd);
    }
    
    WorldCup.nowRound = WorldCup.nowData.splice(0, 2);
    
    if (WorldCup.Round == 1) {
      WorldCup.ranking();
      return;
    }

    $(`.worldcup_list`).html(WorldCup.nowRound.map(v => Html.worldcupHtml(v, type)));
    // DrawTor.drawTable();
  },
  //아이템 선택
  pickItem(e) {
    const target = $(this);

    const selectData = WorldCup.nowRound.find(v => v.idx == target.data('idx'));
    const notSel = WorldCup.nowRound.find(v => v.idx != target.data('idx'));
    
    notSel.round = WorldCup.Round;

    if (WorldCup.type == "store") {
      WorldCup.save(selectData.idx, notSel.idx);
    }

    WorldCup.nextRound.unshift(selectData);
    WorldCup.result.unshift(notSel);

    WorldCup.startPick(WorldCup.type);
  },

  //월드컵 종료
  ranking() {
    WorldCup.resSave();
    $(`.worldcup_section`).html(Html.winnerHtml(WorldCup.nextRound[0], WorldCup.type));
  }
}

const DrawTor = {
  init(type, data) {
    const torData = WorldCup.nowRound.concat(data);

    DrawTor.qty = torData.length;
    DrawTor.maxFloor = Math.ceil(Math.sqrt(DrawTor.qty)) + 1;
    DrawTor.floorHeight = (100 / DrawTor.maxFloor);

    DrawTor.drawTable(torData);
  },

  drawTable(data) {
    if (!data) {
      return;
    }

    let group =  data;

    for (let floor = 1; floor <= DrawTor.maxFloor; floor++) {
      group = DrawTor.makeRound(data);

      const html = DrawTor.makeHtml(group, floor)
      $('.now_round .tor_ta').append(html)
    }
  },

  makeHtml(items, floor) {
    const $floor = $('<div>', {
      class: 'floor',
      'data-floor': floor,
      style: `bottom: ${(floor - 1) * DrawTor.floorHeight}%; height: ${DrawTor.floorHeight}%`
    })

    let itemSize = 0

    if (floor === 1) {
      itemSize = `calc(100% / ${items.length})`
    }

    let left = 0;

    for (let i = 0; i < items.length; i++) {
      const v = items[i];

      if (floor > 1) {
        const $prevFloor = $(`.floor[data-floor=${floor - 1}]`)
        
        setTimeout(() => {
        const $prevFloorItems = $prevFloor.find('.item')
        const $boxs = $prevFloorItems.slice(i * 2, i * 2 + 2)
        dd($boxs)
        const startBox = $boxs.eq(0)[0].getBoundingClientRect()
        const start = startBox.left + startBox.width / 2 - 30
          
        const endBox = $boxs.eq(-1)[0].getBoundingClientRect()
        const end = endBox.left + endBox.width / 2
        const width = end - start + 2
          
        itemSize = width + 'px'
          
        left = startBox.left - 59 + startBox.width / 2 - 15
        }, 100);
      }

      setTimeout(() => {
        
      const $div = $("<div>", {
        class: `item ${v.length === 1 ? 'half' : ''}`,
        style: `width: ${itemSize}; left: ${left}px`
      })

      if (floor > 1) {
        $div.css('position', 'absolute')
      }

      $div.append(v.reduce((acc, v) => acc + `<div>${v}</div>`), '').append("<div class='lineBox'></div>")
      $floor.append($div)
      }, 100);
    }

    return $floor
  },

  makeRound(data) {
    return data.reduce((acc, v) => {
      let key = acc.length - 1
      let last = acc[key]

      if (last.length < 2) {
        acc[key] = ["", ""]
      } else {
        acc.push([""])
      }

      return acc
    }, [[]])
  }
}

const BakeryMap = {
  bakerData: [],
  breadData: [],

  async init() {
    BakeryMap.hook();

    await WorldCup.getData();

    BakeryMap.drawPin();
  },

  hook() {
    $(document)
      .on(`mouseover`, ".map_pin", function() {
        const baker = BakeryMap.bakerData.find(v => v.idx == $(this).data('idx'));
        const [x, y] = [baker.x, baker.y];

        $(`.pin_info`).css({
          "top": y * 1 - 50,
          "left": x * 1,
          "display": "block",
        });

        $(`.pin_info`).html(baker.name);
      })

      .on(`mouseleave`, ".map_pin", function() {
        $(`.pin_info`).html('');

        $(`.pin_info`).css({
          "top": 0,
          "left": 0,
          "display": "none",
        })
      })

      .on(`click`, ".map_pin", function() {
        Modal.open("map_baker");

        const data = BakeryMap.bakerData.find(v => v.idx == $(this).data('idx'));
        $(`.popup_bakery`).html(Html.winnerHtml(data, "store"));
        $(`.worldcup_winner .win_title`).remove();
      })

      .on(`click`, ".shop_loc img", function(e) {
        $(`.shop_loc`).html(`<img class="enr_map" src="resources/map/map.svg" alt="map" title="map">`);

        const img = $(`<img src="resources/map/pin.png" class="loc_pin">`);
        const x = e.clientX - 20;
        const y = e.clientY - 20;
 
        img.css({
          "width": "40px",
          "height": "40px",
          "position": "absolute",
          "z-index": "99",
          "top": y,
          "left": x,
          "cursor": "pointer",
        });

        $(`.shop_loc`).append(img);

        $(`.baker_input input[name="x"]`).val(x);
        $(`.baker_input input[name="y"]`).val(y);
      })
  },

  async drawPin() {
    const bakerData = await $.post(`/get/bakerData`);

    bakerData.forEach((v, i) => {
      const img = $(`<a href="/shop/detail/${v.idx}" style="width: 40px; height: 40px;"><img src="resources/map/pin.png" data-idx="${v.idx}" class="map_pin"></a>`);
      img.css({
        "width": "40px",
        "height": "40px",
        "position": "absolute",
        "z-index": "99",
        "top": v.y * 1,
        "left": v.x * 1,
        "cursor": "pointer",
      });

      $(`.bakery_map`).append(img);
    });
  },

  download(btn) {
    const type = $(btn).data('type');
    const a = $(`<a></a>`);

    let dataUrl = "";

    switch (type) {
      case "json":
        dataUrl = "data:application/json;charset=utf8," + JSON.stringify(BakeryMap.bakerData, null, "\t");

        a.attr('href', dataUrl);
        a.attr('download', "store.json");
        break;
    
      case "graph":
        if (!ls['store_worldCup']) {
          return alert('다운로드 할 수 있는 데이터가 없습니다.');
        }

        dataUrl = BakeryMap.drawGraph();
        a.attr('href', dataUrl);
        a.attr('download', "graph.png");
        break;
    }

    a[0].click();
  },

  drawGraph() {
    const c = $(`<canvas width="800" height="800"></canvas>`)[0];
    const ctx = c.getContext('2d');

    let tl = 0;
    const tc = [];

    let end = 0;
    
    const data = WorldCup.bakerData;
    const tData = [];

    for (let i = 0; i < WorldCup.bakerData.length; i++) {
      if (data[i].w_score == 0) {
        continue;
      }

      tl += 1;
      tData.push(data[i]);

      const total = WorldCup.bakerData.reduce((acc, val) => acc += val.w_score, 0);

      const per = WorldCup.bakerData[i].w_score / total;
      
      const color = BakeryMap.randColor();
      ctx.fillStyle = color;
      tc.push(color);

      ctx.beginPath();

        ctx.moveTo(300, 400);
        ctx.arc(300, 400, 280, end, end += Math.PI * 2 * per);
        ctx.stroke();

        ctx.fill();

      ctx.closePath();
    }

    for (let i = 0; i < tl; i++) {
      const name = tData[i].name;
      const score = tData[i].w_score;

      ctx.fillStyle = tc[i];
      ctx.font = "12px sans-sarif";
      ctx.beginPath();
        ctx.fillRect(600, i * 20 + 10, 20, 10);
        ctx.stroke();

        ctx.fillStyle = "#000";
        ctx.fillText(name, 620, i * 20 + 20);
        ctx.fillText(score, 780, i * 20 + 20);
      ctx.closePath();
    }

    return c.toDataURL();
  },

  randColor() {
    return "#" + Math.round(Math.random() * 0xffffff).toString(16);
  },
  
  async modalSet() {
    const image = Array.from(new Set(BakeryMap.bakerData.map(v => {
      return v.image;
    })));

    $(`#bakery_img`).html(image.map(v => `<option value="${v}">${v}</option>`));

    $(`.sale_Bread`).html(BakeryMap.breadData.map(v => `
      <div>
        <input type="checkbox" value="${v.idx}" id="bread_id${v.idx}" name="items">
        <label for="bread_id${v.idx}">${v.idx}번 빵</label>
      </div>
    `))

    clearInterval(BakeryMap.timer);
    BakeryMap.timer = setInterval(() => {
      $.getJSON('/resources/data/bread.json').done((e) => {
        const ba = [...BakeryMap.breadData].map(v => {
          v.idx = v.idx * 1
          return v;
        });

        if (JSON.stringify(e.bread) != JSON.stringify(ba)) {
          $(`.sale_Bread`).html(e.bread.map(v => `
            <div>
              <input type="checkbox" value="${v.idx}" id="bread_id${v.idx}" name="items">
              <label for="bread_id${v.idx}">${v.idx}번 빵</label>
            </div>
          `))
        }
      })
    }, 1000);
  },

  bakerEnr() {
    const obj = {};
    const item = [];
    let err = false;
      
    $(`.baker_input input, select`).toArray().forEach(v => {
      if ($(v).attr('name') == "items") {
        if (item.length == 0) {
          err = true;
        }

        if ($(v).prop('checked')) {
          item.push(v.value * 1);
          err = false;
        }
      }

      if (!$(v).val().trim() && err == false) {
        err = true;
      }

      if (err == false && $(v).attr('name') !== "items") {
        const key = $(v).attr('name')
        obj[key] = $(v).val();
      }
    })

    if (err) {
      return alert('모든 입력사항을 입력해주세요');
    }

    obj.item = item;

    // BakeryMap.bakerData.push(obj);
    
    const lsData = JSON.parse(ls['store_worldCup']);

    obj.idx = lsData.length + 1;
    obj.w_score = 0;

    lsData.push(obj);
    $.post('/post/bakerSave', {data: obj}).done((e) => {
      const res = JSON.parse(e);

      alert(res.msg);
      Modal.close();
    });
    // ls['store_worldCup'] = JSON.stringify(lsData);
  }
}

const Html = {
  worldcupHtml(data, type = "") {
    return `
      <div class="worldcup_item" data-idx="${data.idx}">
        <div class="worldcup_img">
          <img src="resources/${type}/${data.image}" alt="pick" title="pick">
        </div>

        <div class="worldcup_text">
          <h2>${data.name}</h2>
        </div>
      </div>
    `
  },

  winnerHtml(data, type) {
    switch (type) {
      case 'store':
        let itemList = "";
        
        data.item.map((v, i) => {
          const breadData = WorldCup.breadData.find(x => x.idx == v);

          itemList += `
            <div class="other_item">
              <div class="other_item_img">
                <img src="resources/bread/${breadData.image}" alt="other" title="other">
              </div>

              <h1 class="tlc">${breadData.name}</h1>
            </div>
          `
        })

        return `
          <div class="worldcup_winner">
            <h1 class="win_title">우승</h1>
            <div class="winner_prize flex">
              <div class="winner_img">
                <img src="resources/store/${data.image}" alt="winner" title="winner">
              </div>

              <div class="winner_info">
                <h1>${data.name}</h1>
                <p>${data.contents}</p>
              </div>
            </div>

            <div class="winner_other">
              <h1>판매중인 상품</h1>

              <div class="other_info">
                ${itemList}
              </div>
            </div>
          </div>
        `
        break;
    
      case 'bread':
        let storeHtml = "";

        WorldCup.bakerData.map((v, i) => {
          if (!v.item.includes(data.idx)) {
            return;
          }

          storeHtml+= `
            <div class="other_item">
              <div class="other_item_img">
                <img src="resources/store/${v.image}" alt="other" title="other">
              </div>

              <h1 class="tlc">${v.name}</h1>
            </div>
          `
        })

        return `
          <div class="worldcup_winner">
            <h1>우승</h1>
            <div class="winner_prize flex">
              <div class="winner_img">
                <img src="resources/bread/${data.image}" alt="winner" title="winner">
              </div>

              <div class="winner_info">
                <h1>${data.name}</h1>
                <p>${data.content}</p>
              </div>
            </div>

            <div class="winner_other">
              <h1>판매중인 매장</h1>

              <div class="other_info">
                ${storeHtml}
              </div>
            </div>
          </div>
        `
        break;
    }
  },

}

const Modal = {
  open(target) {
    $(`.modal, #${target}`).addClass('open');

    $(`body`).css('overflow', 'hidden');

    if (target == "store_enr") {
      BakeryMap.modalSet();
    }
  },

  close() {
    $(`.popup`).find('input, select, textarea').toArray().forEach(v => {
      v.val = '';
    })
    $(`.modal, .popup`).removeClass('open');

    $(`body`).css('overflow', 'scroll');
  }
}

$(_ => {
  App.postData();
}); 