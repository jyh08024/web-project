//디버깅 함수
const dd = console.log;

//숫자 형식 0 -> 00 변환 함수
const pad = (num) => {
  return num > 10 ? num :`0${num}`;
}

//기본객체
const App = {
  tool: "",
  pos: [],
  hold: false,
  color:"gray",
  weight: 3,
  fontSize: 16,

  init() {
    App.hook();
    Video.video = $(`.video_area > video`);

    Video.video[0].ontimeupdate = (e) => {
      Video.setTime(e.target.currentTime, ".cur_time");
      Video.moveTrack(e.target.currentTime, e.target.duration);

      Clip.viewSet(e);
    }
  },

  hook() {
    $(document)
      .on(`mousedown mousemove mouseleave mouseup click`, `svg`, (e) => App.event(e))
      .on(`click`, ".select_video", (e) => Video.setVideo(e))
      .on(`click`, ".control_btns > .tool_btn", (e) => {
        if (!Video.src) {
          alert('비디오를 선택해주세요');
          return;
        }
        
        App.tool = $(e.target).data('tool');
      })
      .on(`click`, ".control_btns > .state_btn", (e) => {
        if (!Video.src) {
          alert('비디오를 선택해주세요');
          return;
        }
        
        App.eventSet($(e.target).data('tool'));
      })
      .on(`change`, ".text_styles > div > select", (e) => App.styleSet(e))
      .on(`click`, ".merge_btn", (e) => Clip.merge(e))
  },

  event(e) {
    if (!App.tool) {
      return;
    }

    const [x, y] = [e.offsetX, e.offsetY];

    if (e.type == "mousedown") {
      App.hold = true;
      App.pos.push([x, y]);
    }

    if (App.hold && e.type == "mousemove") {
      App.pos.push([x, y]);
    }

    if (e.type == "mouseup") {
      App.hold = false;
      App.pos = [];
    }

    switch (App.tool) {
      case "line":
        Pen.draw();
        break;

      case "rect":
        Rect.draw();

        if (e.type == "mouseup") {
          Rect.complete(App.color);
        }
        break;

      case "text":
        if (e.type == "click" && !TextCare.nowMake) {
          TextCare.make(x, y);
        }
        break;

      case "sel":
        if (e.type == "click" && Select.nowSel != $(e.target).data('id')) {
          Select.selObject(e.target, x, y);
        }

        if (e.type == "mousedown" && $(e.target).data('id') == Select.nowSel) {
          Select.prevPos = [x, y];
          Select.move(x, y);
        }

        if (App.hold && e.type == "mousemove") {
          Select.move(x, y);
        }
        break;
    }
  },

  eventSet(tool) {
    switch (tool) {
      case "play":
        Video.playState("play");
        break;

      case "pause":
        Video.playState("pause");
        break;

      case "del_all":
        Select.removeAll();
        break;

      case "sel_del":
        Select.targetRemove();
        break;

      case "download":
        Video.download();
        break;
    }
  },

  styleSet(e) {
    const style = $(e.target).data('style');
    switch (style) {
      case "color":
        App.color = e.target.value;
        break;
      
      case "weight":
        App.weight = e.target.value * 1;
        break;
        
      case "fontSize":
        App.fontSize = e.target.value * 1;
        break;
    }
  }
}

