<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>부산 국제 영화제</title>
  <link rel="stylesheet" href="/resources/css/default.css">
  <link rel="stylesheet" href="/resources/font/css/all.css">
  <link rel="stylesheet" href="/resources/font/css/fontawesome.css">
  <script src="/resources/js/jquery-3.6.0.min.js"></script>
  <script src="/resources/js/app.js"></script>
</head>
<body>
  
  <header>
    <div class="logo">
      <a href="/"><h2>부산 국제 영화제</h2></a>
    </div>

    <div class="navigation">
      <div class="menu">
        <div><a href="/provide_list">영화제 배급사 목록</a></div>
        <div><a href="/recommend">추천한 영화 목록</a></div>
        <div><a href="/uploadPage">예고편 업로드</a></div>
        <div><a href="/my_page">내 동영상</a></div>
      </div>
    </div>

    <?php if (USER): ?>
      <div class="user_btn">
        <h3><?= USER['name'] ?>님 환영합니다.</h3>
        <a href="/logout"><button class="logout_btn btn active"><i class="fa fa-user-minus"></i>&nbsp; 로그아웃</button></a>
    </div>
    <?php else: ?>
    <div class="user_btn">
      <a href="/login"><button class="login_btn btn active"><i class="fa fa-user"></i>&nbsp; 로그인</button></a>
      <a href="/join"><button class="join_btn btn active"><i class="fa fa-user-plus"></i>&nbsp; 회원가입</button></a>
    </div>
    <?php endif ?>
  </header>