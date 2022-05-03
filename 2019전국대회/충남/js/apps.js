// 디버깅 함수
const dd = console.log;

//로컬스토리지
const ls = localStorage;

// 페이지저장함수
const save = (type) => {
  ls['editor'] = $(`.edit_area`).html();

  ls['scroll_save'] = JSON.stringify({
    prev_box: $(`.prev_box`).scrollTop(),
    page_list: $(`.page_list`).scrollTop(),
    temp_list: $(`.temp_list`).scrollTop(),
    window: $(window).scrollTop(),
  });

  ls['page_list'] = JSON.stringify([...Page.list.values()]);

  if (type == 'data' && Page.nowPage) {
    let arr = [];

    $(`.prev_box > div`).each((i, v) => {
      if ($(v).children() != 0) {
        const type = $(v).attr('class').split("_")[0];
        arr.push({ type: type, html: $(v).html() });
      }
    })

    Page.nowPage.html = arr;
    ls['cur_page'] = JSON.stringify(Page.nowPage);
  }

  ls['nowSel'] = Preview.nowSection;
}
//기본객체
const App = {
  init() {
    if (ls['editor']) {
      $(`.edit_area`).html(ls['editor']);
      $(`.modal .input`).each((i, v) => {
        $(v).val($(v).attr('data-save'));
      })

      EventC.slideCalc();

      $(`.font_size_input`).html('');
      $(`.font_size_input`).prepend(`
        <input type="text" class="input" name="fontSize">
        <button class="btn">적용</button>
      `);

      $('.modal input[name="fontSize"]').val($(`.font_size_input`).data('save')).spinner({
        max: 999,
        min: 1
      }).attr('readonly', true);
    }

    if (ls['scroll_save']) {
      const scroll = JSON.parse(ls['scroll_save']);

      $.each(scroll, (el, val) => $(`.${el}`).scrollTop(val));
      $(window).scrollTop(scroll.window);
    }

    Page.init();
    Preview.init();
    EventC.hook();
  },
}

// 페이지 관리 객체
const Page = {
  list: new Map(),
  nowPage: "",

  init() {
    if (ls['page_list']) {
      JSON.parse(ls['page_list']).forEach(v => {
        Page.list.set(v.idx, v);
      });

      Page.nowPage = ls['cur_page'] ? JSON.parse(ls['cur_page']) : {};
      Page.pageList();
    }
  },

  newPage() {
    const index = Page.list.size ? Page.list.size + 1 : 1;

    let data = {idx : index, name: `신규 페이지`, code: ``, title: ``, description: ``, keyword: ``, html: [
      { type: "header", html: Template.header() },
      { type: "footer", html: Template.footer() },
    ]};

    Page.list.set(index, data);

    Page.pageList();
    Modal.open('page_add', data);
    save();
  },

  setNowPage(e) {
    const id = $(e.currentTarget).data('id');
    $(`.page_item`).removeClass('sel_page');

    $(`.now_mod_con`).removeClass('now_mod_con');
    $(`.active_section`).removeClass('active_section');

    Page.nowPage = Page.list.get(id);
    Preview.nowSection = "";

    Preview.setView();
    $(e.currentTarget).addClass('sel_page');
    save('data');
  },

  pageList() {
    $(`.page_list`).html([...Page.list.values()].map(v => {
      return `
        <div class="page_item flex alc js ${Page.nowPage.idx == v.idx ? "sel_page" : ""}" data-id="${v.idx}">
          <p>페이지 이름: <span>${v.name}</span></p>
          <p>페이지 고유코드: <span>${v.code}</span></p>
          <button class="btn page_modify" data-id="${v.idx}">페이지수정</button>
        </div>
      `
    }));
  }
}

// 미리보기 영역
const Preview = {
  nowSection: "",

  init() {
    if (ls['nowSel']) {
      Preview.nowSection = ls['nowSel'];
    }
  },

  setView(type = 'init') {
    let temp = {
      "header": Template.header(),
      "visual_1": Template.visual_1(),
      "visual_2": Template.visual_2(),
      "feature_1": Template.feature_1(),
      "feature_2": Template.feature_2(),
      "gallery_1": Template.gallery_1(),
      "gallery_2": Template.gallery_2(),
      "contact_1": Template.contact_1(),
      "contact_2": Template.contact_2(),
      "footer": Template.footer(),
    }

    if (type == 'init') {
      $(`.prev_box div`).removeClass('').html('');

      Page.nowPage.html.map(v => {
        $(`.${v.type}_prev`).html(v.html);
      })
    }

    if (type != "init") {
      let target = type.split('_')[0];
      $(`.${target}_prev`).html(temp[type]);
      
      Page.nowPage.html.push({ type: target, html: $(`.${type}_prev`).html() });
    }

    save('data');
  }
}

