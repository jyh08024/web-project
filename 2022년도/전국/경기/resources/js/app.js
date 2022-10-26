// 디버깅 함수
const dd = console.log;

// 정규식 특수문자 관리
const escape = (str) => str.replace(/[|\\{}()[\]^$+*?.]/g, "\\$&");
// 정규식 초성문자열
const cho = [
  [/ㄱ/g, "[가-깋]"],
  [/ㄲ/g, "[까-낗]"],
  [/ㄴ/g, "[나-닣]"],
  [/ㄷ/g, "[다-딯]"],
  [/ㄸ/g, "[따-띻]"],
  [/ㄹ/g, "[라-맇]"],
  [/ㅁ/g, "[마-밓]"],
  [/ㅂ/g, "[바-빟]"],
  [/ㅃ/g, "[빠-삫]"],
  [/ㅅ/g, "[사-싷]"],
  [/ㅆ/g, "[싸-앃]"],
  [/ㅇ/g, "[아-잏]"],
  [/ㅈ/g, "[자-짛]"],
  [/ㅈ/g, "[짜-찧]"],
  [/ㅊ/g, "[차-칳]"],
  [/ㅋ/g, "[카-킿]"],
  [/ㅌ/g, "[타-팋]"],
  [/ㅍ/g, "[파-핗]"],
  [/ㅎ/g, "[하-힣]"],
];

// 기본함수 
const App = {
  init() {
    App.getData();
  },

  async getData() {
    // const data = await $.getJSON('/resources/JSON/garden.json');
    // App.garden = data.gardens;
    
    if (location.pathname.includes("search")) {
      Search.init();
    }

    if (location.pathname.includes("allGarden")) {
      List.init();
    }

    App.hook();
  },

  // 이벤트 관리 메솓ㅡ
  hook() {
    $(document) 
      .on(`click`, ".tag", (e) => Search.tagSearch(e))
      .on(`click`, ".search_btn", (e) => Search.searching(e))
      .on(`input`, "#search", (e) => Search.searchKey(e.target.value))
      .on(`click`, ".garden_item", (e) => List.detailView(e))
      .on(`click`, ".marker", (e) => List.detailView(e))
      .on(`click`, ".pano", () => Pano.init())
      .on(`mousedown mousemove mouseup`, ".cube_wrap", (e) => Pano.move(e))
      .on(`click`, ".view_move", (e) => Pano.viewMove())
      .on(`click`, ".close_pano", () => Pano.close())

      $(document) 
        .on(`keydown`, (e) => Pano.keyMove(e))
  }
}

// 검색페이지 관리 객체
const Search = {
  selTag: "",
  tags: [],
  
  init() {
    Search.setList(App.garden);
    Search.setTags();
  },

  searchKey(e) {
    const reg = new RegExp(`(${cho.reduce((stack, x) => stack.replace(...x), escape(e))})`, 'gu');
    Search.keyReg = reg;

    Search.searching();
  },

  searching() {
    const data = App.garden.filter(v => v.name.match(Search.keyReg) && Search.tags.map(x => v.themes.find(t => t == x) != undefined ? v.themes.find(t => t == x) : false).filter(_ => _ != false).length == Search.tags.length);

    Search.setList(data);
  },

  tagSearch(e) {
    const target = $(e.currentTarget);
    const tag = target.data('tag');

    if (Search.tags.find(v => v == tag)) {
      Search.tags = Search.tags.filter(v => v != tag);
      target.removeClass('sel_tag');
    } else {
      Search.tags.push(tag);
      target.addClass('sel_tag');
    }

    Search.selTag = JSON.stringify([...Search.tags].sort()).replaceAll("[", "").replaceAll("]", "");
    Search.searching();
  },

  setTags() {
    const tags = [...new Set(App.garden.reduce((acc, v) => {
      return acc.concat(v.themes);
    }, []))];

    $(`.tag_list`).html(tags.map(v => `<div class="tag" data-tag="${v}">${v}</div>`))
  },

  setList(data) {
    $(`.garden_list`).html(data.map(v => Html.gardenHtml(v)));
  },
}

// 전체 정원목록 관리 객체
const List = {
  init() {
    List.setList();
  },

  detailView(e) {
    const val = $(e.currentTarget).data('garden');
    const data = App.garden.find(v => v.name == val);
    dd(data);
    $(`.marker`).removeClass('now_mark');
    $(`.garden_item`).removeClass('high');

    $(e.currentTarget).addClass('high');
    $(`.marker[data-name="${val}"]`).addClass("now_mark");

    $(`.detail`).html(Html.detailHtml(data));
  },

  setList() {
    $(`.garden_area`).html(App.garden.map(v => {
      return `
        <div class="garden_item" data-garden="${v.name}">
          <div class="garden_cont">
            <div class="flex alc js">
              <h4>${v.name}</h4>
              <p class="thema">${v.themes}</p>
            </div>
          </div>
        </div>
      `
    }))

    List.setMap();
  },

  setMap() {
    $(`.mark_list`).html(App.garden.map(v => {
      const left = (v.longitude - 127.5718) / (129.2097 - 127.5718) * 100;
      const top = (v.latitude - 34.7100) / (35.9255 - 34.7100) * 100;

      return `
        <div class="marker" data-name="${v.name}" style="top: ${top}%; left: ${left}%; transform: translate(-${v.longitude - 100}px, ${v.latitude - 100}px);">
          <div>
            <img src="resources/민간정원/${v.name}2.jpg" alt="garden" title="garden" onerror="Html.imgErr(this)">
          </div>
          <img src="resources/map/marker.png" alt="marker" title="marker">
        </div>
      `
    }));
  },
}

