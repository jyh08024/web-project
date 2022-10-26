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
            <h2>예약신청</h2>
            <h4>예약 3단계 중 2단계</h4>
          </div>
          <div class="after_line"></div>

          <div class="form_area">
          	<ul class="flex alc js tlc">
          		<li class="tlc">
          			<span>예약일시</span>
          			<br>
          			<span><?= $_POST['date'] ?> <?= $_POST['time'] ?></span>
          		</li>
          		<li class="tlc">
          			<span>선택한 식당</span>
          			<br>
          			<span><?= $_POST['store'] ?></span>
          		</li>
          		<li class="tlc">
          			<span>메뉴</span>
          			<br>
          			<span><?= $_POST['menu'] ?> <?= $_POST['count'] ?>인분</span>
          		</li>
          		<li class="tlc">
          			<span>인원</span>
          			<br>
          			<span><?= $_POST['person'] ?>명</span>
          		</li>
          	</ul>

            <div class="after_line"></div>

            <form action="/post/res2" method="POST" class="res_form_2 res_form">
              <?php foreach ($_POST as $key => $v): ?>
                <input type="hidden" name="<?= $key ?>" value="<?= $v ?>">
              <?php endforeach ?>
              <div class="input_grid">
                <ul>
                  <li>예약자 이름</li>
                  <li>
                    <input type="text" class="input" name="name" data-name="예약자 이름" value="<?= @$_POST['name'] ? @$_POST['name'] : "" ?>">
                  </li>
                </ul>
                <ul>
                  <li>전화번호</li>
                  <li class="flex alc js">
                    <input type="text" class="num_input input" name="p_1" style="width: 33%;" data-name="전화번호" value="<?= @$_POST['p_1'] ? @$_POST['p_1'] : "" ?>">
                    <input type="text" class="num_input input" name="p_2" style="width: 33%;" data-name="전화번호" value="<?= @$_POST['p_2'] ? @$_POST['p_2'] : "" ?>">
                    <input type="text" class="num_input input" name="p_3" style="width: 33%;" data-name="전화번호" value="<?= @$_POST['p_3'] ? @$_POST['p_3'] : "" ?>">
                  </li>
                </ul>
                <ul>
                  <li>이메일</li>
                  <li>
                    <input type="text" class="input email_input" name="email" data-name="이메일" value="<?= @$_POST['email'] ? @$_POST['email'] : "" ?>">
                  </li>
                </ul>
                <ul>
                  <li>비밀번호</li>
                  <li>
                    <input type="password" class="input" name="pw" data-name="비밀번호" value="<?= @$_POST['pw'] ? @$_POST['pw'] : "" ?>">
                  </li>
                </ul>
              </div>

              <div class="after_line"></div>

              <img src="/resources/images/1.jpg" alt="" style="width: 250px;">
              
              <div class="after_line"></div>

              <div class="btn_right">
                <button class="btn">다음</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>

