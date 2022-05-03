const dd = console.log;

function timeFormat(time) {
  return pad(Math.floor(time / 60)) + ":" + pad(Math.floor(time % 60));
}

function pad(time) {
  return time < 10 ? "0" + time : time
}

//기본 실행, 데이터 받아오기
const App = {
  follow: [],

  async init() {
    Caption.init();
    await App.getData();
    App.hook();
    Upload.init();
    Provide.init();
    App.followCk();
  },

  hook() {
    $(document)
      .on(`click`, ".comName", Recommend.viewList)
      .on(`mouseover mouseleave`, ".rec_video", Recommend.play)
      .on(`click`, ".capBtn", Caption.capOn)
      .on(`input`, ".num", App.number)
      .on(`change`, ".follow", App.follow)
      .on(`click`, ".del_com", App.delCom)
      .on(`change`, "#recom", App.recVod)
  },

  async getData() {
    $.ajaxSetup({
      cache:false,
    });

    const data = await $.getJSON('/resources/data/data.json');

    Recommend.video = data.videos;
    Recommend.setList(data.recommends, data.users);

    Graph.videoData = data.videos;
    Graph.viewData = data.view_history;
  },

  number() {
    $(this).val($(this).val().replace(/[^0-9]/g, ''));
  },

  async followCk() {
    App.follow = await $.post(`/sub`);

    if (App.follow) {
      $(`.follow`).attr('checked', true);
    }
  },

  async follow() {
    if (!App.follow) {
      $.post('/follow', {"follow": $(this).val()}, function() {
        alert('구독되었습니다.');
      });
    } else {
      $.post('/follow/del', {"follow": $(this).val()}, function() {
        alert('취소되었습니다.');
      });
    }

    App.followCk();
    $(`.text_info`).html(await $.post(`/profile/${$(this).val()}`));
  },

  async delCom() {
    const idx = $(this).data('idx');
    const par = $(this).data('par');

    await $.post(`/del/com/${idx}`, function() {
      App.pageCom(par);
    });
  },

  async pageCom(par) {
    $(`.editer_page_section > .comment`).html(await $.post(`/comment/care/${par}`));
    alert('삭제되었습니다.');
  },

  async recVod() {

  }
}


const Provide = {
  init() {
    Provide.hook();
    Provide.setList('');
  },

  hook() {
    $(document)
      .on(`click`, ".pro_sort", Provide.sort)
      .on(`click`, ".prov_movie_sort", Provide.movieSort)
  },

  async setList(type) {
    $(`.provide_list`).html(await $.post(`/userAll/${type}`));
  },

  sort() {
    const type = $(this).data('type');
    Provide.setList(type);
  },

  async movieSort() {
    const pro = $(this).data('idx');
    const type = $(this).data('type');
    $(`.pro_movie_list`).html(await $.post(`/pro/video/${pro}/${type}`));
  }
}

