<div class="after_line wrap"></div>

<div class="modal">
      <div class="popup" id="detail_view">
        <div class="popup_title flex alc js">
          <h2>빵집 상세 정보</h2>
          <i class="fa fa-times-circle popup_close"></i>
        </div>

        <div class="after_line"></div>

        <div class="modal_content flex js">
          <!-- <div class="modal_left">
            <h3 class="color">[빵집 이미지]</h3>
            <div class="subImage_box flex">
              <img src="resources/image/서브이미지/sub_1.jpg" alt="">
              <img src="resources/image/서브이미지/sub_2.jpg" alt="">
              <img src="resources/image/서브이미지/sub_1.jpg" alt="">
              <img src="resources/image/서브이미지/sub_2.jpg" alt="">
            </div>
          </div>

          <div class="modal_right">
            <h3><span class="color">[빵집 이름]</span> 비건바닐라</h3>
            <h3><span class="color">[빵집 주소]</span> 대전광역시 대덕구 비래동 557-12</h3>
            <h3><span class="color">[영엽 시간]</span> 06:00 ~ 20:00</h3>
            <h3 style="font-size: 1rem;"><span class="color">[빵집 소개]</span> 건강한 빵을 위하여 오래 걸리더라도 열정을 담아 정성스럽게 만듭니다. 뚠뚠제과가 드리는 일상 속의 작은 행복, 누구나 일상 속의 담콤한을 누릴 자격이 있습니다.</h3>
          </div> -->
        </div>
      </div>

      <div class="popup" id="menuList">
        <div class="popup_title flex alc js">
          <h2>빵집 메뉴 리스트</h2>
          <i class="fa fa-times-circle popup_close"></i>
        </div>

        <div class="after_line"></div>

        <div class="modal_content modal_menu_list flex alc js">
            <!-- <div class="menuListItem flex" style="background: url('resources/image/메뉴/1.jpg') no-repeat; background-size: 100% 100%;">
              <div class="menu_item_info">
                <h3><span class="color">[메뉴 이름]</span> 딸기 머핀</h3>
                <p><span class="color">[메뉴 정보]</span> 상미종으로 느리게 발효하고 우유 풍미가 고스란히 담겨 진한 맛이 일품인 딸기 머핀</p>
                <p><span class="color">[가격]</span> 23,000</p>
                <p><span class="color">[알레르기 정보]</span> 밀,계란,우유,대두</p>
              </div>
            </div> -->
        </div>
      </div>

      <div class="popup" id="review_modify">
        <div class="popup_title flex alc js">
          <h2>리뷰 수정</h2>
          <i class="fa fa-times-circle popup_close"></i>
        </div>

        <div class="after_line"></div>

        <div class="moadl_content">
          <div class="review_enr">
            <form class="review_mod_form">
              <ul>
                <li><label>리뷰 제목</label></li>
                <li><input type="text" class="input" name="review_title"></li>
              </ul>
              <ul>
                <li><label>리뷰 콘텐츠</label></li>
                <li><textarea name="review_content" id="review_content" cols="130" rows="5"></textarea></li>
              </ul>
              <ul>
                <li><label>리뷰 이미지</label></li>
                <li><input type="file" class="input" name="review_img"></li>
              </ul>
              <input type="hidden" name="bakery_idx" value="${data.idx}">
              <button type="button" class="btn review_enr_btn" style="margin-top: 2rem;" onclick="ajax('../app/reviewEnr.php', '', 'review_mod_form', '수정이 완료되었습니다.')">리뷰 수정</button>
              <button type="button" class="btn review_enr_btn" style="margin-top: 2rem;" onclick="ajax('../app/reviewEnr.php', '', 'review_del_form', '삭제가 완료되었습니다.')">리뷰 삭제</button>
            </form>
          </div>
        </div>
      </div>
    </div>

  <footer>
    <div class="foo_section rap">
      <div class="foo_content flex alc js">
        <div class="foo_left">
          <h2>로고</h2>

          <div class="foo_inner">
            <p>
              대전 빵지순례 | Dajeon boulangerie<br>
              LOCATION: 대전광역시 중구 문화1동 165 | TEL: 042-580-9100<br>
              <br>
              Copyrightⓒ 2021, boulangerie all right reserved
            </p>
          </div>
        </div>

        <div class="foo_right flex alc">

          <div><img src="resources/icons/SNS/2.png" alt="snsicons" title="snsicons"></div>
          <div><img src="resources/icons/SNS/3.png" alt="snsicons" title="snsicons"></div>
          <div><img src="resources/icons/SNS/5.png" alt="snsicons" title="snsicons"></div>
          <div><img src="resources/icons/SNS/facebook.jpg" alt="snsicons" title="snsicons"></div>
        </div>
      </div>
    </div>
  </footer>

  </section>

</body>
</html>