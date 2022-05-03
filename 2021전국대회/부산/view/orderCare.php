  <div class="sub_page_visual">
    <div class="sub_page_title flex alc wrap">
      <h1>매장관리 - 주문관리</h1>
    </div>
  </div>

  <div class="sub_page_section section wrap">
    <div class="sub_section_title">
      <h2>주문내역</h2>
    </div>

    <?php 
      $orderContinue = array_filter($orderData, function($v) {
        return $v['order_state'] != "pickUp";
      });

      $pickOrder = array_filter($orderData, function($v) {
        return $v['order_state'] == "pickUp";
      });
     ?>

    	<?php $state = ["order" => "접수 대기중", "waiting" => "픽업 대기중", "pickUp"=> "픽업 완료"] ?>
      <div class="history_list">
    		<div class="order_table">
    			
    			<div class="table_column flex	 alc js">
    				<div><h3>순번</h3></div>
    				<div><h3>주문일시</h3></div>
    				<div><h3>고객명</h3></div>
    				<div><h3>상품명</h3></div>
    				<div><h3>주문상태</h3></div>
    			</div>

  			<div class="table_inner">

  				<?php foreach ($orderContinue as $key => $v): ?>
            <?php if ($v['menuCount'] <= 0): ?>
              <?php continue; ?>
            <?php endif ?>
            <?php $storeCount = count($v['bread_info']) ?>
            <?php $height = $v['menuCount'] * 40 ?>

	  				<div class="table_info">
	  					<div><p style="height: <?= $height ?>px"><?= $key + 1 ?></p></div>
	  					<div><p style="height: <?= $height ?>px"><?= $v['order_date'] ?></p></div>

	  					<div class="store">
	  						<div class="<?= $storeCount > 1 ? "multiitem" : "" ?>" style="height: <?= $height ?>px">
                  <?php foreach ($v['bread_info'] as $storeKey => $value): ?>
      							<p style="height: <?= count($value) * 40 ?>px"><?= $storeKey ?></p>
                  <?php endforeach ?>
	  						</div>
	  					</div>

	  					<div class="items">
                <?php foreach ($v['bread_info'] as $proKey => $pro): ?>
                  <?php foreach ($pro as $itemKey => $item): ?>
    	  						<div class="<?= count($item) > 1 ? 'multiitem' : "" ?>"><p><?= $item['name'] ?></p></div>
                  <?php endforeach ?>
                <?php endforeach ?>
	  					</div>

	  					<div class="order_state" style="height: <?= $height ?>px">
                <?php foreach ($v['bread_info'] as $key => $val): ?>
                    <?php $odState = ""; ?>

                    <?php foreach ($val as $stKey => $stVal): ?>
                      <?php $odState = $stVal['state'] ?>
                    <?php endforeach ?>

                  <div style="height: <?= count($val) * 40 ?>px; <?= $storeCount > 1 ? "border-bottom: 1px solid rgba(0, 0, 0, .1);" : ""; ?>">
      							<p><?= $state[$odState] ?></p>

      								<form method="POST" action="/post/orderCare/<?= $v['idx'] ?>">
                        <input type="hidden" name="store" value="<?= $userStore['idx'] ?>">
                    <?php if ($odState == "order"): ?>
      									<button class="btn">접수 완료</button>
                      <?php else: ?>
                        <button class="btn">픽업 완료</button>
                    <?php endif ?>
      								</form>
                
                  </div>
                <?php endforeach ?>
	  					</div>

  				<?php endforeach ?>

  			</div>
  		</div>
    </div>

    <div class="sub_section_title">
      <h2>완료 내역</h2>
    </div>

    <div class="history_list">
        <div class="order_table">
          
          <div class="table_column flex  alc js">
            <div><h3>순번</h3></div>
            <div><h3>주문일시</h3></div>
            <div><h3>고객명</h3></div>
            <div><h3>상품명</h3></div>
            <div><h3>주문상태</h3></div>
          </div>

        <div class="table_inner">

          <?php foreach ($pickOrder as $key => $v): ?>

            <?php $storeCount = count($v['bread_info']) ?>
            <?php $height = $v['menuCount'] * 40 ?>

            <div class="table_info">
              <div><p style="height: <?= $height ?>px"><?= $key + 1 ?></p></div>
              <div><p style="height: <?= $height ?>px"><?= $v['order_date'] ?></p></div>

              <div class="store">
                <div class="<?= $storeCount > 1 ? "multiitem" : "" ?>" style="height: <?= $height ?>px">
                  <?php foreach ($v['bread_info'] as $storeKey => $value): ?>
                    <p style="height: <?= count($value) * 40 ?>px"><?= $storeKey ?></p>
                  <?php endforeach ?>
                </div>
              </div>

              <div class="items">
                <?php foreach ($v['bread_info'] as $proKey => $pro): ?>
                  <?php foreach ($pro as $itemKey => $item): ?>
                    <div class="<?= count($item) > 1 ? 'multiitem' : "" ?>"><p><?= $item['name'] ?></p></div>
                  <?php endforeach ?>
                <?php endforeach ?>
              </div>

              <div class="order_state" style="height: <?= $height ?>px">
                <p><?= $state[$v['order_state']] ?></p>
              </div>
            </div>

          <?php endforeach ?>

        </div>
      </div>
    </div>

  </div>

