<!-- 모달 -->
  <input type="checkbox" name="popup_view" id="login_view" hidden>
  <input type="checkbox" name="popup_view" id="join_view" hidden>
  <input type="checkbox" name="popup_view" id="ticket_view" hidden>

  <div class="modal">
    <label for="login_view" class="other_area"></label>
    <label for="join_view" class="other_area"></label>
    <label for="ticket_view" class="other_area"></label>

    <div class="popup" id="ticket_popup" style="width: 1200px">
      <div class="popup_content">
        <div class="popup_left">
          <img src="../resources/img/51.jpg" alt="popup" title="popup">
        </div>
        
        <div class="popup_right">
          <div class="popup_title">
            <h2>예매권</h2>
            
            <div class="popup_close">
              <label for="ticket_view">
                <i class="fa fa-times-circle"></i>
              </label>
            </div>
          </div>
          
          <div class="popup_content">
            <div class="popup_content">
              <canvas id="ticket_cv" width="480" height="280" onclick="downloadTicket()"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
    
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
                <li><input type="text" class="input" name="user_id"></li>
                <li><p class="err user_id_err"></p></li>
              </ul>
              <ul>
                <li>비밀번호</li>
                <li><input type="password" class="input" name="user_pass" style="font-family: 'Malgun Gothic'"></li>
                <li><p class="err user_pass_err"></p></li>
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
            <form action="#" class="join_form">
              <ul>
                <li>아이디</li>
                <li><input type="text" class="input" name="user_id"></li>
                <li><p class="err user_id_err"></p></li>
              </ul>
              <ul>
                <li>비밀번호</li>
                <li><input type="password" class="input" name="user_pass" style="font-family: 'Malgun Gothic'"></li>
                <li><p class="err user_pass_err"></p></li>
              </ul>
              <ul>
                <li>비밀번호 확인</li>
                <li><input type="password" class="input" name="user_pass_ck" style="font-family: 'Malgun Gothic'"></li>
                <li><p class="err user_pass_ck_err"></p></li>
              </ul>
              <ul>
                <li>이름</li>
                <li><input type="text" class="input" name="user_name"></li>
                <li><p class="err user_name_err"></p></li>
              </ul>
              
              <div class="after_line2"></div>
              
              <button class="btn">회원가입</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- 푸터 -->
  <footer>
    <div class="foo_rap header_rap" style="display: block;">
      <div class="after_line"></div>
      
      <div class="foo_top">
        <div class="logo">
          <img src="/resources/logo.png" alt="logo" title="logo">
        </div>

        <div class="foo_menu">
          <a href="#">메인</a>
          <a href="#">축제소개</a>
          <a href="#">영화예매</a>
          <a href="#">이벤트&컬쳐</a>
          <a href="#">역대영화제</a>
        </div>
      </div>

      <div class="foo_bottom">
        <p class="copy">
          주소 (48058) 부산시 해운대구 수영강변대로 120 영화의전당 비프힐 3층 <br>
          전화 1688-3010 <br>
          팩스 051-709-2299 <br>
          <br>
          Copyright ⓒ 2019. BIFF. All rights reserved
        </p>

        <div class="sns_icons">
          <img src="/resources/img/YouTube.png" alt="sns" title="sns">
          <img src="/resources/img/Twitter.png" alt="sns" title="sns">
          <img src="/resources/img/Facebook.png" alt="sns" title="sns">
        </div>
      </div>
    </div>
  </footer>

</body>
</html>