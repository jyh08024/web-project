// 디버깅 함수
const dd = console.log;

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
  }
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
      dd(viewLabel);
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

// 페이지 로드 후 실행
$(() => App.init());