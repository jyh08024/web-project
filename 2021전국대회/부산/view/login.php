  <div class="sub_page_visual">
    <div class="sub_page_title flex alc wrap">
      <h1>로그인</h1>
    </div>
  </div>

  <div class="sub_page_section section wrap">

    <div class="login_form_area">
    
    <form method="POST" action="/post/login" class="login_form flex">
      <div class="login_form_left">
        <img src="/resources/img/성심당2.jpg" alt="login_form" title="login_form">
      </div>

      <div class="login_form_right">
        <div class="form_title">
          <h1>로그인</h1>
        </div>

        <div class="login_input form_input">
          <ul>
            <li><label for="id">아이디</label></li>
            <li><input type="text" class="input" name="id" id="id" placeholder="아이디를 입력해주세요"></li>
          </ul>

          <ul>
            <li><label for="pass_word">비밀번호</label></li>
            <li><input type="password" class="input" name="pass_word" id="pass_word" placeholder="비밀번호를 입력해주세요"></li>
          </ul>

          <ul class="flex alc">
            <li><button class="btn">로그인</button></li>
            <li><a href="/join" class="btn">회원가입</a></li>
          </ul>
        </div>
      </div>
    </form>

  </div>
    
  </div>