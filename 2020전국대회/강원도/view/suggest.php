  <div class="section"></div>

  <div class="section wrap">
    <div class="section_title">
      <div>
        <div class="title_block"></div>
        <h4>제안하기 <span style="font-size: 1.1rem;">SUGGEST</span></h4>
      </div>
    </div>

    <div class="after_line"></div>

    <div class="req_table_top flex alc js" style="margin-bottom: 1rem">
      <h2>요청 목록</h2>
    </div>

    <table class="order_static">
      <thead>
        <th>요청 회원 아이디</th>
        <th>요청명</th>
        <th>가격 한도</th>
        <th>오차 범위</th>
        <th>제안 버튼</th>
      </thead>
      <tbody class="req_list">
        <?php foreach ($data as $key => $v): ?>
          <tr>
            <td><?= $v['user_id'] ?></td>
            <td><?= $v['req_name'] ?></td>
            <td><?= number_format($v['max']) ?></td>
            <td><?= number_format($v['priceRange']) ?></td>
            <td><a href="/suggestStore/<?= $v['idx'] ?>" class="btn">제안</a></td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>