//이벤트 관리 객체
const EventC = {
  dur: 0,
  max: 0,
  timer: '',

  hook() {
    // 스크롤 저장
    $(window).on(`mousewheel`, save)
    $("*").on(`mousewheel`, save)

    $(document)
      //모달 닫기
      .on(`click`, ".popup_close", Modal.close)
      //모달에서 정보변경시
      .on(`submit`, ".popup_content", (e) => EventC.update(e))
      //페이지 클릭시 활성화
      .on(`click`, ".page_item", (e) => Page.setNowPage(e))
      // 인풋 입력값 저장
      .on(`input`, ".popup_content input", (e) => {
        $(e.target).attr('data-save', e.target.value);
        save();
      })
      // 페이지 수정 버튼 클릭
      .on(`click`, ".page_modify", (e) => {
        Modal.open("page_mod", Page.list.get($(e.currentTarget).data('id')));
        save();
      })
      //레이아웃 추가 버튼 클릭
      .on(`click`, ".layout_view", (e) => {
        if (!Page.nowPage) {
          alert('먼저 페이지를 선택해주세요.');
          return;
        }

        $(`.temp_list_item`).removeClass('hide');
        save();
      })
      //레이아웃 이름 클릭
      .on(`click`, ".layout_item", (e) => {
        $(e.currentTarget).parent().find('.sub_layout').removeClass('hide');
      })
      //템플릿 목록에서 템플릿 선택
      .on(`click`, ".sub_layout > div", (e) => {
        const temp = $(e.currentTarget).data('temp');
        Preview.setView(temp);
      })
      // 미리보기에서 레이아웃 영역 선택
      .on(`click`, ".prev_box > div", (e) => {
        const target = $(e.currentTarget).attr('class').split(" ")[0];
        $(`.set_menu > div`).css('display', 'none');

        if (target == Preview.nowSection) {
          return;
        }

        $(`.prev_box > div`).removeClass('active_section');
        Preview.nowSection = target;
        $(`.${target}`).addClass('active_section');

        save();
      })
      // 설정 버튼 클릭시
      .on(`click`, ".set_btn", (e) => {
        const setMenu = Preview.nowSection.split("_")[0];
        $(`.set_menu > div[data-type="${setMenu}"]`).css('display', 'block');

        save();
      })
      // 설정 메뉴 버튼별
      .on(`click`, ".set_menu .md_open", (e) => {
        const type = $(e.currentTarget).data('type');
        if (type == "contacts_mod" || type == "gallery_mod" || type == "feature_mod") {
          Modal.open("title_mod", Page.nowPage);
        } else {
          Modal.open($(e.currentTarget).data('type'), Page.nowPage);
        }

        if (type == "contacts_color" || type == "footer_modify") {
          Modal.open('color_change');
        }
      })
      .on(`click`, ".set_menu .toggle", (e) => {
        const btn = $(e.currentTarget);
        const toggle = btn.data('type');
        const item = $(`.${toggle}`);
        const show = item.css('opacity') ? item.css('opacity') : 1;

        btn.find('span').html(show == 1 ? "보이기" : "감추기");
        item.css('opacity', show == 1 ? 0 : 1);

        save();
      })
      // 로고 변경
      .on(`click`, ".logo_list img", (e) => {
        const src = $(e.target).attr('src');
        $(`.header_rap .logo img`).attr('src', src);

        save('data');
      })
      // 비주얼 이미지 변경
      .on(`click`, ".visual_list img", (e) => EventC.img(e, "visual"))
      // 우클릭
      .on(`contextmenu`, ".visual_title, .visual_ex, .visual_link, .feature_title, .feature_txt, .feature_link, .icon_box, .gallery_title, .gallery_sub, .gallery_txt", (e) => Context.contextEvent(e))
      // 색상변경표 클릭
      .on(`click`, ".color_picker > div", (e) => EventC.color(e))
      // 아이콘 클릭
      .on(`click`, ".icon_sel_div > div", (e) => {
        const idx = $(e.target).index();
        const x = idx % 10;
        const y = Math.floor(idx / 10);

        $(`.now_mod_con img`).css({
          left: -10 - (60 * x) + 'px',
          top: -17 - (70 * y) + 'px', 
        });

        save('data');
        alert('변경되었습니다.');
      })
  },

  update(e) {
    e.preventDefault();
    const type = $(e.target).data('type');
    const val = $(e.target).find(`.input[data-type="${type}"]`).val();
    
    if (['name', 'code', 'title', 'description', 'keyword'].find(v => v == type)) {
      if (!val) {
        alert('내용을 입력해주세요.');
        return;
      }

      const id = $(`.modal`).data('id');
      const data = Page.list.get(id);

      if (data[type] == val) {
        alert('변경된 내용이 없습니다.');
        return;
      }

      if (type == "code" && !new RegExp('^(?=.*[A-z]*)(?=.*[0-9]*)[A-z0-9]+$').test(val)) {
        alert('고유코드는 영문 및 숫자만 입력 가능합니다.');
        return;
      }

      data[type] = val; 
      Page.pageList();
      return;
    }

    if (type == "menu") {
      const menuArr = [];

      $(e.target).find('input').each((i, v) => {
        const val = v.value;

        if (val.trim() == "") {
          return;
        }

        menuArr.push({ menu: v.value, url: $(e.target).find('select')[i].value });
      });

      if (menuArr.length < 3) {
        alert('3개 이상의 메뉴를 입력해주세요.');
        return;
      }

      $(`.header_rap .menu`).html(menuArr.map(v => {
        return `<li><a href="${v.url}">${v.menu}</a></li>`
      }));

      Modal.close();
    }

    if (type == "visual_title" || type == "visual_ex" || type == "feature_title"
     || type == "feature_txt" || type == "gallery_title" || type == "gallery_title"
     || type == "gallery_sub" || type == "gallery_txt") {
      const isStyle = $(e.target).find(`.input`).attr('name') == "text_cont" ? false : true;

      if (isStyle) {
        $(`.now_mod_con`).css('font-size', $(e.target).find(`.input`).val() * 1 + 'px');
      } else {
        if (type == "visual_title" || type == "visual_ex") {
          $(`.now_mod_con span`).html(val.replaceAll("\n", "<br>"));
        } else {
          $(`.now_mod_con`).text(val);  
        }
      }

      Modal.close();
    }

    if (type == "visual_link") {
      const isUrl = $(e.target).find('.input').attr('name') == "text" ? false : true;

      if (isUrl) {
        $(`.now_mod_con`).find('a').attr('href', $(e.target).find('.input').val());
      } else {
        $(`.now_mod_con`).find('a').html(val);
      }
    }
    
    if (type == "section_title") {
      const findTitle = $(`.active_section .section_title`);

      findTitle.find('h1').find('span').html(val);
      findTitle.find('h2').html(val);

      Modal.close();
    }

    alert('변경되었습니다');
    save('data');
  },

  img(e, type) {
    const src = $(e.target).attr('src');

    if (type == "visual") {
      $(e.target).toggleClass('active_section').attr('data-index', new Date().getTime());

      let arr = $(`.visual_list .active_section`);

      if (arr.length >= 2) {
        arr = arr.toArray();

        arr.sort((a, b) => {
          return $(b).attr('data-index') * 1 - $(a).attr('data-index') * 1;
        });

        const slider = $(`.active_section .visual_img`);
        slider.html('');

        arr.map(v => {
          slider.append(`<div><img src="${$(v).attr('src')}"></div>`);
        });

        EventC.slideCalc();
      }
    }
  },

  slideCalc() {
    const slideForm = $(`.active_section .visual_img`);
    const type = slideForm.hasClass('slide_1') ? '_1' : '_2';
    const target = slideForm.find('div').toArray();

    if (type == "_1") {
      slideForm.find('div').css({
        opacity: 0,
        transform: 'scale(.8)',
        marginLeft: -100 + '%',
      });
    } else {
      slideForm.find('div').css({
        opacity: 0,
        transform: 'scale(.8)',
        marginTop: 0,
      });
    }

    target.map((v, i) => {
      $(v).css('z-index', 555 -i);
    })

    slideForm.toArray().map((v, i) => {
      if (type == "_1") {
        $(v).find('div').eq(EventC.dur).css({
          opacity: 1,
          marginLeft: 0,
          transform: 'scale(1)',
        });
      } else {
        $(v).find('div').eq(EventC.dur).css({
          opacity: 1,
          marginTop: 0,
          transform: 'scale(1)',
        });
      }

        EventC.max = target.length;
  
      EventC.dur++;
      EventC.dur = EventC.dur >= EventC.max ? 0 : EventC.dur;
    })

    clearTimeout(EventC.timer);

    EventC.timer = setTimeout(() => {
      EventC.slideCalc();
    }, 3000);
  },

  color(e) {
    const color = $(e.target).data('color');

    if (Preview.nowSection == "contact_prev") {
      $(`.now_mod_con`).attr('data-color', color);
      save('data');
      return;
    }

    if (Preview.nowSection == "footer_prev") {
      $(`footer`).css('background', color);
      save('data');
      return;
    }
    
    $(`.now_mod_con`).css('color', color);

    save('data');
  },
}

