<div class="modal">
    <div class="popup" id="buy_popup">
      <div class="popup_title">
        <h2>구매자 정보 입력</h2>
        <div class="popup_close">
          <i class="fa fa-times-circle"></i>
        </div>
      </div>

      <div class="popup_content">
        <form class="buy_form">
          <ul>
            <li>배송일</li>
            <li><input type="date" class="input" name="buy_day" min="2022-01-15" max="2022-01-20"></li>
          </ul>
          <ul>
            <li>배송시간</li>
            <li>
              <select name="buy_time" class="input" id="buy_time_sel">
                <option value=""></option>
              </select>
            </li>
          </ul>
          <ul>
            <li>구매자명</li>
            <li><input type="text" class="input" name="user_name" value="<?= USER['user_name'] ?>" readonly></li>
          </ul>
          <ul>
            <li>전화번호</li>
            <li><input type="text" class="input" name="user_call" value="<?= USER['user_call'] ?>" readonly></li>
          </ul>
          <ul>
            <li>우편번호</li>
            <li><input type="text" class="input" name="user_code" value="<?= USER['user_code'] ?>" readonly></li>
          </ul>
          <ul>
            <li>주소</li>
            <li><input type="text" class="input" name="user_ad" value="<?= USER['user_ad'] ?>" readonly></li>
          </ul>
          <ul>
            <li>상세 주소</li>
            <li><input type="text" class="input" name="user_detail_ad" value="<?= USER['user_detail_ad'] ?>" readonly></li>
          </ul>

          <div class="after_line"></div>
          <button class="btn buy_complete">구매 완료</button>
        </form>

      </div>
    </div>

     <div class="popup" id="req_popup">
      <div class="popup_title">
        <h2>제안 요청</h2>
        <div class="popup_close">
          <i class="fa fa-times-circle"></i>
        </div>
      </div>

      <div class="popup_content">
        <form class="req_form">
          <ul>
            <li>요청명</li>
            <li><input type="text" name="req_name" class="input"></li>
          </ul>
          <ul>
            <li>가격 한도</li>
            <li><input type="text" name="max" class="input"></li>
          </ul>
          <ul>
            <li>오차 범위</li>
            <li><input type="text" name="priceRange" class="input"></li>
          </ul>
        </form>

        <div class="after_line"></div>

        <button class="btn" onclick="postReq()">요청</button>
      </div>
    </div>

    <div class="popup" id="sug_detail">
      <div class="popup_title">
        <h2>상품 리스트</h2>
        <div class="popup_close">
          <i class="fa fa-times-circle"></i>
        </div>
      </div>

      <div class="popup_content">
        <div class="sug_list_cont">
          <table class="order_static">
            <thead>
              <th>상품명</th>
              <th>상품 개수</th>
              <th>총 가격</th>
            </thead>

            <tbody class="sug_items">
              
            </tbody>
          </table>
        </div>

        <div class="after_line"></div>

        <h2>총 가격: <span class="color sug_total_price">10,000</span>원</h2>
      </div>
    </div>
  </div>

<div class="header_rap">
    <div class="after_line"></div>
  </div>

  <footer>
    <div class="foo_rap wrap flex alc js">
      <div>
        <h2>FAMILY SITE</h2>
        <div class="family_site flex alc">
          <a href="#">문화체육관광부</a>
          <a href="#">전라북도청</a>
          <a href="#">한국관광공사</a>
          <a href="#">완주군청</a>
        </div>
      
        <div class="foo_sns flex alc">
          <i class="fab fa-twitter" style="color: #00aeff;"></i>
          <i class="fab fa-facebook-square" style="color: #3054ef"></i>
          <i class="fab fa-instagram" style="color: #000"></i>
          <i class="fab fa-youtube" style="color: #ff0000"></i>
        </div>
      
        <div class="copy">
          <p>
            (55352) 전북 완주군 용진읍 지암로 61(운곡리 975-78) 와일드푸드축제 추진위원회 <br>
            사업자등록번호 : 418-82-70718 대표자 : 이명기 TEL : 063-290-2621~4 FAX : 063-290-2069 <br>
            주최 : 완주군 / 주관 : 와일드푸드축제 추진위원회 / 후원 : 문화체육관광부, 전라북도, 한국관광공사 <br>
            <br>
            Copyright 2019. 완주와일드푸드축제. All rights reserved.
          </p>
        </div>
      </div>
      
      <div>
        <img src="/resources/img/Map.jpg" alt="map" title="map">
      </div>
    </div>
  </footer>
  
</body>
</html>