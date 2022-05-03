  <div class="sub_page_visual">
    <div class="sub_page_title flex alc wrap">
      <h1>픽업주문 - 주문내역</h1>
    </div>
  </div>

  <div class="sub_page_section section wrap">
    <div class="sub_section_title">
      <h2>주문내역</h2>
    </div>

    <div class="history_list">
    	<?php $state = ["order" => "접수 대기중", "waiting" => "픽업 대기중", "pickUp"=> "픽업 완료", "cancel"=> "주문취소"] ?>
    		<div class="order_table">
    			
    			<div class="table_column flex	 alc js">
    				<div><h3>순번</h3></div>
    				<div><h3>주문일시</h3></div>
    				<div><h3>가게명</h3></div>
    				<div><h3>상품명</h3></div>
    				<div><h3>주문상태</h3></div>
    			</div>

  			<div class="table_inner">

  				<?php foreach ($orderList as $key => $v): ?>
  					<?php $storeCount = count($v['bread_info']) ?>
						<?php $height = "" ?>
						<?php $height2 = $v['menuCount'] * 40 ?>

	  				<div class="table_info">
	  					<div><p style="height: <?= $height2 ?>px"><?= $key + 1 ?></p></div>
	  					<div><p style="height: <?= $height2 ?>px"><?= $v['order_date'] ?></p></div>

	  					<div class="store">
	  						<div class="<?= $storeCount > 1 ? 'multiitem' : "" ?>" style="height: <?= $height2 ?>px">
								<?php foreach ($v['bread_info'] as $storeKey => $value): ?>
	  							<p style="height: <?= count($value) * 40 ?>px"><?= $storeKey ?></p>
								<?php endforeach ?>
	  						</div>
	  					</div>

	  					<div class="items">
	  						<?php foreach ($v['bread_info'] as $stKey => $stVal): ?>
	  							<?php foreach ($stVal as $itemKey => $item): ?>
			  						<div class="<?= count($item) > 1 ? 'multiitem' : "" ?>"><p><?= $item['name'] ?></p></div>
	  							<?php endforeach ?>
	  						<?php endforeach ?>
	  					</div>

	  						
	  					<div class="order_state">
	  					<?php foreach ($v['bread_info'] as $qwe => $asd): ?>
	  						<?php $odState = ""; ?>
	  						
	  						<?php foreach ($asd as $stKey => $stVal): ?>
	  							<?php $odState = $stVal['od_state'] ?>
	  						<?php endforeach ?>
	  						
	  						<div style="height: <?= count($asd) * 40 ?>px; <?= $storeCount > 1 ? "border-bottom: 1px solid rgba(0, 0, 0, .1);" : ""; ?>">
  							<p><?= $state[$odState] ?></p>

  							<?php if ($odState == "order"): ?>
  								<form method="POST" action="/post/orderState/<?= $v['idx'] ?>">
  									<input type="hidden" name="store" value="<?= $qwe ?>">
  									<button class="btn">주문취소</button>
  								</form>
  							<?php endif ?>

	  						</div>
	  					<?php endforeach ?>

	  					</div>
	  				</div>

  				<?php endforeach ?>

  			</div>
  		</div>
    </div>
  </div>

