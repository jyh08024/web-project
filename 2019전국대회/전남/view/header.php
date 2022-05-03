<!DOCTYPE html>
<html lang="zxx">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="/resources/fontAwesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/resources/css/style.css">
  <script src="/resources/js/jquery-3.6.0.min.js"></script>
  <script src="/resources/js/app.js"></script>
</head>
<body>

  <div class="load_animation">
    <h1>NOW LOADING</h1>
  </div>

  <div class="side_btn" onclick="location.href = 'ticketing'">
    <div>
      <i class="fa fa-ticket"></i>
      <h3>영화 예매</h3>
    </div>
  </div>
  <!-- 헤더 -->
  <header>
    <div class="header_rap">
      <div class="logo">
        <a href="/">
          <img src="/resources/logo.png" alt="logo" title="logo">
        </a>
      </div>

      <ul class="menu flex">
        <li>
          <a href="/"><i class="fa fa-home"></i> 메인</a>
        </li>
        <li>
          <a href="#"><i class="fa fa-film"></i> 영화제</a>
      
          <ul class="sub_menu">
            <li>
              <a href="#"><i class="fa fa-film"></i> 영화제</a>
            </li>
            <li class="after_line"></li>
            <li><a href="biff.html">영화제소개</a></li>
            <li><a href="place.html">행사장소개</a></li>
          </ul>
        </li>
        <li>
          <a href="/ticketing"><i class="fa fa-ticket"></i> 예매</a>
      
          <ul class="sub_menu">
            <li>
              <a href="/ticketing"><i class="fa fa-ticket"></i> 예매</a>
            </li>
            <li class="after_line"></li>
            <li><a href="/schedule">상영시간표</a></li>
            <li><a href="/ticketing">영화예매</a></li>
            <li><a href="/ticketinfo">예매내역</a></li>
          </ul>
        </li>
        <li>
          <a href="#"><i class="fa fa-video-camera"></i> 영화</a>
      
          <ul class="sub_menu">
            <li>
              <a href="#"><i class="fa fa-video-camera"></i> 영화</a>
            </li>
            <li class="after_line"></li>
            <li><a href="#">영화안내</a></li>
          </ul>
        </li>
        <li>
          <a href="#"><i class="fa fa-calendar-check-o"></i> 이벤트</a>
      
          <ul class="sub_menu">
            <li>
              <a href="#"><i class="fa fa-calendar-check-o"></i> 이벤트</a>
            </li>
            <li class="after_line"></li>
            <li><a href="#">이벤트안내</a></li>
          </ul>
        </li>
      </ul>

      <div class="user_btn">
        <?php if (USER): ?>
          <h4>아이디:<?= USER['user_id'] ?> / 이름:<?= USER['user_name'] ?></h4>
        <button class="btn" onclick="location.href='/logout'"><i class="fa fa-user"></i> 로그아웃</button>
          <?php else: ?>
        <label class="btn" for="login_view"><i class="fa fa-user"></i> 로그인</label>
        <label class="btn" for="join_view"><i class="fa fa-user-plus"></i> 회원가입</label>
        <?php endif ?>
      </div>
    </div>
  </header>

  <script>
    const reg = {
      "user_id": "^[A-z0-9]+$",
      "user_pass": "^(?=.[A-z0-9])(?=.*[0-9])[A-z0-9]{4,}$",
      "user_name": "^[가-힣A-z]+$",
    };

    const msg = {
      "user_id": "아이디는 영문/숫자로 구성되어야합니다.",
      "user_name": "이름은 한글(자모음이 조합된 한글)/영문만 가능합니다.",
      "user_pass": "비밀번호는 영문숫자조합 4글자 이상이어야합니다.",
      "user_pass_ck": "비밀번호확인은 비밀번호와 일치해야 합니다.",
    };

    let err = false;

    $(document) 
      .on(`input`, ".join_form .input", async (e) => {
        const target = $(e.target);
        const name = target.attr('name');

        $(`.${name}_err`).html('');

        const regCk = name != "user_pass_ck" ? new RegExp(reg[name]).test(target.val()) : $(`.join_form input[name="user_pass"]`).val() == $(`input[name="user_pass_ck"]`).val();

        if (name == "user_id") {
          const idCk = await $.post(`/post/idCk`, { id: target.val() });

          if (idCk) {
            $(`.${name}_err`).html('중복된 아이디입니다.');
            return;
          }
        }

        if (!regCk) {
          $(`.${name}_err`).html(msg[name]);
        }
      })
      .on(`submit`, ".join_form", (e) => {
        e.preventDefault();
        err = false;

        $(e.target).find('input').toArray().forEach(v => {
          err = v.value.trim() == "" ? true : false;
        });

        $(`.join_form .err`).toArray().forEach(v => {
          if (err) {
            return;
          }

          err = $(v).html() ? true : false;
        });

        if (err) {
          alert('조건에 맞게 모든 값을 입력해주세요.');
          return;
        }

        const form = new FormData($(e.target)[0]);

        $.ajax({
          url: `/post/join`,
          processData: false,
          contentType: false,
          data: form,
          method: "POST"
        }).done((res) => {
          alert(res);

          if (res.trim() != "아이디 또는 비밀번호가 틀립니다".trim()) {
            $(`label[for="login_view"]`).click();
            $(`.user_btn`).html(`
              <a class="btn" href="/logout"><i class="fa fa-user"></i> 로그아웃</a>
            `);

            setTimeout(() => {
              location.href = "/";
            }, 100);
          }
        });
      })
      .on(`submit`, "#login_popup form", (e) => {
        e.preventDefault();

        const formData = new FormData($(e.target)[0]);

        $.ajax({
          url: '/post/login',
          processData: false,
          contentType: false,
          data: formData,
          type: 'post',
        }).done((res) => {
          alert(res);

          if (res.trim() != "아이디 또는 비밀번호가 틀립니다".trim()) {
            setTimeout(() => {
              location.href = "/";
            }, 100);
          }
        });
      })
      .on(`click`, ".first_option > button", async (e) => {
        $(`.first_option > button`).removeClass(`now_option`);
        $(`.option_detail .sel_option`).css('display', 'none');
        $(e.target).addClass('now_option');
        $(`.${$(e.target).data('type')}_sel`).css('display', 'grid');
      })
      .on(`click`, ".option_detail > .sel_option button", async (e) => {
        const type = $(e.target).data('type');
        const val = $(e.target).data('value');

        $(`.option_detail > .sel_option button`).removeClass('now_option');
        $(e.target).addClass('now_option');

        if (type == "theater") {
          const theater = await $.post(`/post/getName`);
          const detailTheater = theater.filter(v => v.name.includes(val));

          $(`.th_detail_sel`)
            .css('display', 'grid')
            .html(detailTheater.map(v => {
              return `
                <button data-type="theater_detail" data-value="${v.code}">${v.name}</button>
              `;
            }));
        }
      })
      .on(`click`, ".day_sel button, .th_detail_sel button, .section_sel button", (e) => {
        const type = $(e.target).data('type');
        const val = $(e.target).data('value');

        $(`.day_sel button, .th_detail_sel button, .section_sel button`).removeClass('now_option');
        $(e.target).addClass('now_option');

        $.post('/post/schedule', { sortKey: val, sortType: type }).done((res) => {
          $(`.movie_section`).html(Object.entries(res[0]).map((v, i) => {
            const movie = v[1].map(v => {
              return `
                <div class="movie_item">
                  <div class="movie_img">
                    <img src="../resources/data/poster/${v.posterImage}" alt="movie" title="movie">
                  </div>

                  <div class="movie_info">
                    <h2><a href="/movieDetail/${v.movieCode}"><span class="color">[영화명]</span> ${v.title}</a></h2>
                    <h4><span class="color">[예매코드]</span> ${v.code}</h4>
                    <h4><span class="color">[상영시간]</span> ${v.time}</h4>
                    <h4><span class="color">[상영관]</span> ${v.theaterName}</h4>
                    <h4><span class="color">[상영일]</span> 10월 ${v.day}일</h4>
                  </div>
                </div>
              `;
            });

            return `
              <div class="movie_box">
                <h1 class="box_title">${res[1] == "theater_detail" ? "10월 " + v[0] + "일" : v[0]}</h1>
                <div class="movie_list">
                  ${movie.join("")}
                </div>
              </div>
            `;
          }))
        })
      })
  </script>

