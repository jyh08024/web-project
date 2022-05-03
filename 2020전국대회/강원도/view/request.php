  <div class="section"></div>

  <div class="section wrap">
    <div class="section_title">
      <div>
        <div class="title_block"></div>
        <h4>제안요청</h4>
      </div>
      <p>와일드 푸드 제안요청</p>
    </div>

    <div class="after_line"></div>

    <div class="req_table_top flex alc js" style="margin-bottom: 1rem">
      <h2>요청한 내역</h2>
      <button class="btn req_modal" onclick="Modal.open('req_popup')">제안 요청</button>
    </div>

    <table class="order_static">
      <thead>
        <th>요청명</th>
        <th>가격 한도</th>
        <th>오차 범위</th>
        <th>상세 버튼</th>
      </thead>
      <tbody class="req_list">
      	<?php foreach ($reqData as $key => $v): ?>
	      	<tr>
	      		<td><?= $v['req_name'] ?></td>
	      		<td><?= $v['max'] ?></td>
	      		<td><?= $v['priceRange'] ?></td>
	      		<td>
	      			<a href="/reqDetail/<?= $v['idx'] ?>" class="btn">상세</a>
	      		</td>
	      	</tr>
      	<?php endforeach ?>
      </tbody>
    </table>
  </div>

  <script>
  	function postReq() {
  		const formData = new FormData($(`.req_form`)[0]);

  		$.ajax({
  			url: '/post/req',
  			processData: false,
  			contentType: false,
  			data: formData,
  			type: 'post'
  		}).done((res) => {
  			if (res == "모든 값을 입력해주세요." || res == "오차범위는 10000을 넘을수 없고 가격 한도의 50% 범위를 넘을 수 없습니다." || res == "가격 한도와 오차 범위는 숫자만 입력 가능합니다.") {
          alert(res);
          return;
        }

        alert('요청이 완료되었습니다');
        $(`.req_list`).html(res);
        Modal.close();
  		})
  	}
  </script>