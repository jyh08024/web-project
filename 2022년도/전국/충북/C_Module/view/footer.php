  
  <div class="modal"></div>

  <template>
    <div class="popup invest_popup">
      <div class="popup_title">
        <h2>투자계약서 작성</h2>
        <div class="popup_close">
          <i class="fa fa-times-circle"></i>
        </div>
      </div>

      <div class="after_line"></div>

      <div class="popup_content">
        <form class="invest_sign">
          <ul>
            <li>투자번호</li>
            <li><input type="text" class="input inv_in" name="inv_num" readonly></li>
          </ul>
          <ul>
            <li>청년작가명</li>
            <li><input type="text" class="input art_in" name="artist_name" readonly></li>
          </ul>
          <ul>
            <li>투자자명</li>
            <li><input type="text" class="input" name="invester_name"></li>
          </ul>
          <ul>
            <li>투자금액</li>
            <li><input type="text" class="input val_in" name="invest_val"></li>
          </ul>
          <ul>
            <li>서명란</li>
            <li>
              <canvas id="sign" width="200" height="150" style="border: 1px solid rgba(0, 0, 0, .1)"></canvas>
              <input type="hidden" class="sign_ck">
            </li>
          </ul>
          
          <input type="hidden" name="inv_id">
          <div class="after_line"></div>
          
          <button class="btn">제출하기</button>
        </form>
      </div>
    </div>

    <div class="popup art_mod_popup">
      <div class="popup_title">
        <h2>작품수정</h2>
        <div class="popup_close">
          <i class="fa fa-times-circle"></i>
        </div>
      </div>

      <div class="after_line"></div>

      <div class="popup_content">
        <form class="mod_form">
          <ul>
            <li>작품종류</li>
            <li>
              <select class="input" name="type">
                <?php foreach ($cateList as $key => $v): ?>
                  <option value="<?= $v['type'] ?>"><?= $v['type'] ?></option>
                <?php endforeach ?>
              </select>
            </li>
          </ul>
          <ul>
            <li>작가명</li>
            <li><input type="text" class="input" name="name"></li>
          </ul>
          <ul>
            <li>작품이름</li>
            <li><input type="text" class="input" name="art_name"></li>
          </ul>
          <ul>
            <li>판매가격</li>
            <li><input type="text" class="input" name="price"></li>
          </ul>
          <ul>
            <li>작품소개</li>
            <li><input type="text" class="input" name="description"></li>
          </ul>
          <ul>
            <li>작품사진</li>
            <li><input type="file" class="input" name="image"></li>
          </ul>

          <div class="after_line"></div>

          <input type="hidden" name="idx">

          <button class="btn">작품등록</button>
        </form>
      </div>
    </div>
  </template>

  <div class="layer_popup login_popup">
    <div class="popup_title">
      <h2>로그인</h2>
      <label for="login_layer" class="popup_close"><i class="fa fa-times-circle"></i></label>
    </div>

    <div class="after_line"></div>

    <form class="login_form">
      <ul>
        <li>아이디</li>
        <li><input type="text" class="input" name="id"></li>
      </ul>
      <ul>
        <li>암호</li>
        <li><input type="password" class="input" name="password"></li>
      </ul>

      <div class="after_line"></div>

      <button class="btn">로그인</button>
    </form>
  </div>
</body>
</html>