// 디버깅용
const dd = console.log;
//로컬스토리지
const ls = localStorage;
const ss = sessionStorage;
//로컬스토리지 저장
const save = (type, data) => {
  if (type == "nowLoc") {
    ls['nowLoc'] = JSON.stringify(data);
  }

  if (type == "sim") {
    ls['simTarget'] = JSON.stringify(data);
  }
}
//로딩 애니메이션
const animation = (time) => {
  clearTimeout();
  setTimeout(() => {
    $(`.loading_animation2`).css("opacity", 1);
  }, 10);
  
  setTimeout(() => {
    $(`.loading_animation2 .rect2`).animate({
      "width": "0%"
    }, 6000);
    
    $(`.loading_animation2`).css({
      "opacity": 0,
      "visibility": "hidden", 
      "pointer-events": "none",
      "transition": `${time}s`
    })

    $(`.loading_animation2 h1`).css({
      "animation": "text 3s linear",
      "opacity": 0,
    })
  }, time);
  
  $(`.loading_animation2`).css("opacity", 1);
}

const timeCalc = () => {
  const now = new Date();
  now.setHours(now.getHours()+9);

  let diff = "";

  const _second = 1000;
  const _minute = _second * 60;
  const _hour = _minute * 60;
  const _day = _hour * 24; 

	const sucHtml = $(`.event_item`).toArray();

	sucHtml.forEach((v, i) => {
		diff = new Date($(v).data('close')) - now;

		const days = Math.floor(diff / _day);
	  const hours = Math.floor((diff % _day) / _hour);
	  const minutes = Math.floor((diff % _hour) / _minute);
	  const seconds = Math.floor((diff % _minute) / _second);

	  $(v).find('.timer').html(now > new Date($(v).data('close')) ? `<h1 class='end'>종료된 이벤트</h1>` : `${days}일 ${hours}시간 ${minutes}분 ${seconds}초`);
	})

	sucHtml.sort((a, b) => $(a).data('close') > $(b).data('close') ? -1 : 1);

	$(`.event_list`).html(sucHtml);
}

const eventDetail = async (idx) => {
  const url = JSON.parse(ss['login'])['user_id'] == "admin" ? 'eventMod.php' : 'eventDetail.php';

	locate.load(`${url}`);
	await $.post(`../app/getEvent.php`, {idx: idx}).done((e) => {
		const listData = JSON.parse(e);
		ls['eventData'] = JSON.stringify(listData);
    if (url != "eventMod.php") {
  		App.eventListSet(listData);
    } else {
      App.eventInfoSet(listData);
    }
	});
}

const ajax = (loc, data, form, msg, callback = '') => {
  let err = false;
  let file = "";

  const formData = new FormData($(`.${form}`)[0]);

  $(`.${form} input textarea`).each((idx, el) => {
    if (!$(el).val().trim() && err == false) {
      if (location.pathname.includes('eventMod') && $(el).attr('name') == "banner_img" && !$(el)[0].files[0]) {
        return;
      }

      alert('모든 값을 입력해주세요.');
      err = true;
      return;
    }

    if (location.pathname.includes('adCare')) {
			if (el.files[0].size >= 2097152) {
				return alert('2MB 이하 파일만 선택가능합니다.');
			}
	  }
  })



  if ($(`button[name="postType"]`).length) {
    formData.append('postType', $(callback).val());
    formData.append('postTarget', JSON.parse(ls['eventData'])['idx']);

    if (!$(`input[name="banner_img"]`)[0].files[0]) {
    	formData.append('banner_img', JSON.parse(ls['eventData'])['banner_img']);
    }
  }

  if (!err) {
    $.ajax({
      url: loc,
      contentType: false,
			processData: false,
      data: formData,
      type: "post",
    }).done((e) => {
      const res = JSON.parse(e);
      if (res.type == "error") {
        return alert(res.msg);
      }

      if (msg) {
        alert(msg);
      }

      if (res.move) {
        locate.load(res.move);
      }
      err = false;
      switch (form) {
        case "login_form":
          ss['login'] = JSON.stringify(res.user);
          break;
        case "ad_enr_form": 
        	$(`.ad_banner_list`).html(res.data.map(v => `
        		<div>
	        		<img src="${v.ad_img}" alt="adImg" title="ad_img">
	        		<div class="del_ad" data-idx="${v.idx}">
	        			<h1>X</h1>
	        		</div>
        		</div>
        		`))
        	break;
        case "review_enr_form":
        	$(`.${form}`).find('input, textarea').toArray().forEach(v => {
        		v.value = '';
        	})

        	Bakery.setReview(res.idx);
        	break;
      }
    })
  }
}