<style>
  .option_sel_area {
    width: 100%;
  }

  .sel_option {
    display: grid;
    grid-gap: .5rem;
  }

  .sel_option button {
    width: 100%;
    padding: .4rem;
    font-size: 1rem;
    background: #f4f5fc;
    color: #000;
    cursor: pointer;
    border: 1px solid rgba(0, 0, 0, .1);
  }

  .now_option {
    background: #ff2d31 !important;
    color: #fff !important;
  }

  .option_detail {
    margin-top: 1rem;
  }

  .option_detail > .sel_option {
    display: none;
  }

  .th_detail_sel {
    margin-top: 1rem;
  }

  .movie_list {
    display: grid;
    grid-gap: 1.5rem;
    grid-template-columns: repeat(2, 1fr);
  }

  .movie_item {
    width: 100%;
    height: 100%;
    padding: 1rem;
    border: 1px solid #ff2d31;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-radius: 10px;
  }

  .movie_img {
    width: 45%;
    height: 13rem;
    overflow: hidden;
    border: 1px solid #f4f5fc;
  }

  .movie_img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .movie_info {
    width: 50%;
  }

  .movie_info h2, h4 {
    margin-bottom: .5rem;
  }

  .box_title {
    margin-bottom: .5rem;
  }

  .movie_box {
    margin-bottom: 1rem;
  }
</style>