// 마우스 우클릭 시
const Context = {
  contextEvent(e) {
    if (!Page.nowPage) {
      return;
    }

    e.preventDefault();
    
    const modType =  e.currentTarget.className.split(" ");
    const target = $(e.currentTarget);

    $(`.now_mod_con`).removeClass('now_mod_con');
    target.addClass('now_mod_con');

    if (modType.find(v => v.includes("_title")) || modType.find(v => v.includes("_ex")) || modType.find(v => v.includes("_txt")) || modType.find(v => v.includes("_sub"))) {
      Modal.open('text_info_change', target);
    }

    if (modType.find(v => v.includes("_link"))) {
      Modal.open('link_mod', target);
    }

    if (modType.find(v => v.includes("icon"))) {
      Modal.open('icon_mod', target);
    }
  }
}

// 모달 관리 객체
const Modal = {
  open(target, data = "") {
    $(`.modal, #${target}`).addClass('open');

    $(`.font_size_input`).html('');

    $(`.font_size_input`).prepend(`
      <input type="text" class="input" name="fontSize">
      <button class="btn">적용</button>
    `);

    $('.modal input[name="fontSize"]').spinner({
      max: 999,
      min: 1
    }).attr('readonly', true);

    if (target == "page_add") {
      $(`.modal`).attr('data-id', data.idx);
      $(`.open .input[name="page_name"]`).val("신규 페이지");
    }

    if (target == "page_mod") {
      const keys = ["name", "code", "title", "keyword", "description"];

      keys.forEach((v, i) => {

        $(`.modal input[data-type="${v}"]`).val(data[v]);
      })
    }

    if (target == "menu_mod") {
      $(`.popup_content[data-type="menu"] select`)
        .html('<option value="">URL선택</option>')
        .append([...Page.list.values()]
        .filter(v => v.code != "")
        .map(v => { return `<option value="${v.code}">${v.code}</option>` }));

      $(`.header_rap .menu a`).each((i, v) => {
        $($(`.popup_content[data-type="menu"] input`)[i]).attr('data-save', $(v).text()).val($(v).text());
      })
    }

    if (target == "text_info_change") {
      const hasClass = data.attr('class').split(" ").find(v => v.includes("title") || v.includes("ex") || v.includes("txt") || v.includes("sub")).split("_");

      if (hasClass[1] == "title") {
        $(`.modal .open .popup_content, .modal .open .color_picker`).attr('data-type', `${hasClass[0]}_title`);
        $(`.modal .open .popup_content .input`).attr('data-type', `${hasClass[0]}_title`);
      }

      if (hasClass[1] == "ex") {
        $(`.modal .open .popup_content, .modal .open .color_picker`).attr('data-type', `${hasClass[0]}_ex`);
        $(`.modal .open .popup_content .input`).attr('data-type', `${hasClass[0]}_ex`);
      }

      if (hasClass[1] == "txt") {
        $(`.modal .open .popup_content, .modal .open .color_picker`).attr('data-type', `${hasClass[0]}_txt`);
        $(`.modal .open .popup_content .input`).attr('data-type', `${hasClass[0]}_txt`);
      }

      const modTarget = data;
      const fontSize = Math.round(data.css('font-size').replaceAll('px', "") * 1);

      $(`.open .font_size_input`).attr('data-save', fontSize);
      $(`.open .input[name="fontSize"]`).val(fontSize);
      $(`.open textarea`).attr('data-save', modTarget.text()).val(modTarget.text());
    }

    if (target == "link_mod") {
      if (data.hasClass('visual_link')) {
        $(`.open .popup_content`).attr('data-type', 'visual_link');
        $(`.open .popup_content .input`).attr('data-type', 'visual_link');
      }

      $(`.open .popup_content .input[name="text"]`).attr('data-save', data.text()).val(data.text());
      $(`.open .popup_content .input[name="url"]`).attr('data-save', data.find(`a`).attr('href')).val(data.find(`a`).attr('href'));
    }

    if (target == "title_mod") {
      const val = $(`.active_section .section_title h2`).html();
      $(`.popup.open .popup_content`).attr('data-type', "section_title");
      $(`.popup.open .popup_content .input[name="title"]`)
        .val(val)
        .attr('data-save', val)
        .attr('data-type', 'section_title');
    }

    if (target == "color_change") {
      $(`.now_mod_con`).removeClass('now_mod_con');

      if (Preview.nowSection == "contact_prev") {
        $(`.contact_form`).addClass('now_mod_con');
      }

      if (Preview.nowSection == "footer_prev") {
        $(`.footer_prev`).addClass('now_mod_con');
      }
    }
    
    save();
  },

  close() {
    $(`.modal, .popup`).removeClass('open');
    $(`.modal .input`).val('');
    $(`.font_size_input`).html('');
    save();
  }
}

// 페이지 로드후 실행
$(() => {
  App.init();
});