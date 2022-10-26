// 디버깅 함수
const dd = console.log;
// 기본함수
const App = {
  init() {
    if (location.pathname.includes("reserve")) {
      Res.init();
    }

    App.hook();
  },

  hook() {
    $(document)
      .on(`input`, ".num_input", (e) => {
        const val = e.target.value.replace(new RegExp("[^0-9]", 'g'), "");
        e.target.value = val;
      })
      .on(`blur`, ".person_input", (e) => {
        if (e.target.value * 1 <= 0) {
          e.target.value = 1;
        }
      })
      .on(`click`, ".popup_close", Modal.close)
      .on(`click`, ".res_type_sel", (e) => {
        Res.nowType = e.target.dataset.type;
        Modal.open(`${Res.nowType}_res`);
      })
      .on(`submit`, ".phone_res", (e) => {
        e.preventDefault();
        const msg = vali("phone_res");
        
        $(`.err`).html("");

        if (msg != "pass") {
          msg.forEach(v => {
            $(`.${v.name}_err`).html(v.msg);
          });

          return;
        }

        if ($(`.pw`).val() != $(`.pw_ck`).val()) {
          $(`.pwck_err`).html("비밀번호와 비밀번호 확인이 일치하지 않습니다.");
        }

        Res.inputData = $(e.target).serializeArray();
        Res.detailSet();
      })
      .on(`submit`, ".number_res", (e) => {
        e.preventDefault();
        const msg = vali("number_res");

        $(`.err`).html("");

        if (msg != "pass") {
          msg.forEach(v => {
            $(`.${v.name}_err`).html(v.msg);
          });

          return;
        }

        Res.inputData = $(e.target).serializeArray();
        Res.detailSet();
      })
      .on(`click`, ".val_con", (e) => Res.peopleCount(e))
      .on(`submit`, ".detail_form", (e) => Res.res(e))
      .on(`click`, ".res_state", () => Modal.open('res_state'))
      .on(`click`, ".state_sel", (e) => {
        Modal.open(e.target.dataset.sel);
      })
      .on(`submit`, ".state_form", (e) => {
        e.preventDefault();
        const type = $(e.target).data('type');
        const resList = localStorage['res'] ? JSON.parse(localStorage['res']) : [];
        const formData = $(e.target).serializeArray();
        let data = [];
        
        if (type == "phone") {
          data = resList.filter(v => v.phone == formData.find(v => v.name == "phone").value && v.password == formData.find(v => v.name == "password").value);
        }

        if (type == "number") {
          data = resList.filter(v => v.number == formData.find(v => v.name == "number").value && v.name == formData.find(v => v.name == "name").value);
        }

        if (!data.length) {
          alert('올바른 정보를 입력해주세요.');
          return;
        }

        Res.viewRes(data);
      })
      .on(`click`, ".print_btn", () => {
        window.onbeforeprint = () => {
          $(`.print_table`).show();
          $(`header, .seciton, footer`).hide();
          $(`.modal`).hide();
        }
    
        window.onafterprint = () => {
          $(`.print_table`).hide();
          $(`header, .seciton, footer`).show();
          $(`.modal`).show();
        }
    
        window.print();
      })
  }
}

// 발리데이트 함수
const forms = {
  "phone_res": {
    "phone": ["^[0-9]+$", true, "숫자만 입력가능합니다."],
    "pw": ["^[0-9]{5,5}$", true, "5자리 숫자만 입력가능합니다."],
    "pwck": ["", true, "필수 입력값입니다."],
  },

  "number_res": {
    "number": ["", true, "필수 입력값입니다."],
    "name": ["", true, "필수 입력값입니다."],
    "date": ["", true, "필수 입력값입니다."],
  },
}

const vali = (form) => {
  const formData = $(`.${form}`).serializeArray();
  const err = [];

  for (let v of formData) {
    const [reg, req, msg] = forms[form][v.name];

    if (req && !v.value.trim()) {
      err.push({"name": v.name, "msg": "필수 입력값입니다."});
      continue;
    }

    if (reg && !v.value.match(new RegExp(reg, 'g'))) {
      err.push({"name": v.name, "msg": msg});
    }
  }

  return err.length ? err : "pass";
}

