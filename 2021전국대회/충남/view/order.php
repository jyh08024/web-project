  <div class="section">
    <div class="wrap">
      <div class="section_title flex alc js">
        <div>
          <h1 class="main_title white">예약하기</h1>
          <h1 class="back_title">예약하기</h1>
        </div>
      </div>

      <div class="basket_table">
        <div class="basket_title">
          <div><h3>상품 사진</h3></div>
          <div><h3>빵이름(상호)</h3></div>
          <div><h3>수량</h3></div>
          <div><h3>상품가격</h3></div>
          <div><h3>소계(수량 * 상품가격)</h3></div>
        </div>

        <div class="basket_list" style="height: 350px;">

        </div>

        <div class="total_price_box flex alc jc">
          <div class="total_order_price flex alc js">
            <div class="tlc">
              <p>총 주문 금액</p>
              <h1 class="total_count_price">21,000원</h1>
            </div>

            <div>
              <i class="fa fa-chevron-right" style="font-size: 2rem;"></i>
            </div>

            <div class="tlc">
              <p>총 결제 금액</p>
              <h1 class="total_count_price">21,000원</h1>
            </div>

          </div>
        </div>
      </div>

      <div class="order_info_area">
        <div class="order_info_box">
          <div class="order_info_title">
            <h2>예약정보</h2>
          </div>

          <div class="after_line"></div>

          <div class="order_info_form">
            <form class="form_class order_form" action="/post/order" method="POST">
              <ul>
                <li><label for="">방문 예정날짜</label></li>
                <li><input type="date" class="input" name="visit_date" min="<?= date('Y-m-d') ?>" required></li>
              </ul>
              <ul>
                <li><label for="">방문 예정시간</label></li>
                <li><input type="time" class="input" name="visit_time" required></li>
              </ul>
              <ul>
                <li><label for="">이름</label></li>
                <li><input type="text" class="input" name="user_name" value="<?= USER['user_name'] ?>" required readonly></li>
              </ul>
              <ul>
                <li><label for="">연락처</label></li>
                <li><input type="text" class="input" name="user_call" value="<?= USER['user_call'] ?>" required readonly></li>
              </ul>
              <ul>
                <li><label for="">결제방법</label></li>
                <li>
                  <input type="radio" name="pay_method" id="credit_card" value="card" checked style="width: auto;" required>
                  <label for="credit_card">신용카드</label> 
                </li>
                <li>
                  <input type="radio" name="pay_method" id="cash" value="cash" style="width: auto;" required>
                  <label for="cash">현금</label> 
                </li>
              </ul>

              <div class="after_line"></div>

              <button class="btn">예약하기</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

