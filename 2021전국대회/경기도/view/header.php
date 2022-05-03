<!DOCTYPE html>
<html lang="zxx">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../resources/fontawesome/css/all.css">
  <link rel="stylesheet" href="../resources/fontawesome/css/fontawesome.min.css">
  <link rel="stylesheet" href="../resources/css/style.css">
  <script src="../resources/js/jquery-3.6.0.min.js"></script>
  <script src="../resources/js/app.js"></script>
  <title>Document</title>
</head>
<body id="load">
  
  <?php require "app/lib.php" ?>
  <section id="main">


  <!-- <div class="loading_animation">
    <h1 class="color">한밭 빵지순례 빵끝</h1>
    <div class="flex alc js">
      <div class="rect"></div>
      <div class="rect"></div>
    </div>
  </div> -->

  <header>
    <div class="header_rap wrap">

      <div class="logo_area">
        <a class="move" href="index.php">
          <h2>빵지순례</h2>
        </a>
      </div>
      
      <div class="navigation">
        <ul class="menu">
          <li><a class="move" href="index.php">홈</a></li>
          <li><a class="move" href="intro.php">소개</a></li>
          <li>
            <a class="move" href="#">빵집리스트</a>
          
            <ul class="sub_menu">
              <li><a class="move" href="bakeryList.php">빵집리스트</a></li>
              <li><a class="move" href="location.php">빵집추천</a></li>
              <li><a class="move" href="bakerySearch.php">빵집 검색</a></li>
            </ul>
          </li>
          <li>
            <a class="move" href="#">이벤트</a>
            
            <ul class="sub_menu">
              <li><a class="move" href="eventList.php">이벤트리스트</a></li>
              <li><a class="move" href="event_enr.php">이벤트등록</a></li>
            </ul>
          </li>
          <li><a class="move" href="adCare.php">광고관리</a></li>
        </ul>
      </div>
      
      <div class="user_btn">
        <?php if (USER): ?>
        <button class="btn" onclick="logout();">로그아웃</button>
        <?php else: ?>
        <a href="login.php" class="btn move">로그인</a>
        <a href="join.php" class="btn move">회원가입</a>
        <?php endif ?>
      </div>

    </div>
  </header>