//로그아웃
const logout = () => {
  ss['login'] = [];

  $.ajax({
    url: "../app/logout.php",
    type: "post",
  }).done((e) => {
    alert('로그아웃 되었습니다.');
    locate.load('index.php');
  })
}
// 페이지 이동 감지
window.onpopstate = (e) => {
  e.preventDefault();

  locate.load();
}
// SPA 처리 함수
const locate = {
  load(url = "") {
    const target = url ? url : location.href;

    if (target.includes("login") || target.includes("join")) {
      if (ss['login']) {
        history.back();
      }
    }

    $("#main").load(`${target} #main`, (response, status, xhr) => {
      if (url) history.pushState("", "", target)
      
      $("#main").html($("#main").html().replace(`<section id="main">`, "").replace(`</section>`, ""))
      App.init();
    });
  }
}
// 기본객체
const App = {
	timeout: '',

  init() {
    if (ls['nowLoc'] && !location.pathname.includes("location")) {
      Recom.nowLoc = JSON.parse(ls['nowLoc']);
    }

    if (location.pathname.includes("recommend") && ls['recData']) {
      Recom.baker = JSON.parse(ls["recData"]);
    }

    if (location.pathname.includes("location")) {
      Recom.nowLoc = [];
    }

    if (location.pathname.includes("similarBakery") && ls['simTarget'] && !Bakery.targetBaker.length) {
      Bakery.targetBaker = JSON.parse(ls['simTarget']);
    }

    if (location.pathname.includes("login") || location.pathname.includes("join")) {
      if (ss['login']) {
        alert('로그인 한 회원은 접근할 수 없는 페이지입니다.');
        history.back();
      }
    }
  
    if (location.pathname.includes("event_enr") || location.pathname.includes("adCare")) {
      if (!ss['login'] || JSON.parse(ss['login'])['user_id'] != "admin") {
        alert('관리자만 접근 가능한 페이지입니다.');
        history.back();
      }
    }

    if (location.pathname.includes("eventList")) {
      clearTimeout(App.timeout);

    	App.timeout = setInterval(() => {
        timeCalc();
      }, 500);
    }

    if (ls['eventData']) {
    	App.eventListSet(JSON.parse(ls['eventData']));

      if (location.pathname.includes('eventMod')) {
        App.eventInfoSet(JSON.parse(ls['eventData']));
      }
    }
    
    Recom.init();
    Bakery.init();
    Search.init();
  },

  async setDb() {
    const data = await $.getJSON('../resources/data/json/bakeries.json');

    $.post('../app/dbSet.php', {data: JSON.stringify(data)}).done(function() {
      App.init();
    })
  },

  eventListSet(data) {
  	$(`.event_detail`).html(Html.eventDetail(data));
  	$(`.event_bakery_list`).html(data.bakery_data.map((v) => Html.eventBakery(v)));
  },

  eventInfoSet(data) {
    $(`.event_time input[name="event_start"]`).val(data.event_start);
    $(`.event_time input[name="event_end"]`).val(data.event_end);
    $(`input[name="event_name"]`).val(data.event_name);

    JSON.parse(data.bakery_idx).forEach(v => {
      $(`input[name="${v}"]`).attr('checked', true);
    })
  }
}

const Recom = {
  loc: [],
  nowLoc: [],
  baker: [],

  init() {
    if ($(`.location_item`).length == 0) {
      Recom.LocInit();
    }

    if (location.pathname.includes("recommend") && Recom.baker) {
      Recom.setList("", Recom.baker);
    }
  },

  async LocInit() {
    Recom.loc = await $.getJSON('../resources/data/json/area.json');
    $(`.location_list`).html(Recom.loc.map(v => Html.areaHtml(v)));
  },

  setList(type = "", data) {
    $(`.bakery_list`).html(data.map(v => Html.recBaker(v, type)));
    
    const timer = setTimeout(() => {
      $(`.bakery_list`).width("100%");
    }, 1500);

    clearTimeout(timer);
  },
} 

