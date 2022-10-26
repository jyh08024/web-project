<div class="section"></div>
<div class="section"></div>
<div class="section wrap">
  <div class="section_title ani">
    <h2>서동생활공원 식당예약시스템</h2>
  </div>

  <div class="section_content flex rest_section">
    <div class="top_tab">
      <a class="tab now_tab" href="/restaurant"><i class="fa fa-pencil-square-o"></i> 예약정보 입력</a>
      <a class="tab" href="/restRead"><i class="fa fa-search-plus"></i> 예약 조회</a>
      <a class="tab" href="/qna"><i class="fa fa-book"></i> Q&A</a>
    </div>

    <div class="sb">
      <div class="form_box">
        <!-- <div class="form_left"> -->
          <!-- <img src="/resources/images/1.jpg" alt=""> -->
        <!-- </div> -->
        <div class="form_right">
          <div class="flex alc js">
            <h2>예약정보 입력</h2>
            <h4>예약 3단계 중 1단계</h4>
          </div>
          <div class="after_line"></div>

          <div class="form_area">
            <form action="/post/res1" method="POST" class="res_form_1">
              <div class="input_grid">
                <ul>
                  <li>식당선택</li>
                  <li class="flex alc js store_sel">
                    <label>
                      <span>서동한식당</span>
                      <input type="radio" name="store" value="서동한식당" checked>
                    </label>
                    <label>
                      <span>서동전통찻집</span>
                      <input type="radio" name="store" value="서동전통찻집">
                    </label>
                    <label>
                      <span>서동한우</span>
                      <input type="radio" name="store" value="서동한두">
                    </label>
                  </li>
                </ul>
                <ul>
                  <li>식당 예약 일시</li>
                  <li class="flex alc js">
                    <ul style="width: 49%;">
                      <li>일자</li>
                      <?php
                        $min = date("Y-m-d", strtotime("+1 day"));
                        $max = date("Y-m-d", strtotime("+1 month", strtotime(date("Y-m-d", strtotime($min)))));
                      ?>
                      <input type="date" class="input date_input" name="date" min="<?= $min ?>" max="<?= $max ?>">
                    </ul>
                    <ul style="width: 49%;">
                      <li>시간</li>
                      <select name="time" class="input time_input">

                      </select>
                    </ul>
                  </li>
                </ul>
                <ul>
                  <li>메뉴</li>
                  <li>
                    <select class="input menu_input" name="menu">

                    </select>
                  </li>
                </ul>
                <ul>
                  <li>수량</li>
                  <li class="flex alc js">
                    <input type="text" class="input count_input" name="count" readonly style="width: 60%;" value="1">
                    <div class="btn value_con" data-type="1"><i class="fa fa-caret-up"></i></div>
                    <div class="btn value_con" data-type="-1"><i class="fa fa-caret-down"></i></div>
                  </li>
                </ul>
                <ul>
                  <li>예약 인원</li>
                  <li><input type="text" class="input person_input num_input" name="person"></li>
                </ul>
                <ul>
                  <li>가격</li>
                  <li><span class="price_t" style="font-size: 1.3rem;">0</span>원</li>
                </ul>
              </div>

              <input type="hidden" name="price" class="price_input">

              <div class="after_line"></div>

              <div class="btn_right">
                <button class="btn next_btn" style="display: none;">다음</button>
                <h2 class="is_able"></h2>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  timeSet();

  if (document.referrer == "http://127.0.0.1/post/res2") {
    history.pushState(null, null, location.href);

    window.onpopstate = (e) => {
      location.href = '/post/res2';
    }
  }
</script>