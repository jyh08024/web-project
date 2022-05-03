<?php require "view/header.php"; ?>
  <link rel="stylesheet" href="resources/css/sub.css">

  <div class="section join_section wrap">
      <div class="section_title">
        <p class="main_title">로그인<span class="color">페이지</span></p>
        <p>아직 회원이 아니시라면? <span class="color"><a href="join.php" class="move">회원가입</a></span></p>
      </div>

      <div class="login_form_area">

        <form class="login_form flex alc">
          <div class="login_form_left">
            <img src="resources/image/06.png" alt="loginImg" title="loginImg">
          </div>
          <div class="login_form_right">
            <div class="login_form_title">
              <h2>로그인</h2>
            </div>

            <div class="login_input flex alc js">
              <ul style="width: 100%;">
                <li><label for="">아이디</label></li>
                <li><input type="text" class="input" name="user_id" placeholder="아이디를 입력해주세요"></li>
              </ul>
              <ul style="width: 100%;">
                <li><label for="">비밀번호</label></li>
                <li><input type="password" class="input" name="user_pass" placeholder="비밀번호를 입력해주세요."></li>
              </ul>
              <button type="button" class="login_btn btn" onclick="ajax(`../app/loginPost.php`, ``, `login_form`, `로그인이 완료되었습니다.`)" style="width: 100%;">로그인</button>
            </div>
          </div>
        </form>

      </div>
    </div>
<?php require "view/footer.php"; ?>