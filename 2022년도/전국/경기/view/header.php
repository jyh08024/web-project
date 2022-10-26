<!DOCTYPE html>
<html lang="zxx">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- 폰트어썸 아이콘 로드 -->
  <link rel="stylesheet" href="/resources/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="/resources/fontawesome/css/fontawesome.min.css">
  <!-- 스타일 로드 -->
  <link rel="stylesheet" href="/resources/css/style.css">
  <script src="/resources/js/jquery-3.6.0.min.js"></script>
  <script src="/resources/js/app.js"></script>
</head>
<body>

  <!-- 로딩애니메이션 -->
  <!-- <div class="load"> -->
    <!-- <div class="origin"> -->

    <!-- </div> -->
    <!-- <div class="reflect"> -->

    <!-- </div> -->
    <!-- <div class="shadow_box"> -->

    <!-- </div> -->
  <!-- </div> -->

<!-- 헤더 영역 -->
  <header>
    <!-- 헤더 랩 -->
    <div class="header_rap wrap flex alc js">
      <div class="logo">
        <a href="/">
          <img src="/resources/logo.png" alt="logo" title="logo">
        </a>
      </div>

      <ul class="menu">
        <li class="main_menu">
          <a href="/"><i class="fa fa-home"></i> 홈</a>
        </li>
        <li class="main_menu">
          <a href="/guide"><i class="fa fa-list"></i> 정원안내</a>

          <ul class="sub_menu">
            <li><a href="/guide"><i class="fa fa-list"></i> 정원안내</a></li>
            <li class="after_line opa1"></li>
            <li><a href="/search">정원검색</a></li>
            <li><a href="/allGarden">전체정원목록</a></li>
          </ul>
        </li>
        <li class="main_menu">
          <a href="#"><i class="fa fa-calendar-alt"></i> 정원예약</a>

          <ul class="sub_menu">
            <li><a href="#"><i class="fa fa-calendar-alt"></i> 정원예약</a></li>
            <li class="after_line opa1"></li>
            <li><a href="#">예약확인</a></li>
            <li><a href="/resList">예약내역</a></li>
          </ul>
        </li>
        <li class="main_menu">
          <a href="/news/all/1"><i class="fa fa-comment-o"></i> 정원 소식지</a>
        </li>
      </ul>

      <div class="user_btn">
        <?php if (@USER): ?>
        <a href="/logout" class="btn"><i class="fa fa-user-minus"></i> 로그아웃</a>
        <?php else: ?>
        <a href="/login" class="btn"><i class="fa fa-users"></i> 로그인</a>
        <a href="/join" class="btn"><i class="fa fa-user-plus"></i> 회원가입</a>
        <?php endif ?>
      </div>
    </div>
  </header>

  <style>
    .form_box {
      width: 100%;
      border-radius: 30px;
      display: flex;
      align-items: center;
      box-shadow: 0 0 30px rgb(0 0 0 / 10%);
      overflow: hidden;     
      margin-bottom: 3rem; 
    }

    .form_left {
      width: 100%;
      height: 100%;
    }

    .form_right {
      width: 100%;
      padding: 2rem;
    }

    .form_box ul {
      margin-bottom: .3rem;
    }

    .form_box ul > li:nth-child(1) {
      font-size: 1.1rem;
      margin-bottom: .3rem;
    }

    .disa {
      opacity: .7;
      pointer-events: none;
    }

    .man_board_item,
    .man_board_top {
      grid-template-columns: repeat(5, 1fr);
      height: 54.97px;
    }

    .res_board_item,
    .res_board_top {
      grid-template-columns: repeat(6, 1fr);
    }

    .no_list {
      display: grid;
      grid-gap: 1rem;
      grid-template-columns: repeat(4, 1fr);
      padding: 2rem;
    }

    .guide_item {
      position:relative;
    }

    .guide_1::after {
      content: "1위";
      position: absolute;
      width: 55px;
      height: 55px;
      font-size: 1.2rem;
      font-weight: bold;
      top: 0;
      left: 4%;
      border-radius: 50%;
      background: #c5e302;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .guide_2::after {
      content: "2위";
      position: absolute;
      width: 55px;
      height: 55px;
      font-size: 1.2rem;
      font-weight: bold;
      top: 0;
      left: 4%;
      border-radius: 50%;
      background: #c5e302;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .guide_3::after {
      content: "3위";
      position: absolute;
      width: 55px;
      height: 55px;
      font-size: 1.2rem;
      font-weight: bold;
      top: 0;
      left: 4%;
      border-radius: 50%;
      background: #c5e302;
      display: flex;
      align-items: center;
      justify-content: center;
    }
  </style>

  <script type="text/javascript">
    $(document) 
      .on(`click`, ".popup_close", (e) => {
        $(`.modal`).removeClass('open').html("");
        $(`body`).css('overflow', 'auto');
      })
      .on(`input`, ".toggle input", (e) => {
        // e.preventDefault();

        // $(`.toggle input:checked`).prop('checked', false);
        // $(e.currentTarget).prop('checked', true);
        $.post(`/get/sortGarden`, {"type" : e.target.value}).done((res) => {
          $(`.garden_list`).html(res.map((v, i) => {
            return `<div class="guide_item guide_${i + 1}">
            <a href="/detail/${v.idx}">
              <div class="guide_img">
                <img src="/resources/민간정원/${v.name}2.jpg" alt="img" title="img" onerror="Html.imgErr(this)">
              </div>
              
              <div class="guide_t">
                <div class="flex alc js">
                  <h3>${v.name}</h3>
                  <p>${v.themes}</p>
                </div>

                <div class="flex alc js">
                  <div class="flex alc">
                    <p style="margin-right: .3rem;">별점: ${v.star}점</p>
                    <div class="star">
                      <p class="full_star" style="width: calc(10% * ${v.star});">★★★★★</p>
                      <p class="emp_star">☆☆☆☆☆</p>
                    </div>
                  </div>
                  <p style="margin-bottom: .3rem;">리뷰 수: ${v.review}회</p>
                  <p style="margin-bottom: .3rem;">예약 수: ${v.reserve}회</p>
                </div>
                <p class="garden_ex">${v.introduce}</p>
              </div>
            </a>
          </div>`
          }))
        })
      })
      .on(`input`, ".count_input", (e) => {
        const val = $(e.target).val().replaceAll(/[^0-9]/g  , "");
        e.target.value = val;
      })
      .on(`input`, ".res_form input", (e) => {
        $(`.res_btn`).addClass('disa');
        $(`.price_style`).hide();
      })
      .on(`submit`, ".res_form", (e) => {
        e.preventDefault();
      })
      .on(`click`, ".res_btn", (e) => {
        $(`.res_form`)[0].submit();
      })
      .on(`mousemove mouseleave mouseout`, ".drag_star", (e) => {
      if (e.offsetX >= 164.66) {
        return;
      }

      const val = Math.ceil(e.offsetX / 16.46);

      if (val <= -1) {
        return;
      }

      $(`.star .full_star`).css('width', val * 16.46);
      $(`.star_input`).val(val);
      $(`.star_sc`).html(val + "점");
    })
    .on(`input`, ".rev_img", (e) => {
      const file = Object.values(e.target.files);
      let err = false;

      if (file.length > 4) {
        alert('사진은 최대 4장만 업로드 가능합니다.');
        e.target.value = "";
        return;
      }

      file.forEach(v => {
        if (!v.type.includes("image")) {
          err = true;
        }
      });

      if (err) {
        alert('이미지만 업로드 가능합니다.');
        e.target.value = "";
        return;
      }
    })
      .on(`submit`, ".review_form", (e) => {
      e.preventDefault();

      const tagCk = $(`.tag_input:checked`).length;
      let emp = false;

      $(e.target).find('input:not(.tag_input)').toArray().forEach(v => {
        if (emp) {
          return;
        }

        if (v.value.trim() == "") {
          emp = true;
        }
      });

      if (emp || !tagCk) {
        alert('모든 값을 입력해주세요.');
        return;
      }

      const formData = new FormData(e.target);
      formData.append('tag', $(`.sel_tag input`).toArray().map(v => v.value));
      
      Object.values($(`.rev_img`)[0].files).forEach(v => {
        formData.append('userFile[]', v, v.name);
      })

      $.ajax({
        url: '/post/review',
        processData: false,
        contentType: false,
        data: formData,
        type: 'POST',
        enctype: 'multipart/formData'
      }).done((res) => {
        alert(res[0]);
        $(`.modal`).removeClass('open').html("");
        $(`body`).css('overflow', 'auto');
        $(`.rev_btn[data-idx="${res[1]}"`).css({
          "opacity": 0,
          "pointer-events": "none"
        });
      })
    })

    const tagE = (target) => {
      if ($(target).parent().hasClass('sel_tag')) {
        $(target).parent().removeClass('sel_tag');
      } else {
        $(target).parent().addClass('sel_tag');
      }
    }

    const revModal = (idx, garden) => {
      const clone = $($(`template`)[0].content).find('.rev_popup').clone();
      $(`.modal`).addClass('open').html(clone);
      $(`body`).css('overflow', 'hidden');

      $(`.res_idx_input`).val(idx);
      $(`.garden_input`).val(garden);

      const tags = [
        "자연적인",
        "광활한",
        "가족여행",
        "관광",
        "등산",
        "휴식",
        "연인여행",
        "친구여행",
        "자연탐구",
        "울창한",
        "숲",
        "꽃밭",
        "아름다운",
        "평화로운",
        "멋진",
        "산림",
        "체험장",
        "휴양시설",
        "깔끔한",
        "관리",
        "강",
        "국가관광지",
        "나홀로여행",
        "낚시",
        "공원",
        "들판",
        "산",
        "시원한",
        "활동적인",
        "향긋한"
      ];

      $(`.sub_list_tag`).html(tags.map(v => {
        return `<label class="sub_tag"><input class="tag_input" type="checkbox" name="tag" value="${v}" hidden  onclick="tagE(this)">${v}</label>`;
      }))
    }

    const res_check = (e) => {
      const form = $(`.res_form`).serializeArray();

      if (form[0].value.trim() == "" || form[1].value.trim() == "") {
        alert("모든 값을 입력해주세요.");
        return;
      }

      $.post("/resCk", {date: form[0].value, "count": form[1].value, "garden": form[2].value}).done((res) => {
        if (res.length) {
          alert('예약이 불가능한 날짜입니다. 다른 날짜를 골라주세요.');
          return;
        }

        $(`.res_btn`).removeClass('disa');
        $(`.price_input`).val(5000 * form[1].value);
        $(`.price_style`).show();
        $(`.price`).html((5000 * form[1].value).toLocaleString());
      });
    }
  </script>