// 파노라마 기능
const Pano = {
  open: false,
  nowView: "cube_wrap1",

  init() {
    $(`body`).css('overflow', 'hidden');
    $(`.pano_view`).addClass('pano_open');
    Pano.open = true;

    Pano.moveX = 0;
    Pano.moveY = 0;
  },

  close() {
    $(`body`).css('overflow', 'auto');
    $(`.pano_view`).removeClass('pano_open');
    Pano.open = false;
  },

  viewMove() {
    const nowCube = ["cube_wrap1", "cube_wrap2"].filter(v => v != Pano.nowView);

    $(`.cube`).css('transform', 'rotateX(0deg) rotateY(0deg)');
    $(`.cube_wrap`).removeClass('now_cube');
    $(`.${nowCube}`).addClass('now_cube');

    Pano.moveX = 0;
    Pano.moveY = 0;

    Pano.nowView = nowCube;
  },

  move(e) {
    const pos = [e.pageX, e.pageY];

    switch (e.type) {
      case "mousedown":
        Pano.hold = true;
        Pano.prev = pos;
        break;
      
      case "mousemove": 
        if (!Pano.hold) {
          return;
        }

        Pano.moveX += (Pano.prev[1] - e.pageY) / 10;
        Pano.moveY += (Pano.prev[0] - e.pageX) / 10;

        Pano.moveX = Pano.moveX > 90 ? 90 : (Pano.moveX < -90 ? -90 : Pano.moveX);

        Pano.rotate(Pano.moveX, Pano.moveY);
        Pano.prev = pos;
        break;

      case "mouseup":
      case "mouseleave":
        Pano.hold = false;
        break;
    }
  },

  keyMove(e) {
    if (!Pano.open && ![37, 38, 39, 40].includes(e.keyCode)) {
      return;
    }

    const pos = [Pano.moveX, Pano.moveY];

    const dir = {38: "y", 39: "x", 40: "y", 37: "x"};
    const val = {38: 1, 39: 1, 40: -1, 37: -1};
    const code = e.keyCode;

    if (dir[code] == "y") {
      Pano.moveX = Pano.moveX - val[code];
    }

    if (dir[code] == "x") {
      Pano.moveY = Pano.moveY + val[code];
    }

    Pano.rotate(Pano.moveX, Pano.moveY);
  },

  rotate(x, y) {
    $(`.now_cube .cube`).css('transform', `rotateX(${-x}deg) rotateY(${y}deg)`);
  },
}

// 템플릿 관리
const Html = {
  imgErr(target) {
    const src = $(target).attr('src');
    $(target).attr('src', src.split(".").at(-1) == "jpg" ? src.replace("jpg", "png") : src.replace("png", "jpg"));
  },

  gardenHtml(v) {
    const tList = v.themes.map(v => `<span class="${Search.tags.find(x => x == v) ? "high" : ""}">${v}</span>`);
    return `
      <div class="guide_item">
          <div class="guide_img">
            <img src="/resources/민간정원/${v.name}2.jpg" alt="img" title="img" onerror="Html.imgErr(this)">
          </div>
          
          <div class="guide_t">
            <div class="flex alc js">
              <h3>${v.name.replace(Search.keyReg, `<mark>$1</mark>`)}</h3>
              <p>${tList.join(",")}</p>
            </div>

            <div class="flex alc">
              <p style="margin-right: .3rem;">별점: ${v.score}점</p>
              <div class="star">
                <p class="full_star" style="width: calc(10% * ${v.score});">★★★★★</p>
                <p class="emp_star">☆☆☆☆☆</p>
              </div>
            </div>

            <p class="garden_ex">${v.introduce}</p>
          </div>
      </div>
    `
  },

  detailHtml(data) {
    return `
      <div class="detail_item flex">
          <div class="sub_detail_img">
            <img src="resources/민간정원/${data.name}2.jpg" alt="garden" title="garden">
          </div>
      
          <div class="detail_info">
            <div>
              <h2>${data.name}</h2>
              <p class="thema">${data.themes.join(", ")}</p>
            </div>
            <div>
              <p>${data.address}</p>
              <p>연락처: ${data.phone}</p>
            </div>
            <div class="flex alc">
              <h3>별점:</h3>
              <div class="star">
                <p class="full_star" style="width: calc(10% * ${data.score});">★★★★★</p>
                <p class="emp_star">☆☆☆☆☆</p>
              </div>
              </p>
            </div>
          </div>
          
          <div style="margin-top: 1.5rem; width: 100%;">
            <div class="flex alc js" style="width: 100%; margin-bottom: .6rem;">
              <button class="btn" style="width: 49.4%;"><i class="fa fa-pen"></i> 리뷰 바로가기</button>
              <button class="btn" style="width: 49.4%;"><i class="fa fa-calendar-alt"></i> 예약 바로가기</button>
            </div>
            <button class="btn pano" style="width: 100%;"><i class="fa fa-images"></i> 파노라마</button>
          </div>
        </div>
    `
  }
}

$(() => App.init());