//업로드 페이지
const Upload = {
  video: "",
  max: 0,

  init() {
    Upload.hook();
  },

  hook() {
    $(document)
      .on(`input`, "#upload", Upload.fileCk)
      .on(`input`, "#running_time", Upload.runTime)
      .on(`input`, "#thumb_input", Upload.thumbCk)
      .on(`click`, ".del_thum_up", Upload.thumDel)
  },

  fileCk() {
    if ($(this)[0].files[0].type == "video/mp4" && $(this)[0].files[0].size <= 51200000) {
      $(`#upload_box`).hide();
      $(`.video_info_write`).find('input').attr('disabled', false);

      Upload.videoSet($(this)[0].files[0]);

      return;
    }

    $(this).val('');

    return alert("잘못된 형식이거나 50MB가 넘는 파일입니다.");
  },

  videoSet(data) {
    $(`.videoBox`).css(`display`, 'flex');
    $(`.videoBox`).attr('src', URL.createObjectURL(data));
    
    const video = $(`.videoBox`)[0];

    Upload.video = video;

    video.onloadedmetadata = () => {
      Upload.max = Upload.video.duration;
      $(`.duration_input`).val(Upload.video.duration);
    }
  },

  thumbCk() {
    const type = $(this)[0].files[0].name.split(".");

    if ((type[type.length - 1] == "png" && type[type.length - 1] == "jpg") || this.files[0].size > 1024000) {
      $(this).val('');
      return alert('썸네일은 1MB 이하인 png, jpg 파일만 업로드 가능합니다.');
    }

    $(`.video_info_write ul:nth-child(2), .video_info_write ul:nth-child(3)`).hide();
    $(`.video_info_write ul:first-child`).show();
    $(`#upload_box, .videoBox`).hide();
    Upload.thumbSet($(this)[0].files[0]);
  },

  runTime() {
    if ($(this).val() > Upload.max || $(this).val() < 0) {
      $(this).val(0);
    }

    Upload.video.currentTime = $(this).val();

    const video = $(`.videoBox`);

    const c = $(`.t_cv`)[0];
      c.width = video.width();
      c.height = video.height();

    const ctx = c.getContext('2d');


    ctx.drawImage(video[0], 0, 0, c.width, c.height);

    const url = c.toDataURL();

    $(`#upload_box, .videoBox`).hide();

    $(`.thumbBox`).css(`display`, 'flex');
    $(`.thumbBox`).attr(`src`, url);

    clearTimeout;

    setTimeout(() => {
      $(`#tu`).val(url);
    }, 10);
  },

  thumbSet(data) {
    $(`.thumbBox`).css(`display`, 'flex');
    $(`.thumbBox`).attr(`src`, URL.createObjectURL(data));
  },

  thumDel() {
    $(`#thumb_input`).val('');
    $(`.video_info_write ul:nth-child(2), .video_info_write ul:nth-child(3), .videoBox`).show();
    $(`.video_info_write ul:first-child, .thumbBox`).hide();
  }
}

//추천 페이지
const Recommend = {
  myData: "",
  video: [],
  last: "",

  setList(recom, user) {
    Recommend.myData = 1;

    const otherData = [...user.slice(Recommend.myData)];

    $(`.rec_list`).html(otherData.map(x => Html.recHtml(x, recom)));
  },

  viewList() {
    const videos = $(this).data('idx');
    const userVideo = Recommend.video.filter(x => x.users_id == videos);

    $(`.movie_list_${Recommend.last ? Recommend.last : 0}`).css(
      {'visibility': 'visible',
       'height': '100%'
      });
      
    $(`.movie_list_${videos}`).html(userVideo.map(x => Html.recMovie(x)));

    $(`.movie_list_${videos}`).css('visibility', 'visible');
    $(`.movie_list_${videos}`).css('height', 100 + "%");

    Recommend.last = $(this).data('idx');
  },

  play(e) {
    const target = $(this).find('video');

    switch (e.type) {

      case "mouseover":
        target.css('z-index', "999999");
        target[0].volume = 0;
        target[0].play();

        setTimeout(() => {
          target.css('z-index', "-1");
          target[0].currentTime = 0;
        }, 5000);
        break;
    
      case "mouseleave":
        target.css('z-index', "-1");
        target[0].pause();
        break;
    }
  }
}