const Bakery = {
  bakeries: [],
  targetBaker: [],
  menuList: [],

  async init() {
  	Bakery.bakeries = JSON.parse(await $.post(`../app/bakeryDB.php`));

    if (location.pathname.includes("similarBakery.php")) {
      await Bakery.getData("menuList");
      Bakery.getData('word');
    }

    if (location.pathname.includes("bakeryList")) {
	    Bakery.setList();
    }
  },

  async getData(type) {
    if (type == "menuList" || type == "bakeries") {
      await $.ajax({
        url: `../resources/data/API/bakeries.php`,
        data: { type: type },
        type: "get",
        success: function(data) {
          if (type == "bakeries") {
            Bakery.bakeries = data;
            // Bakery.setList();
          }

          if (type == "menuList") {
            if (location.pathname.includes('bakeryList')) {
              data = data.filter(v => v.bakerIdx == Modal.menuTarget);
              $(`.modal_menu_list`).html(data.map(v => Html.menuListHtml(v)));
            }
              
            Bakery.menuList = data;
          }
        }
      }) 
    }

    if (type == "word") {
      Bakery.word = await $.getJSON('../resources/data/json/word.json');
      Bakery.similarList();
    }
  },

  similarList() {
    const data = Bakery.targetBaker;
    const targetMenu = Bakery.menuList.filter(v => v.bakerIdx == data.idx);

    const wordData = [...Bakery.word];
    const menuList = [...Bakery.menuList];
    let allBakery = [...Bakery.bakeries].filter(v => v.idx !== data.idx);

    let wordList = [];

    wordList = wordData.map(v => {
      v = {word: v, rank: 0};
      for (let review of data.review) {
        v.rank += review.split(v.word).length - 1;
      }

      return v;
    }).sort((a, b) => b.rank - a.rank).splice(0, 20).map(x => x.word);

    allBakery.map((value, i) => {
      const valMenu = menuList.filter(x => x.bakerIdx == value.idx);

      let wordScore = wordList.reduce((acc, val) => {
        for (let review of value.review) {
          acc += (review.split(val).length - 1) * 0.4;
        }

        return acc;
      }, 0)

      let hashScore = value.hashTag.reduce((acc, val) => {
        return acc += data.hashTag.filter(v => v == val).length * 1.5; 
      }, 0)

      let menuScore = valMenu.reduce((acc, val) => {
        return acc += targetMenu.filter(v => v.name == val.name).length * 3;
      }, 0)

      value.simScore = wordScore + hashScore + menuScore;
    })

    allBakery = allBakery.sort((a, b) => b.simScore - a.simScore).filter(v => v.simScore >= 100);
    allBakery.map((v, i) => v.rank = i + 1)

    Bakery.setSimList(allBakery, [wordList, data.hashTag, targetMenu]);
  },

  setList() {
    $(`.bakeList`).html(Bakery.bakeries.map(v => Html.bakeListHtml(v)));
  },

  setSimList(data, searchData) {
    $(`.search_word_list`).html(searchData[0].map(v => {
      return `<div>${v}</div>`
    }));

    $(`.search_hash`).html(searchData[1].map(v => {
      return `<div>${v}</div>`
    }));

    $(`.search_menu`).html(searchData[2].map(v => {
      return `<div>${v.name}</div>`
    }));

    $(`.simList`).html(data.map(v => Html.simBakerList(v)));
  },

  setReview(target, sort = "") {
  	$.ajax({
  		url: `../app/reviewDB.php`,
			data: {idx: target},
			type: 'post' ,
  	}).done((e) => {
  		const data = JSON.parse(e);
  		Bakery.reviewTarget = target;

      if (sort == "favorite") {
  			data.sort((a, b) => b.favorite - a.favorite);
  		}

      if (sort == "date") {
        data.sort((a, b) => b.date - a.date);
      }
      dd(data);
	  	$(`.rev_list`).html(data.map(v => Html.reviewHtml(v)));
  	})

  }
}

