// 디버깅 함수
const dd = console.log;

const valiForm = {
  "join_form": {
    "name": ["^[ㄱ-힣]{2,5}$", true, "이름은 한글 2글자 이상 5글자 이하여야 합니다."],
    "id": ["^(?=.*[a-zA-Z])(?=.*[0-9])[0-9a-zA-Z]+$", true, "아이디는 영문 및 숫자로 조합되어야 합니다."],
    "id_ck": ["", true, "아이디 중복 여부를 확인해주세요."],
    "pw": ["^(?=.*[a-zA-Z])(?=.*[0-9]).{8,}$", true, "비밀번호는 영문 및 숫자 조합 8글자 이상이어야 합니다."],
    "phone": ["", true, "전화번호는 필수 입력값입니다."],
    "captcha": ["", true, "캡챠를 입력해주세요."],
    "image": ["", true, "이미지를 입력해주세요."],
    "category_id": ["", true, "분야를 선택해주세요."],
  },
  "busking_enr_form": {
    "title": ["", true, "모든 값을 입력해주세요."],
    "contents": ["", true, "모든 값을 입력해주세요."],
    "personnel": ["^[0-9]+$", true, "모집인원은 숫자만 입력가능합니다."],
    "category_id": ["", true, "모든 값을 입력해주세요."],
    "page": ["", true, "모든 값을 입력해주세요."],
    "category": ["", true, "모든 값을 입력해주세요."],
  },
}

const vali = (form) => {
  const formData = $(`.${form}`).serializeArray();
  const err = [];

  for (let v of formData) {
    const [reg, req, msg] = valiForm[form][v.name];

    if (req && !v.value.trim()) {
      return "모든 값을 입력해주세요.";
    }

    if (reg && !v.value.match(new RegExp(reg, `g`))) {
      err.push(msg);
    }
  }

  return err.join("\n") || "pass";
}

let idCk = false;

const overlapCk = () => {
  if ($(`.user_id`).val().trim() == "") {
    alert('아이디를 입력해주세요.');
    return;
  }

  if (!$(`.user_id`).val().match(new RegExp("^(?=.*[a-zA-Z])(?=.*[0-9])[0-9a-zA-Z]+$", 'g'))) {
    alert('아이디는 영문 및 숫자로 조합되어야 합니다.');
    return;
  }

  $.post(`/post/idCk`, {input: $(`.user_id`).val()}).done((res) => {
    if (res.length) {
      $(`.id_err`).html(`이미 사용중인 아이디입니다.`).css('color', "#d62527");
      return;
    }

    $(`.id_err`).html('사용 가능한 아이디입니다.').css('color', "#232fa9");
    idCk = true;
  })
}

