	<div id="content">
		<div class="w100">
			<div class="item">
				<h1 class="title">예약관리</h1>
				<table>
					<tr>
						<th>회원등급</th>
						<th>이름</th>
						<th>아이디</th>
						<th>예약 품목명</th>
						<th>대여~반납일</th>
						<th>대여/반납지점</th>
						<th>총 결제금액</th>
						<th>상태</th>
					</tr>

					<?php foreach ($resData as $key => $v): ?>
						<tr>
							<td><?= $v['level'] ?></td>
							<td><?= $v['user_name'] ?></td>
							<td><?= $v['user_id'] ?></td>
							<td><?= $v['product_name'] ?></td>
							<td><?= $v['start'] ?> ~ <?= $v['end'] ?></td>
							<td><?= $v['begin'] ?>/<?= $v['arrive'] ?></td>
							<td><?= number_format($v['pay_price']) ?> 원</td>
							<td>
								<?php if ($v['state'] == "cancel"): ?>
									예약취소
								<?php else: ?>
									<a href="/post/cancel/<?= $v['res_idx'] ?>" class="btn blueBtn Acancel">예약취소</a>
								<?php endif ?>
							</td>
						</tr>
					<?php endforeach ?>
				</table>
			</div>
		</div><!--w100-->
	</div><!--content-->
