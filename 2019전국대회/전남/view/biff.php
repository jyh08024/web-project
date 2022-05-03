  <div class="section"></div>

  <div class="section wrap">
    <div class="section_title">
      <h2>BIFF<span class="color">INTRO</span><span style="font-size: 1rem;">영화제소개</span></h2>
      <p>한국 영화계의 축제, 그 소개</p>
    </div>

    <div class="intro_page_top">
      <img src="resources/img/56.jpg" alt="intro" title="intro">
      <img src="resources/img/23.jpg" alt="intro" title="intro">
    </div>

    <div class="intro_page_content flex alc js">
      <div class="intro_title">
        <p>2019년 10월 3일 부산 국제 영화제를 시작합니다.</p>
      </div>

      <div class="intro_text">
        <p>
          부산국제영화제는 매년 가을 대한민국 부산광역시 영화의전당 일원에서 개최되는 국제영화제다.
          도쿄, 홍콩국제영화제와 더불어 아시아 최대 규모의 영화제다.
          부분경쟁을 도입한 비경쟁영화제로 국제영화제작자연맹의 공인을 받은 영화제이다.
          <br>
          <br>
          부산국제영화제는 한국 영화 산업이 침체기에 빠져 있던 시기에 그 부흥을 위해 태동했다.
          새로운 작가를 발굴 지원함으로써 아시아 영화의 비전을 모색한다는 취지 아래 1996년에 창립되어 한국은 물론 아시아 영화 산업을 한 단계 발전시키는데 공헌하였다.
          <br>
          <br>
          영화제 개최의 주목적은 아시아 영화의 부흥에 포커스를 맞추고, 부산지역 영상산업 유치와 활성화를 도모하고, 관광객을 유치하는데에 있다.
          세계 각국의 배우감독, 제작자, 영화·영상 관계자들과 일반 관객들이 격의 없이 소통할 수 있는 장을 마련하여 왔다.
          <br>
          <br>
          또 세계 영화계에서 한국 영화를 비롯한 아시아 영화의 신선함을 인식하게 했다.
          남포동 BIFF거리에서 진행되던 부산국제영화제는 현재 해운대 요트경기장에서 매년 개막식을 가지고 있다.
        </p>
      </div>
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
