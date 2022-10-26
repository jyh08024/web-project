// 디버깅 함수
const dd = console.log;

const ls = localStorage;

const pad = (num) => {
  return num < 10 ? "0" + num : num;
}

const valiForm = {
  "artist_enr": {
    "inv_num": ["", true, "누락된 값이 있습니다."],
    "artist": ["", true, "누락된 값이 있습니다."],
    "start": ["", true, "누락된 값이 있습니다."],
    "end": ["", true, "누락된 값이 있습니다."],
    "goal": ["^[0-9]+$", true, "모집금액은 숫자만 입력가능합니다."],
  },

  "invest_sign": {
    "inv_num": ["", true, "알맞은 값을 입력해주세요."],
    "artist_name": ["", true, "알맞은 값을 입력해주세요."],
    "invester_name": ["", true, "알맞은 값을 입력해주세요."],
    "invest_val": ["^[0-9]+$", true, "투자금액은 숫자만 입력가능합니다."],
    "inv_id": ["", true, "알맞은 값을 입력해주세요."],
  }
}

const vali = (form) => {
  const formData = $(`.${form}`).serializeArray();
  const err = [];

  for (const v of formData) {
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

// 기본함수
const App = {
  init() {
    if (location.pathname.includes("partici")) {
      Puzzle.init();
    }

    if (location.pathname.includes("enr")) {
      ArtistEnr.init();
    }

    if (location.pathname.includes("invest") || location.pathname.includes("signList")) {
      Invest.init();
    }

    App.hook();
  },
  
  hook() {
    $(document) 
      .on(`submit`, ".artist_enr", (e) => {
        e.preventDefault();
        ArtistEnr.enr(e);
      })
      .on(`click`, ".popup_close", (e) => {
        Modal.close();
      })
      .on(`mousedown mousemove mouseup mouseleave`, "#sign", (e) => Sign.draw(e))
      .on(`submit`, ".invest_sign", (e) => Invest.submit(e))
  },
}

const Puzzle = {
  piece:
    [
      `<svg id="top_left"><path d="M216.05,1.11s.25,26.13,0,50-19.4,29.22-26.63,29.46-14.71-5.85-14.71-5.85c-11.92-8.12-20-4.82-20-4.82s-15.21.25-15.21,24.35,19.15,23.9,19.15,23.9,2.47.57,16-5.71,17.88-5.33,17.88-5.33c22.45,0,23.59,32.73,23.59,32.73V172H144.34c-11.79.19-25.68,17.31-25.68,17.31-6.09,9,8.94,35,8.94,35s4.18,11.42-8.37,17.13S91,242.57,91,242.57c-4.3-.57-18-13.7-7.88-26.26s7.61-20.74,7.61-20.74c-.57-23.4-30.63-24-30.63-24H.73V1.11H216.05" /></svg>`,
      `<svg id="top_center"><path d="M272.7,175.45c5.25,4.14,12.55,11.42,12.55,19.66s-.38,6.85-7.1,18.9-3.93,16.49-3.93,16.49,5.58,14.08,23.58,14.08S321,234.44,321.39,229s-.25-8.64-3.3-14a80.6,80.6,0,0,1-5.32-12v-13.2c0-17,29-18.39,29-18.39h67.52V132.74c0-5-.57-3.42,5.14-16s15.41-12.56,21.87-12.56,8.94,2.28,16,6.66,12.75,1.71,12.75,1.71c5.51-.38,15.21-7.23,15.21-24.35S470.2,61.58,462.4,62.91s-10.65,5.14-10.65,5.14c-7.61,7.8-20.54,6.66-20.54,6.66-21.31,0-22.83-33.11-22.83-33.11V.5h-192s.25,26.13,0,50S197,79.7,189.76,79.94s-14.71-5.85-14.71-5.85c-11.92-8.12-20-4.82-20-4.82s-15.22.25-15.22,24.35,19.15,23.9,19.15,23.9,2.48.57,16-5.71,17.88-5.33,17.88-5.33c22.45,0,23.59,32.73,23.59,32.73v32.16h38.17S266.66,170.69,272.7,175.45Z" /></svg>`,
      `<svg id="top_right"><path d="M469.25,172H409.33V133.2c0-5-.57-3.44,5.14-16s15.41-12.6,21.87-12.6,8.94,2.29,16,6.68S465.07,113,465.07,113c5.51-.38,15.21-7.26,15.21-24.44S470.2,61.79,462.4,63.13s-10.65,5.15-10.65,5.15C444.14,76.11,431.21,75,431.21,75c-21.31,0-22.83-33.22-22.83-33.22V.5H600.5V172h-42s-32.14.74-31.76,23.76c0,0-2.48,7.42,5,17.79s4.94,18.36,4.94,18.36-.09,13-23.77,13-24.73-16.46-24.73-16.46-3.14-6.75,5.7-13.51,6.57-16.65,6.66-16.93S502,184.4,491,178.88,480,173.21,469.25,172Z" /></svg>`,
      `<svg id="center_left"><path d="M115.77,395H215.82V358s1-13.51-5.07-21.88-14.2-14.72-17.75-14.72-10.91,2.54-20.8,8.63-16.48,2.79-16.48,2.79a34,34,0,0,1-12.18-26.64,30.19,30.19,0,0,1,14-25.62s5.33-3.49,14.46,2.57,7.61,8.7,18,8.27,14.71-3.23,17.76-9.57,8.11-10.79,8.11-27.34l.57-83.15H144.2c-11.79.19-25.77,17.69-25.77,17.69-6.08,9,8.94,35,8.94,35s4.19,11.41-8.37,17.12-28.26,1.14-28.26,1.14c-4.3-.57-18-13.7-7.88-26.26s7.61-20.74,7.61-20.74c-.57-23.4-30.62-24-30.62-24H.5V395H34s27.64-8.82,28.66-18.45-.26-14.21-2.79-20.3S52,345.29,51.73,336.66s8.37-18.51,23.59-18.51,27.14,7.61,27.14,15.72-5.84,18.52-8.12,23.34-4.06,6.6-4.06,13.7,0,9.14,7.87,14.72S109.05,395,115.77,395Z" /></svg>`,
      `<svg id="center_center"><path d="M409.65,354.79s-2.22-12.37-7-18.07-12.18-10.85-15.79-10.66-10.84,1.14-24.73,7.8c0,0-7,2.86-11.6,3.05,0,0-18.07-3.24-18.07-21.31s9.7-26.45,16.73-26.45,8.75-.38,16.74,4.94,8.94,6.47,20,6.47,17.5-11.42,17.5-11.42,6.21-8.75,6.21-19.21V171.79H342.12s-29,1.4-29,18.4v13.19a81,81,0,0,0,5.32,12.06c3,5.33,3.68,8.51,3.3,14S316.13,245,298.12,245s-23.58-14.08-23.58-14.08-2.79-4.44,3.93-16.49,7.1-10.66,7.1-18.9S278.27,180,273,175.88c-6-4.77-18.13-4.09-18.13-4.09H216.71l-.07,0v82.77c0,16.55-5.07,21-8.11,27.34s-7.36,9.13-17.75,9.57-8.88-2.22-18-8.27-14.46-2.57-14.46-2.57a30.19,30.19,0,0,0-13.95,25.62,34,34,0,0,0,12.18,26.64s6.59,3.3,16.48-2.79,17.25-8.63,20.8-8.63,11.66,6.35,17.75,14.72S216.64,358,216.64,358V395h50.22c9.38,0,15,3.35,20,6.65s11.16,9.39,11.16,19.53-3,14-7.61,20.05-5.58,7.86-5.58,13.7,8.62,20.55,25.87,20.55,27.14-11.93,27.14-17.25.25-7.87-3.81-16-7.1-14.71-7.1-20.8.26-12.18,8.62-18.27,24.1-8.17,24.1-8.17h50V353.27" /></svg>`,
      `<svg id="center_right"><path d="M409.33,355.05s-2.22-12.37-7-18.08-12.18-10.85-15.79-10.65-10.84,1.14-24.73,7.8c0,0-7,2.85-11.6,3,0,0-18.07-3.23-18.07-21.31s9.7-26.45,16.74-26.45,8.75-.38,16.74,5,8.94,6.47,20,6.47,17.5-11.42,17.5-11.42,6.21-8.75,6.21-19.22V172.05h59.92C480,173.3,480.09,173.46,491,179s9.61,18.84,9.51,19.13,2.19,10.18-6.66,16.93-5.7,13.51-5.7,13.51,1,16.46,24.73,16.46,23.77-13,23.77-13,2.57-8-4.94-18.37-5-17.79-5-17.79c-.38-23,31.76-23.76,31.76-23.76h42V395.21c-20.92,0-24.73,1.82-28.91,5.25s-10.27,6.85-10.27,14.84,1.14,14.08,5.7,22.83,4.57,5.33,4.57,16.37-11.42,15.6-26.25,15.6-22.83-8-22.83-16.36,1.52-10.28,6.09-18.65,5.7-10.66,5.7-13.7,1.53-4.95-4.18-14.46-25.2-11.72-25.2-11.72H409.33V353.52" /></svg>`,
      `<svg id="bottom_left"><path d="M216.69,558.38V600.5H1.37V395.13H34.85s27.64-8.82,28.66-18.46-.26-14.2-2.79-20.29-7.86-10.91-8.12-19.54S61,318.32,76.19,318.32s27.13,7.61,27.13,15.73-5.83,18.52-8.11,23.34-4.06,6.6-4.06,13.7,0,9.14,7.86,14.72,10.91,9.32,17.63,9.32H216.69V446s1.23,14.24-6.13,25.4-10.65,13.7-18.26,14.2-8.88-1.26-17.76-5.58c0,0-3.17-4.36-17.43-4.36,0,0-16.93,1.14-16.93,27.59s16.55,25.3,16.55,25.3,10.84.38,18.26-6.66c0,0,3.8-5.13,17.12-5.13,0,0,7.41-2.35,14.14,8.18S216.69,546.7,216.69,558.38Z" /></svg>`,
      `<svg id="bottom_center"><path d="M216.69,395.13l50.17-.18c9.38,0,15,3.35,20,6.65s11.16,9.39,11.16,19.53-3,14-7.61,20.05-5.58,7.86-5.58,13.7,8.62,20.55,25.87,20.55,27.14-11.93,27.14-17.25.25-7.87-3.81-16-7.1-14.71-7.1-20.8.26-12.18,8.62-18.27S359.12,395,359.12,395h50.53v71.34s2.16,21.69,7.48,27.4,8.75,9.52,16.36,9.52,12.17-1.65,18.26-5.39,7.8-5.46,14.46-5.65,19.21,4.19,19.21,26.45-16.93,24-16.93,24-5.33,1.72-14.84-4.37-10.84-8.76-17.88-8.56-15,3.23-18.45,8.37-7.67,9.32-7.67,23.78V600.5h-193V558.38c0-11.68-3.72-23-10.44-33.48s-14.14-8.18-14.14-8.18c-13.32,0-17.12,5.13-17.12,5.13-7.42,7-18.26,6.66-18.26,6.66s-16.55,1.15-16.55-25.3,16.93-27.59,16.93-27.59c14.26,0,17.43,4.36,17.43,4.36,8.88,4.32,10.15,6.09,17.76,5.58s10.9-3,18.26-14.2,6.13-25.4,6.13-25.4V395.13" /></svg>`,
      `<svg id="bottom_right"><path d="M409.65,395v71.34s2.16,21.69,7.48,27.4,8.75,9.52,16.36,9.52,12.17-1.65,18.26-5.39,7.8-5.46,14.46-5.65,19.21,4.19,19.21,26.45-16.93,24-16.93,24-5.33,1.72-14.84-4.37-10.84-8.76-17.88-8.56-15,3.23-18.45,8.37-7.67,9.32-7.67,23.78V600.5H600.5V395c-20.89,0-24.69,1.84-28.87,5.27s-10.25,6.87-10.25,14.89,1.14,14.13,5.7,22.91,4.55,5.35,4.55,16.42-11.39,15.66-26.2,15.66-22.79-8-22.79-16.42,1.52-10.31,6.08-18.71,5.69-10.69,5.69-13.75,1.52-5-4.17-14.51S505.08,395,505.08,395H409.65" /></svg>`,
  ],
  isDur: false,

  init() {
    Puzzle.hook();
  },

  hook() {
    $(document) 
      .on(`click`, ".puzzle_top img", (e) => {
        if (Puzzle.isDur) {
          return;
        }

        Puzzle.hitView = "";

        Puzzle.nowPuzzle = $(e.target).attr('src');
        Puzzle.start();
        Puzzle.setting();
      })
      .on(`keydown`, (e) => {
        if (!Puzzle.hold || !Puzzle.target) {
          return;
        }
        
        e.preventDefault();

        const deg = e.keyCode == 38 ? +15 : -15;
        const rot = Puzzle.target.find(`path`)[0].dataset.rotate * 1 + deg;

        Puzzle.target
          .find('path')
          .css({ 'transform': `rotate(${rot}deg) scale(.7)` })

        Puzzle.target
          .find('path')
          .attr('data-rotate', rot);
      })
      .on(`click`, ".hint_view", (e) => {
        if (Puzzle.hintView) {
          return;
        }

        $(`#puzzle_frame > svg`).each((i, el) => {
          $(el).find('path').attr('fill', 'none');
          $(el).attr('fill', `url(#img${i + 1})`)
        })

        // setTimeout(() => {
          // $(`#puzzle_frame > svg`).attr('fill', "#fff");
        // }, 5000);
      })
  },

  start() {
    Puzzle.isDur = true;
    Puzzle.leftPiece = 9;

    let time = 60;
    $(`.timer`).html(time);

    setInterval(() => {
      time--;
      $(`.timer`).html(time);

      if (time == 0) {
        location.reload();
      }
    }, 1000);
  },

  gameEnd() {
    const prom = prompt("축하합니다! \n이름:");
    
  },

  setting() {
    let piece = "";
    let patterns = "";
    
    $(`#puzzle_piece`)[0].innerHTML = "<defs></defs>";

    for (let i = 0; i < 9; i++) {
      const pattern = $(`
        <pattern id="img${(i + 1)}" patternUnits="userSpaceOnUse" width="600" height="600"></pattern>
      `);

      const url = pattern.attr('id');

      const rotate = Math.floor(Math.random() * 10) * 15;
      
      const originX = i % 3 * 200 + 100;
      const originY = Math.floor(i / 3) * 200 + 100;

      const nowPiece = $(Puzzle.piece[i]);
      const rand = [Math.floor(Math.random() * 150) - 100, Math.floor(Math.random() * 150) - 100];

      nowPiece
        .attr('x', rand[0])
        .attr('y', rand[1])
        .find(`path`)
        .css({ 'transform-origin': `${originX}px ${originY}px`, 'transform': `rotate(${rotate}deg) scale(.7)` })
        .attr('data-rotate', rotate);

      nowPiece
        .attr('fill', `url(#${url})`)

      patterns += pattern[0].outerHTML;
      piece += nowPiece[0].outerHTML;
    }

    $(`#puzzle_piece defs`)[0].innerHTML = patterns;
    $(`#puzzle_frame defs`)[0].innerHTML = patterns;

    $(`#puzzle_piece defs pattern`).each((i, el) => {
      el.innerHTML = `<image href="${Puzzle.nowPuzzle}" x="0" y="0" width="600" height="600"></image>`;
    });
    $(`#puzzle_frame defs pattern`).each((i, el) => {
      el.innerHTML = `<image href="${Puzzle.nowPuzzle}" x="0" y="0" width="600" height="600"></image>`;
    });

    $(`#puzzle_piece`)[0].innerHTML += piece;

    $(`#puzzle_piece > svg`).draggable({
      start: (e, ui) => {
        Puzzle.hold = true;
        Puzzle.target = ui.helper;

        if ($(e.target).attr('x')) {
          Puzzle.moveX = $(e.target).attr('x') * -1;
          Puzzle.moveY = $(e.target).attr('y') * -1;
        } else {
          Puzzle.moveX = Puzzle.moveY = 0;
        }

        Puzzle.prev = [e.pageX, e.pageY];
      },

      drag: (e, ui) => {
        Puzzle.moveX += (Puzzle.prev[0] - e.pageX);
        Puzzle.moveY += (Puzzle.prev[1] - e.pageY);

        $(e.target).attr('x', -Puzzle.moveX);
        $(e.target).attr('y', -Puzzle.moveY);
        Puzzle.prev = [e.pageX, e.pageY];
      },

      stop: (e, ui) => {
        Puzzle.hold = false;
        Puzzle.target = "";
        ui.helper.css('pointer-events', 'none');
        const dropUI = document.elementFromPoint(e.clientX, e.clientY);

        if ($(dropUI).attr('id') != ui.helper.attr('id') || !$(dropUI).hasClass('drop_path')) {
          ui.helper.css('pointer-events', 'auto');
          return;
        }

        Puzzle.leftPiece--;
        ui.helper.attr('x', -645);
        ui.helper.attr('y', 0);
        $(ui.helper).find('path').css({
          'transform': `rotate(0deg) scale(1)`
        })

        if (Puzzle.leftPiece <= 0) {
          Puzzle.gameEnd();
        }
      }
    })
  }
}

const ArtistEnr = {
  init() {
    $(`.artist_enr input`).val("");
    const str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $(`.inv_num`).val(str[Math.floor(Math.random() * str.length)] + (100 + Math.floor(Math.random() * 899)));
  },

  enr(e) {
    const msg = vali('artist_enr');

    if (msg != "pass") {
      alert(msg);
      return;
    }

    const today = new Date();
    if (new Date($(`input[name="start"]`).val()) < today.getFullYear() + "-" + today.getMonth() + "-" + today.getDate()) {
      alert('시작일은 오늘보다 이전일 수 없습니다.');
      return;
    }

    if ($(`input[name="start"]`).val() > $(`input[name="end"]`).val()) {
      alert('시작일은 종료일보다 작아야합니다.');
      return;
    }

    const realData = {};
    const saveData = ls['inv_enr'] ? JSON.parse(ls['inv_enr']) : [];

    for (let v of $(e.target).serializeArray()) {
      realData[v.name] = v.value;
    }

    realData['id'] = saveData.length + 1;
    saveData.push(realData);
    ls['inv_enr'] = JSON.stringify(saveData);
    alert('청년작가가 등록되었습니다.');

    ArtistEnr.init();
  },
}

const Invest = {
  init() {
    Invest.saveData = ls['invest'] ? JSON.parse(ls['invest']).sort((a, b) => b.time - a.time) : [];
    Invest.data = ls['inv_enr'] ? JSON.parse(ls['inv_enr']) : [];

    if (location.pathname.includes("invest")) {
      Invest.setList();
    }

    if (location.pathname.includes("sign")) {
      Invest.signList();
    }
  },

  setList() {
    $(`.invest_list`).html(Invest.data.map(v => Html.investHtml(v)));
  },

  signList() {
    $(`.sign_list`).html(Invest.saveData.map(v => Html.signList(v)));
  },

  signDown(id) {
    const data = Invest.saveData.find(v => v.id == id);
    const c = $(`<canvas width="793" height="495"></canvas>`)[0];
    const ctx = c.getContext('2d');
    const image = new Image();

    image.src = "/resources/B/투자계약서.png";

    image.onload = (e) => {
      ctx.drawImage(e.target, 0,0);
      ctx.font = "bold 32px Malgun Gothic";
      ctx.fillText(data.inv_num, 250, 150);
      ctx.fillText(data.artist_name, 250, 225);
      ctx.fillText(data.invester_name, 250, 300);
      ctx.fillText((data.invest_val * 1).toLocaleString(), 250, 375);

      const sign = $(`<img style="width: 100px; height: 60px;"></img>`)[0];

      sign.onload = (img) => {
        ctx.drawImage(img.target, 520, 350);

        $(`<a href="${c.toDataURL()}" download="fund.png"></a>`)[0].click();
      }

      sign.src = data.sign;
    }

  },

  setModal(id) {
    const data = Invest.data.find(v => v.id == id);
    Modal.open('invest');

    $(`.inv_in`).val(data.inv_num);
    $(`.art_in`).val(data.artist);
    $(`input[name="inv_id"]`).val(data.id);

    Invest.target = data;
  },

  submit(e) {
    e.preventDefault();
    const msg = vali("invest_sign");

    if (msg != "pass") {
      alert(msg);
      return;
    }

    if (Invest.target.goal < $(`.val_in`).val() * 1) {
      alert('투자금액은 총 모집금액을 초과할 수 없습니다.');
      return;
    }

    const realData = {};
    Invest.saveData = ls['invest'] ? JSON.parse(ls['invest']) : [];

    for (let v of $(e.target).serializeArray()) {
      realData[v.name] = v.value;
    }

    realData['time'] = new Date().getTime();
    realData['id'] = Invest.saveData.length + 1;
    realData['sign'] = $(`#sign`)[0].toDataURL();
    Invest.saveData.push(realData);
    ls['invest'] = JSON.stringify(Invest.saveData);
    alert('제출되었습니다.');
    Modal.close();

    Invest.setList();
  }
}

const Sign = {
  draw(e) {
    const c = $(`#sign`)[0];
    const ctx = c.getContext('2d');

    const pos = [e.offsetX, e.offsetY];
    switch (e.type) {
      case "mousedown":
        Sign.hold = true;
        Sign.pos = pos;
        break;
    
      case "mousemove":
        if (!Sign.hold) {
          return;
        }

        let x = e.offsetX;
        let y = e.offsetY;
        ctx.lineJoin = "round";
        ctx.lineCap = "round";
        ctx.lineWidth = "2";

        ctx.beginPath();
        ctx.moveTo(...Sign.pos);
        ctx.lineTo(x, y);
        ctx.stroke();
        ctx.closePath();

        Sign.pos = [x, y];
        $(`.sign_ck`).val("pass");
        break;

      case "mouseup":
      case "mouseleave":
        Sign.hold = false;
        break;
    }
  }
}

const Modal = {
  template: (name) => $($(`template`)[0].content).find(`.${name}_popup`).clone(),

  open(target) {
    $(`body`).css('overflow', 'hidden');
    $(`.modal`).addClass(`open`).html(Modal.template(target));
  },

  close() {
    $(`body`).css('overflow', 'auto');
    $(`.modal`).removeClass('open').html("");
  }
}

const Html = {
  investHtml(data) {
    const investList = Invest.saveData.filter(v => v.inv_id == data.id);
    const total = investList.reduce((acc, v) => {
      return acc += v.invest_val * 1;
    }, 0);
    
    const per = total / data.goal * 100;

    return `
      <div class="b_padding shadow">
        <div class="flex alc">
          <div class="dia_box">
            <h2>${per.toFixed(2)}%</h2>
            <svg class="circle" viewBox="0 0 32 32">
              <circle r="16" cx="16" cy="16" stroke-dasharray="${per == 100 ? 110 : per} 100" stroke="#ff6161">
              </circle>
              <circle class="incircle" r="10" cx="16" cy="16" stroke="#ff6161" stroke-dasharray="110 100"></circle>
              <circle class="outcircle" r="15.9" cx="16" cy="16" stroke="#ff6161" stroke-dasharray="110 100"></circle>
            </svg>
          </div>

          <div class="flex js inv_foo b_padding">
            <h2>투자번호: ${data.inv_num}</h2>
            <div>
              <p>청년작가명</p>
              <h3>${data.artist}</h3>
            </div>
            <div>
              <p>모집기간</p>
              <h4>${data.start} ~ ${data.end}</h4>
            </div>
            <div>
              <p>모집목표금액</p>
              <h2 style="font-size: 1.9rem">${(data.goal * 1).toLocaleString()}원</h2>
            </div>
            <div>
              <p>현재모집금액</p>
              <h2 style="font-size: 1.9rem">${(total * 1).toLocaleString()}원</h2>
            </div>

            <div class="after_line"></div>
            ${data.end < new Date().getFullYear() + "-" + pad(new Date().getMonth() + 1) + "-" + new Date().getDate() || per >= 100
            ? `<h2>모집완료</h2>`
            : `<button class="btn" onclick="Invest.setModal(${data.id})">투자하기</button>`
            }
          </div>
        </div>
      </div>
    `
  },

  signList(data) {
    dd(data);
    return `
      <div class="b_padding shadow">
        <div class="flex alc js">
          <div>
            <div style="padding-bottom: 1.5rem;">
              <p>투자번호</p>
              <h1>${data.inv_num}</h1>
            </div>
            <div>
              <p>청년작가명</p>
              <h3>${data.artist_name}</h3>
            </div>
            <div>
              <p>투자자명</p>
              <h3>${data.invester_name}</h3>
            </div>
            <div>
              <p>투자금액</p>
              <h3>${(data.invest_val * 1).toLocaleString()}원</h3>
            </div>
          </div>
          <button class="btn" onclick="Invest.signDown(${data.id})">투자계약서</button>
        </div>
      </div>
    `
  }
}

// 페이지 로드 후 실행
$(() => App.init());