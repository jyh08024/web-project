<div class="emp_box"></div>

  <div class="page_title rap flex alc jc">
    <h1>마이 페이지 - <?= USER['name'] ?></h1>
    <img src="/resources/img/7.jpg" alt="back" title="back">
  </div>

  <div class="rap section_inner">

  	<?php if (USER['type'] == "rider"): ?>
  	<div class="order_div">
  		<div class="section_title">
	  		<div>
	  			<div class="title_block"></div>
	  			<h4>마이 페이지 - 내 정보 영역</h4>
	  		</div>	
	  		<p>회원님의 현재 정보를 확인할 수 있습니다.</p>
	  	</div>

	  	<div class="after_line"></div>

	  	<form action="/post/userInfo" method="POST">
	  		<ul>
	  			<li>내 위치</li>
	  			<li>
	  				<select name="location_id" id="" class="input">
	  					<?php foreach ($location as $key => $v): ?>
	  						<option value="<?= $v['id'] ?>" <?= USER['location_id'] == $v['id'] ? "selected" : "" ?>><?= $v['borough'] ?> <?= $v['name'] ?></option>
	  					<?php endforeach ?>
	  				</select>
	  			</li>
	  		</ul>

	  		<ul>
	  			<li>내 교통수단</li>
	  			<li>
	  				<select name="transportation" class="input">
	  					<option value="motorcycle" <?= USER['transportation'] == "motorcycle" ? "selected" : "" ?>>오토바이</option>
	  					<option value="bike" <?= USER['transportation'] == "bike" ? "selected" : "" ?>>자전거</option>
	  				</select>
	  			</li>
	  		</ul>

	  		<div class="after_line"></div>

	  		<button class="show_more">
	  			<p>저장</p>
	  			<i class="fa fa-angle-right"></i>
	  		</button>
	  	</form>
  	</div>

  	<?php endif ?>


  	<?php 
  		$t_label = $_SESSION['label'][USER['type']];
  	 ?>

  	<div class="load_div">
  		
	  	<?php if (USER['type'] == "normal"): ?>
	  		
	  		<div class="order_div">

			  	<div class="section_title">
			  		<div>
			  			<div class="title_block"></div>
			  			<h4>마이 페이지 - 주문 조회 영역</h4>
			  		</div>	
			  		<p>회원님의 주문 내역을 확인할 수 있습니다.</p>
			  	</div>

			  	<div class="after_line"></div>

			  		<?php 
			  			$order = users::userOrder();
			  		 ?>

			  		<table class="order_table">
			  			<thead>
				  			<?php foreach ($t_label['order'] as $key => $v): ?>
				  				<th><?= $v ?></th>
				  			<?php endforeach ?>
			  			</thead>

			  			<tbody>
			  				<?php foreach ($order as $key => $v): ?>
				  				<tr>
			  						<td width="10%"><?= $v['store']['name'] ?></td>
			  						<td><?= $v['order_at'] ?></td>
			  						<td width="25%">
			  							<?php foreach ($v['view_menu'] as $key => $val): ?>
			  								<p><?= $val ?></p>
			  							<?php endforeach ?>
			  						</td>
			  						<td width="10%"><?= $v['rider'] ? $v['rider']['name'] : "" ?></td>
			  						<td>
			  							<?php if ($v['state'] == "taking"): ?>
				  							<?php $timeStamp = strtotime($v['taking_at']); ?>

				  							 <?= date("Y-m-d H:i:s", $timeStamp) ?>
			  							<?php endif ?>
			  						</td>
			  						<td>
			  							<?php if ($v['state'] == "complete"): ?>
			  								<div class="show_more rev_btn" style="<?= $v['review'] ? "pointer-events: none" : ""; ?>" onclick="mdSet('review_popup', <?= $v['store_id'] ?>)">
			  									<p>리뷰</p>
			  									<i class="fa fa-angle-right"></i>
			  								</div>
			  							<?php endif ?>
			  						</td>
			  						<td>
			  						<?php if ($v['state'] == "complete"): ?>
			  								<div class="show_more rev_btn" style="<?= $v['grade'] ? "pointer-events: none" : ""; ?>" onclick="mdSet('score_popup', <?= $v['store_id'] ?>)">
			  									<p>평점</p>
			  									<i class="fa fa-angle-right"></i>
			  								</div>
			  							<?php endif ?>
			  						</td>
			  						<td><?= $v['view_state'] ?></td>
				  				</tr>
			  				<?php endforeach ?>
			  			</tbody>
			  		</table>
		  		</div>

	  		<div class="order_div">

			  	<div class="section_title">
			  		<div>
			  			<div class="title_block"></div>
			  			<h4>마이 페이지 - 예약 조회 영역</h4>
			  		</div>	
			  		<p>회원님의 예약 내역을 확인할 수 있습니다.</p>
			  	</div>

			  	<div class="after_line"></div>

			  		<?php 
			  			$res = users::userRes();
			  		 ?>

			  		<table class="order_table">
			  			<thead>
				  			<?php foreach ($t_label['res'] as $key => $v): ?>
				  				<th><?= $v ?></th>
				  			<?php endforeach ?>
			  			</thead>

			  			<tbody>
			  				<?php foreach ($res as $key => $v): ?>
				  				<tr>
			  						<td><?= $v['store']['name'] ?></td>
			  						<td><?= $v['reservation_at'] ?></td>
			  						<td><?= $v['request_at'] ?></td>
			  						<td><?= $v['view_state'] ?></td>
				  				</tr>
			  				<?php endforeach ?>
			  			</tbody>
			  		</table>
		  		</div>

	  	<?php endif ?>

	  	<?php if (USER['type'] == "owner"): ?>
	  		
	  		<div class="order_div">
	  			<div class="section_title">
			  		<div>
			  			<div class="title_block"></div>
			  			<h4>마이 페이지 - 주문 조회 영역</h4>
			  		</div>	
			  		<p>가게에 들어온 주문 내역을 확인할 수 있습니다.</p>
			  	</div>

			  	<div class="after_line"></div>

			  	<?php 
				  	$order = stores::ownerOrder();
			  	 ?>

		  	  <table class="order_table">
			  	 	<thead>
			  	 		<?php foreach ($t_label['order'] as $key => $v): ?>
			  	 			<th><?= $v ?></th>
	  	 				<?php endforeach ?>		
			  	 	</thead>

			  	 	<tbody>
			  	 		<?php foreach ($order as $key => $v): ?>
			  	 			<tr>
			  	 				<td><?= $v['orderer']['name'] ?></td>
			  	 				<td><?= $v['orderer']['loc']['borough'] ?> <?= $v['orderer']['loc']['name'] ?></td>
			  	 				<td>
			  	 					<?php foreach ($v['view_menu'] as $key => $val): ?>
			  	 						<p><?= $val ?></p>
			  	 					<?php endforeach ?>
			  	 				</td>
			  	 				<td>
			  	 					<?php if ($v['state'] == "order"): ?>
		  	 						<div class="flex alc jc">
			  	 							
			  	 						<div class="show_more" onclick='$.post("/post/orderState/<?= $v['id'] ?>", {state: "accept"})' style="margin-right: .5rem">
			  	 							<p>수락</p>
			  	 							<i class="fa fa-angle-right"></i>
			  	 						</div>
			  	 						<div class="show_more" onclick='$.post("/post/orderState/<?= $v['id'] ?>", {state: "reject"})'>
			  	 							<p>거절</p>
			  	 							<i class="fa fa-angle-right"></i>
			  	 						</div>
		  	 						</div>
			  	 					<?php endif ?>
			  	 					<?= $v['view_state'] ?>
		  	 					</td>
			  	 			</tr>
			  	 		<?php endforeach ?>
			  	 	</tbody>
		  	  </table>
	  		</div>

	  		<div class="order_div">
	  			<div class="section_title">
			  		<div>
			  			<div class="title_block"></div>
			  			<h4>마이 페이지 - 예약 조회 영역</h4>
			  		</div>	
			  		<p>가게에 들어온 주문 내역을 확인할 수 있습니다.</p>
			  	</div>

			  	<div class="after_line"></div>

			  	<?php 
				  	$res = stores::ownerRes();
			  	 ?>

		  	  <table class="order_table">
			  	 	<thead>
			  	 		<?php foreach ($t_label['res'] as $key => $v): ?>
			  	 			<th><?= $v ?></th>
	  	 				<?php endforeach ?>		
			  	 	</thead>

			  	 	<tbody>
			  	 		<?php foreach ($res as $key => $v): ?>
			  	 			<tr>
			  	 				<td><?= $v['user']['name'] ?></td>
			  	 				<td><?= $v['reservation_at'] ?></td>
			  	 				<td><?= $v['request_at'] ?></td>
			  	 				<td>
			  	 					<?php if ($v['state'] == "order"): ?>
		  	 						<div class="flex alc jc">
			  	 						<div class="show_more" onclick='$.post("/post/resState/<?= $v['id'] ?>", {state: "accept"})' style="margin-right: .5rem">
			  	 							<p>수락</p>
			  	 							<i class="fa fa-angle-right"></i>
			  	 						</div>
			  	 						<div class="show_more" onclick='$.post("/post/resState/<?= $v['id'] ?>", {state: "reject"})'>
			  	 							<p>거절</p>
			  	 							<i class="fa fa-angle-right"></i>
			  	 						</div>
		  	 						</div>
			  	 					<?php endif ?>
			  	 					<?= $v['view_state'] ?>
		  	 					</td>
			  	 			</tr>
			  	 		<?php endforeach ?>
			  	 	</tbody>
		  	  </table>
	  		</div>

	  		<div class="order_div">
	  			<div class="section_title">
			  		<div>
			  			<div class="title_block"></div>
			  			<h4>마이 페이지 - 메뉴 리스트 영역</h4>
			  		</div>	
			  		<p>가게에 메뉴 정보를 확인할 수 있습니다.</p>
			  	</div>

			  	<div class="after_line"></div>

			  	<?php 
				  	$res = stores::menuList();
			  	 ?>

		  	  <table class="order_table">
			  	 	<thead>
			  	 		<?php foreach ($t_label['menu'] as $key => $v): ?>
			  	 			<th><?= $v ?></th>
	  	 				<?php endforeach ?>		
			  	 	</thead>

			  	 	<tbody>
			  	 		<?php foreach ($res as $key => $v): ?>
			  	 			<tr>
			  	 				<td><img src="<?= $v['image'] ?>" alt="menu" title="menu" class="menu_img"></td>
			  	 				<td><?= $v['name'] ?></td>
			  	 				<td><?= $v['price'] ?>원</td>
			  	 				<td>
			  	 					<?php if ($v['sale'] > 0): ?>
			  	 						<?= $v['sale'] ?>%
			  	 					<?php endif ?>
			  	 				</td>
			  	 				<td>
			  	 					<?php if ($v['sale'] > 0): ?>
			  	 						<?= $v['sale_price'] ?>원
			  	 					<?php endif ?>
			  	 				</td>
			  	 				<td><?= $v['allSel']['c'] ? $v['allSel']['c'] : 0 ?>개</td>
			  	 				<td>
			  	 					<div class="show_more" style="width: 130px; margin-right: 0" onclick="mdSet('sale_popup', <?= $v['id'] ?>, <?= $v['sale'] ?>)">
			  	 						<p>할인 버튼</p>
			  	 						<i class="fa fa-angle-right"></i>
			  	 					</div>
			  	 				</td>
			  	 			</tr>
			  	 		<?php endforeach ?>
			  	 	</tbody>
		  	  </table>
	  		</div>

	  	<?php endif ?>

	  	<?php if (USER['type'] == "rider"): ?>
	  		
	  		<div class="order_div">
	  			<div class="section_title">
			  		<div>
			  			<div class="title_block"></div>
			  			<h4>마이 페이지 - 배달 리스트 영역</h4>
			  		</div>	
			  		<p>현재 수락가능한 배달을 확인할 수 있습니다.</p>
			  	</div>

			  	<div class="after_line"></div>

			  	<?php 
				  	$res = users::riderOrder();
			  	 ?>

		  	  <table class="order_table">
			  	 	<thead>
			  	 		<?php foreach ($t_label['order'] as $key => $v): ?>
			  	 			<th><?= $v ?></th>
	  	 				<?php endforeach ?>		
			  	 	</thead>

			  	 	<tbody>
			  	 		<?php foreach ($res as $key => $v): ?>
			  	 			<tr>
			  	 				<td><?= $v['store']['name'] ?></td>
			  	 				<td><?= $v['store']['loc']['borough'] ?> <?= $v['store']['loc']['name'] ?></td>
			  	 				<td><?= $v['orderer']['loc']['borough'] ?> <?= $v['orderer']['loc']['name'] ?></td>
			  	 				<td>
			  	 					<?php foreach ($v['view_menu'] as $key => $val): ?>
			  	 						<p><?= $val ?></p>
			  	 					<?php endforeach ?>
			  	 				</td>
			  	 				<td>
			  	 					<?php if ($v['state'] == "accept"): ?>
			  	 						<div class="show_more" onclick='$.post("/post/orderState/<?= $v['id'] ?>", {state: "taking"})'>
			  	 							<p>수락</p>
			  	 							<i class="fa fa-angle-right"></i>
			  	 						</div>
			  	 					<?php endif ?>
			  	 					<?php if ($v['state'] == "taking"): ?>
			  	 						<div class="show_more" onclick='$.post("/post/orderState/<?= $v['id'] ?>", {state: "complete"})'>
			  	 							<p>완료</p>
			  	 							<i class="fa fa-angle-right"></i>
			  	 						</div>
			  	 					<?php endif ?>
			  	 					<?= $v['view_state'] ?>
		  	 					</td>
			  	 			</tr>
			  	 		<?php endforeach ?>
			  	 	</tbody>
		  	  </table>
	  		</div>
	  	<?php endif ?>

  	</div>
  </div>
 
<script>
	setInterval(() => {
	 	load("mypage");
	}, 500);
</script>