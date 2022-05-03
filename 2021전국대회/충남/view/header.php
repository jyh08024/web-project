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
          <li><a href="#baker_street_section">빵 거리</a></li>
          <li><a href="#respon_bread_section">대표빵</a></li>
          <li><a href="#recom_baker_section">추천빵집</a></li>
          <li><a href="#gal_section">갤러리</a></li>
          <li><a href="/storeList">빵집순례</a></li>
        </ul>
      </div>
  
      <div class="btn_area">
        <?php if (USER): ?>
          <a href="/get/logout" class="btn">로그아웃</a>
        <?php if (USER['user_type'] == "member"): ?>
          <a href="/get/userModify" class="btn">회원정보수정</a>
        <?php else: ?>
          <button class="btn join_btn">회원가입</button>
        <?php endif ?>
        <?php else: ?>
        <button class="btn login_btn" onclick="Modal.open('login_popup')">로그인</button>
        <button class="btn join_btn">회원가입</button>
        <?php endif ?>
      </div>
    </div>
  
    <div class="header_line"></div>
  </header>