//비디오 페이지, 비디오 컨트롤러
const Video = {
  caption: [],
  isPlay: false,
  video: "",

  init() {  
    Video.video = $(`.video_div video`)[0];

    Video.hook();

    $(`.seekRange`).attr('max', Video.video.duration);
    $(`.volumeFill`).width(($(`.volumeRange`).val() / Video.video.volume) * 100 + "%")
    Video.setTime(Video.video.duration, ".fullTime");
    Video.setList($(`.video_div video`).data('idx'));

    Video.video.ontimeupdate = () => {

      Video.setTime(Video.video.currentTime, ".nowTime");
      Video.range(Video.video.currentTime, Video.video.duration);
      Caption.viewCap(Video.video.currentTime);
    }
  },

  hook() {
    $(document)
      .on(`click`, ".play, .pause", Video.play)
      .on(`input`, ".seekRange", Video.move)
      .on(`input`, ".volumeRange", Video.volCon)
      .on(`click`, ".fa-expand-arrows-alt", Video.fullScreen)
      .on(`click`, ".write_comment", Video.comPost)
  },

  play() {
    const video = $(`.video_div video`)[0];

    Video.isPlay = !Video.isPlay
    video[Video.isPlay ? 'play' : 'pause']();

    $(`.play`).css("display", Video.isPlay ? "none" : "block");
    $(`.pause`).css("display", Video.isPlay ? "block" : "none");
  },

  setTime(sec, type) {
    const min = (Math.floor(sec / 60) + "").padStart(2, 0);
    const second = (Math.floor(sec % 60) + "").padStart(2, 0);

    $(type).html(min + ":" + second);
  },

  range(range, max) {
    $(`.seekFeel`).width((range / max) * 100 + "%");
    $(`.seekRange`).val(range);
  },

  move() {
    Video.video.currentTime = $(this).val();
  },

  volCon() {
    Video.video.volume = $(`.volumeRange`).val();
    $(`.volumeRange`).val(Video.video.volume);
    $(`.volumeFill`).width(($(`.volumeRange`).val() * Video.video.volume) * 100 + "%");
  },

  fullScreen() {
    if ($(window).height() != $('.video_div').height()) {
      $('.video_div')[0].requestFullscreen();
    } else {
      document.exitFullscreen();
    }
  },

  comPost(e) {
    e.preventDefault();

    const idx = $(this).data('idx');
    dd(idx)
    if ($(`#comment_content`).val().trim() == "") {
      return alert('댓글을 입력해주세요.');
    }

    $.post(`/comment/post/${idx}`, {"result": $(`#comment_content`).val()}, function() {
      alert('작성이 완료되었습니다.');
      Video.setList(idx);
    });
  },

  async setList(idx) {
    $(`.comment_lists`).html(await $.post(`/comment/list/${idx}`));
  }
}


//자막 
const Caption = {
  cc: [],
  capInfo: {},
  isActive: false,
  isTrue: false,

  async init() {
    await $.ajax({
      url: '/resources/js/caption.txt',
      mimeType: "text/plain; charset=euc-kr",
      success(val) {
        Caption.cc = val.split('\n');
      }
    });
    
    this.setTxt();
  },

  setTxt() {
    let arr = Caption.cc.filter(v => v.trim() != '');
    let data = {};

    $.each(arr, (i, v) => {
      if (i % 2 == 0) {
        data[v] = arr[i + 1];
      }
    })

    Caption.capInfo = data;
  },

  capOn() {
    Caption.isActive = !Caption.isActive

    $(`.capBtn i:first-child`).css("display", Caption.isActive ? "none" : "block");
    $(`.capBtn i:nth-child(2)`).css("display", Caption.isActive ? "block" : "none");
  },

  viewCap(time) {
    if (!Caption.isActive) {
      return;
    }

    let now = timeFormat(time);

    $.each(Caption.capInfo, (k, v) => {
      let start = k.trim().split(" ~ ")[0];
      let end = k.trim().split(" ~ ")[1];

      Caption.makeCap(start, end, now, v);
    })
  },

  makeCap(start, end, now, v) {
    dd(now);
    if (start <= now && now <= end) {
      $(`.caption`).show();
      $(`.caption`).html(v);
      Caption.isTrue = true;

    } else if (!Caption.isTrue) {
      $(`.caption`).hide();
      if (start < now && now < end) {
        $(`.caption`).show();
        $(`.caption`).html(v);
      }
    }
  }
}


