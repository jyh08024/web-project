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
						<?php foreach ($orderData['list'] as $key => $v): ?>
							<tr>
								<td><?= $key + 1 ?></td>
								<td><img src="/resources/images/<?= $v['image'] ?>" alt="image" title="image"></td>
								<td><?= $v['name'] ?></td>
								<td><?= $v['start'] ?> ~ <?= $v['end'] ?></td>
								<td><?= $v['begin'] ?>/<?= $v['arrive'] ?></td>
								<td><?= number_format($v['pay_price']) ?> 원</td>
								<td><?= $v['view_state'] ?></td>
								<td>
									<?php if ($v['state'] == "reserv"): ?>
										<a href="/post/cancel/<?= $v['reserv_idx'] ?>" class="btn blueBtn">예약취소</a>
									<?php endif ?>
									<a href="/contract/<?= $v['reserv_idx'] ?>" class="btn blueBtn">렌탈계약서</a>
								</td>
							</tr>
						<?php endforeach ?>
						<!-- <tr>
							<td>2</td>
							<td><img src="./images/24%20%ED%8C%AC%ED%85%80%20CITY.jpg" alt="image" title="image"></td>
							<td>24 팬텀 CITY</td>
							<td>2018-04-01 10:00 ~ 2018-04-01 12:00</td>
							<td>여수시/순천시</td>
							<td>20,400 원</td>
							<td>대기중</td>
							<td>
								<a href="#" class="btn blueBtn">예약취소</a>
								<a href="./contract.html" class="btn blueBtn">렌탈계약서</a>
							</td>
						</tr>
						<tr>
							<td>3</td>
							<td><img src="./images/24%20%ED%8C%AC%ED%85%80%20CITY.jpg" alt="image" title="image"></td>
							<td>24 팬텀 CITY</td>
							<td>2018-04-01 10:00 ~ 2018-04-01 12:00</td>
							<td>여수시/순천시</td>
							<td>20,400 원</td>
							<td>결제완료</td>
							<td>
								<a href="./contract.html" class="btn blueBtn">렌탈계약서</a>
							</td>
						</tr> -->
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
						<?php foreach ($orderData['cancel'] as $key => $v): ?>
							<tr>
								<td><?= $v['name'] ?></td>
								<td><?= $v['start'] ?> ~ <?= $v['end'] ?></td>
								<td><?= $v['begin'] ?>/<?= $v['arrive'] ?></td>
								<td><?= number_format($v['pay_price']) ?> 원</td>
								<td><?= $v['view_reason'] ?></td>
							</tr>
						<?php endforeach ?>
						<!-- <tr>
							<td>24 팬텀 CITY</td>
							<td>2018-04-02 11:00 ~ 2018-04-02 13:00</td>
							<td>여수시/여수시</td>
							<td>20,400 원</td>
							<td>사용자1 님에 의해 취소되었습니다.</td>
						</tr>
						<tr>
							<td>24 팬텀 CITY</td>
							<td>2018-03-02 15:00 ~ 2018-03-02 17:00</td>
							<td>여수시/여수시</td>
							<td>20,400 원</td>
							<td>반납되었습니다.</td>
						</tr> -->
					</table>
				</div>
			</div>