// 예약하기 관리 객체
const Res = {
  init() {
    Res.load();
  },

  async load() {
    const data = await $.getJSON("/resources/data/reserve.json");
    Res.data = data.data;

    Res.setList();
  },

  viewRes(data) {
    Modal.close();
    Modal.open('res_data');

    $(`.data_view`).html(data.map(v => `
      <div class="data_item">
        <ul>
          <li>예약한 일자</li>
          <li>${v.res_date}</li>
        </ul>
        <ul>
          <li>인원</li>
          <li>성인: ${v.adult}인 / 소인: ${v.child}인 / 원주민: ${v.native}인 | 총 ${v.adult *1 + v.child * 1 + v.native *1}인</li>
        </ul>
        <ul>
          <li>금액</li>
          <li>${v.price}</li>
        </ul>
      </div>
    `));

    $(`.print_list`).html(data.map(v => `
      <tr>
        <td>${v.res_date}</td>
        <td>성인: ${v.adult}인 / 소인: ${v.child}인 / 원주민: ${v.native}인 | 총 ${v.adult *1 + v.child * 1 + v.native *1}인</td>
        <td>${v.price}</td>
      </tr>
    `))
  },

  res(e) {
    e.preventDefault();

    const data = $(e.target).serializeArray();
    let err = "";    

    if (!$(`.date_input`).val()) {
      err += "날짜를 선택해주세요. \n";
    }

    if (Res.priceCalc() <= 0) {
      err += "인원을 입력해주세요. \n";
    }

    if (err != "") {
      alert(err);
      return;
    }

    const saveData = localStorage['res'] ? JSON.parse(localStorage['res']) : [];
    const obj = {};

    [...data, ...Res.inputData].forEach(v => {
      obj[v.name] = v.value;
    });

    saveData.push(obj);
    localStorage['res'] = JSON.stringify(saveData);

    alert('예약이 완료되었습니다.');
    Modal.close();
  },

  detailSet() {
    Res.nowItem = {
      "category": "인기체험관",
      "Image": "1.jpg",
      "parkName": "서동생활공원 인기1",
      "creator": "서동생활공원",
      "period": "2022.7.13 ~ 2022.9.12"
    };

    Modal.open('res_detail');
    $(`.res_img`).html(`
      <img src="/resources/images/${Res.nowItem.Image}" onclick="window.open('/resources/images/${Res.nowItem.Image}')">
      <img src="/resources/images/${Res.nowItem.Image}" onclick="window.open('/resources/images/${Res.nowItem.Image}')">
      <img src="/resources/images/${Res.nowItem.Image}" onclick="window.open('/resources/images/${Res.nowItem.Image}')">
    `);

    Res.prev = "";

    $(`.date_input`).datepicker({
      dateFormat: 'yy-mm-dd',
      prevText: "이전 달",
      nextText: "다음 달",
      monthNames: ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
      dayNamesMin: ["일", "월", "화", "수", "목", "금", "토"],
      showMonthAfterYear: true,
      yearSuffix: "년",
      minDate: 0,

      onSelect() {
        const selDay = new Date($(this).val());

        if (selDay.getDay() == 2) {
          alert('해당 날짜는 선택할 수 없습니다.');
          $(this).val(Res.prev);
          return;
        }

        const per = Res.nowItem.period.split("~");

        if (new Date(per[0]) > selDay || new Date(per[1]) < selDay) {
          alert('해당 기간에는 체험활동 신청이 불가능 합니다.');
          $(this).val(Res.prev);
          return;
        }

        Res.prev = $(this).val();
      },
    })
  },

  peopleCount(e) {
    const total = $(`.adult`).val() * 1 + $(`.child`).val() * 1 + $(`.native`).val() * 1;
    const val = e.currentTarget.dataset.type;
    const target = $(e.currentTarget).parent().parent().find('input');

    const changeVal = target.val() * 1 + val * 1;

    if (total >= 6 && val == 1) {
      alert('체험인원은 6명을 초과 할 수 없습니다.');
      return;
    }

    target[0].value = changeVal < 0 ? 0 : changeVal;

    const totalPrice = Res.priceCalc();
    $(`.price_input`).val(totalPrice);
    $(`.price`).html(totalPrice.toLocaleString());
  },

  priceCalc() {
    return $(`.detail_form`).find('input:not(.date_input):not(.price_input)').toArray().reduce((acc, v) => {
      return acc += v.value * v.dataset.price;
    }, 0);
  },

  setPopup(name) {
    Modal.open('res_type');
    Res.nowItem = Res.data.find(v => v.name == name);
  },

  setList() {
    $(`.card_list`).html(Res.data.filter(v => v.category == "추천체험관" || v.category == "인기체험관").map(v => Html.cardItem(v)));

    $(`.card_list`).animate({
      "margin-left": "0",
    }, 1500);

    $(`.all_card_list`).html(Res.data.map(v => Html.cardItem(v)));

    Res.setSlide();
  },

  setSlide() {
    const slide = $(`.card_list`);
    const bef = slide.find('.card_item').first();
    const clone = bef.clone();

    slide.delay(1200).animate({
      'margin-left': '-342px'
    }, 600, () => {
      bef.remove();
      slide.append(clone);

      slide.animate({
        'margin-left': '0',
      }, 0, () => {
        Res.setSlide();
      })
    })
  }
}

// 템플릿 관리
const Html = {
  cardItem(data) {
    return `
      <div class="card_item" onclick="Res.setPopup('${data.parkName}')">
        <div class="card_text">
          <div class="card_cont">
            <p>${data.creator} - ${data.category}</p>
            <h2>${data.parkName}</h2>
          </div>
        </div>
        <img src="/resources/images/${data.Image}" alt="">
      </div>
    `
  }
}

// 모달 관리
const Modal = {
  temp: (popup) => $($(`template`)[0].content).find(`.${popup}_popup`).clone(),

  open(target) {
    $(`body`).css('overflow', 'hidden');
    $(`.modal`).addClass('open').html(Modal.temp(target));
  },

  close() {
    $(`body`).css('overflow', 'auto');
    $(`.modal`).removeClass('open').html("");    
  }
}

$(() => App.init());