//예고편 관리 부분 동영상 편집기
const Editer = {
  list: [],
  target: "",
  idx: 1,
  isPlay: false,

  init() {
    Editer.hook();
    clearTimeout();
    setTimeout(() => {
      Editer.thumb();
    }, 100);
  },

  hook() {
    $(document)
      .on(`click`, ".addCap", Editer.CapEnr)
      .on(`change`, ".timeInput", Editer.timeCk)
      .on(`click`, ".timeLine", Editer.preView)
      .on(`mouseup`, ".timeLine", function(e) {
        const data = $(this).data('id');

        if (e.button == 2) {
          $(`.conBtn`).html(Html.conBtn(data));
          $(`.conBtn`).show();
        }
      })
      .on(`contextmenu`, ".timeLine", function() {
        return false;
      })
      .on(`click`, ".mod_cap", Editer.modSet)
      .on(`click`, ".saveCap", Editer.modify)
    },

  timeCk() {
    const max = Editer.target[0].duration;
    const target = $(`.timeInput`);
    const targetAll = target.toArray();

    targetAll.forEach(v => {
      if (v.value *1 >= max) {
        $(this).val("");
        return alert('영상 최대길이인' + Math.floor(max) + "초를 넘길수 없습니다.");
      }
    });

    if (target[0].value - target[1].value > 1 && target[0].value && target[1].value) {
      $(this).val("");
      return alert('시작시간이 끝시간보다 빨라야하며 1초이상 차이나야합니다.');
    }
  },

  CapEnr(e) {
    e.preventDefault();
    const data = {
      "idx": Editer.idx,
      start: $(`#startTime`).val(),
      end: $(`#endTime`).val(),
      content: $(`#CapContent`).val(),
    }

    if (!$(`#CapContent`).val()) {
      return alert('자막을 입력해주세요.');
    }
    
    const timeFind = Editer.list.find(v => v.start == $(`#startTime`).val() || v.end == $(`#endTime`).val());

    if (timeFind) {
      return alert('해당되는 시간에 이미 자막이 있습니다.')
    }

    Editer.idx ++;
    Editer.list.push(data);

    alert('자막이 등록되었습니다.');
    Editer.setCap();
  },

  setCap() {
    $(`.ckBar2`).html(Editer.list.map(v => Html.captionHtml(v)));
  },

  modSet() {
    const btn = $(this).data('idx');
    const value = Editer.list.find(x => x.idx == btn);

    $(`#startTime`).val(value.start);
    $(`#endTime`).val(value.end);
    $(`#CapContent`).val(value.content);
    $(`.saveCap`).attr('data-idx', value.idx);
  },

  modify() {
    if (!$(this).data('idx')) {
      return alert('수정할 자막을 선택해주세요.');
    }

    if (!$(`#CapContent`).val()) {
      return alert('자막을 입력해주세요.');
    }
    const target = $(this).data('idx');    

    const data = {
      "idx": target,
      start: $(`#startTime`).val(),
      end: $(`#endTime`).val(),
      content: $(`#CapContent`).val(),
    }

    Editer.list[target] = data;

    if (Editer.isPlay) {
      Editer.target[0].pause();
    }

    Editer.setCap();
  },

  preView() {
    clearTimeout();
    const timeIdx = $(this).data('idx');
    const video = Editer.target[0];
    const timeData = Editer.list.find(x => x.id == timeIdx);
    Editer.isPlay = true;

    video.currentTime = +timeData.start;
    video.play();

    video.ontimeupdate = () => {
      if (video.currentTime >= timeData.end) {
        Video.isPlay = false;
        video.pause();
      }

      Caption.makeCap(timeFormat(timeData.start), timeFormat(timeData.end), timeFormat(video.currentTime), timeData.content);
    }
  },

  async thumb() {
    const video = $(`#editTarget`);
    Editer.target = video;

    const imgList = await Promise.all(Array(11).fill('').map((v, i) => 
      Editer.drawImg(video, `#t=${video[0].duration * (i / 11)}`)));
      
    imgList.shift();

    $(`.ckBar1`).html(imgList.map((x) => {
      return `<img src="${x}" alt="img">`
    }));

  },

  drawImg(video, snap) {
    return new Promise(res => {
      const v = $("<video>")[0]
      v.src = video[0].src + snap
      v.onloadeddata = (e) => {
        const c = $("<canvas>")[0];
        c.width = video.width();
        c.height = video.height();
        c.getContext(`2d`).drawImage(e.target, 0, 0, c.width, c.height);
        const url = c.toDataURL()

        res(url)
      };
    })
  }
}