// 기본함수
const App = {
  init() {
    App.hook();

    if (location.pathname.includes("view")) {
      Preview.init();
    }

    if (location.pathname.includes("info")) {
      Chart.init();
    }
  },

  hook() {
    $(document)
      .on(`click`, ".gallery_item", (e) => {
        $(`.gallery_item`).removeClass("now_gal");

        if ($(e.currentTarget).hasClass("now_gal")) {
          $(e.currentTarget).removeClass('now_gal');
        } else {
          $(e.currentTarget).addClass('now_gal');
        }
      })
      .on(`click`, ".prev_btn", (e) => {
        sessionStorage['prev_garden'] = $(e.currentTarget).data('garden');
        const size = "width=1200,height=900";
        window.open("view.html", "", size);
      })
      .on(`click`, ".down_btn", Chart.downLoad)
      .on(`click`, ".popup_close", Modal.close)
      .on(`input`, ".user_id", (e) => {
        $(`.id_err`).html("");
      })
      .on(`submit`, ".join_form", (e) => {
        e.preventDefault();

        const msg = vali("join_form");
        
        if (msg != "pass") {
          alert(msg);
          return;
        }

        if ($(`.cap_input`).val() != Modal.cap) {
          alert('캡챠를 다시 확인해주세요.');
          return;
        }

        if (!idCk) {
          alert('아이디 중복여부를 확인해주세요.');
          return;
        }        

        ajax(e.target, "/post/join");
      })
      .on(`input`, ".file_input", (e) => {
        const file = Object.values(e.target.files)[0];

        if (file.type.split("/")[0] != "image") {
          alert('이미지만 올릴 수 있습니다.');
          e.target.value = "";
        }
      })
      .on(`submit`, ".login_form", (e) => {
        e.preventDefault();

        ajax(e.target, "/post/login");
      })
      .on(`input`, ".num_input", (e) => {
        const val = $(e.target).val().replaceAll(/[^0-9]/g  , "");
        e.target.value = val;
      })
      .on(`submit`, ".busking_enr_form", (e) => {
        e.preventDefault();

        const msg = vali("busking_enr_form");

        if (msg != "pass") {
          alert(msg);
          return;
        }

        if ($(`input[name="personnel"]`).val() * 1 <= 0) {
          alert('모집인원은 최소 1명 이상이어야 합니다.');
          return;
        }

        ajax(e.target, '/post/recruit');
      })
  }
}

// ajax 함수
const ajax = (form, url) => {
  const formData = new FormData($(form)[0]);
  
  $.ajax({
    url: url,
    processData: false,
    contentType: false,
    data: formData,
    type: 'POST',
    enctype: 'multipart/form-data',
  }).done((res) => {
    switch (res[0]) {
      case "join":
        alert(res[1]);
        location.href = '/';        
        break;

      case "login":
        if (res[1] == "err") {
          alert('아이디 혹은 비밀번호를 다시 확인해주세요.');
          return;
        }

        $(`.user_btn`).html(`<a href="/logout" class="btn"><i class="fa fa-user-minus"></i> 로그아웃</a>`);

        if (res[2]) {
          $(`.mypage_link`).html(`<a href="/admin/${res[2]}">관리자페이지</a>`);
        }

        alert(res[1]);
        Modal.close();
        break;

      case "recruit":
        alert(res[1]);
        $.post(`${res[2]}`).done((res) => {
          $(`.rec_list`).html(res.map(v => {
            return `
              <div class="rec_item">
                <a href="/recDetail/${v.id}">
                  <div>
                    <div class="bold">${v.title}</div>
                  </div>
                  <div>
                    <div>${v.user_name}</div>
                  </div>
                  <div>
                    <div>${v.create_dt}</div>
                  </div>
                  <div>
                    <div>${v.category}</div>
                  </div>
                </a>
              </div>
            `
          }))

          Modal.close();
        })
        break;
    }
  })
}

const ScheduleView = (data) => {
  $.post("/get/buskings", {data: data}).done((res) => {
    Modal.open('schedule');

    $(`.popup_content`).html(res.map(v => {
      return `
        <h2 style="margin-bottom: .5rem;">${v.time}</h2>

        <div class="modal_schedule">
          <div class="flex alc js">
            <p>버스킹 이름: ${v.name}</p>
            <p>버스커 아이디: ${v.user_id}</p>
            <p>버스킹 분야: ${v.category}</p>
          </div>
        </div>
      `
    }))
  })
}