const Search = {
  bakery: [],
  selTag: [],
  
  async init() {
    if (!location.pathname.includes("bakerySearch")) {
      return;
    }

    await Bakery.getData('bakeries');
    Search.bakery = [...Bakery.bakeries];

    Search.setHashList();
    Search.setList(Search.bakery);
  },

  regSet() {
    const inputReg = new RegExp(`(${$(`.search_input`).val()})`, "gu");

    Search.Reg = inputReg;
    Search.search();
  },

  search() {
    const data = Search.bakery.filter(v => {
      let check = true;

      if (Search.selTag.length) {
        check = false;

        Search.selTag.forEach(x => {
          if (v.hashTag.includes(x)) {
            check = true;
          }
        });
      }

      return check && (v.name.match(Search.Reg) || v.openTime.match(Search.Reg) || v.endTime.match(Search.Reg))
    });

    Search.setList(data);
  },

  setHashList() {
    const hash = Search.bakery.map(v => v.hashTag).reduce((acc, val) => {

      return [...new Set(acc.concat(val))];
    }, []);

    $(`.hash_tag_list`).html(hash.map(v => `<div class="search_hashTag" data-tag="${v}">${v}</div>`));
  },

  setList(data) {
    if (!data.length) {
      $(`.search_baker_list`).html(`<h1 class="color tlc">검색 결과가 없습니다.</h1>`);
      return;
    }

    $(`.search_baker_list`).html(data.map(v => Html.searchPageHtml(v)));
  }
}