//예고편 관리 분석
const Graph = {
  videoData: [],
  viewData: [],

  init() {
    Graph.setData();
  },

  setData() {
    const videoIdx = 27;

    const video = Graph.videoData.find(v => v.idx == videoIdx);
    const view = Graph.viewData.filter(v => v.video_idx == video.idx)
    .sort((a, b) => a.date - b.date)
    .map(v => {
      v.ceilData = Math.ceil(v.increase / 10000) * 10000;

      return v;
    });

    Graph.draw(view);
  },

  draw(data) {
    const max = Math.max(...data.map(v => v.ceilData)) / 10000;
    const maxCount = max * 10000;

    const c = $(`.cv1`)[0];
    const ctx = c.getContext('2d');

    ctx.beginPath();
    ctx.font = "14px Microsoft phagspa"
    ctx.fillStyle = "#333";

    //증가량 숫자 부분
    for (let i = 0; i <= 5; i++) {
      const lineHeight = 540 - (480 * (i / 5));
      const val = Math.floor(i * maxCount / 5).toLocaleString();

      ctx.fillText(val, 10, lineHeight);
      ctx.fillStyle = "#333";
      ctx.fillRect(60, lineHeight, 2000, 1);
    }

    let startX = 100;
    let moveTo = [];

    const hc = (val) => 540 - (480 * (val / maxCount));

    data.map(v => {
      const d = new Date(v.date);

      const dates = d.getFullYear() + "년" + (d.getMonth() + 1) + "월";
      const lh = hc(v.ceilData);

      if (!moveTo.length) {
        moveTo = [startX, lh];
        startX += 110;

        ctx.moveTo(...moveTo);
        return ctx.fillText(dates, moveTo[0], 575);
      }

      ctx.bezierCurveTo(moveTo[0] + 40, moveTo[1], startX - 40 , lh, startX, lh);

      ctx.fillText(dates, startX, 575);

      ctx.lineTo(startX, lh);

      moveTo = [startX, lh];
      startX += 110;
      ctx.lineWidth = 2;
      ctx.strokeStyle = "black";
    });

    ctx.stroke();
    ctx.closePath();
  },
}

const Html = {
  recHtml(data, recom) {
    const count = recom.filter(x => x.user_idx == data.idx);
    return `
      <div class="provide_item">
        <div class="pro_top">
          <div class="pro_info">
            <img src="resources/img/${data.img}" alt="user" title="user">
            <div class="text_info">
              <h2 class="comName" data-idx="${data.idx}">${data.name}</h2>
              <p>내가 추천한 영화: <span class="color">${count.length}개</span></p>
            </div>
          </div>

          <div class="detail_btn">
            <button class="btn wait_btn"><i class="fa fa-film"></i>&nbsp; 영상보기</button>
            <!-- <a href="provider.html"><button class="btn"><i class="fa fa-link"></i> 배급사 이동</button></a> -->
          </div>
        </div>

        <div class="pro_mini_title">
          <h3>주식회사 도호 | 영화목록</h3>
        </div>

        <div class="movie_list movie_list_${data.idx}">

        </div>

      </div>

      <div class="after_line"></div>
    `
  },

  recMovie(data) {
    const date = new Date(data.date);
    const enrTime = date.getHours() + ":" + date.getMinutes();
    return `
      <div class="main_movie_item">
      <div class="item_img rec_video">
        <img src="resources/img/${data.thumbnail}" alt="thumb" title="thumb" class="">
        <video src="/resources/video/${data.video}"></video>
      </div>
      <div class="item_content">
        <h3>${data.title}</h3>
        <p class="explain">
          ${data.description.substr(0, 30)}...
        </p>
        <p class="maker">
          조회수:${data.view.toLocaleString()}회 | 영상길이: ${Math.floor(data.duration / 60)}분 ${Math.floor(data.duration % 60) == 0 ? "" : Math.floor(data.duration % 60) + "초"} | 등록된 시간: ${enrTime}
        </p>
      </div>

    </div>
    `
  },

  captionHtml(data) {
    let start = +data.start / Editer.target[0].duration * 100;
    let end = +data.end / Editer.target[0].duration * 100 +1;

    return `
      <div class="timeLine" data-id="${data.idx}" style="width: ${Math.floor(end) - Math.floor(start)}%; left: ${Math.floor(start)}%">
        <div class="top">
          <p>${data.start}초</p>
          <p>${data.end}초</p>
        </div>
        <div class="cent">
          <p>${data.content}</p>
        </div>
      </div>
    `
  },

  conBtn(data) {
    return `
      <button class="btn mod_cap" data-idx="${data}">수정</button>
      <button class="btn del_cap" data-idx="${data}">삭제</button>
    `
  }
}

$(() => App.init());