// 정원 미리보기 기능
const Preview = {
  init() {
    const garden = sessionStorage['prev_garden'];

    const viewBox = $(`
      <div class="view_box flex alc jc">
        <div class="cube_wrap">
          <div class="cube">
            <div class="view front"></div>
            <div class="view right"></div>
            <div class="view back"></div>
            <div class="view left"></div>
            <div class="view top"></div>
            <div class="view bottom"></div>
          </div>
        </div>
      </div>
    `);

    viewBox.find('.view').css('background-image', `url(/resources/garden/${garden}/${garden}.png)`);
    $(`body`).html(viewBox);

    Preview.moveX = Preview.moveY = 0;
    $(`.cube`).css('transform', 'rotateX(0deg) rotateY(0deg)');

    Preview.hook();
  },

  hook() {
    $(document)
      .on(`mousemove mousedown mouseup moveleave`, (e) => Preview.move(e))
  },

  move(e) {
    const pos = [e.pageX, e.pageY];

    switch (e.type) {
      case "mousedown":
        Preview.hold = true;
        Preview.prev = pos;
        break;
    
      case "mousemove":
        if (!Preview.hold) {
          return;
        }

        Preview.moveX += (Preview.prev[1] - e.pageY) / 10;
        Preview.moveY += (Preview.prev[0] - e.pageX) / 10;

        Preview.moveX = Preview.moveX > 90 ? 90 : (Preview.moveX < -90 ? -90 : Preview.moveX);

        Preview.rotate(Preview.moveX, Preview.moveY);
        Preview.prev = pos;
        break;

      case "mouseleave":
      case "mouseup":
        Preview.hold = false;
        break;
    }
  },

  rotate(x, y) {
    $(`.cube`).css('transform', `rotateX(${-x}deg) rotateY(${y}deg)`);
  }
}