const Html = {
  areaHtml(data) {
    return `
       <div class="location_item flex js alc">
          <div class="loc_img">
            <img src="resources/image/행정구역/${data.image}" alt="loc" title="loc">
          </div>
          <div class="loc_info">
            <h2>${data.name}</h2>
            <button class="loc_sel_btn btn" data-idx="${data.idx}">선택</button>
          </div>
        </div>
    `
  },

  recBaker(data, type) {
    return `
      <div class="baker_item">
          <div class="baker_img">
            <img src="../resources/image/빵집/${data.mainImage}" alt="baker" title="baker">
          </div>
          <div class="baker_info">
            <h3><span class="color">[빵집 이름]</span> ${data.name}</h3>
            <h3><span class="color">[위치]</span> ${data.location}</h3>
            <h3 style="line-height: 20px;">
              <span class="color">[영업시간]</span><br>
              <span style="font-size: .9rem;">open: ${data.openTime}<Br>
                ~<br>
              close: ${data.endTime}</span>
            </h3>
            <h3>
              <span class="color">[정렬방식]</span> ${type == "" ? "기본" : 
                (type == "review" ? `리뷰개수 ${data.reviewCnt}개` : 
                (type == "score" ? `평점 ${data.grade}점` : 
                (type == "ai" ? `점수 ${data.aiScore}점` : "")
                )
                )
              }
            </h3>
          </div>
        </div>
    `
  },

  bakeListHtml(data) {
    return `
      <div class="bakery_content" style="background: url('../resources/image/빵집/${data.mainImage}') no-repeat; background-size:100% 600px;">
          <div class="bakery_cont_info flex alc ">
            <h3><span class="color">[빵집 이름]</span>: ${data.name}</h3>
            <h3><span class="color">[영업 시간]</span>: ${data.openTime} ~ ${data.endTime}</h3>
            <p style="font-size: .9rem"><span class="color">[빵집 소개]</span>: ${data.intro}</p>

            <div class="after_line"></div>

            <div class="bake_btn_area flex alc js">
              <button class="btn2 detail_view" data-idx="${data.idx}" data-type="detail_view" onclick="Modal.open(this)">상세보기</button>
              <button class="btn2 view_menu" data-idx="${data.idx}" data-type="menuList" data-type="menuList" onclick="Modal.open(this)">메뉴 보기</button>
              <button class="btn2 similar_bakery" data-idx="${data.idx}">유사한 빵집 찾아보기</button>
            </div>
          </div>
        </div>
    `
  },

  detailHtml(target) {
    const data = Bakery.bakeries.find(v => v.idx == $(target).data('idx')); 

    let imgHtml = "";

    JSON.parse(data.subImage).map(v => {
      imgHtml += `<img src="/resources/image/서브이미지/${v}" alt="bakery_info" title="bakery_info">`
    })

    return `
      <div class="modal_left">
        <h3 class="color">[빵집 이미지]</h3>
        <div class="subImage_box flex">
        ${imgHtml}
        </div>
      </div>

      <div class="modal_right">
        <h3><span class="color">[빵집 이름]</span> ${data.name.replace(Search.Reg, "<mark>$1</mark>")}</h3>
        <h3><span class="color">[빵집 주소]</span> ${data.location}</h3>
        <h3><span class="color">[영엽 시간]</span> ${data.openTime} ~ ${data.endTime}</h3>
        <h3 style="font-size: 1rem;"><span class="color">[빵집 소개]</span> ${data.intro}</h3>
      </div>

      <div class="after_line"></div>

      <div class="review_enr">
      	<form class="review_enr_form">
      		<ul>
      			<li><label>리뷰 제목</label></li>
      			<li><input type="text" class="input" name="review_title"></li>
      		</ul>
      		<ul>
      			<li><label>리뷰 콘텐츠</label></li>
      			<li><textarea name="review_content" id="review_content" cols="130" rows="5"></textarea></li>
      		</ul>
      		<ul>
      			<li><label>리뷰 이미지</label></li>
      			<li><input type="file" class="input" name="review_img"></li>
      		</ul>
      		<input type="hidden" name="bakery_idx" value="${data.idx}">
      		<button type="button" class="btn review_enr_btn" style="margin-top: 2rem;" onclick="ajax('../app/reviewEnr.php', '', 'review_enr_form', '등록이 완료되었습니다.')">리뷰 등록</button>
      	</form>
      </div>

      <div class="after_line"></div>
      <div class="sort_review">
				<button class="btn2 review_sort_btn" data-type="favorite">좋아요순</button>
      	<button class="btn2 review_sort_btn" data-type="date">최신순</button>
      </div>
      <div class="review_list rev_list">

      </div>
    `
  },

  menuListHtml(data) {
    return `
      <div class="menuListItem flex" style="background: url('resources/image/메뉴/${data.image}') no-repeat; background-size: 100% 100%;">
        <div class="menu_item_info">
          <h3><span class="color">[메뉴 이름]</span> ${data.name}</h3>
          <p><span class="color">[메뉴 정보]</span> ${data.intro}</p>
          <p><span class="color">[가격]</span> ${data.price}</p>
          <p><span class="color">[알레르기 정보]</span> ${data.allergy}</p>
        </div>
      </div>
    `
  },

  simBakerList(data) {
    return `
      <div class="bakery_content simBaker" style="background: url('resources/image/빵집/${data.mainImage}'); no-repeat; background-size: 100% 100%;">
      ${data.rank < 4 ? `<div class="sim_rank">${data.rank}등</div>` : ""}
        <div class="bakery_cont_info flex ">
          <h3><span class="color">[빵집 이름]</span>: ${data.name}</h3>
          <h3><span class="color">[영업 시간]</span>: ${data.openTime} ~ ${data.endTime}</h3>
          <p><span class="color">[빵집 소개]</span>: ${data.intro}</p>
          <h4><span class="color">유사도 점수: ${Math.floor(data.simScore)}</span></h4>
        </div>
      </div>
    `
  },

  searchPageHtml(data) {
    let tags = "";

    data.hashTag.map(v => {
      tags += `<p class="${Search.selTag.find(x => x == v) ? "highlights" : ""}">${v}</p>`;
    });
    
    return `
      <div class="bakery_content simBaker" style="background: url('resources/image/빵집/${data.mainImage}') no-repeat; background-size: 100% 100%;">
          <div class="bakery_cont_info flex ">
            <h3><span class="color">[빵집 이름]</span>: ${data.name}</h3>
            <h3><span class="color">[영업 시간]</span>: ${data.openTime} ~ ${data.endTime}</h3>
            <p><span class="color">[빵집 소개]</span>: ${data.intro}</p>
            <div class="flex alc js ba_tag">
              ${tags}
            </div>
          </div>
        </div>
    `
  },

  eventDetail(data) {
  	data.bakery_data = data.bakery_data.map(v => {
  		return JSON.parse(v);
  	});

  	return `
	  	<div class="event_item flex alc jc" style="background: url('${data.banner_img}') no-repeat; background-size: 100%, 100%;">
		    <div class="event_info">
		      <h1 class="event_name">이벤트 명: ${data.event_name}</h1>
		      <h1>함께하는 빵집: ${data.bakery_data.map(v => {return v.name})}</h1>
		      <h1>이벤트 기간: ${data.event_start} ~ ${data.event_end}</h1>
		    </div>
		  </div>
  	`
  },

  eventBakery(data) {
  	return `
	  	<div class="bakery_content target_event_bakery" style="background: url('../resources/image/빵집/${data.mainImage}') no-repeat; background-size: cover;" data-idx="${data.idx}" data-type="detail_view">
	      <div class="bakery_cont_info flex alc ">
	        <h3><span class="color">[빵집 이름]</span>: ${data.name}</h3>
	        <h3><span class="color">[영업 시간]</span>: ${data.openTime} ~ ${data.endTime}</h3>
	        <p><span class="color">[빵집 위치]</span>: ${data.location}</p>

	        <div class="after_line"></div>

	        <div class="bake_btn_area flex alc js">
	        	<p>${data.intro}</p>
	        </div>
	      </div>
	    </div>
  	`
  },

  reviewHtml(data) {
  	return `
  	<div class="bakery_review flex">
				<div class="review_img">
          <img src="${data.review_img}" alt="review" title="review">
        </div>

        <div class="review_right">
          <i class="far fa-heart"></i>
          <p class="like_count">좋아요 <span>${data.favorite ? data.favorite : 0}개</span></p>
          <h4>${data.review_title}</h4>
          <p class="reivew_content" onclick="Modal.open(this)" data-idx="${data.idx}" data-type="review_modify">
            ${data.review_content}
          </p>
          <div class="review_info">
            <p class="time"><span>${data.date}</span>에 작성</p>
          </div>
        </div>
			</div>
  	`
  }
}

