<div class="section"></div>
<div class="section"></div>
<div class="section wrap">
  <div class="section_title ani">
    <h2>Q & A 게시판</h2>
  </div>

  <div class="section_content flex rest_section">
    <div class="top_tab">
      <a class="tab" href="/restaurant"><i class="fa fa-pencil-square-o"></i> 예약정보 입력</a>
      <a class="tab" href="/restRead"><i class="fa fa-search-plus"></i> 예약 조회</a>
      <a class="tab now_tab" href="/qna"><i class="fa fa-book"></i> Q&A</a>
    </div>

    <div class="sb">
      <div class="form_box">
        <!-- <div class="form_left"> -->
          <!-- <img src="/resources/images/1.jpg" alt=""> -->
        <!-- </div> -->
        <div class="form_right">
          <div class="flex alc js">
            <h2>Q & A</h2>

            <?php if (@USER): ?>
              <div class="flex alc" style="width: 35%;">
                <a href="/qWrite" class="btn">글작성</a>
                <select name="store" class="input store_input">
                  <option value="서동한식당">서동한식당</option>
                  <option value="서동전통찻집">서동전통찻집</option>
                  <option value="서동한두">서동한우</option>
                </select>
              </div>
            <?php endif ?>
          </div>
          <div class="after_line"></div>

          <div class="box_cont">
            <?php if (!@USER): ?>
              <form action="/post/isRes" method="POST">
                <ul>
                  <li>이메일 주소</li>
                  <li><input type="text" name="email" class="input"></li>
                </ul>
                <ul>
                  <li>비밀번호</li>
                  <li><input type="password" name="pw" class="input"></li>
                </ul>

                <div class="after_line"></div>

                <button class="btn">예약확인</button>
              </form>
              <?php else: ?>
              
              <div class="res_list form_box tlc">
                <?php foreach ($q as $key => $v): ?>
                  <div class="label_box q_item">
                    <a href="/q/<?= $v['idx'] ?>">
                      <div class="flex alc">
                        <img src="/resources/logo.png">
                        <h2><?= mb_strlen($v['title']) > 25 ? substr($v['title'], 0, 25) : $v['title'] ?></h2>
                      </div>
                    </a>
                  </div>
                <?php endforeach ?>
              </div>
            <?php endif ?>
          </div>
        </div>
      <div>
    </div>
    
  </div>
</div>

