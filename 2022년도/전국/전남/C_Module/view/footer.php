<div class="modal"></div>

<template>
  <div class="popup join_popup">
    <div class="popup_title">
      <h2>회원가입</h2>
      <div class="popup_close">
        <i class="fa fa-times-circle"></i>
      </div>
    </div>

    <div class="after_line opa"></div>

    <div class="popup_content">
      <form class="join_form">
        <ul>
          <li>이름</li>
          <li><input type="text" class="input" name="name"></li>
        </ul>
        <ul>
          <li class="flex alc js">
            <p>아이디 <br><span class="id_err"></span></p>
            <button class="btn" type="button" onclick="overlapCk($(`user_id`).val())" style="padding: .4rem 1.6rem;">중복확인</button>
          </li>
          <li>
            <input type="text" class="input user_id" name="id">
          </li>
        </ul>
        <ul>
          <li>비밀번호</li>
          <li><input type="password" class="input" name="pw"></li>
        </ul>
        <ul>
          <li>전화번호</li>
          <li><input type="text" class="input" name="phone"></li>
        </ul>
        <ul>
          <li>
            <p>캡챠</p>
            <canvas id="capt" width="180" height="80"></canvas>
          </li>
          <li>
            <input type="text" class="input cap_input" name="captcha">
          </li>
        </ul>
        <ul>
          <li>프로필 사진</li>
          <li><input type="file" class="input file_input" name="image"></li>
        </ul>
        <ul>
          <li>공연 분야</li>
          <li>
            <select name="category_id" class="input">
              <?php foreach ($category as $key => $v): ?>
                <option value="<?= $v['id'] ?>"><?= $v['category'] ?></option>
              <?php endforeach ?>
            </select>
          </li>
        </ul>

        <div class="after_line opa"></div>

        <button class="btn">가입하기</button>
      </form>
    </div>
  </div>

  <div class="popup login_popup">
    <div class="popup_title">
      <h2>회원가입</h2>
      <div class="popup_close">
        <i class="fa fa-times-circle"></i>
      </div>
    </div>

    <div class="after_line opa"></div>

    <div class="popup_content">
      <form class="login_form">
        <ul>
          <li>아이디</li>
          <li><input type="text" class="input" name="id"></li>
        </ul>
        <ul>
          <li>비밀번호</li>
          <li><input type="password" class="input" name="pw"></li>
        </ul>

        <div class="after_line opa"></div>

        <button class="btn">로그인</button>
      </form>
    </div>
  </div>

  <div class="popup schedule_popup">
    <div class="popup_title">
      <h2>버스킹 일정</h2>
      <div class="popup_close">
        <i class="fa fa-times-circle"></i>
      </div>
    </div>

    <div class="after_line opa"></div>

    <div class="popup_content" style="height: 600px; overflow-y:scroll;">
      
    </div>
  </div>

  <div class="popup busking_enr_popup">
    <div class="popup_title">
      <h2>버스커 모집</h2>
      <div class="popup_close">
        <i class="fa fa-times-circle"></i>
      </div>
    </div>

    <div class="after_line opa"></div>

    <div class="popup_content">
      <form class="busking_enr_form">
        <ul>
          <li>제목</li>
          <li><input type="text" class="input" name="title"></li>
        </ul>
        <ul>
          <li>내용</li>
          <li><input type="text" class="input" name="contents"></li>
        </ul>
        <ul>
          <li>모집인원</li>
          <li><input type="text" class="input num_input" name="personnel"></li>
        </ul>
        <ul>
          <li>분야</li>
          <li>
            <select class="input" name="category_id">
              <?php foreach ($category as $key => $v): ?>
                <option value="<?= $v['id'] ?>"><?= $v['category'] ?></option>
              <?php endforeach ?>  
            </select>
          </li>
        </ul>

        <div class="after_line opa"></div>
        <input type="hidden" name="page" value="<?= $page ?>">
        <input type="hidden" name="category" value="<?= $nowCate ?>">
        <button class="btn">모집하기</button>
      </form>
    </div>
  </div>
</template>

<div class="foo_ab">
  <div class="foo_ab_t">
    <h2>“</h2>
    <br>
    <p>
      아름다운 자연이 모인곳, <br>
      잘 가꾸어진 정원과 어우러지는 분위기, <br>
      색다른 볼거리가 있는 아름다운 장소, <br>
      이곳에 방문할 수 있어 좋았습니다.
    </p>
  </div>
  <img src="/resources/img/42.jpg" alt="foo" title="foo">
</div>

<footer>
  <div class="foo_rap">
    <div class="wrap">
      <div class="foo_top flex alc js">
        <div class="foo_menu flex alc">
          <div><a href="#">이용안내</a></div>
          <div><a href="#">개인정보 처리방침</a></div>
          <div><a href="#">저작권 보호정책</a></div>
          <div><a href="#">도로명 주소안내</a></div>
          <div><a href="#">사이트오류 신고</a></div>
        </div>

        <div class="foo_sns flex alc">
          <div><a href="#"><i class="fa fa-instagram"></i></a></div>
          <div><a href="#"><i class="fa fa-facebook-official"></i></a></div>
          <div><a href="#"><i class="fa fa-linkedin"></i></a></div>
          <div><a href="#"><i class="fa fa-twitter"></i></a></div>
        </div>
      </div>

      <div class="foo_bot">
        <div class="logo flex">
          <a href="#">
            <img src="/resources/logo.png" alt="logo" title="logo">
          </a>
        </div>
        <br>
        <p class="copy">
          전라남도 여수시 여문2로 148 <br>
          COPYRIGHT ⓒ 2022 YEOSU INFORMATION SCIENCE <br> HIGH SCHOOL WEB DESIGN AND DEVELOPMENT CLUB ALL RIGHTS RESERVED.
        </p>
      </div>
    </div>
  </div>
</footer>

</body>
</html>