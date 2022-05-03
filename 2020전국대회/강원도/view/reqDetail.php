<div class="section"></div>

<div class="section wrap">
	<div class="section_title">
		<div>
      <div class="title_block"></div>
      <h4>제안요청 상세 <span style="font-size: 1.1rem;">REQUEST_DETAIL</span></h4>
    </div>
	</div>

	<div class="after_line"></div>

	<div class="req_table_top flex alc js" style="margin-bottom: 1rem">
    <h2>제안한 목록</h2>
  </div>

  <table class="order_static">
    <thead>
      <th>제안한 회원 아이디</th>
      <th>제안명</th>
      <th>상세</th>
      <th>구매</th>
    </thead>
    <tbody class="req_list">
      <?php foreach ($data as $key => $v): ?>
        <tr>
          <td><?= $v['user_id'] ?></td>
          <td><?= $v['req_name'] ?></td>
          <td><button class="btn" onclick='sugDetail(<?= json_encode($v['item'], true) ?>)'>상세</button></td>
          <td>
            <a href="/buySug/<?= $v['idx'] ?>" class="btn">구매</a>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>

<script>
	function sugDetail(data) {
		const list = JSON.parse(data);
		Modal.open('sug_detail');

		$(`.sug_items`).html(list.map(v => {return `
			<tr>
				<td>${v.product_name} / ${v.price} 원</td>
				<td>${v.cnt} 개</td>
				<td>${(v.totalCost * 1).toLocaleString()}</td>
			</tr>
			`}));

    $(`.sug_total_price`).html(list.reduce((acc, val) => acc += val.totalCost * 1, 0).toLocaleString());
	}
</script>