<!DOCTYPE html>
<html lang="zxx">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="/resources/fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/resources/css/style.css">
  <link rel="stylesheet" href="/js/jquery-ui-1.12.1.custom/jquery-ui.css">
  <script src="/js/jquery-3.6.0.js"></script>
  <script src="/js/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
  <script src="/js/script.js"></script>
</head>
<body class="pr">
  <input type="checkbox" name="login_layer" id="login_layer" hidden>
  <header>
    <div class="header_rap">
      <div class="logo">
        <a href="/">
          <img src="/resources/logo.png" alt="logo" title="logo">
        </a>
      </div>
      <div>
        <ul class="menu">
          <li class="main_menu">
            <input type="checkbox" name="menu_1" id="menu_1" hidden>
            <label for="menu_1">
              <i class="fa fa-list"></i> 이용안내 
              <span class="m_icon menu_icon_plus">[<i class="fa fa-plus"></i>]</span>
              <span class="m_icon menu_icon_minus">[<i class="fa fa-minus"></i>]</span>
            </label>

            <ul class="sub_menu">
              <li><a href="#">관람안내</a></li>
              <li><a href="#">정원안내</a></li>
            </ul>
          </li>
          <li class="main_menu">
            <input type="checkbox" name="menu_2" id="menu_2" hidden>
            <label for="menu_2">
              <i class="fa fa-calendar-check-o"></i> 작업실임대 
              <span class="m_icon menu_icon_plus">[<i class="fa fa-plus"></i>]</span>
              <span class="m_icon menu_icon_minus">[<i class="fa fa-minus"></i>]</span>
            </label>

            <ul class="sub_menu">
              <li><a href="/leaseStat">임대현황</a></li>
              <li><a href="/lease">임대등록</a></li>
            </ul>
          </li>
          <li class="main_menu">
            <input type="checkbox" name="menu_3" id="menu_3" hidden>
            <label for="menu_3">
              <i class="fa fa-chain"></i> 청년작가지원 
              <span class="m_icon menu_icon_plus">[<i class="fa fa-plus"></i>]</span>
              <span class="m_icon menu_icon_minus">[<i class="fa fa-minus"></i>]</span>
            </label>

            <ul class="sub_menu">
              <li><a href="/signList">투자목록보기</a></li>
              <li><a href="/invest">투자하기</a></li>
              <li><a href="#">펀드보기</a></li>
              <li><a href="/enr">청년작가등록</a></li>
            </ul>
          </li>
          <li class="main_menu">
            <input type="checkbox" name="menu_4" id="menu_4" hidden>
            <label for="menu_4">
              <i class="fa fa-image"></i> 작품판매 
              <span class="m_icon menu_icon_plus">[<i class="fa fa-plus"></i>]</span>
              <span class="m_icon menu_icon_minus">[<i class="fa fa-minus"></i>]</span>
            </label>

            <ul class="sub_menu">
              <!-- <li><a href="/artSale">작품판매</a></li> -->
              <li><a href="/artList">작품목록</a></li>
              <li><a href="/artEnr">작품등록</a></li>
              <li><a href="/artCare">작품관리</a></li>
              <li><a href="/cart">장바구니</a></li>
            </ul>
          </li>
          <li class="main_menu">
            <label href="#"><i class="fa fa-calendar"></i> 이벤트</label>
          </li>
          <li class="main_menu">
            <label>
              <a href="/partici"> 참여하기</a>
            </label>
          </li>
        </ul>
      </div>
      <div class="header_bottom">
        <?php if (USER): ?>
          <a href="/logout" class="btn">로그아웃</a>
        <?php else: ?>
          <label for="login_layer" class="btn"><i class="fa fa-users"></i> 로그인</label>
        <?php endif ?>
      </div>
    </div>
  </header>

  <?php 
    $youthLayout = [];
    $reverse = [];

    $allow = $_SERVER['REQUEST_URI'] == "/leaseStat" ? "" : "not_allowed";
    
    for($i = 1; $i <= 20; $i++) {
      $num = 100 + $i;

      if ($i >= 11) {
        $reverse[] = "<div class='room {$allow} youth_$num' data-type='youth' data-room='$num'>$num</div>";
        continue;
      }

      $youthLayout[] = "<div class='room {$allow} youth_$num' data-type='youth' data-room='$num'>$num</div>";
    }

    $futureLayout = [];
    $fuVert = [];
    $futureRe = [];

    for ($i = 1; $i <= 14; $i++) { 
      $num = 100 + $i;

      if ($i == 8 || $i == 7) {
        $fuVert[] = "<div class='room {$allow} future_$num flex alc jc' data-type='future' data-room='$num' style='height: 98.87px;'>$num</div>";
        continue;
      }

      if ($i >= 9) {
        $futureRe[] = "<div class='room {$allow} future_$num' data-type='future' data-room='$num'>$num</div>";
        continue;
      }

      $futureLayout[] = "<div class='room {$allow} future_$num' data-type='future' data-room='$num'>$num</div>";
    }
   ?>
  
  <script>
    $(document) 
      .on(`submit`, ".login_form", (e) => {
        e.preventDefault();
        
        const id = $(e.target).find('input[name="id"]').val();
        const pass = $(e.target).find('input[name="password"]').val();

        if (id.trim() == "" || pass.trim() == "") {
          alert('모든 값을 입력해주세요.');
          return;
        }

        ajax("login_form", "/post/login");
      })
      .on(`click`, "label[for='login_layer']", (e) => {
        $(`.login_form input`).val("");
      })
      .on(`click`, ".room", (e) => {
        const type = $(e.target).data('type');
        const selRoom = $(e.target).data('room');
        const [build, room] = [$(`input[name="build"]`).val(), $(`input[name="room"]`).val()];

        $(`.enr_btn`).removeClass('disable');

        const buildVal = build ? build + "," + type : type;
        const roomVal = room ? room + "," + selRoom : selRoom;

        $(`input[name="build"]`).val(buildVal);
        $(`input[name="room"]`).val(roomVal);
      })

      const searchRoom = () => {
        const data = [$(`input[name="start"]`).val(), $(`input[name="end"]`).val()];

        if (data[0].trim() == "" || data[1].trim() == "") {
          alert('임차기간을 선택해주세요.');
        }

        $.post(`/check/room`, {date: data}).done((res) => {
          $(`input[name="room"]`).val('');
          $(`.room`).removeClass('not_allowed');
          res.forEach(v => {
            $(`.${v.build}_${v.room}`).addClass('not_allowed');
          });
        })
      }

      const setStat = (youth, future) => {
        const data = [...youth, ...future];

        data.forEach(v => {
          if (v.room.includes(",")) {
            const room = v.room.split(",");
            room.forEach(val => {
              $(`.${v.build}_${val}`).css('background', v.color);
            });
          } else {
            $(`.${v.build}_${v.room}`).css('background', v.color);
          }
        });

        $(`.y_stat`).html(youth.map(v => {
          return `
            <div class="stat_item">
              <div>
                <div class="c_box" style="background: "${v.color}"></div>
              </div>
              <div>${v.room.replaceAll(",", ", ")}</div>
              <div>${v.user_name}</div>
              <div>${v.start} ~ ${v.end}</div>
            </div>
          `
        }));

        $(`.f_stat`).html(future.map(v => {
          return `
            <div class="stat_item">
              <div>
                <div class="c_box" style="background: "${v.color}"></div>
              </div>
              <div>${v.room.replaceAll(",", ", ")}</div>
              <div>${v.user_name}</div>
              <div>${v.start} ~ ${v.end}</div>
            </div>
          `
        }));
      }

      const csvDown = (data, e) => {
      const col = ["구매날짜", "구매번호", "상품이름", "판매가격"];
      let csv = "\uFEFF" + col.join(",") + "\n";

      const arr = [];

      // "/";

      Object.values(data).forEach(v => {
        v.forEach(val => {
          const arr = [];
          arr.push(val.date.split(" ")[0]);
          arr.push(val.buy_num);
          arr.push(val.art_name);
          arr.push(val.price.toLocaleString());
          csv += arr.join(",") + "\n";
        });

      });

      let down = document.createElement('a');

      const blob = new Blob([csv], {type: 'text/csv;charset=utf-8;'});

      down.download = "구매내역.csv";
      down.href = URL.createObjectURL(blob);

      down.click();
    }

    $(document)
      .on(`submit`, ".artEnrForm, .mod_form", (e) => {
        dd('asd');
        e.preventDefault();
        const data = $(e.target).serializeArray();
        let err = false;

        data.forEach(v => {
          if (err) {
            return;
          }

          if (v.value.trim() == "") {
            err = true;
            $(`input[name="${v.name}"]`).focus();
            alert('모든 값을 입력해주세요.');
          }
        });

        if (err) {
          return;
        }

        if (!$(e.target).find(`input[name="price"]`).val().match("^[0-9]+$")) {
          alert('판매가격은 숫자만 입력가능합니다.');
          return;
        }

        if (location.pathname.includes("artEnr")) {
          const img = $(e.target).find("input[name='image'");
          
          if (img[0].files.length <= 0) {
            alert('모든 값을 입력해주세요.');
            img.focus();
            return;
          }

          $(e.target)[0].submit();
        } else {
          ajax("mod_form", "/artMod");
        }
      })
      .on(`change`, ".view_cate_sel", (e) => {
        loadCate = e.target.value;
      })
      .on(`click`, ".search_btn", (e) => {
        searchVal = $(`.search_input`).val();
      })

      let loadCate = "all";
      let searchVal = "";

      const artLoad = () => {
        if (location.pathname.includes("artList")) {
          $.post(`/get/artList`).done((res) => {
            if ($(res).html() != $(`.art_list`).html()) {
              $(`.art_list`).html("");
              $(`.art_list`).html($(res).html());
            }
          })
        }

        if (location.pathname.includes("artCare")) {
          $.post(`/get/artCare/${loadCate}`, {data: searchVal}).done((res) => {
            if ($(res).html() != $(`.care_box`).html()) {
              $(`.care_box`).html("");
              $(`.care_box`).html($(res).html());
            }
          })
        }
      }

      const artMod = (artData) => {
        Modal.open('art_mod');
        const key = Object.keys(artData);
        const value = Object.values(artData);

        key.forEach((v, i) => {
          $(`input[name="${v}"], select[name="${v}"]`).val(value[i]);
        });
      }

      const artDel = (idx) => {
        $.post(`/post/deleteArt`, {del: idx}).done((res) => {
          alert(res);
        });
      }
  </script>

  <style>
    /* header { */
      /* display: none; */
    /* } */
    .high {
      background: #ff6161;
      color: #fff;
    }
    .layout_area > div > div {
      width: 48%;
    }

    .layout_box {
      display: flex;
      align-items: center;
    }

    .layout_box > div {
      padding: 1.2rem;
      border: 1px solid rgba(0, 0, 0, .6);
      cursor: pointer;
    }

    .care_list,
    .cart_box,
    .stat_box {
      border: 1px solid rgba(0,0,0,.1);
    }

    .care_top,
    .history_top,
    .cart_top,
    .stat_top {
      background: #333;
      color: #fff;
    }

    .cart_top h4,
    .stat_top h4 {
      width: 25%;
      text-align:center;
      padding: 1rem 2rem;
    }

    .care_top h3,
    .history_top h4 {
      width: 20%;
      text-align:center;
      padding: 1rem 1.5rem;
    }

    .stat_list {
      height: 150px;
      overflow-y:scroll;
    }

    .stat_item {
      border: 1px solid rgba(0,0,0,.1);
      border-top: none;
      display: flex;
      align-items:center;
      justify-content: space-between;
    }

    .stat_item > div {
      width: 25%;
      padding: 1rem 2rem;
      display: flex;
      align-items:center;
      justify-content:center;
    }

    .c_box {
      width: 20px;
      height: 20px;
      background: #333;
    }

    .not_allowed {
      cursor: not-allowed;
      opacity: .5;
      pointer-events: none;
    }

    .disable {
      pointer-events: none;
      opacity: .5;
    }

    .art_item {
      width: 100%;
      padding: 2rem;
      margin-top: 2rem;
      margin-bottom: 2rem;
    }

    .art_item:nth-child(1) {
      margin-top: 0;
    }

    .art_img {
      width: 40%;
      height: 320px;
    }

    .art_content {
      width: 58%;
      flex-direction: column;
    }

    .history_box {
      display: grid;
      grid-gap: 1rem;
      grid-template-columns: repeat(2, 1fr);
    }

    .history_list {
      height: 250px;
      overflow-y: scroll;
    }

    .care_item
    .history_list > .history_div {
      border: 1px solid rgba(0,0,0,.1);
      border-top: none;
      display: flex;
      align-items:center;
      justify-content: space-between;
    }

    .care_item,
    .history_list > div > div {
      width: 25%;
      display: flex;
      align-items:center;
      justify-content:center;
    }

    .care_item {
      width: 100%;
      height: 100%;
    }

    .care_item > div {
      width: 20%;
      height: 55px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-right: 1px solid rgba(0, 0, 0, .1);
      border-bottom: 1px solid rgba(0, 0, 0, .1);
    }

    .history_div > div {
      border-right: 1px solid rgba(0, 0, 0, .1);
    }

    .multi_item {
      display: block !important;
    }

    .multi_item > div {
      width: 100%;
      padding: 1rem .6rem;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .multi_item > div:not(:last-child) {
      border-bottom: 1px solid rgba(0, 0, 0, .1);
    }

    .price_box {
      font-size:  2rem;
      font-weight: 100;
    }
  </style>