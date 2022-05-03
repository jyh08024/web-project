//디버깅 함수
const dd = console.log;

//로컬스토리지 선언
const ls = localStorage;

//기본 함수
const App = {
  init() {
    Booth.init();
  },
  
}

//부스 그리기 및 이동 관리 객체
const Booth = {
  //레이아웃들
  types: [],
  //현재 부스번호
  target: "",
  //지금 그릴수 있는지
  hold: false,
  //컬러
  color: {},
  //부스기본 템플릿
  boothHtml: "<div class='tmp_booth' style='width: 0; height: 0; top: 0; left: 0;'></div><div class='tmp_view' style='width: 0; height: 0; top: 0; left: 0;'></div>",
  //현재 레이아웃에 부스 내용물
  nowLayout: [],

  async init() {
    const data = await $.getJSON('../resources/data/plan.json');
    //레이아웃 타입 배열
    Booth.types = [ {name: "road0", road: []}, { name: "road1", road: data.road1 }, { name: "road2", road: data.road2 }, { name: "road3", road: data.road3 } ];
    Booth.color = data.color;

    //제공된 데이터에서 부스 이름과 색깔을 뽑아서 사이즈 0의 기본 부스 생성
    Object.values(Booth.color).forEach(v => {
      const name = Object.keys(Booth.color)[Object.values(Booth.color).findIndex(f => f == v)];
      Booth.boothHtml += `<div class="booth ${name}" style="width: 0; height: 0; border:none; background: ${v}" data-booth="${name}">${name}</div>`
    });

    //레이아웃 초기화
    $(`.layout_box`).html(Booth.drawLayout(Booth.types[0], "box"));
    $(`.layout_box`).css('poiner-events', 'auto');
    //가로 세로 칸 좌표 표시
    $(`.row_num`).html(Booth.lineNumber(80));
    $(`.col_num`).html(Booth.lineNumber(40));

    //레이아웃 선택 콤보박스 생성
    $(`.layout_name`).html(Booth.setBoothName(Booth.color));

    //레이아웃 타입 영역 타입 생성
    for (let i = 0; i < 4; i++) {
      $(`.layout_${i}`).html(Booth.drawLayout(Booth.types[i]));
    }

    //부스 데이터 관리 객체 호출
    Bdata.init();
    Booth.hook();
  },

  hook() {
    $(document)
    //레이아웃 타입 변경
      .on(`click`, ".layout_type > div", function(e) {
        const type = $(e.currentTarget).data('type');
        $(`.layout_box`).html(Booth.drawLayout(Booth.types[type], "box"));
        $(`.layout_box`).css('poiner-events', 'auto');

        $(`.move_box`).html(Booth.boothHtml);
        Booth.layoutInit();
        Bdata.save();
      })

      .on(`change`, ".layout_name", (e) => Booth.setTarget(e.target.value))

      .on(`mousedown mousemove mouseup mouseleave`, ".layout_total", (e) => Booth.drawBooth(e))
      .on(`mouseover mouseleave click mousedown`, ".booth", function(e) {
        switch (e.type) {
          case "mouseover":
            $(`.layout_box`).css('poiner-events', 'none');
            break;

          case "click":
            $(`.layout_box`).css('poiner-events', 'none');
            break;

          case "mousedown":
            $(`.layout_box`).css('poiner-events', 'none');
            break;

          case "mouseleave":
            $(`.layout_box`).css('poiner-events', 'auto');
            break;
        }
      })
  },

  drawLayout(type = Booth.types[0], target = "") {
    let arr = new Array(3200).fill('<div></div>');

    type.road.map((v, i) => {
      let id = v[0] + (v[1] - 1) * 80 - 1;
      arr[id] = `<div class='road'></div>`;
    });

    $(`.move_box`).html(Booth.boothHtml);
    return arr.join('');
  },

  lineNumber(num) {
    let html = "";

    for (let i = 1; i <= num; i++) {
      html += `<div>${i}</div>`;
    }

    return html;
  },

  setBoothName(option) {
    let html =  `<option selected disabled>선택</option>`;

    $.each(option, (v, i) => {
      html += `<option value="${i}">${v}</option>`;
      Booth.nowLayout.push({booth: v, info: []});
    });

    return html;
  },

  setTarget(target) {
    const nowBooth = Object.keys(Booth.color)[Object.values(Booth.color).findIndex(v => v == target)];
    Booth.target = nowBooth;

    $(`.now_booth`).html(nowBooth);
    $(`.color_box`).css('background', `${target}`);

    const boothInfo = Booth.nowLayout.find(v => v.booth == nowBooth).info;
    Booth.sizeGet(boothInfo);
  },

  drawBooth(e) {
    if ($(e.target).hasClass('booth')) {
      return;
    }

    switch (e.type) {
      case "mousedown":
        if (!Booth.target) {
          return alert('먼저 부스를 선택해 주세요.');
        }

        Booth.hold = true;

        Booth.startX = $(e.target).position().left;
        Booth.startY = $(e.target).position().top;

        $(`.tmp_booth`).css({
          'top': Booth.startY,
          'left': Booth.startX,
          'width': 0,
          'height': 0,
          'z-index': '999999999'
        });

        $(`.booth`).css('pointer-events', 'none');
        // $(`.tmp_view`).css({
          // 'border': '1px dashed #ff2e32'
        // });
        break;

      case "mousemove":
        if (!Booth.hold) {
          return;
        }

        const x = Booth.startX;
        const y = Booth.startY;

        const {left, top} = $(e.target).position();

        const width = Math.abs(x - left - $(`.layout_box > div`).outerWidth());
        const height = Math.abs(y - top - $(`.layout_box > div`).outerHeight());
        const posLeft = x - left > 0 ? x - width : x;
        const posTop = y - top > 0 ? y - height : y;

        $(`.tmp_booth`).css({
          'left': posLeft,
          'top': posTop,
          'width': width,
          'height': height,
        });

        Booth.tmpBox = [width, height, posLeft, posTop];
        break;

      case "mouseup":
        Booth.hold = false;
        Booth.nowDrag = false;

        if (Booth.tmpBox[0] <= $(`.layout_box > div`).width() * 2 || Booth.tmpBox[1] <= $(`.layout_box > div`).height() * 2) {
          Booth.resetTmp();
          return alert('부스의 칸은 최소 2X2 이상이어야 합니다.');
        }

        Booth.completeBooth(Booth.tmpBox, Booth.target);
        Bdata.save();
        break;

      case "mouseleave":
        Booth.hold = false;
        Booth.tmpBox = [0, 0, 0, 0];

        Booth.resetTmp();
        break;
    }
  },

  completeBooth(info, target) {
    $(`.booth`).css('pointer-events', 'auto');
    Booth.resetTmp();

    const overlap = Booth.overlapCk(info);

    if (overlap) {
      alert('통행로나 다른 부스와 겹칠 수 없습니다.');
      return;
    }

    $(`.${target}`).css({
      'width': info[0],
      'height': info[1],
      'left': info[2],
      'top': info[3],
      'font-size': '1.8rem',
    });

    Booth.makeDrag(`.${target}`);
    Booth.nowLayout.find(v => v.booth == target).info = info;
  
    Booth.sizeGet(info);
  },

  sizeGet(info) {
    const size = info.length ? (info[0] / 15) * (info[1] / 15) : 0;
    $(`.real_size`).html(size);
  },

  layoutInit() {
    Booth.nowLayout = [];
    Booth.target = "";

    $(`.layout_name`).html(Booth.setBoothName(Booth.color));
    $(`.now_booth`).html($(`.layout_name`).val());
    $(`.color_box`).css('background', 'none');
    $(`.real_size`).html(0);
  },

  overlapCk(info) {
    let overlap = false;

    let [x1, y1] = [info[2], info[3]];
    let [x2, y2] = [x1 + info[0], y1 + info[1]];

    $(`.layout_box .road, .booth`).toArray().forEach((v, i) => {
      if (overlap || ($(v).height() <= 0 && $(v).width() <= 0) || $(v).hasClass(Booth.target)) {
        return;
      }

      let [vx1, vy1] = [$(v).position().left, $(v).position().top];
      let [vx2, vy2] = [vx1 + $(v).width(), vy1 + $(v).height()];

      if (!((vx2 <= x1 || x2 <= vx1) || (vy2 <= y1 || y2 <= vy1))) {
        overlap = true;
      }
    })
    
    return overlap;
  },

  resetTmp() {
    $(`.tmp_booth`).css({
      'top': 0,
      'left': 0,
      'width': 0,
      'height': 0,
      'pointer-events': 'none',
      'z-index': 0
    });    
  },

  makeDrag(target) {
    $(target).draggable({
      'containment': '.layout_total',
      'grid': [15, 15],
      'zIndex': 99999,

      start(e, ui) {
        Booth.target = $(e.target).data('booth');
      },

      stop(e, ui) {
        let nowData = [e.target.offsetWidth, e.target.offsetHeight, e.target.offsetLeft, e.target.offsetTop];
        let befData = Booth.nowLayout.find(v => v.booth == e.target.classList[1]);

        const overLap = Booth.overlapCk(nowData);

        if (overLap) {
          alert('통행로나 다른 부스와 겹칠 수 없습니다.');
          $(e.target).css('left', befData.info[2]).css('top', befData.info[3]);
          return;
        }

        Booth.nowLayout.find(v => v.booth == e.target.classList[1]).info = nowData;
        return;
      }
    });
  }
}

