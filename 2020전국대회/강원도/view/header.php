<!DOCTYPE html>
<html lang="zxx">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="/resources/fontawesome/css/fontawesome.css">
  <link rel="stylesheet" href="/resources/fontawesome/css/all.css">
  <link rel="stylesheet" href="/resources/css/style.css">
  <script src="/resources/js/jquery-3.6.0.min.js"></script>
  <script src="/resources/js/app.js"></script>
</head>
<body>

  <div class="toast">
    
  </div>

  <header>
    <div class="header_rap">
      <div class="nav_area flex alc">
        <div class="logo">
          <a href="/">
            <img src="/resources/logo.png" alt="logo" title="logo">
          </a>
        </div>

        <ul class="menu">
          <li><a href="/">홈</a></li>
          <li><a href="/store">쇼핑몰</a></li>
          <li><a href="/request">제안 요청</a></li>
          <li><a href="/suggest">제안 하기</a></li>
          <?php if (USER && USER['user_type'] == "admin"): ?>
            <li><a href="/admin">판매 통계 보기</a></li>
          <?php endif ?>
        </ul>
      </div>

      <div class="user_btn_area">
        <div class="sns_icons flex alc" style="justify-content: flex-end;">
          <i class="fab fa-twitter" style="color: #00aeff;"></i>
          <i class="fab fa-facebook-square" style="color: #3054ef"></i>
          <i class="fab fa-instagram" style="color: #000"></i>
          <i class="fab fa-youtube" style="color: #ff0000"></i>
        </div>
        <div class="user_btn">
          <?php if (USER): ?>
            <a href="/logout" class="btn login_btn"><i class="fa fa-user-minus"></i> 로그아웃</a>
            <?php else: ?>
            <a href="/login" class="btn login_btn"><i class="fa fa-user"></i> 로그인</a>
            <a href="/join" class="btn join_btn"><i class="fa fa-user-plus"></i> 회원가입</a>
          <?php endif ?>
        </div>
      </div>
    </div>
  </header>