const Chart = {
  nowGarden: [],
  nowLabel: [],

  init() {
    Chart.load();
  },

  async load() {
    Chart.data = await $.getJSON("/resources/chart.json");
    Chart.data.data.map(v => {
      v['dataWlabel'] = v.data.map((x, i) => {
        const lb = Chart.data.labels[i];
        return {[lb]: x};
      });
    })

    Chart.setChart();
  },

  setChart() {
    $(`.view_garden_list`).html(Chart.data.data.map(v => `<div class="view_item" onclick="Chart.setGarden('${v.garden}', this)"><div class="color_box" style="background: ${v.color}"></div><p>${v.garden}</p></div>`));

    $(`.label_list`).html(Chart.data.labels.map(v => `<div onclick="Chart.labelSet('${v}', this)"><p>${v}</p></div>`));

    Chart.nowLabel = Chart.data.labels;
    Chart.draw();
  },

  setGarden(garden, target) {
    const isView = Chart.nowGarden.find(v => v == garden);

    if (isView) {
      Chart.nowGarden = Chart.nowGarden.filter(v => v != garden);
      $(target).removeClass('now_view_garden');
    } else {
      if (Chart.nowGarden.length >= 3) {
        alert('정원 데이터는 최대 3개까지만 가능합니다.');
        return;
      }

      Chart.nowGarden.push(garden);
      $(target).addClass('now_view_garden');
    }

    Chart.drawVal();
  },

  labelSet(label, target) {
    const isDraw = Chart.nowLabel.find(v => v == label);

    if (isDraw) {
      if (Chart.nowLabel.length <= 3) {
        alert('항목은 3개 이상이어야합니다.');
        return;
      }
      
      Chart.nowLabel = Chart.nowLabel.filter(v => v != label);
      $(target).addClass('not_draw');
    } else {
      Chart.nowLabel.push(label);
      $(target).removeClass('not_draw');
    }

    Chart.draw();
  },

  draw() {
    let degree = 0;

    let labelHtml = "";
    let boxHtml = "";

    $(`#line_g`)[0].innerHTML = Chart.nowLabel.map((v, i) => {
      const [x, y] = Chart.getPos(degree, 300);
      const [tx, ty] = Chart.getPos(degree, 325);

      dd(Chart.nowLabel.length);
      degree += 360 / Chart.nowLabel.length;

      labelHtml += `<text x="${tx}" y="${ty}" dx="-18.5" dy="${i == 0 ? 0 : 8}" style="font-size: .95rem;">${v}</text>`;
      return `<polyline points="360,360 ${x},${y}" fill="none" stroke="#666" stroke-width="1.5px" />`
    });

    for (let i = 0; i < 6; i++) {
      degree = 0;

      const points = new Array(Chart.nowLabel.length).fill().map(v => {
        const [gX, gY] = Chart.getPos(degree, (300 * (i * 20) / 100));

        degree += 360 / Chart.nowLabel.length;
        return `${gX},${gY}`;
      });

      boxHtml += `<polygon points="${points.join(" ")}" stroke="#666" stroke-width="1.5px" fill="none" />`;
    }

    $(`#label_g`)[0].innerHTML = labelHtml;
    $(`#box_g`)[0].innerHTML = boxHtml;
    $(`#val_g`)[0].innerHTML = [0, 20, 40, 60, 80, 100].map((v, i) => {
      return `<text x="${350 + i * 55}" y="376">${v}</text>`
    });

    Chart.drawVal();
  },

  drawVal() {
    let chartHtml = "";
    
    Chart.nowGarden.map(v => {
      const nowData = Chart.data.data.find(x => x.garden == v);
      let degree = 0;

      const viewLabel = nowData.dataWlabel.filter(_ => Chart.nowLabel.find(k => k == Object.keys(_)));

      const points = viewLabel.map(v => {
        const [gx, gy] = Chart.getPos(degree, (300 * Object.values(v)[0] / 100));

        degree += 360 / Chart.nowLabel.length;
        chartHtml += `<ellipse cx="${gx}" cy="${gy}" rx="5" ry="5" fill="${nowData.color}" />`;
        return `${gx},${gy}`;
      });

      chartHtml += `<polygon points="${points.join(" ")}" fill="${nowData.backgroundColor}" stroke-width="2px" stroke="${nowData.color}" />`;
    });

    $(`#mark_box`)[0].innerHTML = chartHtml;
  },

  getPos(degree, radius) {
    const radian = Math.PI / 180 * degree;
    const x = radius * Math.cos(radian);
    const y = radius * Math.sin(radian);
    return [Math.floor(x + 360), Math.floor(y + 360)];
  },

  downLoad() {
    const svg = new XMLSerializer().serializeToString($(`#chart`)[0]);
    const src = URL.createObjectURL(new Blob([svg], {type: "image/svg+xml;charset=utf-8;"}));
    const img = new Image();

    img.onload = (e) => {
      const c = $(`<canvas width="720" height="720"></canvas>`)[0];
      const ctx = c.getContext('2d');

      ctx.beginPath();
      ctx.clearRect(0, 0, 720, 720);
      
      ctx.fillStyle = "#fff";
      ctx.fillRect(0, 0, 720, 720);
      ctx.drawImage(e.target, 0, 0);
      ctx.closePath();

      $(`<a href="${c.toDataURL()}" download="chart_img.png"></a>`)[0].click();
      $(c).remove();
    }

    img.src = src;
  }
}

const Modal =  {
  temp: (target) => $($(`template`)[0].content).find(`.${target}_popup`).clone(),

  open(target) {
    $(`body`).css('overflow', 'hidden');
    $(`.modal`).addClass('open').html(Modal.temp(target));

    if (target == "join") {
      Modal.makeCap();
    }
  },

  close() {
    $(`body`).css('overflow', 'auto');
    $(`.modal`).removeClass('open').html("");
  },

  makeCap() {
    const strList = new Array(26).fill().map((v, i) => String.fromCharCode(i + 97));
    const numList = [];

    for (let i = 0; i < 10; i++) {
      numList.push(`${i}`);
    }

    strList.sort((a, b) => Math.random() - 0.5);
    numList.sort((a, b) => Math.random() - 0.5);

    const capStr = strList.join("").substring(0, 4) + numList.join("").substring(0, 1);

    const c = $(`#capt`)[0].getContext('2d');
    
    c.font = "32px Arial";
    c.fillText(capStr, 50, 40);

    Modal.cap = capStr;
  }
}

// 페이지 로드 후 실행
$(() => App.init());