  <div class="section"></div>

  <div class="section wrap">
    <div class="section_title">
      <h2>BIFF<span class="color">PLACE</span><span style="font-size: 1rem;">행사장소개</span></h2>
      <p>한국 영화계의 축제, 행사장 소개</p>
    </div>

    <div class="intro_page_top">
      <img src="resources/img/map1.png" alt="intro" title="intro">
      <img src="resources/img/map2.png" alt="intro" title="intro">
    </div>
  </div>

  <input type="checkbox" name="popup_view" id="login_view" hidden>
  <input type="checkbox" name="popup_view" id="join_view" hidden>

  <div class="modal">
    <label for="login_view" class="other_area"></label>
    <label for="join_view" class="other_area"></label>

    <div class="popup" id="login_popup">
      <div class="popup_content">
        <div class="popup_left">
          <img src="resources/img/51.jpg" alt="popup" title="popup">
        </div>

        <div class="popup_right">
          <div class="popup_title">
            <h2>로그인</h2>

            <div class="popup_close">
              <label for="login_view">
                <i class="fa fa-times-circle"></i>
              </label>
            </div>
          </div>

          <div class="popup_content">
            <form action="#" method="POST">
              <ul>
                <li>아이디</li>
                <li><input type="text" class="input" id="user_id"></li>
                <li>
                  <p class="err user_id_err"></p>
                </li>
              </ul>
              <ul>
                <li>비밀번호</li>
                <li><input type="password" class="input" id="user_pass"></li>
                <li>
                  <p class="err user_pass_err"></p>
                </li>
              </ul>

              <div class="after_line2"></div>

              <button class="btn">로그인</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="popup" id="join_popup">
      <div class="popup_content">

        <div class="popup_left">
          <img src="resources/img/51.jpg" alt="popup" title="popup">
        </div>

        <div class="popup_right">
          <div class="popup_title">
            <h2>회원가입</h2>

            <div class="popup_close">
              <label for="join_view">
                <i class="fa fa-times-circle"></i>
              </label>
            </div>
          </div>

          <div class="popup_content">
            <form action="#" method="POST">
              <ul>
                <li>아이디</li>
                <li><input type="text" class="input" id="user_id"></li>
                <li>
                  <p class="err user_id_err"></p>
                </li>
              </ul>
              <ul>
                <li>비밀번호</li>
                <li><input type="password" class="input" id="user_pass"></li>
                <li>
                  <p class="err user_pass_err"></p>
                </li>
              </ul>
              <ul>
                <li>비밀번호 확인</li>
                <li><input type="password" class="input" id="user_pass_ck"></li>
                <li>
                  <p class="err user_pass_ck_err"></p>
                </li>
              </ul>
              <ul>
                <li>이름</li>
                <li><input type="password" class="input" id="user_name"></li>
                <li>
                  <p class="err user_name_err"></p>
                </li>
              </ul>

              <div class="after_line2"></div>

              <button class="btn">회원가입</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