//비디오 관리
const Video = {
  src: false,

  setVideo(e) {
    const target = e.currentTarget;

    if ($(target).hasClass('now_movie')) {
      return;
    }

    let src = $(target).data('video');
    Video.video.attr('src', src);

    $(`.select_video`).removeClass('now_movie');
    $(target).addClass('now_movie');

    Video.video[0].onloadedmetadata = (e) => {
      Video.dur = e.target.duration;

      $(`svg *`).remove();
      $(`.timeline > .clips_area`).html('');
      $(`.clip_move`)
        .css('left', 0)
        .draggable({
          'containment': ".timeline",

          drag(e, ui) {
            let time = Video.video[0].duration * ((ui.position.left + 30) / 1320 * 100) / 100;
            Video.video[0].pause();
            Video.video[0].currentTime = time;
            Video.setTime(time, ".cur_time");
          }
        });

      $(`.video_clip`).html(`<div class="clip_obj"></div>`);
      Video.src = true;

      Video.setTime(Video.dur, ".total_time");
    }
  },

  playState(state) {
    if (!Video.src) {
      return;
    }

    state == "play" ? Video.video[0].play() : Video.video[0].pause();
  },

  setTime(time, target) {
    const h = pad(Math.floor(time / 3600));
    const min = pad(Math.floor(time / 60));
    const second = pad(Math.floor(time % 60));
    const ms = time <= 0 ? "00" : `${time}`.split(".")[1].substring(0, 2);
    
    $(`${target} > span`).html(`${h}:${min}:${second}:${ms}`);
  },

  moveTrack(now, dur) {
    const trackLoc = 1320 * (now / dur * 100) / 100 - 30;
    $(`.clip_move`).css('left', (trackLoc < 0 ? 0 : trackLoc) + "px");
  },

  download() {
    const svg = $(`svg`).clone();
    svg.find('*').css('display', 'none');
    svg.find(`*[data-remove="true"]`).remove();
    const video = $(`.video_area > video`).attr('src')

    let html = `
    <div class="video_area">
    ${svg[0].outerHTML}
    <video src="${"http://localhost/" + video}"></video>
    <span class="input_p"></span>

    <div class="play_pause">
      <div class="play" onclick="videoP()">재생</div>
      <div class="pause" onclick="videoP()">정지</div>
    </div>
  </div>

  <style>
    * {
      margin: 0;
      padding: 0;
      list-style: none;
      box-sizing: border-box;
    }

    a {
      color: inherit;
      text-decoration: none;
    }

    html, body {
      font-size: 16px;
      font-family: "Microsoft Phagspa";
      letter-spacing: 0;
    }

    .video_area {
      width: 1300px;
      height: 650px;
      background: #000;
      margin-bottom: 1rem;
      position: relative;
    }

    .video_area > video {
      user-select: none;
      width: 100%;
      height: 100%;
    }

    svg {
      position: absolute;
      width: 100%;
      height: 100%;
      left: 0;
      top: 0;
      z-index: 1;
    }

    .polyline {
      stroke-width: 3px;
      fill: none;
      pointer-events: none;
    }

    .play_pause {
      position: absolute;
      z-index: 9999;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      opacity: 0;
      transition: .5s;
    }

    .pause {
      display: none;
    }

    .play_pause > div {
      width: 100px;
      padding: 2.32rem 0rem;
      /* display: flex; */
      /* align-items: center; */
      /* justify-content: center; */
      text-align: center;
      background: #ffa500;
      color: #fff;
      font-size: 1.2rem;
      font-weight: bold;
      cursor: pointer;
      border-radius: 50%;
    }
  </style>

  <script>
    let state = false;

    function videoP() {
      state = !state

      console.log(state);
      document.querySelector('video')[state ? 'play' : 'pause']();
      document.querySelector('.pause').style.display = state ? "block" : "none";
      document.querySelector('.play').style.display = state ? "none" : "block";
    }

    let viewState = false;

    document.querySelector('.video_area').addEventListener('mouseover', function() {
      if (!viewState) {
        return;
      }

      document.querySelector('.play_pause').style.opacity = 1;
    })

    document.querySelector('.video_area').addEventListener('mouseleave', function() {
      viewState = true;
      document.querySelector('.play_pause').style.opacity = 0;
    })

    document.querySelector('.video_area > video').addEventListener('timeupdate', () => {
      viewSet();
    })

    function viewSet() {
      const playTime = document.querySelector('video').currentTime;
      const svg = document.querySelectorAll('svg > *');

      svg.forEach((v, i) => {
        v.style.display = "none";
        const start = v.dataset.start;
        const end = v.dataset.end;

        if (playTime >= start && playTime <= end) {
          v.style.display = 'block';
        }
      })
    }
  </script> 
    `;

    let downHtml = `
      <!DOCTYPE html>
      <html lang="en">
      <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
      </head>
      <body>
        ${html}
      </body>
      </html>
    `;

    let blob = new Blob([downHtml], {type: 'text/html'});
    const url = window.URL.createObjectURL(blob);

    const date = new Date();
    const year = `${date.getFullYear()}`.slice(2);
    const month = date.getMonth() + 1 > 12 ? 1 : date.getMonth() + 1;
    const day = date.getDate();

    $(`<a href="${url}" download="movie-${year}${month}${day}.html">`)[0].click();
  }
}

//자유곡선
const Pen = {
  hold: false,

  draw() {
    if (App.pos.length == 2) {
      Pen.id = Clip.newId();
      Pen.item = Clip.svg(Pen.id, 'polyline');
      Clip.newClip(Pen.id);
    }

    if (App.pos.length >= 2) {
      let loc = "";

      App.pos.forEach((v, i) => {
        loc += `${v[0]},${v[1]} `;
      });

      Pen.item.attr('points', loc);
    }
  }
}

