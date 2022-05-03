	<div id="content">
		<div class="w100">
			<div class="admin">
				<h1 class="title">결제 및 반납관리</h1>
				<table>
					<tr>
						<th>회원등급</th>
						<th>이름</th>
						<th>아이디</th>
						<th>품목명</th>
						<th>대여~반납일</th>
						<th>대여/반납지점</th>
						<th>총 결제금액</th>
						<th>상태</th>
					</tr>
					<?php foreach ($resCare as $key => $v): ?>
						
						<tr>
							<td><?= $v['level'] ?></td>
							<td><?= $v['user_name'] ?></td>
							<td><?= $v['user_id'] ?></td>
							<td><?= $v['product_name'] ?></td>
							<td><?= $v['start']." ~ ".$v['end'] ?></td>
							<td><?= $v['begin']."/".$v['arrive'] ?></td>
							<td><?= number_format($v['pay_price']) ?></td>
							<td>
								<?php if ($v['state'] == "reserv"): ?>
									<a href="/post/resState/<?= $v['reserv_index'] ?>" class="btn blueBtn">결제완료</a>
								<?php else: ?>
									<?php $viewState = ["payment"=> "결제완료", "return"=> "반납완료"] ?>
									<?= $viewState[$v['state']] ?>
								<?php endif ?>
							</td>
						</tr>

					<?php endforeach ?>
					<!-- <tr>
						<td>VIP회원</td>
						<td>사용자1</td>
						<td>user1</td>
						<td>24 팬텀 CITY</td>
						<td>2018-04-01 10:00 ~ 2018-04-01 12:00</td>
						<td>여수시/순천시</td>
						<td>20,400 원</td>
						<td>
							<a href="#" class="btn blueBtn">결제완료</a>
						</td>
					</tr>
					<tr>
						<td>VIP회원</td>
						<td>사용자1</td>
						<td>user1</td>
						<td>24 팬텀 CITY</td>
						<td>2018-04-01 10:00 ~ 2018-04-01 12:00</td>
						<td>여수시/순천시</td>
						<td>20,400 원</td>
						<td>
							결제완료
						</td>
					</tr> -->
				</table>
			</div>
		</div><!--w100-->
	</div><!--content-->

<script>
	function load() {
		$.post("/view/html", (res) => {
			if ($(res).html().trim() != $(`table`).html().trim()) {
				$(`table`).html(res);
			}
		})
	}

	setInterval(() => {
		load();
	}, 700);
</script>