const Modal = {
  menuTarget: "",

  open(target = "", data = "") {
    const type = $(target).data('type') ? $(target).data('type') : "";
    dd(type)
    $(`.modal, #${type}`).addClass('open');

    if (type == "detail_view") {
      $(`.modal_content`).html(Html.detailHtml(target));
      Bakery.setReview($(target).data('idx'));
    }

    if (type == "review_modify") {

    }

    if (type == "menuList") {
      Modal.menuTarget = $(target).data('idx');
      Bakery.getData(type);
    }
  },

  close() {
    if (Modal.menuTarget) {
      Modal.menuTarget = "";
    }

    $(`.modal, .popup`).removeClass('open');
  }
}

const sortData = {
  visitant: ["0", "50", "150", "250", "300"],
  reviewCnt: ["0", "20", "40", "60", "80"],
  sales: ["0", "1000000", "1500000", "2000000", "2500000"],
}

const Event = {
  hook() {
    $(document)
      //SPA이벤트
      .on("click", ".move", function (e) {
        e.preventDefault();

        const target = $(this).attr("href");

        locate.load(target)
      })
      //지역리스트 지역선택
      .on(`click`, ".loc_sel_btn", function (e) {
        const target = $(e.target);
        $(`.next_move`).removeClass('disabled');

        if (target.attr('class').includes("now_loc")) {
          let delIdx = Recom.nowLoc.indexOf(Recom.loc.find(v => v.idx == target.data('idx')));
          
          target.removeClass('now_loc');
          Recom.nowLoc.splice(delIdx, 1);
          save("nowLoc", Recom.nowLoc);

          return target.html('선택');
        }

        if (!Recom.nowLoc) {
          $(`.next_move`).addClass('disabled');
        }

        target.addClass('now_loc');
        Recom.nowLoc.push(Recom.loc.find(v => v.idx == target.data('idx')));
        target.html('선택취소');

        save("nowLoc", Recom.nowLoc);
      })
      //지역리스트에서 다음페이지 버튼 클릭
      .on(`click`, ".next_page", async function(e) {
        e.preventDefault();
        locate.load("recommend.php");

        const areaArr = [];
        
        Recom.nowLoc.forEach(v => {
          areaArr.push(v.name);
        });

        animation(3000);

        await $.ajax({
          url: `../resources/data/API/recommend.php`,
          data: { type: "bakeries", area: areaArr },
          type: "get",
          timeout: `30000`,
          error: function (req, sta, err) {
            App.isRun = false;

            if (err == "timeout") {
              alert('API 요청에 실패하였습니다.');
              return locate.load("location.php");
            }
          },
          success: function (data) {
            animation(1000);

            Recom.baker = data;
            ls['recData'] = JSON.stringify(data);
            Recom.setList("", data);
          }
        })
      })
      //추천페이지 정렬하기
      .on(`click`, ".recom_sort_btn button", function(e) {
        const data = [...Recom.baker];
        const type = $(e.target).data('type');

        $(`.recom_sort_btn button`).css('background', "#fff");

        switch (type) {
          case "review":
            data.sort((a, b) => b.reviewCnt - a.reviewCnt);
            break;

          case "score":
            data.sort((a, b) => b.grade - a.grade);
            break;

          case "ai":
            let arr = [];

            for (v of data) {
              let sortSta = ["visitant", "reviewCnt", "sales"];

              arr = sortSta.map(x => {
                return sortData[x].filter(val => val < v[x]).length;
              })

              v.aiScore = v.grade + arr.reduce((acc, val) => acc + val, 0);
            }

            data.sort((a, b) => b.aiScore - a.aiScore);
            break;
        }
        
        $(`.bakery_list`).width(0);

        $(e.target).css('background', "#ffa500");
        Recom.setList(type, data);
      })
      //모달 닫기
      .on(`click`, ".popup_close", Modal.close)
      //비슷한 빵집 찾기 
      .on(`click`, ".similar_bakery", function(e) {
        const targetIdx = $(e.target).data('idx');
        
        Bakery.targetBaker = Bakery.bakeries.find(v => v.idx == targetIdx);
        save('sim', Bakery.targetBaker);
        locate.load("similarBakery.php");
      })
      //빵집 검색 해시테그 클릭
      .on(`click`, ".search_hashTag", function(e) {
        const target = $(e.target);

        if (target.hasClass('sel_tag')) {
          const index = Search.selTag.indexOf(target.data('tag'));

          Search.selTag.splice(index, 1);
          target.removeClass('sel_tag');

          Search.search();
          return;
        }

        if (Search.selTag.length >= 10) {
          return alert('해시태그는 최대 10개까지 선택 가능합니다.');
        }
        
        Search.selTag.push(target.data('tag'));
        target.addClass('sel_tag');

        Search.search();
      })
      //빵집 검색 인풋 입력
      .on(`input`, ".search_input", Search.regSet)
      //이벤트 등록 시간 체크
      .on(`change`, ".event_time input", function(e) {
        const time1 = $(`.event_time input`)[0].value;
        const time2 = $(`.event_time input`)[1].value;

        if (!time1 || !time2) {
          return;
        }

        if (time1 > time2) {
          $(`.event_time input`)[1].value = "";
          return alert('종료일은 시작일보다 빠를 수 없습니다.');
        }

      })
      // 이벤트 세부 사항에서 이벤트 진행 빵집 선택
      .on(`click`, ".target_event_bakery", function(e) {
      	let timer = '';
      	locate.load('bakeryList.php');
      	
      	clearTimeout(timer);
      	timer = setTimeout(() => {
	      	Modal.open($(this)[0])
      	}, 100)

      })
      //광고 관리 페이지 광고 배너 삭제
      .on(`click`, ".del_ad", async function(e) {
      	const dataIdx = $(e.target).closest('div').data('idx');

      	$.post(`../app/adDB.php`, {data: dataIdx, type: "delete"}).done((e) => {
      		$(`.ad_banner_list`).html(JSON.parse(e).data.map(v => `
        		<div>
	        		<img src="${v.ad_img}" alt="adImg" title="ad_img">
	        		<div class="del_ad" data-idx="${v.idx}">
	        			<h1>X</h1>
	        		</div>
        		</div>
        		`))
      	})
      })
      .on(`click`, ".review_sort_btn", function(e) {
        Bakery.setReview(Bakery.reviewTarget, $(e.target).data('sort'));
      })
  }
}

$(() => {
  if (!ss['login']) {
    ss['login'] = [];
  }

  App.setDb();
  Event.hook();
})