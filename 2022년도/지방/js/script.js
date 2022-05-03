// 디버깅 함수
const dd = console.log;
// 기본함수
const App = {
  // 초기화
  init() {
    App.hook();
    if (window.location.pathname.includes("sub2")) {
      Card.init();
    }

    if (window.location.pathname.includes("sub3")) {
      Review.list();
    }
  },

  // 이벤트 함수
  hook() {
    $(document)
      .on(`click`, ".popup_close", Modal.close)
      .on(`input`, ".phone_input", (e) => {
        const val = e.target.value
          .replace(/[^0-9]/g, "")
          .substring(0, 11)
          .replace(/^(\d{0,3})(\d{0,4})(\d{0,4})$/g, "$1-$2-$3")
          .replace(/\-{1,2}$/g, "")

        e.target.value = val;
      })
      .on(`mousemove mouseleave mouseout`, ".form_star .star_div", (e) => {
        if (e.offsetX >= 182) {
          return;
        }

        const val = Math.ceil(e.offsetX / 18.2);

        if (val <= -1) {
          return;
        }

        $(`.form_star .star_div .fill_star`).css('width', val * 18.2 + "px");
        $(`.star_input`).val(val);
        $(`.form_star .score_html`).html(val);
      })
      .on(`input`, ".file_input", (e) => {
        const files = Object.values(e.target.files);
        let err = false;

        files.forEach(v => {
          if (err) {
            return;
          }

          v.type != "image/jpeg" && v.name.split(".")[1] !="jpg" ? err = true : "";
        });

        if (err) {
          alert('이미지는 jpg 파일만 업로드 가능합니다.');
          e.target.value = "";
          return;
        }
      })
      .on(`submit`, ".review_form", (e) => {
        e.preventDefault();

        let err = false;
        const vali = [];

        $(e.target).find('input:not(.file_input), textarea').toArray().forEach(v => {
          if (err) {
            return;
          }

          if (v.value.trim() == "") {
            err = true;
          }

          if (err) {
            return;
          }

          if (v.name == "name" && !v.value.match(/^[ㄱ-힣A-Za-z]{2,50}$/)) {
            vali.push("이름은 한글과 영어로 2에서 50자 사이로 입력가능합니다.");
          }

          if (v.name == "contents" && v.value.length < 100) {
            vali.push("내용은 100자 이상 입력되어야 합니다.");
          }
        });

        const fileInput = $(e.target).find(`.file_input`);
        const fileEmp = fileInput.toArray().filter(v => !$(v).val());

        if (err || fileInput.length == fileEmp.length) {
          alert('필수 입력값이 누락되었습니다.');
          return;
        }

        if (vali.length) {
          alert(vali.join('\n'));
          return;
        }

        const formData = new FormData(e.target);

        $.ajax({
          url: `api/reviews`,
          processData: false,
          contentType: false,
          data: formData,
          type: "POST"
        }).done((res) => {
          alert(res.message);
          Review.list(10, true);
          Modal.close();
        }).fail((res) => {
          alert(res.responseJSON.message);
        })

        // alert('구매 후기가 등록되었습니다.');
        // Modal.close();
      })
      .on(`mousewheel`, (e) => {
        if (!window.location.pathname.includes("sub3") || Review.load) {
          return;
        }

        const windowSize = $(window).scrollTop() + $(window).height();

        if (windowSize >= $(`.review_list`).offset().top + $(`.review_list`).height()) {
          Review.list(Review.key + 10);
        }
      })
  }
}

