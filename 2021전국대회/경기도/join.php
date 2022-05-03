<?php require "view/header.php"; ?>
  <link rel="stylesheet" href="resources/css/sub.css">

  <div class="section join_section wrap">
      <div class="section_title">
        <p class="main_title">회원가입<span class="color">페이지</span></p>
        <p>이미 회원이시라면? <span class="color"><a href="login.php" class="move">로그인</a></span></p>
      </div>

      <div class="join_form_area">

        <form class="join_form flex alc">
          <div class="join_form_left">
            <img src="resources/image/06.png" alt="joinImg" title="joinImg">
          </div>
          <div class="join_form_right">
            <div class="join_form_title">
              <h2>회원가입</h2>
            </div>

            <div class="join_input flex alc js">
              <ul style="width: 49%;">
                <li><label for="">아이디</label></li>
                <li><input type="text" class="input" name="user_id" placeholder="아이디를 입력해주세요"></li>
              </ul>
              <ul style="width: 49%;">
                <li><label for="">비밀번호</label></li>
                <li><input type="text" class="input" name="user_pass" placeholder="비밀번호를 입력해주세요."></li>
              </ul>
              <ul style="width: 800px">
                <li><label for="">이름</label></li>
                <li><input type="password" class="input" name="user_name" placeholder="이름을 입력해주세요."></li>
              </ul>

              <button type="button" class="join_btn btn" onclick="ajax(`../app/joinPost.php`, ``, `join_form`, `회원가입이 완료되었습니다.`)" style="width: 100%;">회원가입</button>
            </div>
          </div>
        </form>

      </div>
    </div>
<?php require "view/footer.php"; ?>