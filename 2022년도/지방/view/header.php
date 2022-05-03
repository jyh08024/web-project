<!-- html 작성 시작 -->
<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- 페이지 타이틀 -->
  <title>Document</title>
  <!-- 스타일파일 로드 -->
  <link rel="stylesheet" href="/style.css">
  <script src="/js/jquery-3.6.0.min.js"></script>
  <script src="/js/script.js"></script>
</head>

<body>

  <!-- 헤더 -->
  <header>
    <div class="logo">
      <a href="#">
        <img src="/resources/typho.png" alt="slogan" title="slogan">
      </a>
    </div>
  </header>

  <!-- 메뉴 버튼 -->
  <div class="side_btn">
    <input type="checkbox" name="menu_btn" id="menu_tg" hidden>
    <input type="checkbox" name="menu_btn" id="admin_tg" hidden>
    <input type="checkbox" name="menu_btn" id="sns_tg" hidden>

    <div class="tg_box">
      <div class="toggle home_tg">
        <a href="/">
          <img src="/resources/icons/home.png" alt="home" title="home">
        </a>
      </div>
    </div>

    <?php if (@USER && @USER['ID'] == "admin"): ?>
    <div class="tg_box admin_tg_box">
      <div class="toggle admin_tg">
        <label for="admin_tg" class="tlc white">
          관리자 <br>메뉴
        </label>
      </div>

      <div class="menu_box">
        <div></div>
        <div><a href="/productCare">특산품 관리</a></div>
        <div><a href="/eventCare/0">이벤트 관리</a></div>
      </div>
    </div>
    <?php endif ?>

    <div class="tg_box menu_tg_box">
      <div class="toggle menu_tg">
        <label for="menu_tg">
          <img src="/resources/icons/menu.png" alt="menu" title="menu">
          <img src="/resources/icons/close.png" alt="close" title="close" class="close">
        </label>
      </div>

      <div class="menu_box">
        <div></div>
        <div class="<?= $_SERVER['REQUEST_URI'] == "/sub1" ? "now_page" : "" ?>"><a href="/sub1">특산품 안내</a></div>
        <div class="<?= $_SERVER['REQUEST_URI'] == "/sub2" ? "now_page" : "" ?>"><a href="/sub2">이벤트</a></div>
        <div class="<?= $_SERVER['REQUEST_URI'] == "/sub3" ? "now_page" : "" ?>"><a href="/sub3">구매후기</a></div>
      </div>
    </div>

    <div class="tg_box sns_tg_box">
      <div class="toggle sns_tg">
        <label for="sns_tg">
          <img src="/resources/icons/share.png" alt="menu" title="menu">
          <img src="/resources/icons/close.png" alt="close" title="close" class="close">
        </label>
      </div>

      <div class="sns_box">
        <div></div>
        <div><a href="#"><img src="/resources/icons/face.png" alt="sns" title="sns"></a></div>
        <div><a href="#"><img src="/resources/icons/insta.png" alt="sns" title="sns"></a></div>
        <div><a href="#"><img src="/resources/icons/you.png" alt="sns" title="sns"></a></div>
        <div><a href="#"><img src="/resources/icons/twit.png" alt="sns" title="sns"></a></div>
      </div>
    </div>
  </div>
  