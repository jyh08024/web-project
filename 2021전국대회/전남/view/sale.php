  <div class="emp_box"></div>
  
  <div class="page_title rap flex alc jc">
    <h1>할인 이벤트 페이지</h1>
    <img src="/resources/img/7.jpg" alt="back" title="back">
  </div>

  <div class="rap section_inner">
  	<div class="section">
	    <div class="section_title">
	      <div>
	        <div class="title_block"></div>
	        <h4>검색 영역</h4>
	      </div>
	      <p>현재 할인중인 메뉴를 검색할 수 있습니다.</p>
	    </div>

	    <div class="after_line"></div>

	    <form action="/post/saleSearch" method="POST" class="flex alc js">
	      <ul style="width: 80%;">
	        <li>검색어</li>
	        <li><input name="search_val" type="text" class="input" placeholder="검색어를 입력해주세요." required style="width: 100%;"></li>
	      </ul>

	      <button class="btn show_more" style="margin-top: 1.5rem;">
	        <p>검색</p>
	        <i class="fa fa-angle-right"></i>
	      </button>
	    </form>

	    <div class="after_line"></div>

  	</div>

    <div class="section">

	    <div class="section_title">
	      <div>
	        <div class="title_block"></div>
	        <h4>할인 메뉴</h4>
	      </div>
	      <p>현재 할인중인 메뉴들 입니다.</p>
	    </div>

	    <div class="after_line"></div>
    	
    	<table class="order_table">
    		<thead>
    			<tr>
    				<?php foreach ($_SESSION['label']['sale'] as $key => $v): ?>
	    				<th><?= $v ?></th>
    				<?php endforeach ?>
    			</tr>
    		</thead>

    		<tbody class="load_div">
    			<?php foreach ($bread as $key => $v): ?>
    				<tr style="cursor: pointer" onclick="location.href = 'http://localhost/order/<?= $v['store_id'] ?>/<?= $v['bread_id'] ?>/'">
    					<td><?= $v['bread_name'] ?></td>
    					<td><img src="<?= $v['bread_image'] ?>" alt="bread" title="bread" class="menu_img"></td>
    					<td><?= number_format($v['price']) ?>원</td>
    					<td><?= $v['sale'] ?>%</td>
    					<td><?= number_format(round($v['price'] * ((100 - $v['sale']) / 100))) ?>원</td>
    					<td><?= $v['store_name'] ?></td>
    				</tr>
    			<?php endforeach ?>
    		</tbody>
    	</table>

    </div>
  </div>

  <script>
  	setInterval(() => {
  		load("saleLoad/<?= $search ?>")
  	}, 500)
  </script>