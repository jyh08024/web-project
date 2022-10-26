  <div class="pano_view flex alc jc">
    <div class="now_pano_info">
      <div class="tlc">
        <h2>파노라마</h2>
        <button class="btn view_move">시점이동</button>
        <button class="btn close_pano">닫기</button>
      </div>
    </div>
    
    <div class="cube_wrap cube_wrap1 now_cube">
      <div class="cube">
        <div class="view front"></div>
        <div class="view right"></div>
        <div class="view back"></div>
        <div class="view left"></div>
        <div class="view top"></div>
        <div class="view bottom"></div>
      </div>
    </div>

    <div class="cube_wrap cube_wrap2">
      <div class="cube">
        <div class="view front"></div>
        <div class="view right"></div>
        <div class="view back"></div>
        <div class="view left"></div>
        <div class="view top"></div>
        <div class="view bottom"></div>
      </div>
    </div>
  </div>

  <div class="modal"></div>

  <template>
    <div class="popup rev_popup">
      <div class="popup_title">
        <h2>후기 작성</h2>
        <div class="popup_close">
          <i class="fa fa-times-circle"></i>
        </div>
      </div>  

      <div class="after_line opa1"></div>

      <div class="popup_content">
        <form class="review_form">
          <ul>
            <li>내용</li>
            <li><input type="text" class="input" name="content"></li>
          </ul>
          <ul>
            <li>별점</li>
            <li>
              <div class="star drag_star">
                <p class="full_star" style="width: 0">★★★★★</p>
                <p class="emp_star">☆☆☆☆☆</p>
              </div>
              <h3 class="star_sc">0점</h3>
              <input type="hidden" class="star_input" name="star">
            </li>
          </ul>
          <ul>
            <li>사진</li>
            <li><input type="file" name="image" class="input rev_img" multiple></li>
          </ul>
          <ul>
            <li>태그목록</li>
            <li class="sub_list_tag">
                
            </li>
          </ul>

          <input type="hidden" name="res" class="res_idx_input">
          <input type="hidden" name="garden" class="garden_input">

          <div class="after_line"></div>

          <button class="btn">등록</button>
        </form>
      </div>
    </div>
  </template>

  <div class="section" style="padding-top: 20rem;"></div>
  <footer class="section">
    <div class="wrap foo_s flex js">
      <div><h1>경남민간정원</h1></div>

      <div class="foo_menu">
        <h2 class="foo_t">메뉴</h2>
        <p><a href="#">개인정보 처리방침</a></p>
        <p><a href="#">이용안내</a></p>
        <p><a href="#">고객센터</a></p>
        <p><a href="#">저작권정보</a></p>
      </div>
      <div>
        <h2 class="foo_t">Copyright</h2>
        <p>Copyright (c) 2021 ~ 2022 Gyeongnam Garden. All rights reserved.</p>
      </div>
      <div>
        <h2 class="foo_t">Help</h2>
        <p>Call: (055) 126-0021 <br>
          Email: help@gyeongnam.garden <br>
          Address: 경남 함양군 서성면 가르내길 202-1 (우 50002) <br></p>
      </div>
    </div>
  </footer>
  
</body>
</html>