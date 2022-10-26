<!DOCTYPE html>
<html lang="zxx">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="/resources/fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/resources/css/style.css">
  <script src="/resources/js/jquery-3.6.0.min.js"></script>
  <script src="/resources/js/jquery-ui.min.js"></script>
  <script src="/script.js"></script>
</head>
<body>

  <header>
    <div class="header_rap wrap flex alc js">
      <div class="logo">
        <a href="#">
          <img src="/resources/logo.png" alt="logo" title="logo">
        </a>
      </div>

      <ul class="menu">
        <li class="main_menu">
          <button><i class="fa fa-home"></i> Main</button>
        </li>
        <li class="main_menu">
          <button><i class="fa fa-calendar"></i> 체험신청</button>

          <ul class="sub_menu">
            <li><a href="#"><i class="fa fa-calendar"></i> 체험신청</a></li>
            <li class="after_line"></li>
            <li><a href="#">예약하기</a></li>
            <li><a href="#">예약확인</a></li>
          </ul>
        </li>
        <li class="main_menu">
          <button><i class="fa fa-cutlery"></i> food court</button>

          <ul class="sub_menu">
            <li><a href="#"><i class="fa fa-cutlery"></i> food court</a></li>
            <li class="after_line"></li>
            <li><a href="#">예약신청</a></li>
            <li><a href="#">예약조회</a></li>
            <li><a href="#">Q&A</a></li>
          </ul>
        </li>
      </ul>
      
      <div class="search_area flex js">
        <div class="rank_area">
          <div class="rank_slide">
            <div>
              <p class="rank">1</p>
              <p>의령군 날씨</p>
            </div>
            <div>
              <p class="rank">2</p>
              <p>서동생활공원</p>
            </div>
            <div>
              <p class="rank">3</p>
              <p>경남 날씨</p>
            </div>
            <div>
              <p class="rank">4</p>
              <p>전국기능경기대회</p>
            </div>
            <div>
              <p class="rank">5</p>
              <p>웹디자인및개발</p>
            </div>
            <div>
              <p class="rank">1</p>
              <p>의령군 날씨</p>
            </div>
          </div>
        </div>

        <div class="search_angle">
          <i class="fa fa-angle-right"></i>
        </div>

        <div class="search_box flex alc js">  
          <input type="text" placeholder="서동생활공원">
          <div class="search_btn">
            <i class="fa fa-search"></i>
          </div>
        </div>
      </div>
    </div>
  </header>

  <style>
    .sb {
      box-shadow: 0 0 60px rgb(0 0 0 / 7%);
      padding: 2rem;
    }

    .rest_section {
      height: 100%;
    }

    .rest_section .sb {
      width: 85%;
    }

    .top_tab {
      width: 15%;
      height: 100%;
      display: flex;
      flex-direction: column;
      /* align-items: center; */
      position: relative;
      z-index: 9;
    }

    .tab {
      width: 100%;
      height: 55px;
      padding: .3rem 1.5rem;
      font-size: 1.05rem;
      background: #fff;
      /* border-top-left-radius: 15px; */
      /* border-bottom-left-radius: 15px; */
      box-shadow: 0 0 60px rgb(0 0 0 / 3%);
      /* border: 1px solid rgba(0, 0, 0, .07); */
      cursor: pointer;
      display: flex;
      /* flex-direction: column; */
      align-items: center;
      justify-content: space-between;
      text-align: center;
    }

    .tab i {
      font-size: 1.6rem;
    }

    .now_tab {
      background: #333;
      color: #c5e302;
    }

    .form_box {
      width: 100%;
      display: flex;
    }

    /* .form_left { */
      /* width: 30%; */
    /* } */

    .form_right {
      width: 100%;
      padding: 1.8rem;
    }

    .res_form ul li:nth-child(1) {
      font-size: 1.15rem;
      margin-bottom: .3rem;
    }

    .input_grid {
      display: grid;
      grid-gap: 1.2rem;
      grid-template-columns: repeat(2, 1fr);
    }

    .res_grid {
      display: grid;
      grid-gap: 1rem;
      grid-template-columns: repeat(9, 1fr);
    }

    .res_top div {
      width: 100%;
      padding: 1rem 0;
      font-size: 1.1rem;
      text-align: center;
    }

    .res_cont > .res_item {
      margin-bottom: .7rem;
      padding-bottom: .7rem;
      border-bottom: 1px solid rgba(0, 0, 0, .1);
      align-items: center;
      text-align:center;
    }

    .q_item {
      width: 100%;
      display: flex;
      justify-content: space-between;
      padding-bottom: .3rem;
      border-bottom: 1px solid rgba(0, 0, 0, .1);
      margin-bottom: .3rem;
    }

    .q_item a {
      width: 100%;
    }

    .q_item img {
      width: 200px;
      margin-right: 1.2rem;
    }

    .seld {
      position: relative;  
    }

    .sel_btn {
      padding: .2rem 1rem;
      font-size: .85rem;
    }

    .seld::after {
      content: "채택되었습니다";
      position: absolute;
      top: 0;
      left: 4%;
      background: #c5e302;
      color:#000;
      padding: .4rem;
      border-radius: 99999999px;
      font-weight: bold;
      font-size: .8rem;
    }

    .answer_item {
      display:flex;
      align-items: center;
      padding-top: .5rem;
      padding-bottom: .5rem;
      border-bottom: .5px solid rgba(0, 0, 0,.1);
    }
    .user_img {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      border: .5px solid rgba(0, 0, 0, .1);
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      margin-right: 1rem;
    }

    .user_img i {
      font-size: 6rem;
      padding-top: 1rem;
    }
  </style>

  <script>
    let menu = [];
    let nowStore = "서동한식당";

    const menuSet = () => {
      $.get(`/메뉴.txt`).done((res) => {
        const newMenu = {};
        let isKey = "";

        res.split("\n").forEach(v => {
          if (v.trim() == "") {
            return;
          }

          const key = v.trim().split(".");

          if (key.length >= 2) {
            newMenu[key[1].trim()] = [];
            isKey = key[1].trim();
            return;
          }

          const menu = v.trim().split(" ");
          const price = menu.at(-1).replace(",", "").replace("원", "");

          menu.pop();

          newMenu[isKey].push([menu.join(" "), price]);
        });

        menu = newMenu;
        const first = menu[nowStore];
        const price = first[0][1];
        
        $(`.menu_input`).html(first.map(v => `<option value="${v[0]}">${v[0]}</option>`));
        $(`.price_input`)
          .val(price)
          .attr('data-price', price);

        $(`.price_t`).html((price * 1).toLocaleString());
      })
    }

    const timeSet = () => {
      $(`.time_input`).html("");

      for (let i = 11; i <= 21; i++) {
        $(`.time_input`).append(`<option value="${i}:00" ${i > 20 ? "disabled" : ""}>${i}:00</option>`);
        $(`.time_input`).append(`<option value="${i}:30" ${i >= 20 ? "disabled" : ""}>${i}:30</option>`);
      }
    }

    $(document)
      .on(`click`, ".value_con", (e) => {
        const type = $(e.currentTarget).data('type');
        const target = $(e.currentTarget).parent().find('input');

        const changeVal = target[0].value * 1 + type;

        target[0].value = changeVal < 1 ? 1 : changeVal;

        const menuPrice = $(`.price_input`)[0].dataset.price;

        $(`.price_t`).html((menuPrice * target.val()).toLocaleString());
        $(`.price_input`).val(menuPrice * target.val())
      })
      .on(`change`, ".store_sel input", (e) => {
        nowStore = e.target.value;

        const nowMenu = menu[nowStore];

        $(`.count_input`).val(1);
        $(`.price_input`)
          .val(nowMenu)
          .attr('data-price', nowMenu[0][1]);
        $(`.price_t`).html((nowMenu[0][1] * 1).toLocaleString());

        $(`.menu_input`).html(nowMenu.map(v => `<option value="${v[0]}">${v[0]}</option>`))
      })
      .on(`change`, ".menu_input", (e) => {
        const nowMenu = menu[nowStore].find(v => v[0] == e.target.value);
        $(`.count_input`).val(1);
        $(`.price_t`).html((nowMenu[1] * 1).toLocaleString());
        $(`.price_input`)
          .val(nowMenu[1])
          .attr("data-price", nowMenu[1]);
      })
      .on(`input`, ".res_form_1 input, .res_form_1 select", (e) => {
        const trimCk = [];
        const errArr = $(`.res_form_1`).find('input, select').toArray().map(v => {
          if (!v.value.trim()) {
            trimCk.push(true);
            return {name: v.name, err: false};
          }

          trimCk.push(false);

          if (v.name == "time" && ["15", "16", "17"].includes(v.value.split(":")[0])) {
            return {name: v.name, err: false};
          }

          return {name: v.name, err: true};
        })

        const err = errArr.filter(v => !v.err);

        if (!trimCk.includes(true)) {
          if (err.length) {
            $(`.next_btn`).hide();

            $(`.is_able`)
              .show()
              .css('color', "red")
              .html("불가능");
          } else if (!err.length) {
            $(`.next_btn`).show();

            $(`.is_able`)
              .show()
              .css('color', "blue")
              .html("가능");
          }
        }
      })
      .on(`submit`, ".res_form_2", (e) => {
        e.preventDefault();

        const data = $(e.target).find('input:not(input[type="hidden"])');
        let isPhone = false;

        const msg = data.toArray().map(v => {
          if (v.name == "name" && (!v.value.trim() || v.value.match("/\s/", 'g'))) {
            return `이름은 공백을 입력할 수 없습니다.`;
          }

          if (!v.value.trim() && !v.name.includes("p_")) {
            return `${v.dataset.name}을(를) 입력해주세요.`;
          }

          if (v.name.includes("p_") && !isPhone) {
            if (!v.value.trim()) {
              isPhone = true;
              return "전화번호를 모두 입력해주세요.";
            }
          }

          if (v.name == "email" && !v.value.match(new RegExp("^[a-zA-Z0-9+-\_.]+@[a-zA-Z0-9+\_.]+\.[a-zA-Z0-9-.]+$", 'g'))) {
            return "올바른 이메일 형식을 지켜주세요.";
          }

          if (v.name == "pw" && !v.value.match(new RegExp("^[0-9]{4,4}|[a-zA-Z]{4,4}$"))) {
            return "비밀번호는 숫자 또는 영문(대소문자 구분)으로 4자리로 구성되어야합니다.";
          }

          return "";
        });

        const msgs = msg.filter(v => v != "");

        if (msgs.length) {
          alert(msgs.join("\n"));
          return;
        }

        e.target.submit();
      })
      .on(`submit`, ".del_form", (e) => {
        e.preventDefault();
        const conf = confirm("입력된 내용을 삭제하시겠습니까?");

        if (!conf) {
          return;
        }

        // e.target.submit();
        location.href = '/form/del';
      })
      .on(`submit`, ".read_form", (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);

        $.ajax({
          url: "/post/resRead",
          contentType: false,
          processData: false,
          type: "POST",
          data: formData,
        }).done((res) => {
          $(`.res_cont`).html(res.map(v => `
          <div class="res_grid res_item">
                <div>${v.store}</div>
                <div>${v.date} <br> ${v.time}</div>
                <div>${v.menu} <br> ${v.count}인분</div>
                <div>${v.person}명</div>
                <div>${v.name}</div>
                <div>${(v.price * 1).toLocaleString()}</div>
                <div>${v.p_1}-${v.p_2}-${v.p_3}</div>
                <div>${v.email}</div>
                <div>
                  <button class="btn" onclick='recptSet(${JSON.stringify(v)})' style="padding: .3rem 1.2rem;">영수증</button>
                </div>
              </div>
          `));
        })
      })
      .on(`submit`, ".a_sel_form", (e) => {
        e.preventDefault();

        $.post(`/sel/answer`, {pw: $(`.sel_pw`).val(), idx: $(`.a_idx`).val(), q_idx: $(`.q_idx`).val()}).done((res) => {
          if (res == "") {
            alert("비밀번호가 일치하지 않습니다.");
            return;
          }

          alert('채택되었습니다.');
          
          $(`.a_list`).html(res);
          Modal.close();
        })
      })

    const recptSet = (data) => {
      recData = data;
      Modal.open('recpt');
    }

    const drawRec = (type) => {
      const c = $(`<canvas width="450" height="300"></canvas>`)[0];
      const ctx = c.getContext('2d');

      ctx.fillStyle = "#fff";
      ctx.fillRect(0, 0, 450, 300);

      ctx.font = "36px bold sans-sarif";
      ctx.fillStyle = "#333";
      ctx.fillText("영수증", 225 - 50, 48);

      ctx.moveTo(10, 60);
      ctx.lineTo(450, 60);
      ctx.lineWidth = 0.5;
      ctx.setLineDash([20]);
      
      ctx.font = "20px sans-sarif";
      
      ctx.fillText("예약일시", 10, 90);
      ctx.textAlign = "right";
      ctx.fillText(recData['date'] + " " + recData['time'], 450 - 15, 90);
      
      ctx.moveTo(10, 102);
      ctx.lineTo(450, 102);
      ctx.lineWidth = 0.5;
      ctx.setLineDash([20]);

      ctx.textAlign = "left";

      ctx.fillText("선택한 식당", 10, 140);
      ctx.fillText("인원", 10, 170);
      ctx.fillText("메뉴", 10, 200);
      ctx.fillText("예약자명", 10, 230);

      ctx.textAlign = "right";

      ctx.fillText(recData['store'], 450 - 15, 140);
      ctx.fillText(recData['person'] + "명", 450 - 15, 170);
      ctx.fillText(recData['menu'] + " " + recData['count'] + "인분", 450 - 15, 200);
      ctx.fillText(recData['name'], 450 - 15, 230);

      ctx.moveTo(10, 250);
      ctx.lineTo(450, 250);
      ctx.lineWidth = 0.5;
      ctx.setLineDash([20]);
      ctx.stroke();

      ctx.font = "24px sans-sarif";

      ctx.fillText((recData['price'] * 1).toLocaleString(), 450 - 15, 285);
      ctx.textAlign = "left";
      ctx.fillText("가격", 10, 285);

      $(`<a href="${c.toDataURL()}" download="금액 영수증.${type}"></a>`)[0].click();
    }

    const selAnswer = (aId, qId) => {
      Modal.open('sel');
      $(`.a_idx`).val(aId);
      $(`.q_idx`).val(qId);
    }

    $(() => {
      menuSet();
    });
  </script>