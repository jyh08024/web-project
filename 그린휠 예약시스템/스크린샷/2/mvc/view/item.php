
	
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
					<?php foreach ($admin['item'] as $key => $value): ?>
						<tr>
							<td><?php echo $value['level'] ?></td>
							<td><?php echo $value['name'] ?></td>
							<td><?php echo $value['id']?></td>
							<td><?php echo $value['info']['name'] ?></td>
							<td><?php echo mb_substr($value['start'], 0, -3) ?> ~ <?php echo mb_substr($value['end'], 0, -3) ?></td>
							<td><?php echo $value['start_place'] ?>/<?php echo $value['end_place'] ?></td>
							<td><?php echo number_format($value['pay']['realPay']) ?> 원</td>
							<td>
								<?php if ($value['stat'] != "예약취소"): ?>
									<button onclick="location.href='/cancle/<?php echo $value['idx'] ?>'" class="btn blueBtn Acancel">예약취소</button>
								<?php else: ?>
									예약취소
								<?php endif ?>
							</td>
						</tr>
					<?php endforeach ?>
				</table>
			</div>
		</div><!--w100-->
	</div><!--content-->
	
</body>
</html>