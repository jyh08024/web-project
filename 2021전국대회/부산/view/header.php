<!DOCTYPE html>
<html lang="zxx">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>빵집 순례</title>
  <link rel="stylesheet" href="/resources/css/style.css">
  <script src="/resources/js/jquery-3.6.0.min.js"></script>
  <script src="/resources/js/app.js"></script>
</head>
<body>

  <header>
    
    <div class="header_top wrap flex alc">
      <a href="#">한국어</a>
      <a href="#">English</a>
      <a href="#">中文(简体))</a>
    </div>

    <div class="header_main wrap flex alc js">
      <div class="logo">
        <a href="/">
          <h2>대전 빵집 순례</h2>
        </a>
      </div>

      <div class="navigation">
        <ul class="main_menu flex alc js">
          <li>
            <a href="#">대전 빵집 순례</a>

            <ul class="sub_menu">
              <li><a href="/intro">대전시 소개</a></li>
              <li><a href="/famousBakery">대표빵집</a></li> 
            </ul>
          </li>
          <li><a href="/bakerPick">빵드컵</a></li>
          <li><a href="/bakeryMap">대전 빵지도</a></li>
          <li>
            <a href="/pickUpOrder">픽업 주문</a>

            <ul class="sub_menu">
              <li><a href="/pickUpOrder">주문하기</a></li>
              <li><a href="/pickUpHistory">주문내역</a></li>
            </ul>
          </li>
          <?php if (@USER): ?>
            <?php $userStore = baker::find('admin_id = ?', [USER['id']]) ?>

          <?php if ($userStore): ?>
            <li>
              <a href="/storeCare/<?= $userStore['idx'] ?>">매장 관리</a>
              
              <ul class="sub_menu">
                <li><a href="/storeCare/<?= $userStore['idx'] ?>">기본 정보관리</a></li>
                <li><a href="/productCare/<?= $userStore['idx'] ?>">상품 관리</a></li>
                <li><a href="/orderCare/<?= $userStore['idx'] ?>">주문 관리</a></li>
              </ul>
            </li>
          <?php endif ?>
          <?php endif ?>
        </ul>
      </div>

      <div class="user_btn">
        <?php if (USER): ?>
          <a href="/logout" class="btn">로그아웃</a>
          <?php else: ?>
          <a href="/login" class="btn">로그인</a>
          <a href="/join" class="btn">회원가입</a>
        <?php endif ?>
      </div>
    </div>
  </header>