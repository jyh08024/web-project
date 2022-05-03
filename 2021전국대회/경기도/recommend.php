<?php require "view/header.php"; ?>
    <link rel="stylesheet" href="resources/css/sub.css">


    <div class="loading_animation2">
      <h1 class="color">한밭 빵지순례 빵끝</h1>
      <div class="flex alc js">
        <div class="rect2"></div>
        <div class="rect2"></div>
      </div>
    </div>

    <div class="section location_section wrap">
      <div class="section_title">
        <p class="main_title">빵집<span class="color">리스트</span></p>
        <p>선택한 지역을 바탕으로 구성된 빵집 리스트입니다.</p>
      </div>

      <div class="recom_sort_btn tlc">
        <button class="btn2" data-type="review">리뷰 순 추천</button>
        <button class="btn2" data-type="score">평점 순 추천</button>
        <button class="btn2" data-type="ai">AI 추천</button>
      </div>

      <div class="bakery_list flex alc">
        <!-- <div class="baker_item">
          <div class="baker_img">
            <img src="../resources/image/1web.jpg" alt="baker" title="baker">
          </div>
          <div class="baker_info">
            <h3><span class="color">[빵집 이름]</span> asd</h3>
            <h3><span class="color">[위치]</span> asasd</h3>
            <h3 style="line-height: 20px;">
              <span class="color">[영업시간]</span><br>
              <span style="font-size: .9rem;">open: 123123<Br>
                ~<br>
              close: 123123</span>
            </h3>
          </div>
        </div> -->
      </div>
    </div>

      <?php require "view/footer.php"; ?>