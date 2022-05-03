  <div class="modal">
    <div class="popup" id="review_detail" style="height: 866.55px;">
      <div class="form_area">
        <div class="form_img review_big">
          <img src="resources/img/photo(13).jpg" class="resImg" alt="form" title="form" style="object-fit: cover;">
        </div>

        <div class="form_content">
          <div class="popup_title">
            <div>
              <h2>리뷰 상세</h2>
              <p>글번호: <span class="detail">0</span>번</p>
            </div>

            <div class="popup_close close_popup">
              X
            </div>
          </div>
        
          <div class="after_line"></div>

          <div class="review_detail">
            <ul>
              <li>이름</li>
              <li><input type="text" class="input name_input" name="name" readonly></li>
            </ul>
            <ul>
              <li>구매품</li>
              <li><input type="text" class="input" name="product" readonly></li>
            </ul>
            <ul>
              <li>구매처</li>
              <li><input type="text" class="input" name="shop" readonly></li>
            </ul>
          <ul>
            <li>구매일</li>
            <li><input type="date" class="input" name="purchase-date" readonly></li>
          </ul>
          <ul>
            <li class="flex alc js">
              <p>
                내용
              </p>
            </li>
            <li>
              <textarea name="contents" class="input" cols="30" rows="3" style="resize: none;" readonly></textarea>
            </li>
          </ul>
          <ul>
            <li>별점</li>
            <li>
              <div class="review_star flex alc">
                <p style="margin-top: .6rem;">별점 : <span class="score_html">0</span>점</p>
                
                <div class="star_div">
                  <p class="emp_star">☆☆☆☆☆</p>
                  <p class="fill_star" style="width: 0">★★★★★</p>
                </div>
              </div>
              <input type="hidden" name="score" class="star_input">
            </li>
          </ul>
          <ul>
            <li class="flex alc js">
              <p>사진</p>
            </li>
            <li class="img_input_area">
              
              </li>
            </ul>
            
            <div class="after_line"></div>
            
            <div class="flex alc">
              <button class="btn" style="width: 50%;">이전</button>
              <button class="btn" style="width: 50%;">다음</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="popup" id="review_popup" style="height: 846.55px;">
      <div class="form_area">
        <img src="resources/img/photo(13).jpg" class="form_img resImg" alt="form" title="form" style="object-fit: cover;">

        <div class="form_content">
          <div class="popup_title">
            <h2>후기등록</h2>
            <div class="popup_close close_popup">
              X
            </div>
          </div>
        
          <div class="after_line"></div>
        
          <form class="review_form">
            <ul>
              <li>이름<span class="red">*</span></li>
              <li><input type="text" class="input name_input" name="name"></li>
            </ul>
            <ul>
              <li>구매품<span class="red">*</span></li>
              <li><input type="text" class="input" name="product"></li>
            </ul>
            <ul>
              <li>구매처<span class="red">*</span></li>
              <li><input type="text" class="input" name="shop"></li>
            </ul>
            <ul>
              <li>구매일<span class="red">*</span></li>
              <li><input type="date" class="input" name="purchase-date"></li>
            </ul>
            <ul>
              <li class="flex alc js">
                <p>
                  내용<span class="red">*</span>
                </p>
                <p>총 <span class="cont_c color">0</span>자</p>
              </li>
              <li>
                <textarea name="contents" class="input" cols="30" rows="3" style="resize: none;" oninput="$(`.cont_c`).html(this.value.length.toLocaleString())"></textarea>
              </li>
            </ul>
            <ul>
              <li>별점<span class="red">*</span></li>
              <li>
                <div class="form_star flex alc">
                  <p>별점 : <span class="score_html">0</span>점</p>
                
                  <div class="star_div">
                    <p class="emp_star">☆☆☆☆☆</p>
                    <p class="fill_star" style="width: 0">★★★★★</p>
                  </div>
                </div>
                <input type="hidden" name="score" class="star_input">
              </li>
            </ul>
            <ul>
              <li class="flex alc js">
                <p>사진(1개 이상)<span class="red">*</span></p>
                <button type="button" class="btn" onclick="$(`.img_input_area`).append(`<input type='file' class='input file_input' name='photo[]'>`)">사진추가</button>
              </li>
              <li class="img_input_area">
                <input type="file" class="input file_input" name="photo[]">
              </li>
            </ul>
        
            <div class="after_line"></div>
            
            <div class="flex alc">
              <button type="button" class="btn" style="width: 50%;" onclick="Modal.close()">닫기</button>
              <button class="btn" style="width: 50%;">등록</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <footer>
    <p>Copyright (C) Gyeongsangbuk-do. All Rights Reserved.</p>
  </footer>

</body>
</html>