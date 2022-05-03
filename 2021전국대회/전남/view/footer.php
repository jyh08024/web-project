	<div class="modal">
		<div class="popup" id="map_popup" style="width: 770px;">
			<div class="popup_title">
				<h2>지도보기</h2>

					<div class="now_mag">
						<i class="fa fa-arrows-alt" style="transform: rotate(45deg); cursor: pointer;"></i>
						<i class="fa fa-search"></i>
						<p class="now_mag_c">100%</p>
					</div>
	
				<div class="popup_close">
					<i class="fa fa-times-circle"></i>
				</div>
			</div>
	
			<div class="after_line"></div>
	
			<div class="map_div">
				<canvas id="map_cv" width="700" height="700"></canvas>
			</div>
		</div>

		<div class="popup" id="make_stamp" style="width: 800px;">
      <div class="popup_title">
        <h2>스탬프 카드 발급</h2>

        <div class="popup_close">
          <i class="fa fa-times-circle"></i>
        </div>
      </div>

      <div class="after_line"></div>

      <input type="text" class="input card_name" placeholder="스탬프 카드의 이름을 입력해주세요.">

      <div class="after_line"></div>

      <div class="show_more download">
        <p>다운로드</p>
        <i class="fa fa-angle-right"></i>
      </div>
    </div>

    <div class="popup" id="stamp_get" style="width: 800px;">
      <div class="popup_title">
        <h2>스탬프 찍기</h2>
    
        <div class="popup_close">
          <i class="fa fa-times-circle"></i>
        </div>
      </div>
    
      <div class="after_line"></div>
    
      <input type="file" class="input sel_coupon" data-type="stamp">
    </div>

    <div class="popup" id="sale_popup" style="width: 700px">
    	<div class="popup_title">
        <h2>할인 모달</h2>
    
        <div class="popup_close">
          <i class="fa fa-times-circle"></i>
        </div>
      </div>
    
      <div class="after_line"></div>

      <form class="sale_form">
      	<ul>
      		<li>할인율</li>
      		<li><input type="number" name="sale" class="input val_input" min="0" max="99" required=""></li>
      	</ul>

      	<input type="hidden" name="bread_id" class="id_input">
      	<div class="after_line"></div>

      	<button class="show_more">
      		<p>할인</p>
      		<i class="fa fa-angle-right"></i>
      	</button>
      </form>
    </div>

    <div class="popup" id="review_popup" style="width: 700px;">
    	<div class="popup_title">
        <h2>리뷰 모달</h2>
    
        <div class="popup_close">
          <i class="fa fa-times-circle"></i>
        </div>
      </div>
    
      <div class="after_line"></div>

      <form class="rev_form">
      	<ul>
      		<li>제목</li>
      		<li><input type="text" name="title" class="input" required=""></li>
      	</ul>
      	<ul>
      		<li>내용</li>
      		<li><textarea type="text" name="contents" class="input" required="" style="resize: none"></textarea></li>
      	</ul>
      	<ul>
      		<li>이미지</li>
      		<li><input type="file" name="image" class="input"></li>
      	</ul>

      	<input type="hidden" name="store_id" class="id_input">
      	<div class="after_line"></div>

      	<button class="show_more">
      		<p>등록</p>
      		<i class="fa fa-angle-right"></i>
      	</button>
      </form>
    </div>

    <div class="popup" id="score_popup" style="width: 700px;">
    	<div class="popup_title">
        <h2>평점 모달</h2>
    
        <div class="popup_close">
          <i class="fa fa-times-circle"></i>
        </div>
      </div>
    
      <div class="after_line"></div>

      <form class="score_form">
      	<ul>
      		<li>평점</li>
      		<li>
      			<select name="score" class="input" required="">
      				<option value="1" selected="">1점</option>
      				<option value="2">2점</option>
      				<option value="3">3점</option>
      				<option value="4">4점</option>
      				<option value="5">5점</option>
      			</select>
      		</li>
      	</ul>

      	<input type="hidden" name="store_id" class="id_input">
      	<div class="after_line"></div>

      	<button class="show_more">
      		<p>평점 주기</p>
      		<i class="fa fa-angle-right"></i>
      	</button>
      </form>
    </div>
	</div>

	<footer>
		<div class="foo_rap rap">
			<div class="foo_top flex alc js">
				<div class="logo">
					<a href="/">
						<img src="/logo3.png" alt="logo" title="logo">
					</a>
				</div>

				<div class="foo_menu flex alc">
					<a href="#">이용안내</a>
					<a href="#">개인정보 처리방침</a>
					<a href="#">저작권 보호정책</a>
					<a href="#">도로명 주소안내</a>
					<a href="#">사이트오류 신고</a>
				</div>
			</div>

			<div class="foo_bottom flex alc js">
				<h4 class="copy">
					전라남도 여수시 여문2로 148 <br>
					COPYRIGHTⓒ 2021 Daejeon Bakery Merchants Association
				</h4>

				<div class="sns_icons flex alc ">
					<div><i class="fa fa-instagram"></i></div>
					<div><i class="fa fa-facebook-square"></i></div>
					<div><i class="fa fa-twitter"></i></div>
					<div><i class="fa fa-google-plus-square"></i></div>
				</div>
			</div>
		</div>
	</footer>
    
</body>
</html>