  <div class="emp_box"></div>
  
  <div class="page_title rap flex alc jc">
    <h1>주문 페이지 - <?= $baker['name'] ?></h1>
    <img src="/resources/img/7.jpg" alt="back" title="back">
  </div>

  <div class="rap section_inner">
  	<div class="section">
  		<div class="section_title">
	      <div>
	        <div class="title_block"></div>
	        <h4>리뷰 영역</h4>
	      </div>
	      <p>현재 빵집의 리뷰를 확인 할 수 있습니다.</p>
	    </div>

	    <div class="after_line"></div>

	    <div class="review_list">
	    	<?php if (@count($board)): ?>
	    		
	    		<?php foreach ($board[$now -1][$page - 1] as $key => $v): ?>
	    			
	    	<div class="review_line flex alc js">
	    		<div class="review_area">
	    			<div class="review_img">
	    				<?php if (!$v['image']): ?>
	    					<h2>No image</h2>
	    					<?php else: ?>
	    				<img src="<?= $v['image'] ?>" alt="review" title="review">
	    				<?php endif ?>
	    			</div>

	    			<div class="review_content" style="width: 100%;">
	    				<h4><span class="color">[공감 개수] <i class="fa fa-heart"></i></span> <?= $v['likes'] ?>개</h4>
	    				<h4><span class="color">[제목]</span><?= $v['title'] ?></h4>
	    				<h4><span class="color">[내용]</span></h4>
	    				<div class="rev_cont" style="height: 3rem; overflow-y: scroll; font-size: .9rem;">
	    					<?= $v['contents'] ?>
	    				</div>
	    				<h4><span class="color">[작성자이름 / 작성일]</span> <?= $v['name'] ?> / <?= $v['write_at'] ?></h4>
	    				<div class="flex alc">
		    				<h4><span class="color">[공감 버튼]</span></h4>
		    				<form action="/post/like/<?= $v['rev_id'] ?>" method="POST">
			    				<button class="show_more">
			    					<p>공감</p>
			    					<i class="fa fa-angle-right"></i>
			    				</button>
		    				</form>
	    				</div>
	    				<?php if (USER['id'] == $baker['user_id']): ?>
		    				<h4><span class="color">[답글]</span></h4>
		    				<form action="/post/reple/<?= $v['rev_id'] ?>" method="POST" class="flex alc js">
		    					<input type="text" class="input" name="contents" style="width: 60%" required>
		    					<button class="show_more">
		    						<p>답글</p>
		    						<i class="fa fa-angle-right"></i>
		    					</button>
		    				</form>
	    				<?php endif ?>
	    			</div>
	    		</div>

	    		<div class="reple_area">
    				<h2><span class="color">[답글]</span></h2>

	    			<?php foreach ($v['reple'] as $key => $val): ?>
	    				<div class="reple_line">
	    					<div class="reple_owner flex alc">
		    					<div class="reple_user flex alc jc">
		    						<i class="fa fa-user"></i>
		    					</div>
		    					<h2><?= $baker['owner']['name'] ?></h2>
	    					</div>

	    					<div class="reple_info flex alc">
	    						<h4 class="color">[내용]</h4>
		    					<p><?= $val['contents'] ?></p>
	    					</div>
	    				</div>
	    			<?php endforeach ?>
	    		</div>
	    	</div>

	    		<?php endforeach ?>
	    	<?php endif ?>
	    </div>

	    <div class="page_btn">
	    	<?php if (count($block)): ?>
	        <?php foreach ($board[$now - 1] as $key => $v): ?>
	          <a href="/order/<?= $id ?>//<?= $key + 1 ?>" class="page_btn <?= $page == $key + 1 ? "now_page" : "" ?>"><?= $key + 1 ?></a>
	        <?php endforeach ?>
	      <?php endif ?>
	    </div>
  	</div>

  	<div class="section">
  		<div class="section_title">
	      <div>
	        <div class="title_block"></div>
	        <h4>주문 영역</h4>
	      </div>
	      <p>현재 빵집의 메뉴를 확인, 주문할 수 있습니다.</p>
	    </div>

	    <div class="after_line"></div>

			<div class="order_btn flex alc js" onclick="orderPost(<?= $baker['id'] ?>)">
    		<p>주문하기</p>
    		<i class="fa fa-angle-right bold" style="margin-left: .5rem;"></i>
    	</div> 

	    <table class="order_table">
    		<thead>
    			<tr>
    				<?php foreach ($_SESSION['label']['order'] as $key => $v): ?>
	    				<th><?= $v ?></th>
    				<?php endforeach ?>
    			</tr>
    		</thead>

    		<tbody>
    			<?php foreach ($baker['menu'] as $key => $v): ?>
    				<tr>
    					<td><?= $v['name'] ?></td>
    					<td><img src="<?= $v['image'] ?>" alt="bread" title="bread" class="menu_img"></td>
    					<td><?= number_format($v['price']) ?>원</td>
    					<td class="sale_per" data-id="<?= $v['id'] ?>" data-sale="<?= $v['sale'] ?>">
    						<?php if ($v['sale'] > 0): ?>
	    						<?= $v['sale'] ?>%
    						<?php endif ?>
    					</td>
    					<td class="sale_price" data-id="<?= $v['id'] ?>" data-price="<?= round($v['price'] * ((100 - $v['sale']) / 100)) ?>">
								<?php if ($v['sale'] > 0): ?>
	    						<?= number_format(round($v['price'] * ((100 - $v['sale']) / 100))) ?>원
    						<?php endif ?>    						
    					</td>
    					<td style="width: 40%"><input type="number" class="input menu_count" name="price" style="height: 30%; width: 50%;" data-price="<?= $v['sale'] > 0 ? round($v['price'] * ((100 - $v['sale']) / 100)) : $v['price'] ?>" data-bread="<?= $v['id'] ?>" <?= $id2 == $v['id'] ? "value=1" : "" ?>></td>
    				</tr>
    			<?php endforeach ?>
    		</tbody>
    	</table>
  	</div>

  	<div>
  		<div class="section_title">
	      <div>
	        <div class="title_block"></div>
	        <h4>예약 영역</h4>
	      </div>
	      <p>현재 빵집에 방문 예약할 수 있습니다.</p>
	    </div>

	    <div class="after_line"></div>

	    <form action="/post/reserve/<?= $baker['id'] ?>" method="POST">
	    	<ul>
	    		<li>날짜</li>
	    		<li><input type="date" class="input" name="date" min="<?= date("Y-m-d") ?>"></li>
	    	</ul>
	    	<ul>
	    		<li>시간</li>
	    		<li><input type="time" class="input" name="time"></li>
	    	</ul>

	    	<div class="after_line"></div>

	    	<button class="show_more">
	    		<p>예약하기</p>
	    		<i class="fa fa-angle-right"></i>
	    	</button>
	    </form>
  	</div>
  </div>

  <script>
  	function priceLoad() {
  		$.post(`/load/price/<?= $baker['id'] ?>`).done((res) => {
  			res.forEach((v, i) => {
  				const sale = $(`.sale_per[data-id="${v.id}"]`)[0].dataset.sale;
  				
  				if (sale == v.sale) {
  					return;
  				}

  				$(`.sale_per[data-id="${v.id}"]`).html(v.sale + "%");
  				$(`.sale_per[data-id="${v.id}"]`)[0].dataset.sale = v.sale;

  				$(`.sale_price[data-id="${v.id}"]`).html(Math.round(v.price * ((100 - v.sale) / 100)).toLocaleString());
  				$(`.sale_price[data-id="${v.id}"]`)[0].dataset.price = Math.round(v.price * ((100 - v.sale) / 100));
  			})
  		})
  	}

  	setInterval(() => {
  		priceLoad();
  	}, 500)	
  </script>