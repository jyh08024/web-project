  
  <div class="worldcup_section sub_section section wrap">
    <!-- <div class="worldcup_winner">

      <div class="winner_prize flex">
        <div class="winner_img">
          <img src="resources/bread/523101.jpg" alt="winner" title="winner">
        </div>
        
        <div class="winner_info">
          <h1>소보로빵</h1>
          <p>표면에 오돌토돌한 달콤한 쿠쿠</p>
        </div>
      </div>

      <div class="winner_other">
        <h1>판매중인 매장</h1>

        <div class="other_info">
          <div class="other_item">
            <div class="other_item_img">
              <img src="resources/store/99-1.jpg" alt="other" title="other">
            </div>

            <h1 class="tlc">어디어디</h1>
          </div>
        </div>
      </div>
    </div> -->

    <div class="_worldcup">

      <div class="now_round tlc">
        <h1></h1>
        <!-- <div class="tor_ta"></div> -->
      </div>

      <!-- <div class="tor_table">
        <div class="flex alc jc">
          <div class="tor_round">
            <div></div>
            <div></div>
          </div>
          <div class="tor_round">
            <div></div>
            <div></div>
          </div>
          <div class="tor_round">
            <div></div>
            <div></div>
          </div>
          <div class="tor_round">
            <div></div>
            <div></div>
          </div>
          <div class="tor_round">
            <div></div>
            <div></div>
          </div>
          <div class="tor_round">
            <div></div>
            <div></div>
          </div>
          <div class="tor_round">
            <div></div>
            <div></div>
          </div>
          <div class="tor_round">
            <div></div>
            <div></div>
          </div>
          <div class="tor_round">
            <div></div>
            <div></div>
          </div>
          <div class="tor_round">
            <div></div>
            <div></div>
          </div>
          <div class="tor_round">
            <div></div>
            <div></div>
          </div>
          <div class="tor_round">
            <div></div>
            <div></div>
          </div>
          <div class="tor_round">
            <div></div>
            <div></div>
          </div>
          <div class="tor_round">
            <div></div>
            <div></div>
          </div>
          <div class="tor_round">
            <div></div>
            <div></div>
          </div>
          <div class="tor_round">
            <div></div>
            <div></div>
          </div>
          <div class="tor_round">
            <div></div>
            <div></div>
          </div>
          <div class="tor_round">
            <div></div>
            <div></div>
          </div>
        </div>
      </div> -->
        
      <div class="worldcup_list flex alc js">

        <!-- <div class="worldcup_item">
          <div class="worldcup_img">
            <img src="resources/bread/523101.jpg" alt="pick" title="pick">
          </div>

          <div class="worldcup_text">
            <h2>ㅁㄴㅇㅁㄴㅇ</h2>
          </div>
        </div>
        
        <div class="worldcup_item">
          <div class="worldcup_img">
            <img src="resources/bread/523101.jpg" alt="pick" title="pick">
          </div>

          <div class="worldcup_text">
            <h2>ㅁㄴㅇㅁㄴㅇ</h2>
          </div>
        </div> -->

      </div>
      
    </div>
  </div>

  <div class="modal">
    <div class="popup" id="setpick">
      <div class="popup_title">
        <h2>진행할 빵드컵</h2>
      </div>

      <div class="after_line"></div>

      <div class="popup_content">
        <h3>진행할 빵드컵</h3>
        <div class="worldcup_type flex alc jc">
          <div>
            <label for="baker_worldcup">매장</label>
            <input type="radio" name="pick_type" id="baker_worldcup" checked data-type="store">
          </div>
          <div>
            <label for="bread_worldcup">빵</label>
            <input type="radio" name="pick_type" id="bread_worldcup" data-type="bread">
          </div>
        </div>

        <h3>후보 개수</h3>
        <div class="count_length">
          <select name="candid" id="candid_length" class="input" style="width: 100%;" onchange="WorldCup.setPick($(`input[name='pick_type']:checked`).data('type'), 1)">
            <option value="2">2개</option>
          </select>
        </div>
      </div>

      <div class="after_line"></div>

      <button class="btn start_worldcup">시작</button>
    </div>
  </div>