//사각형
const Rect = {
  hold: false,

  draw() {
    if (App.pos.length == 2) {
      Rect.id = Clip.newId();
      Rect.item = Clip.svg(Rect.id);
      Clip.newClip(Rect.id);
    }

    if (App.pos.length >= 2) {
      const s = App.pos[0];
      const e = App.pos[App.pos.length - 1];

      Rect.item.css({
        x: Math.min(s[0], e[0]),
        y: Math.min(s[1], e[1]),
        width: Math.abs(s[0] - e[0]),
        height: Math.abs(s[1] - e[1]),
      });
    }
  },

  complete(color) {
    Rect.item.css('background', color);
  }
}

//텍스트 관리 객체
const TextCare = {
  nowMake: false,

  make(x, y) {
    TextCare.id = Clip.newId();
    TextCare.item = Clip.svg(TextCare.id).append(`<textarea class="text_clip" data-id="${TextCare.id}" style="width: 100%; height: 100%; overflow: hidden; resize: none; font-family: initial;"></textarea>`);

    TextCare.item.css({
      'width': App.fontSize + 6,
      'height': App.fontSize + 16,
      'border': `3px solid ${App.color}`,
      x: x,
      y: y,
    });

    const textArea = TextCare.item.find('textarea');

    TextCare.nowMake = true;

    textArea.css({
      'font-size': App.fontSize + "px",
      'color': App.color
    })[0].focus();

    textArea.on('input', (e) => {
      const sizeInput = $(`.video_area > .input_p`);
      sizeInput.css('font-size', App.fontSize);
      sizeInput.html(e.target.value
        //copy("\u200B")로 폭없는 공백 문자 복사해서 <br>뒤에 붙임 ㅋㅋ;
        .replaceAll("\n", "<br>​")
        .replaceAll(" ", "&nbsp;​")
      );

      TextCare.item.css({
        'width': sizeInput.outerWidth() + App.fontSize,
        'height': sizeInput.outerHeight() + 5,
      });
    })
    .on(`focusout`, (e) => {
      if (!e.target.value.trim()) {
        TextCare.item.remove();
        TextCare.nowMake = false;
        return;
      }

      $(e.target).attr('disabled', 'disabled');
      TextCare.item.css('border', 'none');
      TextCare.item.css({
        'border': 'none'
      });

      textArea.css('pointer-events', 'none');
      Clip.newClip(TextCare.id);

      setTimeout(() => {
        TextCare.nowMake = false;
      }, 150);
    })
  }
}

//svg 선택
const Select = {
  nowSel: "",
  selObject(target, x, y) {
    const id = $(target).attr('data-id');
    const t = $(`svg > *[data-id="${id}"]`);

    if (t[0].tagName == "svg") {
      return;
    }

    $(`svg *`).removeClass('sel_svg_obj').attr('data-active', "");
    $(`.clip_obj`).removeClass('sel_clip_obj');
    $(`svg *[data-remove="true"]`).remove();

    if (t[0].tagName == "polyline") {
      const clone = t.clone().attr('data-remove', 'true').css({
        strokeWidth: t.css('stroke-width').replace('px', '') * 1 + 6,
        stroke: "#ffa500",
      });

      t.before(clone);
    } else {
      t
      .attr('data-active', 'true')
      .addClass('sel_svg_obj');
    }
    
    $(`.clip_obj[data-id='${id}']`).addClass('sel_clip_obj');
    
    Select.nowSel = id;
    Select.prevPos = [x, y];
  },

  removeAll() {
    $(`svg *`).remove();
    $(`.clips_area`).html('');

    Select.nowSel = "";
  },

  targetRemove() {
    $(`svg *[data-id="${Select.nowSel}"]`).remove();
    $(`.clip_obj[data-id="${Select.nowSel}"]`).remove();

    Select.nowSel = "";
  },

  move(x, y) {
    const item = $(`svg *[data-id="${Select.nowSel}"]`);

    if (!item.length) {
      return;
    }

    const moveX = x - Select.prevPos[0];
    const moveY = y - Select.prevPos[1];

    
    item.toArray().forEach((v, i) => {
      const target = $(v);
      
      const posX = target.css('x').replace('px', '') * 1 + moveX;
      const posY = target.css('y').replace('px', '') * 1 + moveY;

      if (v.tagName == "polyline") {
        const points = item.attr('points').split(' ').reduce((acc, val) => {
          if (!val.trim()) {
            return acc;
          }

          const [start, end] = val.split(",");
          let pos = [start * 1 + moveX, end * 1 + moveY].join(',');
          return `${acc} ${pos}`;
        }, '');

        target.attr('points', points);
      } else {
        target.css({
          x: posX,
          y: posY,
        });
      }

    })

    Select.prevPos = [x, y];
  }
}

