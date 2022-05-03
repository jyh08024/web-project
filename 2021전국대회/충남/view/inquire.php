<div class="section">
	<div class="wrap">
		<div class="section_title flex alc js">
      <div>
        <h1 class="main_title white">조회하기</h1>
        <h1 class="back_title">조회하기</h1>
      </div>
    </div>

    <div class="search_condition">
    	<h2>검색조건</h2>
    	
    	<div class="search_box">
    		<form action="/post/search" method="POST" class="search_type_form flex alc js">
		    	<select name="search_type" class="search_type input" onchange="changeCon()">
		    		<option value="all">전체보기</option>
		    		<option value="res_baker">예약건이 있는 빵집</option>
		    		<option value="menu_search">상품명</option>
		    		<option value="visit_time">방문예정날짜(시작일, 종료일)</option>
		    	</select>

		    	<div class="search_input" style="width: 70%;">

		    	</div>

		    	<button class="btn">검색하기</button>
    		</form>
    	</div>

    	<div class="after_line"></div>
    	<div class="area_title">
    		<h2>예약목록</h2>
    	</div>

  		<?php foreach ($order as $key => $v): ?>
    	<div class="reserve_list">

    			<?php foreach ($v['order_menu'] as $key => $menu): ?>

    				<?php if (!$menu['baker_name']): ?>
    					<?php continue; ?>
    				<?php endif ?>

	    		<div class="res_item">
	    			<div class="order_baker">
	    				<h3><?= $menu['baker_name'] ?></h3>
	    			</div>

	    			<div class="res_item_content flex alc">
		    			<div class="res_item_img">
		    				<img src="/resources/빵메뉴/<?= $menu['image'] ?>" alt="baker_img" title="baker_img">
		    			</div>

		    			<div class="res_content">
		    				<div class="item_req flex alc">
			    				<h4><?= $menu['keep'] ?></h4>
			    				<h4><?= $menu['shelf'] ?></h4>
		    				</div>

		    				<h3><span class="color">[상품명]</span> <?= $menu['menuname'] ?></h3>
		    				<h4><span class="color">[수량]</span> <?= $menu['count'] ?>개</h4>
		    				<h4><span class="color">[이름]</span> <?= USER['user_name'] ?></h4>
		    				<h4><span class="color">[연락처]</span> <?= USER['user_call'] ?></h4>
		    				<h4><span class="color">[방문예정시간]</span> <?= $v['visit_date'] ?> <?= $v['visit_time'] ?></h4>
		    				<h4><span class="color">[예약등록일시]</span> <?= $v['enr_time'] ?></h4>
		    			</div>

		    			<div class="after_line"></div>

		    			<div class="res_content_bot">
		    				<div class="flex alc js">
		    					<h4>가격</h4>
		    					<h4><?= number_format($menu['price']) ?>원</h4>
		    				</div>
		    				<div class="flex alc js">
		    					<h3>총 주문가격</h3>
		    					<h3><span class="color"><?= number_format($menu['subtotal']) ?>원</span></h3>
		    				</div>
		    				<div class="flex alc js">
		    					<?php if ($v['visit_date']." ".$v['visit_time'] > date('Y-m-d H:i')): ?>
			    					<a href="/remove/order/<?= $menu['cart_idx'] ?>" class="btn">예약취소</a>
		    					<?php else: ?>
			    					<button class="btn" disabled style='opacity: .7;'>예약취소</button>
			    				<?php endif ?>
		    					<button class="btn" <?= $menu['is_review'] == "true" ? "disabled style='opacity: .7;'" : "" ?> onclick="openRevModal(this)" data-idx="<?= $v['idx'] ?>">후기작성</button>
		    				</div>
		    			</div>
	    			</div>
	    		</div>

    			<?php endforeach ?>
    	</div>

    	<div class="after_line" style="margin-top: 3rem; margin-bottom: 3rem;"></div>
    		<?php endforeach ?>
    </div>


	</div>
</div>

<?php 
	$bakerList = [];
	$orderJson = json_encode($order);
 ?>

<?php foreach ($order as $key => $v): ?>
	<?php $bakerList = $v['baker_list'] ?>
<?php endforeach ?>

<?php $bakerList = json_encode($bakerList); ?>

<script>
	function changeCon() {
		const val = $(`.search_type`).val();
		let html = "";

		switch (val) {
	    case "res_baker":
				const bakerList = [...new Set(JSON.parse('<?= $bakerList ?>'))];
				const sel = $(`<select name="baker_sel" class="sel_order_baker input" style="width: 100%;"></select>`);

				bakerList.map(v => {
					sel.append(`<option value="${v}">${v}</option>`);
				});

				html = sel;
	      break;

  		case "menu_search":
	      html = $(`<input type="text" class="input" name="search_key" placeholder="메뉴명을 입력해주세요." style="width: 100%;" required>`);
	      break;

      case "visit_time":
	    	html = `<input type="date" name="start_date" class="input" style="width: 50%;" min="<?= date('Y-m-d') ?>" onchange="dateCk(this)" required><input type="date" name="end_date" class="input" style="width: 50%;" min="<?= date('Y-m-d') ?>" required>`;
	      break;

      case "all":
      	html = "<h2 class='color tlc'>전체보기</h2>"
      	break;
	  }

	  $(`.search_input`).html(html);
	}

	changeCon();

	function dateCk(t) {
		const val = $(t).val();

		$(`.search_input`)
			.find('input[name="end_date"]')
			.val('')
			.attr('min', val);
	}

	function openRevModal(target) {
		const orderIdx = $(target).data('idx');
		const data = JSON.parse('<?= $orderJson ?>').find(v => v.idx == orderIdx);

		Modal.open('review_modal');
		$(`.review_form`).html(data.order_menu.map(v => reviewForm(v)));

		const btnHtml = `
			<button class="btn">후기등록</button>
		`;

		$(`.review_form`).append(btnHtml);
		$(`.review_form`).append(`<input type="hidden" name="order_idx" value="${data.idx}">`);
		$(`.star_on`).css('width', `${$(`.star_change`).val() * 10}%`);
	}

	function reviewForm(data) {
    return `
          <div class="review_popup_con">
            
            <div class="review_form_inner">
              <div class="order_menu_info flex alc">
                <div class="order_bread_img">
                  <img src="/resources/빵메뉴/${data.image}" alt="bread" title="bread">
                </div>

                <div class="order_bread_info">
                  <h2><span class="color">[구매한 빵집]</span> - ${data.baker_name}</h2>
                  <h3><span class="color">[상품명]</span> - ${data.menuname}</h3>
                  <h3><span class="color">[가격]</span> - ${(data.price * 1).toLocaleString()}원</h3>
                  <h3><span class="color">[구매개수]</span> - ${data.count}개</h3>
                  <h3><span class="color">[총합계]</span> - ${(data.subtotal * 1).toLocaleString()}원</h3>
                </div>
              </div>
              <div class="after_line"></div>

              <div class="review_input flex alc js">
                <input type="text" class="input" name="review_content[]" placeholder="후기 내용을 입력해주세요" required>
                <input type="hidden" name="target_cart[]" value="${data.cart_idx}">
                <div class="starts"> 
                  <span class="star_change_star">
                    ☆☆☆☆☆
                    <span class="star_on">★★★★★</span>
                    <input type="range" class="star_change" name="rev_grade[]" min="1" max="10" step="1" value="1" required>
                  </span>
                </div>
              </div>

              <div class="after_line"></div>
            </div>
          </div>
    `
  }
</script>