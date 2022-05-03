<?php require "view/header.php" ?>
  
<link rel="stylesheet" href="resources/css/main.css">


  <div class="visual_section section wrap">
    <div class="visual_title tlc">
      <h1 class="big_t">떠나자! 빵지순례!</h1>
    </div>
    
    <div class="visual_slide_top">
      <h3>다함께 떠나는 대전 빵지 순례</h3>
    </div>
    <div class="visual_img_rap">
      <div class="visual_slide_rap">
        <div><img src="resources/image/1web.jpg" alt="visual_img" title="visual_img"></div>
        <div><img src="resources/image/02.png" alt="visual_img" title="visual_img"></div>
        <div><img src="resources/image/05.png" alt="visual_img" title="visual_img"></div>
        <div><img src="resources/image/06.png" alt="visual_img" title="visual_img"></div>
        <div><img src="resources/image/11.png" alt="visual_img" title="visual_img"></div>
        <div><img src="resources/image/07.png" alt="visual_img" title="visual_img"></div>
        <div><img src="resources/image/12.png" alt="visual_img" title="visual_img"></div>
        <div><img src="resources/image/29web.jpg" alt="visual_img" title="visual_img"></div>
        <div><img src="resources/image/14.png" alt="visual_img" title="visual_img"></div>
        <div><img src="resources/image/08.png" alt="visual_img" title="visual_img"></div>
      </div>
    </div>
  </div>

  <div class="ad_section section wrap">
    <?php 
      $adData = ad::mq("SELECT * FROM ad ORDER BY RAND() LIMIT 1")->fetch();
     ?>
    <img src="<?= $adData['ad_img'] ?>" alt="ad" title="ad">
  </div>
  
  <div class="today_section section wrap">
    <div class="section_title">
      <p class="main_title">오늘의<span class="color">빵집</span></p>
      <p>많은 사람들이 추천한, 오늘의 추천 빵집!</p>
    </div>

    <div class="section_content">
      <div class="today_list flex alc">

        <div class="today_item1">
          <div class="today_text_box flex">
            <h1 class="store_name">안공빵집</h1>
            <p class="sub_text">안산시 상롤구 안산공고로 안산공업고</p>
            <p class="hashs">#_아이스크림빵 #_소보루빵</p>
            
            <div class="after_line"></div>
            
            <a href="#" class="color">메뉴보러가기→</a>
          </div>
        </div>

        <div class="today_item2">
          <div class="today_text_box flex">
            <h1 class="store_name">안공빵집</h1>
            <p class="sub_text">안산시 상롤구 안산공고로 안산공업고</p>
            <p class="hashs">#_아이스크림빵 #_소보루빵</p>
        
            <div class="after_line"></div>
        
            <a href="#" class="color">메뉴보러가기→</a>
          </div>
        </div>

        <div class="today_item3">
          <div class="today_text_box flex">
            <h1 class="store_name">안공빵집</h1>
            <p class="sub_text">안산시 상롤구 안산공고로 안산공업고</p>
            <p class="hashs">#_아이스크림빵 #_소보루빵</p>
        
            <div class="after_line"></div>
        
            <a href="#" class="color">메뉴보러가기→</a>
          </div>
        </div>

      </div>
    </div>
  </div>
  
  <div class="best_menu_section section wrap">
    <div class="section_title">
      <p class="main_title">베스트<span class="color">메뉴</span></p>
      <p>꾸준히 사랑받는 베스트 오브 베스트 메뉴!</p>
    </div>

    <div class="section_content">
      <div class="menu_item1 flex js">
        <div class="flex">

          <div class="menu_img">
            <img src="resources/image/32.jpg" alt="menu" title="menu">
          </div>
          
          <div class="best_menu_info">
            <h2>오늘만 세일!</h2>
            <h1>꾸덕꾸덕 초코 케잌</h1>
            <p>꾸준히 사랑받고 있는 최고의 메뉴들</p>
            
            <div class="menu_info_bottom flex alc">
              <div class="best_menu_price">
                <div>
                  <h3 class="before_price">
                    22,500
                  </h3>
                  <h2 class="after_price">
                    22,500
                  </h2>
                </div>
              </div>
              
              <div class="best_menu_btn">
                <a href="#">
                  <p>구경하러가기</p>
                  <div class="btn_text">바로가기</div>
                </a>
              </div>
            </div>
            
            <div class="menu_sub_img flex alc js">
              <img src="resources/image/25.jpg" alt="menu" title="menu">
              <img src="resources/image/25.jpg" alt="menu" title="menu">
              <img src="resources/image/25.jpg" alt="menu" title="menu">
            </div>
          </div>
        </div>

        <div class="menu_subs">
          <div class="menus">
            <div class="today_text_box">
              <h1 class="store_name">죽빵</h1>
              <p class="sub_text">대나무 죽순으로 만든 빵!</p>
              <p class="hashs">#_죽순 #_향긋</p>
            
              <div class="after_line"></div>
            
              <a href="#" class="color">메뉴보러가기→</a>
            </div>
          </div>

          <div class="menus">
            <div class="today_text_box">
              <h1 class="store_name">만원빵</h1>
              <p class="sub_text">재료비도 만원 가격도 만원!</p>
              <p class="hashs">#_만원 #_싸다_싸!</p>
            
              <div class="after_line"></div>
            
              <a href="#" class="color">메뉴보러가기→</a>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>

  <div class="event_section section wrap">
    <div class="section_title">
      <p class="main_title">끝내주는<span class="color">이벤트</span></p>
      <p>제휴빵집들과 함께 진행중인 매혹적인 이벤트</p>
    </div>

    <?php 
      $now = date('Y-m-d');
      $eventData = event::mq("SELECT * FROM event WHERE event_end > ? ORDER BY event_end ASC", $now)->fetchAll();
      $eventData2 = event::mq("SELECT * FROM event WHERE event_end < ? ORDER BY event_end DESC", $now)->fetchAll();

      $eventList = array_merge($eventData, $eventData2);
    ?>

    <div class="event_list flex">

      <?php if ($eventList): ?>
      <div class="event_main">
        <div class="event_main_box" style="background: url('<?= $eventList[0]['banner_img'] ?>') no-repeat; background-size: 100% 100%;">
          <div class="today_text_box flex">
            <h1 class="store_name"><span><?= $eventList[0]['event_start'] ?> ~ <?= $eventList[0]['event_end'] ?></span></h1>
            <p class="sub_text bold" style="font-size: 1.6rem;"><?= $eventList[0]['event_name'] ?></p>
            <p class="hashs bold">방문구매시 롤케잌 1+1 혜택</p>
            
            <div class="after_line"></div>
            
            <p class="color" style="cursor: pointer; text-decoration: underline;" onclick="eventDetail(<?= $eventList[0]['idx'] ?>)">이벤트보러가기→</p>
          </div>
        </div>
      </div>
      
      <div class="sub_event_list">
        <div class="sub_event_box" style="overflow: auto">
          <?php foreach ($eventList as $key => $v): ?>
            <?php if ($key != 0): ?>

          <div class="event_item flex js">
            <div class="event_left">
              <h2><?= $v['event_start'] ?></h2>
              <h2><?= $v['event_name'] ?></h2>

              <div class="event_label">
                <p><?= $v['event_start'] ?> ~ <?= $v['event_end'] ?></p>
                <p><?= $v['event_name'] ?></p>
                <p class="color" style="cursor: pointer; text-decoration: underline;" onclick="eventDetail(<?= $v['idx'] ?>)">이벤트보러가기→</p>
              </div>
            </div>
            <div class="event_right">
              <img src="<?= $v['banner_img'] ?>" alt="event" title="event">
            </div>

            <div class="after_line"></div>
          </div>
            <?php endif ?>

          <?php endforeach ?>

          <!-- <div class="event_item flex js">
            <div class="event_left">
              <h2>10.05</h2>
              <h2>방문해서 직접 배우는<br>베이킹 클래스! 함께<br>하는 교실</h2>
          
              <div class="event_label">
                <p>2021.10.05</p>
                <p>안공빵집</p>
              </div>
            </div>
            <div class="event_right">
              <img src="resources/image/41.jpg" alt="event" title="event">
            </div>
          
            <div class="after_line"></div>
          </div> -->
        </div>
      </div>
      <?php else: ?>
        <div class="tlc" style="width: 100%;">
        <h1 class="color" style="font-size: 4rem;">이벤트를 기다려주세요.</h1>
        </div>
      <?php endif ?>
    </div>

  </div>
  
  <div class="review_section section wrap">
    <div class="section_title">
      <p class="main_title">베스트<span class="color">리뷰</span></p>
      <p>직접 다녀온 고객님들의 생생한 리뷰</p>
    </div>

    <div class="review_list flex alc js">
      <div class="review_item flex">
        <div class="review_img">
          <img src="resources/image/02.png" alt="review" title="review">
        </div>

        <div class="review_right">
          <i class="far fa-heart"></i>
          <p class="like_count">좋아요 <span>553개</span></p>
          <p class="reivew_content">
            어제 구매했는데 오늘까지도 빵이 바삭바삭해요,<br>
            이번만이 아니라 다음 방문때도 또 구매하고 싶은<br>
            빵이었던거 같아요!
          </p>
          <div class="review_info">
            <p class="time"><span>2021.10.04 22:33:22</span>에 작성</p>
            <p>안공빵집/공갈빵</p>
          </div>
        </div>
      </div>

      <div class="review_item flex">
        <div class="review_img">
          <img src="resources/image/02.png" alt="review" title="review">
        </div>
      
        <div class="review_right">
          <i class="far fa-heart"></i>
          <p class="like_count">좋아요 <span>553개</span></p>
          <p class="reivew_content">
            어제 구매했는데 오늘까지도 빵이 바삭바삭해요,<br>
            이번만이 아니라 다음 방문때도 또 구매하고 싶은<br>
            빵이었던거 같아요!
          </p>
          <div class="review_info">
            <p class="time"><span>2021.10.04 22:33:22</span>에 작성</p>
            <p>안공빵집/공갈빵</p>
          </div>
        </div>
      </div>

      <div class="review_item flex">
        <div class="review_img">
          <img src="resources/image/02.png" alt="review" title="review">
        </div>
      
        <div class="review_right">
          <i class="far fa-heart"></i>
          <p class="like_count">좋아요 <span>553개</span></p>
          <p class="reivew_content">
            어제 구매했는데 오늘까지도 빵이 바삭바삭해요,<br>
            이번만이 아니라 다음 방문때도 또 구매하고 싶은<br>
            빵이었던거 같아요!
          </p>
          <div class="review_info">
            <p class="time"><span>2021.10.04 22:33:22</span>에 작성</p>
            <p>안공빵집/공갈빵</p>
          </div>
        </div>
      </div>

      <div class="review_item flex">
        <div class="review_img">
          <img src="resources/image/02.png" alt="review" title="review">
        </div>
      
        <div class="review_right">
          <i class="far fa-heart"></i>
          <p class="like_count">좋아요 <span>553개</span></p>
          <p class="reivew_content">
            어제 구매했는데 오늘까지도 빵이 바삭바삭해요,<br>
            이번만이 아니라 다음 방문때도 또 구매하고 싶은<br>
            빵이었던거 같아요!
          </p>
          <div class="review_info">
            <p class="time"><span>2021.10.04 22:33:22</span>에 작성</p>
            <p>안공빵집/공갈빵</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <a href="#">
    <div class="go_top_btn">
      Top
    </div>
  </a>

  <?php require "view/footer.php"; ?>