//클립 관련 관리 객체
const Clip = {
  newClip(id) {
    let clipBox = $(`
      <div>
        <div class="clip_obj" data-id="${id}">
          <input type="checkbox" name="merge" class="merge_box" data-id="${id}">
        </div>
      </div>
    `);

    $(`.clips_area`).prepend(clipBox);

    $(`.clips_area`).sortable({
      update() {
        $(`.clips_area > div`).toArray().forEach((v, i) => {
            const nowClip = $(v).find('.clip_obj');
            const clipItem = $(`svg *[data-id="${nowClip.attr('data-id')}"]`);
            const cloneItem = clipItem.clone();
            
            $(`.video_area > svg`).prepend(cloneItem);
            clipItem.remove();
        })
      }
    });

    $(`.clip_obj`).resizable({
      containment: ".timeline",
      handles: "e, w",

      resize(e, ui) {
        const size = ui.size.width;
        Clip.playTime(ui, size, $(e.target).data('id'));

        $(e.target).draggable({
          containment: $(e.target).parent(),

          drag(e, ui) {
            const width = $(e.target).outerWidth();
            Clip.playTime(ui, width, $(e.target).data('id'));
          }
        })
      }
    });
  },

  svg(id, type = 'foreignObject') {
    return $(document.createElementNS('http://www.w3.org/2000/svg', type)).css({
      color: App.color,
      fontSize: App.fontSize,
      fill: 'none',
      strokeLinejoin: 'round',
      strokeLinecap: 'round',
      stroke: App.color,
      strokeWidth: App.weight,
      border: `3px solid ${App.color}`
    }).attr({
      'data-id': id,
      'data-type': type == 'polyline' ? 'line' : 'foreignObject',
      'data-active': '',
      'data-start': 0,
      'data-end': Video.dur,
      'data-item': 'item'
    }).appendTo('.video_area > svg');
  },

  newId() {
    return new Date().getTime();
  },

  playTime(ui, width, id) {
    const pos = ui.position.left;
    const size = pos + width;

    const total = Video.video[0].duration;
    let [start, end] = [total * ((pos * 1) / 1320 * 100) / 100, total * ((size * 1) / 1320 * 100) / 100];

    const target = $(`svg *[data-id="${id}"]`);

    target.attr({
      'data-start': start,
      'data-end': end,
    });

    if (size == 1320) {
      end = total;
    }
    
    Video.setTime(start, ".clip_start");
    Video.setTime(end, ".clip_during");
  },

  viewSet(videoEvent) {
    const svg = $(`svg > *`);
    svg.css('display', 'none');

    svg.toArray().forEach((v, i) => {
      const target = $(v);
      const start = target.attr('data-start') * 1;
      const end = target.attr('data-end') * 1;

      if (videoEvent.target.currentTime >= start && videoEvent.target.currentTime <= end) {
        target.css('display', 'block');
      }
    })
  },

  merge(e) {
    const startTime = [];
    const endTime = [];
    const newId = Clip.newId();

    $(`svg > *`).attr('data-active', "").css('border', 'none');
    $(`svg > *[data-remove="true"]`).remove();

    $(`.merge_box:checked`).toArray().forEach((v, i) => {
      const id = $(v).attr('data-id');
      const item = $(`svg *[data-id="${id}"]`).attr('data-id', newId);

      $(v).closest('.clip_obj').parent().remove();

      startTime.push(item.attr('data-start') * 1);
      endTime.push(item.attr('data-end') * 1);
    })

    const start = Math.min(...startTime);
    const end = Math.max(...endTime);    

    $(`svg > *[data-id="${newId}"]`).attr({
      'data-start': start,
      'data-end': end,
    });

    Clip.newClip(newId);

    const left = start / Video.video[0].duration * 1320;
    const width = (end - start) / Video.video[0].duration * 1320;

    $(`.clip_obj[data-id="${newId}"]`).css({
      'width': width,
      'left': left,
    });

    Video.setTime(start, ".clip_start");
    Video.setTime(end, ".clip_during");
  }
}

//화면 로드후 기본실행
$(() => {
  App.init();
});