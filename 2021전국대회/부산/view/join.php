  <div class="sub_page_visual">
    <div class="sub_page_title flex alc wrap">
      <h1>회원가입</h1>
    </div>
  </div>

  <div class="sub_page_section section wrap">

    <div class="login_form_area" style="height: 550px;">
    
    <form method="POST" action="/post/join" class="login_form flex">
      <div class="login_form_left">
        <img src="/resources/img/성심당2.jpg" alt="login_form" title="login_form">
      </div>

      <div class="login_form_right">
        <div class="form_title">
          <h1>회원가입</h1>
        </div>

        <div class="login_input form_input">
          <ul>
            <li><label for="id">ID</label></li>
            <li><input type="text" class="input" name="id" id="id" placeholder="아이디를 입력해주세요"></li>
          </ul>

          <ul>
            <li><label for="pass_word">비밀번호</label></li>
            <li><input type="password" class="input" name="pass_word" id="pass_word" placeholder="비밀번호를 입력해주세요"></li>
          </ul>

          <ul>
            <li><label for="user_pass_ck">비밀번호 확인</label></li>
            <li><input type="password" class="input" name="user_pass_ck" id="user_pass_ck" placeholder="비밀번호를 입력해주세요"></li>
          </ul>

          <ul>
            <li><label for="user_name">이름</label></li>
            <li><input type="text" class="input" name="user_name" id="user_name" placeholder="이름을 입력해주세요"></li>
          </ul>


          <ul class="flex alc">
            <li><button class="btn">회원가입</button></li>
          </ul>
        </div>
      </div>
    </form>

  </div>
    
  </div>