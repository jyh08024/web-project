<!DOCTYPE html>
<html lang="zxx">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>빵 이야기</title>
  <link rel="stylesheet" href="/resources/fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/resources/css/style.css">
  <script src="/resources/js/jquery-3.4.1.min.js"></script>
  <script src="/resources/js/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
  <script src="/resources/js/app.js"></script>
</head>
<body>

  <header id="page_header">
    <div class="header_rap wrap flex alc js">
      <div class="logo">
        <a href="/">
          <h3>빵 이야기</h3>
        </a>
      </div>

      <div class="navigation">
        <ul class="menu flex alc js">
          <li><a href="/inquire/all//">조회하기</a></li>
          <li><a href="/basket">장바구니</a></li>
          <?php if (USER): ?>
            <li><a href="/get/logout">로그아웃</a></li>
            <?php if (USER['user_type'] == "member"): ?>
              <li><a href="/get/userModify">회원정보수정</a></li>
            <?php else: ?>
              <li class="jo_btn"><button class="join_btn">회원가입</button></li>
            <?php endif ?>
          <?php else: ?>
          <li class="log_btn"><button class="login_btn" onclick="Modal.open('login_popup')">로그인</button></li>
          <li class="jo_btn"><button class="join_btn">회원가입</button></li>
          <?php endif ?>
        </ul>
      </div>

    </div>

    <div class="header_line"></div>
  </header>