const Review = {
  key: 10,
  data: [],
  load: false,
  nowView: "",

  list(key = Review.key, write = false) {
    Review.load = true;

    $.get(`/api/reviews?last-key=${key}`).done((res) => {
      if (write) {
        Review.data.pop();
        Review.data.unshift(res.reviews[0]);
        $(`.review_list`).html(Review.data.map(v => Review.reviewTemp(v)));
        Review.load = false;
        return;
      }

      if (!res.reviews.length || JSON.stringify(res.reviews[0]) == JSON.stringify([...Review.data].slice(Review.data.length - 10, Review.data.length))) {
        return;
      }

      Review.key = key;
      Review.data.push(...res.reviews);

      $(`.review_list`).html(Review.data.map(v => Review.reviewTemp(v)));
      Review.load = false;
    }).fail((res) => {
      alert(res.responseJSON.message);
    })
  },

  reviewTemp(v) {
    return `
      <div class="review_item" onclick="Review.detail(${v.key})">
        <div class="review_img">
          <img src="${v.photo}" alt="photo" title="photo" onerror="$(this).parent().html('<h2>No Image</h2>')">
        </div>

        <div class="review_content">
          <div class="review_title flex alc js">
            <h2>구매품 : ${v.product}</h2>
            <p class="color">글번호 : ${v.key}</p>
          </div>

          <p class="fw100">내용 : ${v.contents} ...</p>

          <div class="review_bottom">
            <p>이름(작성자) : ${v.name}</p>
            <p>구매처 : ${v.shop}</p>
            <p>구매일 : ${v['purchase-date']}</p>
          </div>

          <div class="review_star flex alc" style="justify-content: flex-end;">
            <p class="score_html">별점 : ${v.score}점</p>

            <div class="star_div">
              <p class="emp_star">☆☆☆☆☆</p>
              <p class="fill_star" style="width: calc(18.2 * ${v.score}px);">★★★★★</p>
            </div>
          </div>
        </div>
      </div>
    `
  },

  detail(key) {
    $.get(`/api/reviews/${key}`).done((res) => {
      Modal.close();
      Modal.open('review_detail');

      Review.nowView = key;
      $(`.detail`).html(key);
      $(`.review_detail`).html(Review.detailTemp(res));

      if (res.photos.length) {
        const bigImg = `<img src="${res.photos[0].file}">`;
        $(`.review_big`).html(bigImg);
      } else {
        $(`.review_big`).html(`<h2 class="tlc" style="padding-top: 23rem;">No Image</h2>`)
      }
    }).fail((res) => {
      alert(res.responseJSON.message);
    })
  },

  detailTemp(data) {
    const img = data.photos.map((v, i) => {
      if (i == 0) {
        return;
      }

      return `<img src="${v.file}" onclick="Review.bigChange(this)">`
    });

    return `
      <ul>
        <li>이름</li>
        <li><input type="text" class="input name_input" name="name" value="${data.name}" readonly></li>
      </ul>
      <ul>
        <li>구매품</li>
        <li><input type="text" class="input" name="product" value="${data.product}" readonly></li>
      </ul>
      <ul>
        <li>구매처</li>
        <li><input type="text" class="input" name="shop" value="${data.shop}" readonly></li>
      </ul>
    <ul>
      <li>구매일</li>
      <li><input type="date" class="input" name="purchase-date" value="${data['purchase-date']}" readonly></li>
    </ul>
    <ul>
      <li class="flex alc js">
        <p>
          내용
        </p>
      </li>
      <li>
        <textarea name="contents" class="input" cols="30" rows="3" style="resize: none;" value="${data.contents}" readonly></textarea>
      </li>
    </ul>
    <ul>
      <li>별점</li>
      <li>
        <div class="review_star flex alc">
          <p style="margin-top: .6rem;">별점 : <span class="score_html">${data.score}</span>점</p>
          
          <div class="star_div">
            <p class="emp_star">☆☆☆☆☆</p>
            <p class="fill_star" style="width: calc(18.2 * ${data.score}px)">★★★★★</p>
          </div>
        </div>
        <input type="hidden" name="score" class="star_input">
      </li>
    </ul>
    <ul>
      <li class="flex alc js">
        <p>사진</p>
      </li>
      <li class="img_input_area">
        ${img.join("")}
        </li>
      </ul>
      
      <div class="after_line"></div>
      
      <div class="flex alc">
        <button class="btn" style="width: 50%;" onclick="Review.detail(Review.nowView + 1)">이전</button>
        <button class="btn" style="width: 50%;" onclick="Review.detail(Review.nowView - 1)">다음</button>
      </div>
    `
  },

  bigChange(target) {
    const bef = $(target).attr('src');
    const changeTarget = $(`.review_big img`).attr('src');

    $(target).attr('src', changeTarget);
    $(`.review_big img`).attr('src', bef);
  },
}

