  <div class="modal">
    <div class="popup" id="map_popup">
      <div class="popup_title">
        <h2>지도보기</h2>

        <div class="modal_close">
          <i class="fa fa-times-circle"></i>
        </div>
      </div>

      <div class="after_line"></div>

      <div class="popup_con">

        <div class="control_pannel">
          <div class="button_box" data-type="mouse_move">
            <i class="fa fa-mouse-pointer"></i> 이동
          </div>
          <div class="button_box" data-type="write_text">
            <i class="fa fa-font"></i> 글쓰기
          </div>
          <div class="button_box font_size_set">
            <input type="number" value="16" id="font-size" class="input"> 글씨 크기
          </div>
          <div class="button_box" data-type="draw_line">
            <i class="fa fa-pencil"></i> 선그리기
          </div>
          <div class="button_box color_picker">
            <input type="color" id="line_color"> 색상
          </div>
          <div class="button_box" data-type="enlarge">
            <i class="fa fa-search-plus"></i> 확대
          </div>
          <div class="button_box" data-type="reduce">
            <i class="fa fa-search-minus"></i> 축소
          </div>
          <div class="mag">
            <div>100%</div>
          </div>
          <div>
            <button class="btn share_map">공유하기</button>
          </div>
        </div>
        <div class="baker_map_div">
          <canvas id="draw_cv" width="900" height="650"></canvas>
          <canvas id="map_cv" width="900" height="650"></canvas>
        </div>
      </div>
    </div>
    
    <div class="popup" id="join_popup">
      <div class="popup_title">
        <h2>회원가입</h2>

        <div class="modal_close">
          <i class="fa fa-times-circle"></i>
        </div>
      </div>

      <div class="after_line"></div>

      <div class="popup_content">
        <form class="join_form form_class">
          <ul>
            <li><label for="">아이디</label></li>
            <li class="flex alc js">
              <input type="text" id="user_id" name="user_id" class="input" placeholder="아이디를 입력해주세요" style="width: 70%;" required>
              <button type="button" class="btn overlap_ck" onclick="App.idOverlap()">중복확인</button>
            </li>
            <li><p class="overlap"></p></li>
          </ul>

          <ul>
            <li><label for="">비밀번호</label></li>
            <li class="flex alc js">
              <input type="text" name="user_pass" class="input" placeholder="비밀번호를 입력해주세요" style="width: 70%;" required>
            </li>
          </ul>

          <ul>
            <li><label for="">이름</label></li>
            <li class="flex alc js">
              <input type="text" name="user_name" id="user_call" class="input" placeholder="이름를 입력해주세요" style="width: 70%;" required>
            </li>
          </ul>

          <ul>
            <li><label for="">전화번호</label></li>
            <li class="flex alc js">
              <input type="text" name="user_call" class="input" placeholder="전화번호를 입력해주세요" style="width: 70%;" required oninput="callForm(this)">
            </li>
          </ul>

          <ul>
            <li><label for="">e-mail</label></li>
            <li class="flex alc js">
              <input type="text" name="user_email" class="input" placeholder="e-mail를 입력해주세요" style="width: 70%;" required>
            </li>
          </ul>

          <ul class="key_pad_ul">
            <li><label for="">인증번호</label></li>
            <li class="flex alc js">
              <input type="text" name="user_code" class="input code_input" placeholder="인증번호를 입력해주세요" style="width: 70%;" required readonly>
              <div class="key_pad">
                <div class="key_pad_key">
                  <div>1</div>
                  <div>1</div>
                  <div>1</div>
                  <div>1</div>
                  <div>1</div>
                  <div>1</div>
                  <div>1</div>
                  <div>1</div>
                  <div>1</div>
                  <div>1</div>
                </div>
                <div class="key_pad_control">
                  <div>
                    <button type="button" class="btn back_space" data-type="back"><<--</button>
                    <button type="button" class="btn" data-type="reset">reset</button>
                  </div>
                </div>
              </div>
            </li>
          </ul>

          <div class="after_line"></div>

        </form>
        <button class="btn" onclick="ajax('/post/join', '.join_form')">회원가입</button>
      </div>
    </div>

    <div class="popup" id="login_popup">
      <div class="popup_title">
        <h2>로그인</h2>

        <div class="modal_close">
          <i class="fa fa-times-circle"></i>
        </div>
      </div>

      <div class="after_line"></div>


      <div class="popup_content">
        <input type="radio" hidden name="login_type" id="member_login" checked>
        <input type="radio" hidden name="login_type" id="non_member_login">
        <div class="form_type_btn">
          <label for="member_login" class="form_type">회원 로그인</label>
          <label for="non_member_login" class="form_type">비회원 로그인</label>
        </div>

        <div class="member_login_div login_div">
          
          <form class="form login_form member_login_form">
            <ul>
              <li><label>아이디</label></li>
              <li><input type="text" class="input" name="user_id" placeholder="아이디를 입력해주세요."></li>
            </ul>
            <ul>
              <li><label>비밀번호</label></li>
              <li><input type="text" class="input" name="user_pass"placeholder="비밀번호를 입력해주세요."></li>
            </ul>
            <ul class="key_pad_ul">
              <li><label for="">인증번호</label></li>
              <li class="flex alc js">
                <input type="text" name="user_code" class="input code_input" placeholder="인증번호를 입력해주세요" required readonly>
                <div class="key_pad">
                  <div class="key_pad_key">
                    <div>1</div>
                    <div>1</div>
                    <div>1</div>
                    <div>1</div>
                    <div>1</div>
                    <div>1</div>
                    <div>1</div>
                    <div>1</div>
                    <div>1</div>
                    <div>1</div>
                  </div>
                  <div class="key_pad_control">
                    <div>
                      <button type="button" class="btn back_space" data-type="back"><<--</button>
                      <button type="button" class="btn" data-type="reset">reset</button>
                    </div>
                  </div>
                </div>
              </li>
            </ul>

            <div class="after_line"></div>
            <input type="hidden" name="login_type" value="member">

          </form>
          <button class="btn" onclick="ajax('/post/login', '.member_login_form')">로그인</button>
        </div>

        <div class="none_member_login_div login_div">
          
          <form class="form login_form non_member_login_form">
            <ul>
              <li><label>예약자 이름</label></li>
              <li><input type="text" class="input" name="reserver" placeholder="예약자이름을 입력해주세요."></li>
            </ul>
            <ul>
              <li><label>예약자 전화번호</label></li>
              <li><input type="text" class="input" name="reserv_call"placeholder="예약자 전화번호를 입력해주세요."></li>
            </ul>

            <div class="after_line"></div>
            <input type="hidden" name="login_type" value="none">
          </form>
            <button class="btn" onclick="ajax('/post/login', '.non_member_login_form')">로그인</button>
        </div>
      </div>
    </div>

    <div class="popup" id="review_modal">
      <div class="popup_title">
        <h2>후기작성</h2>

        <div class="modal_close">
          <i class="fa fa-times-circle"></i>
        </div>
      </div>

      <div class="after_line"></div>

      <div class="popup_content review_popup_div">
        <form action="" class="form_class review_form">
          
        </form>
      </div>
    </div>
  </div>
  
  <footer>
    <div class="foo_rap wrap">
      <div class="after_line"></div>

      <div class="foo_top flex alc js">
        <div class="logo">
          <a href="index.html">
            <h3>빵 이야기</h3>
          </a>
        </div>

        <div class="foo_menu flex alc js">
          <a href="#">개인정보처리방침</a>
          <p>|</p>
          <a href="#">이용약관</a>
          <p>|</p>
          <a href="#">도로명주소안내</a>
          <p>|</p>
          <a href="#">사이트맵</a>
        </div>
      </div>

      <div class="foo_bottom flex alc js">
        <h4 class="copy">
          인천시 부평구 무네미로 448번길 77 전국기능경기대회 <br>
          COPYRIGHTⓒ 2021 HRDKOREA
        </h4>

        <div class="sns_icons flex alc js">
          <div>
            <img src="resources/icon/sns_1.png" alt="sns_icon" title="sns_icon">
          </div>
          <div>
            <img src="resources/icon/sns_2.png" alt="sns_icon" title="sns_icon">
          </div>
          <div>
            <img src="resources/icon/sns_3.png" alt="sns_icon" title="sns_icon">
          </div>
          <div>
            <img src="resources/icon/sns_4.png" alt="sns_icon" title="sns_icon">
          </div>
          <div>
            <img src="resources/icon/sns_5.png" alt="sns_icon" title="sns_icon">
          </div>
        </div>
      </div>
    </div>
  </footer>

</body>
</html>