<div class="section"></div>
  <div class="section"></div>
  <div class="section">
    <div class="wrap">
      <div class="section_title ani">
        <div>
          <h4 class="main_title"><span class="title_cont">정원예약 - <?= $garden['name'] ?></span></h4>
        </div>
      </div>

      <div class="section_content">
        <div class="join_form form_box">
          <div class="form_left">
            <img src="/resources/민간정원/<?= $garden['name'] ?>2.jpg" alt="form" title="form">
          </div>
          <div class="form_right">
            <h2>정원예약</h2>
            <div class="after_line opa1"></div>

            <form action="/post/res" method="POST" class="res_form">
              <ul>
                <li>방문날짜</li>
                <li><input type="date" class="input" name="date" min="<?= date("Y-m-d") ?>"></li>
              </ul>
              <ul>
                <li>방문인원</li>
                <li><input type="text" class="count_input input" name="count"></li>
              </ul>

              <div class="after_line opa1"></div>

              <input type="hidden" name="garden" value="<?= $garden['idx'] ?>">
              <input type="hidden" name="price" class="price_input" value="">

              <div class="flex alc">
                <button type="button" class="btn" onclick="res_check()">예약 가능 여부 확인</button>
                <button class="btn disa res_btn">예약</button>
                <h2 style="display: none;" class="price_style">결제금액: <span class="price"></span></h2>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    // $(document)
      // .on(`submit`, ".res_form")
  </script>