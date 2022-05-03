	
	<div id="content">
		<div class="w100">
			<div class="mypage">
				<h1 class="title">마이페이지</h1>
				
				<div class="page">
					<h3 class="title">예약 및 결제 완료된 품목</h3>
					<table>
						<tr>
							<th>구분</th>
							<th>품목 이미지</th>
							<th>품목명</th>
							<th>대여일(시간)~반납일(시간)</th>
							<th>대여/반납지점</th>
							<th>총 결제금액</th>
							<th>예약상태</th>
							<th>선택</th>
						</tr>
						<?php foreach ($list['list'] as $key => $value): ?>
							<tr>
								<td><?php echo $value['idx'] ?></td>
								<td><img src="/images/<?php echo $value['info']['image'] ?>" alt="image" title="image"></td>
								<td><?php echo $value['info']['name'] ?></td>
								<td><?php echo mb_substr($value['start'], 0, -3) ?> ~ <?php echo mb_substr($value['end'], 0, -3) ?></td>
								<td><?php echo $value['start_place'] ?>/<?php echo $value['end_place'] ?></td>
								<td><?php echo number_format($value['pay']['realPay']) ?> 원</td>
								<td><?php echo $value['stat'] ?></td>
								<td>
									<?php if ($value['stat'] == "대기중"): ?>
										<a href="/cancle/<?php echo $value['idx'] ?>" class="btn blueBtn">예약취소</a>
									<?php endif ?>
									<a href="/rentals/<?php echo $value['idx'] ?>" class="btn blueBtn">렌탈계약서</a>
								</td>
							</tr>
						<?php endforeach ?>
					</table>
				</div><!--page-->
					
				<div class="cancelT">
					<h3 class="title">취소 및 반납된 품목</h3>
					<table>
						<tr>
							<th>품목명</th>
							<th>대여일(시간) ~ 반납일(시간)</th>
							<th>대여/반납지점</th>
							<th>총 결제금액</th>
							<th>취소사유</th>
						</tr>
						<?php foreach ($list['cancle'] as $key => $value): ?>
							<tr>
								<td><?php echo $value['info']['name'] ?></td>
								<td><?php echo mb_substr($value['start'], 0, -3) ?> ~ <?php echo mb_substr($value['end'], 0, -3) ?></td>
								<td><?php echo $value['start_place'] ?>/<?php echo $value['end_place'] ?></td>
								<td><?php echo number_format($value['pay']['realPay']) ?> 원</td>
								<td><?php echo $value['cancle'] ?></td>
							</tr>
						<?php endforeach ?>
					</table>
				</div>
			</div><!--mypage-->
		</div><!--w100-->
	</div><!--content-->
	
</body>
</html>