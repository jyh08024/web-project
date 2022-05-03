  <div class="section"></div>

  <div class="section wrap">
    <div class="section_title">
      <div>
        <div class="title_block"></div>
        <h4>회원가입</h4>
      </div>
      <p>와일드 푸드 회원가입</p>
    </div>

    <div class="after_line"></div>

    <div class="section_content flex alc jc">
      <form class="join_form forms" action="/post/join" method="POST" style="width: 70%;">
        <ul>
          <li>이름</li>
          <li><input type="text" class="input" name="user_name"></li>
        </ul>
        <ul>
          <li>전화번호</li>
          <li><input type="text" class="input" name="user_call"></li>
        </ul>
        <ul>
          <li>우편번호</li>
          <li><input type="text" class="input" name="user_code"></li>
        </ul>
        <ul>
          <li>주소</li>
          <li><input type="text" class="input" name="user_ad"></li>
        </ul>
        <ul>
          <li>상세 주소</li>
          <li><input type="text" class="input" name="user_detail_ad"></li>
        </ul>
        <ul>
          <li>아이디</li>
          <li><input type="text" class="input" name="user_id"></li>
        </ul>
        <ul>
          <li>비밀번호</li>
          <li><input type="password" class="input" name="user_pass"></li>
        </ul>
        <ul>
          <li>비밀번호 확인</li>
          <li><input type="password" class="input" name="user_pass_ck"></li>
        </ul>
        <ul>
          <li>회원타입</li>
          <li>
            <label for="nor_val">일반회원</label>
            <input type="radio" name="user_type" id="nor_val" value="normal" checked="">
            <label for="con_val">컨슈머회원</label>
            <input type="radio" name="user_type" id="con_val" value="consumer">
          </li>
        </ul>

        <div class="after_line"></div>

        <button class="btn">회원가입</button>
      </form>
    </div>
  </div>