//부스 데이터 관리 객체
const Bdata = {
  saveList: new Map(),

  init() {
    if (!ls['boothData']) {
      ls['boothData'] = JSON.stringify([]);
    }

    if (!ls['nowDraw'] || ls['nowDraw'] == "undefined") {
      ls['nowDraw'] = JSON.stringify(Booth.nowLayout);
    }

    if (!ls['drawTarget']) {
      ls['drawTarget'] = Booth.target;
    }

    if (!ls['nowBooth']) {
      ls['nowBooth'] = JSON.stringify($(`.layout_box`).html());
    }

    Booth.target = ls['drawTarget'];

    if (Booth.target) {
      Booth.setTarget(Object.values(Booth.color)[Object.keys(Booth.color).findIndex(f => f == Booth.target)]);
    }
    
    JSON.parse(ls['boothData']).forEach((v, i) => {
      Bdata.saveList.set(v.idx, v);
    });

    $(`.layout_box`).html(JSON.parse(ls['nowBooth']));

    JSON.parse(ls['nowDraw']).forEach((v, i) => {
      if (!v.info.length) {
        return;
      }
      
      Booth.completeBooth(v.info, v.booth);
    });

    if (Bdata.saveList.size > 0) {
      $(`.save_list`).html([...Bdata.saveList.values()].map(v => Html.saveHtml(v)));
    }

    Bdata.hook();
  },

  hook() {
    $(document)
      .on(`click`, ".del_layout", () => {
        alert('삭제되었습니다.');

        $(`.booth`).css({
          'width': 0,
          'height': 0,
          'left': 0,
          'right': 0,
          'font-size': 0,
        });

        Booth.nowLayout = [];

        $.each(Booth.color, (v, i) => {
          Booth.nowLayout.push({ booth: v, info: [] });
        });

        Bdata.save();
        Booth.layoutInit();
      })
      .on(`click`, ".save_layout", () => Bdata.saveLayout())
      .on(`click`, ".save_img", (e) => Bdata.setLayout(e))
      .on(`click`, ".delete_layout_btn", (e) => Bdata.delBooth(e))
  },

  saveLayout() {
    let html = $(`.layout_total`)[0].outerHTML;
    let svg = `
			<svg xmlns="http://www.w3.org/2000/svg" width="1200" height="600">
        <foreignObject width="100%" height="100%"> 
          <div xmlns="http://www.w3.org/1999/xhtml" width="100%" height="100%" style="position:relative">
            ${html}
            ${$('style')[0].outerHTML}
          </div> 
        </foreignObject> 
			</svg>
		`;

    const src = "data:image/svg+xml," + encodeURIComponent(svg) + "";
    const data = {
      idx: Bdata.saveList.size + 1,
      layout: html,
      img: src,
      data: Booth.nowLayout,
    };

    Bdata.saveList.set(data.idx, data);
    $(`.save_list`).html([...Bdata.saveList.values()].map(v => Html.saveHtml(v)));
    Bdata.save();
  },

  setLayout(e) {
    const html = $($(e.target).data('html')).html();
    const data = $(e.target).data('info');

    $(`.layout_total`).html(html);
    Booth.nowLayout = data;

    Booth.makeDrag(".booth");
    Bdata.save();

    Booth.layoutInit();
  },

  save() {
    ls['boothData'] = JSON.stringify([...Bdata.saveList.values()]);
    ls['nowDraw'] = JSON.stringify(Booth.nowLayout);
    ls['drawTarget'] = Booth.target;
    ls['nowBooth'] = JSON.stringify($(`.layout_box`).html());
  },

  delBooth(e) {
    Bdata.saveList.delete($(e.target).data('idx'));
    $(`.save_list`).html([...Bdata.saveList.values()].map(v => Html.saveHtml(v)));
    
    Bdata.save();
  }
}

const Html = {
  saveHtml(data) {
    return `
      <div class="save_item">
          <div class="delete_layout_btn" data-idx="${data.idx}">X</div>
          <div class="save_img">
            <img src='${data.img}' data-html='${data.layout}' data-info='${JSON.stringify(data.data)}'>
          </div>
        </div>
    `
  }
}

//페이지 온로드시
$(_ => {
  App.init();
});