<div class="modal"></div>

  <template>
  <div class="popup recpt_popup">
      <div class="popup_title">
        <h2>영수증 출력</h2>
        <div class="popup_close">
          <i class="fa fa-times-circle"></i>
        </div>
      </div>
      
      <div class="after_line"></div>

      <div class="popup_content flex alc js">
        <div class="sel_btn" onclick="drawRec('png')">png 다운로드</div>
        <div class="sel_btn" onclick="drawRec('jpg')">jpg 다운로드</div>
      </div>
    </div>

    <div class="popup res_type_popup">
      <div class="popup_title">
        <h2>예약하기</h2>
        <div class="popup_close">
          <i class="fa fa-times-circle"></i>
        </div>
      </div>
      
      <div class="after_line"></div>

      <div class="popup_content flex alc js">
        <div class="res_type_sel" data-type="phone">휴대폰 번호로 예약하기</div>
        <div class="res_type_sel" data-type="number">주민번호로 예약하기</div>
      </div>
    </div>

    <div class="popup phone_res_popup">
      <div class="popup_title">
        <h2>휴대폰 번호로 예약하기</h2>
        <div class="popup_close">
          <i class="fa fa-times-circle"></i>
        </div>
      </div>
    
      <div class="after_line"></div>
    
      <div class="popup_content">
        <form class="phone_res">
          <ul>
            <li>
              <span>휴대폰번호</span>
              <br>
              <span class="err phone_err"></span>
            </li>
            <li><input type="text" class="input phone_input" name="phone"></li>
          </ul>
          <ul>
            <li>
              <span>비밀번호(5자리 숫자)</span>
              <br>
              <span class="err pw_err"></span>
            </li>
            <li><input type="password" class="input pw" name="pw"></li>
          </ul>
          <ul>
            <li>
              <span>비밀번호 확인</span>
              <br>
              <span class="err pwck_err"></span>
            </li>
            <li><input type="password" class="input pw_ck" name="pwck"></li>
          </ul>

          <div class="after_line"></div>

          <button class="btn">다음</button>
        </form>
      </div>
    </div>

    <div class="popup number_res_popup">
      <div class="popup_title">
        <h2>주민번호 예약하기</h2>
        <div class="popup_close">
          <i class="fa fa-times-circle"></i>
        </div>
      </div>
    
      <div class="after_line"></div>
    
      <div class="popup_content">
        <form class="number_res">
          <ul>
            <li>
              <span>주민번호</span>
              <br>
              <span class="err number_err"></span>
            </li>
            <li><input type="text" class="input" name="number"></li>
          </ul>
          <ul>
            <li>
              <span>이름</span>
              <br>
              <span class="err name_err"></span>
            </li>
            <li><input type="text" class="input" name="name"></li>
          </ul>
          <ul>
            <li>
              <span>생년월일</span>
              <br>
              <span class="err date_err"></span>
            </li>
            <li><input type="date" class="input" name="date"></li>
          </ul>
    
          <div class="after_line"></div>
    
          <button class="btn">다음</button>
        </form>
      </div>
    </div>

    <div class="popup res_detail_popup">
      <div class="popup_title">
        <h2>상세 선택</h2>
        <div class="popup_close">
          <i class="fa fa-times-circle"></i>
        </div>
      </div>
    
      <div class="after_line"></div>
    
      <div class="popup_content">
        <form class="detail_form">
          <ul>
            <li>예약 가능한 날짜</li>
            <li><input type="text" class="input date_input" name="res_date" autocomplete="off"></li>
          </ul>
          <ul>
            <li>인원</li>
            <li class="flex alc js" style="margin-bottom: .5rem;">
              <p style="font-size: .9rem; width: 7%;">성인</p>
              <input type="text" class="input adult" name="adult" readonly style="width: 65%;" value="0" data-price="1000">
              <div class="flex alc">
                <div class="btn val_con" data-type="1" style="padding: .3rem 1.5rem;"><i class="fa fa-plus"></i></div>
                <div class="btn val_con" data-type="-1" style="padding: .3rem 1.5rem;"><i class="fa fa-minus"></i></div>
              </div>
            </li>
            <li class="flex alc js" style="margin-bottom: .5rem;">
              <p style="font-size: .9rem; width: 7%;">소인</p>
              <input type="text" class="input child" name="adult" readonly style="width: 65%;" value="0" data-price="500">
              <div class="flex alc">
                <div class="btn val_con" data-type="1" style="padding: .3rem 1.5rem;"><i class="fa fa-plus"></i></div>
                <div class="btn val_con" data-type="-1" style="padding: .3rem 1.5rem;"><i class="fa fa-minus"></i></div>
              </div>
            </li>
            <li class="flex alc js">
              <p style="font-size: .9rem; width: 7%;">원주민</p>
              <input type="text" class="input native" name="native" readonly style="width: 65%;" value="0" data-price="300">
              <div class="flex alc">
                <div class="btn val_con" data-type="1" style="padding: .3rem 1.5rem;"><i class="fa fa-plus"></i></div>
                <div class="btn val_con" data-type="-1" style="padding: .3rem 1.5rem;"><i class="fa fa-minus"></i></div>
              </div>
            </li>
          </ul>
          <ul>
            <li>금액</li>
            <li><span class="price" style="font-size: 1.1rem">0</span>원</li>
            <input type="hidden" name="price" class="price_input" value="0">
          </ul>
    
          <div class="after_line"></div>
    
          <div class="flex alc js res_img">
    
          </div>
    
          <div class="after_line"></div>
    
          <div class="btn_right">
            <button class="btn">예약</button>
          </div>
        </form>
      </div>
    </div>

    <div class="popup res_state_popup">
      <div class="popup_title">
        <h2>예약현황</h2>
        <div class="popup_close">
          <i class="fa fa-times-circle"></i>
        </div>
      </div>

      <div class="after_line"></div>

      <div class="popup_content flex alc js">
        <div class="state_sel" data-sel="state_phone">휴대폰 번호로 확인하기</div>
        <div class="state_sel" data-sel="state_number">주민번호로 확인하기</div>
      </div>
    </div>

    <div class="popup state_phone_popup">
      <div class="popup_title">
        <h2>예약현황</h2>
        <div class="popup_close">
          <i class="fa fa-times-circle"></i>
        </div>
      </div>
    
      <div class="after_line"></div>
    
      <div class="popup_content">
        <form class="state_form phone_form" data-type="phone">
          <ul>
            <li>휴대폰번호</li>
            <li><input type="text" class="input" name="phone"></li>
          </ul>
          <ul>
            <li>비밀번호</li>
            <li><input type="password" class="input" name="password"></li>
          </ul>

          <div class="after_line"></div>

          <button class="btn">다음</button>
        </form>
      </div>
    </div>
    
    <div class="popup state_number_popup">
      <div class="popup_title">
        <h2>예약하기</h2>
        <div class="popup_close">
          <i class="fa fa-times-circle"></i>
        </div>
      </div>
    
      <div class="after_line"></div>
    
      <div class="popup_content">
        <form class="state_form number_form" data-type="number">
          <ul>
            <li>주민번호</li>
            <li><input type="text" class="input" name="number"></li>
          </ul>
          <ul>
            <li>이름</li>
            <li><input type="text" class="input" name="user_name"></li>
          </ul>
    
          <div class="after_line"></div>
    
          <button class="btn">다음</button>
        </form>
      </div>
    </div>

    <div class="popup res_data_popup">
      <div class="popup_title">
        <h2>예약현황</h2>
        <div class="popup_close">
          <i class="fa fa-times-circle"></i>
        </div>
      </div>

      <div class="after_line"></div>

      <div class="popup_content">
        <div class="data_view">
          
        </div>

        <div class="after_line"></div>

        <button class="btn print_btn">출력</button>
      </div>
    </div>

    <div class="popup sel_popup">
      <div class="popup_title">
        <h2>채택하기</h2>
        <div class="popup_close">
          <i class="fa fa-times-circle"></i>
        </div>
      </div>

      <div class="after_line"></div>

      <div class="popup_content">
        <form class="a_sel_form">
          <ul>
            <li>비밀번호</li>
            <li><input type="password" class="input sel_pw" name="pw"></li>
          </ul>

          <input type="hidden" name="idx" class="a_idx">
          <input type="hidden" name="q_idx" class="q_idx">

          <div class="after_line"></div>

          <button class="btn">체택하기</button>
        </form>
      </div>
    </div>
  </template>
  
  <footer>
    <div class="section wrap">
      <div class="after_line"></div>

      <div class="foo_top flex alc js">
        <div class="foo_logo">
          <img src="/resources/logo.png" alt="logo" title="logo">
        </div>

        <div class="foo_sns">
          <i class="fa fa-twitter"></i>
          <i class="fa fa-instagram"></i>
          <i class="fa fa-facebook-official"></i>
        </div>
      </div>

      <div class="foo_bot">
        <div class="foo_map">
          <img src="/resources/mao.png" alt="map" title="map">
        </div>
      </div>

    </div>
  </footer>
  
</body>
</html>
