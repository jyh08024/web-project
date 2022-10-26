<!DOCTYPE html>
<html lang="zxx">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- 스타일 파일 로드 -->
  <link rel="stylesheet" href="/resources/fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/resources/css/style.css">
  <script src="/resources/js/jquery-3.6.0.min.js"></script>
  <script src="/resources/js/app.js"></script>
</head>
<body>

  <!-- 헤더영역 -->
  <header>
    <div class="header_rap wrap flex alc js">
      <!-- 로고 -->
      <div class="logo">
        <a href="#">
          <img src="/resources/logo.png" alt="logo" title="logo">
        </a>
      </div>

      <!-- 메뉴 -->
      <ul class="menu">
        <li><a href="/info">정원 정보</a></li>
        <li><a href="/comu/all/1">버스킹</a></li>
        <li><a href="/sub/all">관람/체험</a></li>
        <li class="mypage_link"><a href="#">마이페이지</a></li>
      </ul>

      <!-- 버튼 -->
      <div class="user_btn">
        <?php if (@USER): ?>
          <a href="/logout" class="btn"><i class="fa fa-user-minus"></i> 로그아웃</a>
        <?php else: ?>
          <button class="btn" onclick="Modal.open('login')"><i class="fa fa-user-plus"></i> 로그인</button>
          <button class="btn" onclick="Modal.open('join')"><i class="fa fa-users"></i> 회원가입</button>
        <?php endif ?>
      </div>
    </div>
  </header>

  <!-- 햄버거 메뉴 구현 -->
  <input type="checkbox" name="ham_open" id="ham_open" hidden>
  <label for="ham_open" id="ham_full" class="ham_con"></label>

  <div class="ham_btn ham_con">
    <label for="ham_open" class="flex alc jc">
      <i class="fa fa-bars"></i>
    </label>
  </div>

  <div class="ham_con ham">
    <ul class="menu">
      <li><a href="#">정원 정보</a></li>
      <li><a href="#">버스킹</a></li>
      <li><a href="#">관람/체험</a></li>
      <li><a href="#">마이페이지</a></li>
    </ul>

    <div class="user_btn">
      <button class="btn"><i class="fa fa-user-plus"></i> 로그인</button>
    </div>
  </div>

  <?php 
    $category = categories::allData();
  ?>