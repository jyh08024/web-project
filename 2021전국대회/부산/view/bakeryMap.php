    <div class="sub_page_visual">
      <div class="sub_page_title flex alc wrap">
        <h1>대전 빵지도</h1>
      </div>
    </div>

    <div class="sub_section section wrap bakery_map_section">
      <div class="map_section_inner flex js">

        <div class="bakery_map">
          <div class="pin_info"></div>
          <img src="resources/map/map.svg" alt="map" title="map">
        </div>

        <div class="map_button">
          <div>
            <?php if ($userStore): ?>
            <button class="btn" onclick="Modal.open('store_enr')">매장등록</button>
            <button class="btn" onclick="BakeryMap.download(this)" data-type="json">JSON 다운로드</button>
            <?php endif ?>
            <button class="btn" onclick="BakeryMap.download(this)" data-type="graph">그래프 다운로드</button>
          </div>
        </div>
      </div>
    </div>  

    <!-- <canvas id="cv" width="800" height="800"></canvas> -->

    <div class="modal">
      <div class="popup" id="map_baker">
        <div class="popup_title flex alc js">
          <h2>매장 정보</h2>

          <div class="popup_close">X</div>
        </div>
        
        <div class="after_line"></div>

        <div class="popup_content popup_bakery">

        </div>
      </div>

      <div class="popup" id="store_enr">
        <div class="popup_title flex alc js">
          <h2>매장 등록</h2>
      
          <div class="popup_close">X</div>
        </div>
      
        <div class="after_line"></div>
      
        <div class="popup_content">
          <div class="baker_enr_form">
            <ul class="baker_input">
              <li><label for="">관리자 아이디</label></li>
              <li><input type="text" class="input" name="admin_id"></li>
              <li><label for="">매장이름</label></li>
              <li><input type="text" class="input" name="name"></li>
              <li><label for="">매장 대표 이미지</label></li>
              <li>
                <select name="image" id="bakery_img" class="input">

                </select>
              </li>
              <li><label for="">매장 위치</label></li>
              <li class="shop_loc"><img src="resources/map/map.svg" alt="map" title="map"></li>
              <li>
                <input type="hidden" name="x">
                <input type="hidden" name="y">
              </li>
              <li><label for="">매장 소개글</label></li>
              <li><input type="text" class="input" name="contents"></li>
              <li><label for="">판매중인 빵</label></li>
              <li class="sale_Bread flex alc js">
                <!-- <div>
                  <input type="checkbox" value="" id="bread_id" name="items">
                  <label for="bread_id">1번 빵</label>
                </div> -->
              </li>
            </ul>
          </div>

          <div class="after_line"></div>

          <button class="btn popup_close">취소</button><button class="btn baker_enr" onclick="BakeryMap.bakerEnr()">등록</button>
        </div>
      </div>
    </div>

