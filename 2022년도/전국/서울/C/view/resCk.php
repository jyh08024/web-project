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
						<h2>예약내용 확인</h2>
            <h4>예약 3단계 중 3단계</h4>
					</div>
          <div class="after_line"></div>

          <div class="form_area">
          	<ul class="flex alc js tlc" style="margin-bottom: 1.5rem;">
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
            <ul class="flex alc js tlc">
          		<li class="tlc">
          			<span>예약자 이름</span>
          			<br>
          			<span><?= $_POST['name'] ?></span>
          		</li>
          		<li class="tlc">
          			<span>전화번호</span>
          			<br>
          			<span><?= $_POST['p_1'] ?>-<?= $_POST['p_2'] ?>-<?= $_POST['p_3'] ?></span>
          		</li>
          		<li class="tlc">
          			<span>이메일</span>
          			<br>
          			<span><?= $_POST['email'] ?></span>
          		</li>
          		<li class="tlc">
          			<span>비밀번호</span>
          			<br>
          			<span><?= $_POST['pw'] ?></span>
          		</li>
          	</ul>

            <div class="after_line"></div>

            
            <div class="btn_right">
              <form action="/post/res1" method="POST">
                <?php foreach ($_POST as $key => $v): ?>
                  <input type="hidden" name="<?= $key ?>" value="<?= $v ?>">
                <?php endforeach ?>
                <button class="btn">수정</button>
              </form>
              <form action="/form/del" class="del_form" method="POST">
                <button class="btn canc_btn">취소</button>
              </form>
              <form action="/post/res3" method="POST">
                <?php foreach ($_POST as $key => $v): ?>
                  <input type="hidden" name="<?= $key ?>" value="<?= $v ?>">
                <?php endforeach ?>
                <button class="btn">확인</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>