const Card = {
  data: [],
  randData: [],
  time: 0,
  timer: "",
  flipTimer: "",
  findTimer: "",
  hintTimer: "",
  target: "",
  start: false,
  find: [],

  init() {
    Card.setData();
    Card.hook();
  },

  hook() {
    $(document)
      .on(`click`, ".game_start", Card.gameStart)
      .on(`click`, ".card_box", (e) => Card.click(e))
      .on(`click`, ".hint_view", () => Card.hintView())
      .on(`submit`, ".event_form", (e) => Card.result(e))
  },

  setData() {
    const data = `L001	창원시	풋고추		풋고추, 단감, 수박, 홍합
    L002	진주시	고추		고추, 마, 실크, 배
    L003	통영시	굴		굴, 진주, 나전칠기
    L004	사천시	멸치		멸치, 단감, 쥐치포, 옹기
    L005	김해시	단감		단감, 화훼, 참외, 도자기
    L006	밀양시	대추		대추, 깻잎, 사과, 풋고추, 도자기
    L007	거제시	유자		유자, 죽순, 알로에, 한라봉, 천혜향
    L008	양산시	매실		매실, 버섯, 딸기, 달걀, 당근
    L009	의령군	수박		수박, 호박, 한지, 버섯
    L010	함안군	곶감		곶감, 수박, 파프리카, 연근
    L011	창녕군	양파		양파, 마늘, 고추, 단감
    L012	고성군	방울토마토	방울토마토, 멸치젓, 대하
    L013	남해군	마늘		마늘, 고사리, 멸치
    L014	하동군	녹차		녹차 인삼, 배, 작설차
    L015	산청군	약초		약초, 곶감, 동충하초, 누에가루, 황화씨
    L016	함양군	밤		밤, 흑돼지, 포도, 명주, 산채, 농악기
    L017	거창군	사과		사과, 덩굴차, 딸기, 포도
    L018	합천군	돼지고기		돼지, 작약, 양파,  돗자리, 왕골, 도자기, 한과`
    .replaceAll("\t\t", "\t").split("\n").map((v, i) => {
      const item = v.split("\t");
      return {idx: i + 1, code: item[0], location: item[1], product: item[2], itemList: item[3]};
    })

    Card.data = data;
    Card.setList();
  },

  gameInit(restart = false) {
    clearInterval(Card.timer);
    clearTimeout(Card.flipTimer);
    clearTimeout(Card.findTimer);
    clearTimeout(Card.hintTimer);
    Card.randData = [];
    Card.time = 0;
    Card.timer = "";
    Card.flipTimer = "";
    Card.findTimer = "";
    Card.hintTimer = "";
    Card.target = "";
    Card.start = false;
    Card.find = [];

    Card.setList();
    $(`.hint_view`).addClass('btn_disa');
    $(`.game_start`).html("게임시작").removeClass('btn_disa');
    $(`.min, .sec`).html("00");
    $(`.find_c, .last_c`).html("0");
    $(`.event_form input`).val("");
    $(`.form_area`).addClass('none');

    if (restart) {
      Card.gameStart();
    }
  },

  gameStart() {
    if (Card.start) {
      Card.gameInit(true);
      return;
    }

    $(`.game_start`).addClass("btn_disa");
    $(`.card`).addClass('flip');
    $(`.min, .sec`).html("00");

    Card.timeSet(5000);

    setTimeout(() => {
      $(`.game_start`).html("다시하기").removeClass('btn_disa');
      $(`.card_list`).removeClass('pointerNone');
      $(`.card`).removeClass('card_ani').removeClass('flip');
      $(`.min, .sec`).html("00");

      setTimeout(() => {
        Card.timeSet(90000);
        Card.start = true;
        $(`.hint_view`).removeClass('btn_disa');
        // $(`.card`).removeClass('flip');
      }, 400);
    }, 4600);
  },

  click(e) {
    const target = $(e.currentTarget);
    const card = target.find('.card');

    if (card.hasClass('flip') || card.hasClass('findCard') || $(`.flip`).length >= 2) {
      return;
    }

    clearTimeout(Card.findTimer);

    const idx = target.data('idx');
    card.addClass('flip');

    if (!Card.target) {
      Card.target = idx;

      Card.findTimer = setTimeout(() => {
        Card.target = "";
        $(`.flip`).removeClass('flip');
      }, 3000);
    } else {
      Card.ck(idx);
    }
  },

  ck(idx) {
    if (Card.target == idx) {
      Card.find.push([Card.target, idx]);
      Card.target = "";

      $(`.flip`).addClass('findCard').removeClass('flip');
      $(`.findCard`).find('.back_text, .back_ck img:nth-child(1)').removeClass('none');

      $(`.find_c`).html(Card.find.length);

      if (Card.find.length == 8) {
        Card.gameEnd();
      }
    } else {
      Card.flipTimer = setTimeout(() => {
        $(`.flip`).removeClass('flip');
        Card.target = "";
      }, 300);
    }
  },

  hintView() {
    clearTimeout(Card.findTimer);
    clearTimeout(Card.flipTimer);
    Card.target = "";

    $(`.hint_view`).addClass('btn_disa');
    $(`.card:not(.findCard)`).addClass('flip');
    $(`.card_list`).addClass('pointerNone');

    Card.hintTimer = setTimeout(() => {
      $(`.flip`).removeClass('flip');
      $(`.hint_view`).removeClass('btn_disa');
      $(`.card_list`).removeClass('pointerNone');
    }, 3000);
  },

  gameEnd() {
    clearInterval(Card.timer);
    $(`.hint_view`).addClass('btn_disa');
    $(`.last_c, .find_c`).html(Card.find.length);
    $(`.card_list`).addClass('pointerNone');

    $(`.card:not(.findCard)`).addClass('notFind');
    $(`.notFind`).find('.back_text, .back_ck img:nth-child(2)').removeClass('none');

    $(`.score_val`).val(Card.find.length);

    setTimeout(() => {
      $(`.form_area`).removeClass('none');
      $(`.form_area`)[0].scrollIntoView(true);
    }, 300);
  },

  result(e) {
    e.preventDefault();
    let err = false;
    const vali = [];

    $(e.target).find('input').toArray().forEach(v => {
      if (err) {
        return;
      }

      if (v.value.trim() == "") {
        err = true;
      }

      if (err) {
        return;
      }

      if (v.name == "name" && !v.value.match(/^[ㄱ-힣A-Za-z]{2,50}$/)) {
        vali.push("이름은 한글과 영어로 2에서 50자 이내로 작성 가능합니다.");
      }

      if (v.name == "phone" && !v.value.match(/^\d{3}-\d{4}-\d{4}$/)) {
        vali.push("핸드폰번호는 11자리 숫자만 입력 가능합니다.");
      }
    });

    if (err) {
      alert('필수 입력값이 누락되었습니다.')
      return;
    }

    if (vali.length) {
      alert(vali.join("\n"));
      return;
    }

    const formData = new FormData(e.target);

    $.ajax({
      url: '/api/event/applicants',
      processData: false,
      contentType: false,
      data: formData,
      type: "POST"
    }).done((res) => {
      alert(res.message);
      Card.stamp();
    }).fail((res) => {
      alert(res.responseJSON.message);
      Card.stamp();
    })
  },

  stamp() {
    $(`.check_box`).html(`
      <div class="stamp stamp_none">
        <img src="resources/stamp_none.png" alt="stamp" title="stmap">
      </div>
      <div class="stamp_none stamp">
        <img src="resources/stamp_none.png" alt="stamp" title="stmap">
      </div>
      <div class="stamp_none stamp">
        <img src="resources/stamp_none.png" alt="stamp" title="stmap">
      </div>
    `);

    $(`.chain_`).html(`3일 연속으로 출석으로 경품행사에 참여하세요!`);

    $.get(`/api/event/${$(`.phone_input`).val()}/stamps`).done((res) => {
      res.stamps.forEach((v, i) => {
        if (v.trim() == "") {
          return;
        }

        if (i == 2) {
          $(`.chain_`).html('축하합니다. 3일연속 출석하여 경품선정 대상자가 되었습니다.');
        }

        $($(`.stamp_none`)[0]).html(`
          <img src="resources/stamp.png" alt="stamp" title="stmap">
          <h2>${v}</h2>
        `).removeClass('stamp_none');
      });
      Card.gameInit();
    }).fail((res) => {
      alert(res.responseJSON.message);
    });
  },

  timeSet(time) {
    Card.time = time;
    Card.setTimer(Card.time);

    Card.timer = setInterval(() => {
      Card.time = Card.time - 1000;

      if (Card.time <= 0) {
        clearInterval(Card.timer);
        Card.start ? Card.gameEnd() : "";
      }

      Card.setTimer(Card.time);
    }, 1000);
  },

  setTimer(time) {
    const min = new Date(time).getMinutes();
    const sec = new Date(time).getSeconds();

    $(`.min`).html(min >= 10 ? min : "0" + (min));
    $(`.sec`).html(sec >= 10 ? sec : "0" + (sec));
  },

  setList() {
    const randData = [...Card.data].sort((a, b) => Math.random() - 0.5).slice(0, 8);
    Card.randData = [...randData, ...randData].sort((a, b) => Math.random() - 0.5);

    $(`.game_start`).removeClass('btn_disa');
    $(`.card_list`).html(Card.randData.map(v => Card.cardTemp(v)));
  },

  cardTemp(data, flip = false) {
    return `
      <div class="card_box" data-idx="${data.idx}">
        <div class="card card_ani ${flip ? "flip" : ""}">
          <div class="front"></div>
          <div class="back">
            <div class="back_ck">
              <img class="resImg none" src="resources/check.png" alt="check" title="check">
              <img class="resImg none" src="resources/none.png" alt="check" title="check">
            </div>
            <div class="back_text none">
              ${data.location} - ${data.product}
            </div>
            <img src="resources/특산품/${data.location}_${data.product}.jpg" alt="special" title="special">
          </div>
        </div>
      </div>
    `
  }
}

// 모달 관리
const Modal = {
  open(target) {
    $(`body`).css('overflow', 'hidden');
    $(`.modal, #${target}`).addClass('open');
  },

  close() {
    $(`.popup .fill_star`).css('width', 0);
    $(`.popup .score_html`).html(0);
    $(`.popup .cont_c`).html(0);
    $(`.star_input`).val(0)
    $(`.popup .img_input_area`).html(`<input type="file" class="input file_input" name="photo[]">`);
    $(`body`).css('overflow', 'auto');
    $(`.popup`).find('input, select, textarea').val("");
    $(`.modal, .popup`).removeClass('open');
  }
}

$(() => App.init());