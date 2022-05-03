	<div id="content">
		<div class="w100">
			<div class="cart">
				<form method="POST" action="/post/rentalSearch" class="search form-inline">
					<label>품목구분</label>
					<select class="form-control" name="category" id="category">
						<option disabled selected value="">품목구분</option>
						<option data-category="자전거">전기자전거</option>
						<option data-category="자전거">미니전기자동차</option>
						<option data-category="자전거">전기스쿠터</option>
						<option data-category="자동차">전기자동차</option>
						<option data-category="자동차">장거리전기자동차</option>
					</select>
					<label>대여지점</label>
						<select name="placeS" id="placeS" class="place">
								<option disabled selected>대여지점</option>
								<option value="여수시">여수시</option>
								<option value="순천시">순천시</option>
								<option value="목포시">목포시</option>
								<option value="담양군">담양군</option>
								<option value="보성군">보성군</option>
								<option value="완도군">완도군</option>
								<option value="해남군">해남군</option>
								<option value="구례군">구례군</option>
							</select>
							<label>반납지점</label>
							<select name="placeE" id="placeE" class="place">
								<option disabled selected>반납지점</option>
								<option value="여수시">여수시</option>
								<option value="순천시">순천시</option>
								<option value="목포시">목포시</option>
								<option value="담양군">담양군</option>
								<option value="보성군">보성군</option>
								<option value="완도군">완도군</option>
								<option value="해남군">해남군</option>
								<option value="구례군">구례군</option>
							</select>
					<div class="form-group div-category" data-category="자동차" style="display: none;">
						<label>대여가능일</label>
						<input type="text" id="start2" name="start" class="form-control">
						<label>반납가능일</label>
					<input type="text" id="end2" name="end" class="form-control">
					</div>
					<div class="form-group div-category" data-category="자전거">
						<label>대여가능시간</label>
						<select class="Rtime form-control" name="start">
							<option disabled selected>대여시간</option>
							<option>01:00</option>
							<option>02:00</option>
							<option>03:00</option>
							<option>04:00</option>
							<option>05:00</option>
							<option>06:00</option>
							<option>07:00</option>
							<option>08:00</option>
							<option>09:00</option>
							<option>10:00</option>
							<option>11:00</option>
							<option>12:00</option>
							<option>13:00</option>
							<option>14:00</option>
							<option>15:00</option>
							<option>16:00</option>
							<option>17:00</option>
							<option>18:00</option>
							<option>19:00</option>
							<option>20:00</option>
							<option>21:00</option>
							<option>22:00</option>
							<option>23:00</option>
						</select>
						<label>반납가능시간</label>
						<select class="Rtime form-control" name="end">
							<option disabled selected>반납시간</option>
							<option>02:00</option>
							<option>03:00</option>
							<option>04:00</option>
							<option>05:00</option>
							<option>06:00</option>
							<option>07:00</option>
							<option>08:00</option>
							<option>09:00</option>
							<option>10:00</option>
							<option>11:00</option>
							<option>12:00</option>
							<option>13:00</option>
							<option>14:00</option>
							<option>15:00</option>
							<option>16:00</option>
							<option>17:00</option>
							<option>18:00</option>
							<option>19:00</option>
							<option>20:00</option>
							<option>21:00</option>
							<option>22:00</option>
							<option>23:00</option>
							<option>24:00</option>
						</select>
					</div>
					<button class="btn greenBtn">검색</button>
				</form>
				
				<div class="cartList">
					<ul class="col-md-12">
						<?php foreach ($data as $key => $v): ?>
						<li class="col-md-6">
							<form action="/post/cart" method="POST">
								<input type="hidden" name="start" value="<?= $start ?>">
								<input type="hidden" name="end" value="<?= $end ?>">
								<input type="hidden" name="begin" value="<?= $begin ?>">
								<input type="hidden" name="arrive" value="<?= $arrive ?>">
								<input type="hidden" name="pro_idx" value="<?= $v['idx'] ?>">					
								<div>
									<img src="/resources/images/<?= $v['image'] ?>" alt="image">
									<p><span>품목명 : </span><?= $v['name'] ?></p>
									<p><span>가격 : </span><?= number_format($v['price']) ?>원</p>
									<p><span>주행거리 : </span><?= $v['distance'] ?>km</p>
									<p><span>최고속도 : </span><?= $v['speed'] ?>km/h</p>
									<p><span>대여가능 수량 : </span>
										<?php if ($search): ?>
										<?= $v['now_quantity'] ?> / <?= $v['quantity'] ?>대
										<?php else: ?>
											검색 후 확인 가능합니다.
										<?php endif ?>
									</p>
									<?php if ($search): ?>
										<button class="btn blueBtn">추가하기</button>
									<?php endif ?>
								</div>

							</form>
						</li>
						<?php endforeach ?>
						<!-- <li class="col-md-6">
							<div>
								<img src="./images/BMW%20C%20%EC%97%90%EB%B3%BC%EB%A3%A8%EC%85%98.png" alt="image">
								<p><span>품목명 : </span>BMW C 에볼루션</p>
								<p><span>가격 : </span>22,000원</p>
								<p><span>주행거리 : </span>160km</p>
								<p><span>최고속도 : </span>120km/h</p>
								<p><span>대여가능 수량 : </span>3 / 3대</p>
								<button class="btn blueBtn">추가하기</button>
							</div>
						</li>
						<li class="col-md-6">
							<div>
								<img src="./images/PM100.jpg" alt="image">
								<p><span>품목명 : </span>PM100</p>
								<p><span>가격 : </span>35,000원</p>
								<p><span>주행거리 : </span>100km</p>
								<p><span>최고속도 : </span>80km/h</p>
								<p><span>대여가능 수량 : </span>3 / 3대</p>
								<button class="btn blueBtn">추가하기</button>
							</div>
						</li>
						<li class="col-md-6">
							<div>
								<img src="./images/YUNBIKE%20C1.jpg" alt="image">
								<p><span>품목명 : </span>YUNBIKE C1</p>
								<p><span>가격 : </span>8,000원</p>
								<p><span>주행거리 : </span>60km</p>
								<p><span>최고속도 : </span>25km/h</p>
								<p><span>대여가능 수량 : </span>8 / 8대</p>
								<button class="btn blueBtn">추가하기</button>
							</div>
						</li>
						<li class="col-md-6">
							<div>
								<img src="./images/%EA%B3%A0%EA%B3%A0%EB%A1%9C2.jpg" alt="image">
								<p><span>품목명 : </span>고고로2</p>
								<p><span>가격 : </span>20,000원</p>
								<p><span>주행거리 : </span>110km</p>
								<p><span>최고속도 : </span>90km/h</p>
								<p><span>대여가능 수량 : </span>6 / 6대</p>
								<button class="btn blueBtn">추가하기</button>
							</div>
						</li>
						<li class="col-md-6">
							<div>
								<img src="./images/%EC%95%8C%ED%86%A4%20%EC%9D%B4%EB%85%B8%EC%A0%A0M.jpg" alt="image">
								<p><span>품목명 : </span>알톤 이노젠M</p>
								<p><span>가격 : </span>8,000원</p>
								<p><span>주행거리 : </span>60km</p>
								<p><span>최고속도 : </span>25km/h</p>
								<p><span>대여가능 수량 : </span>5 / 5대</p>
								<button class="btn blueBtn">추가하기</button>
							</div>
						</li>
						<li class="col-md-6">
							<div>
								<img src="./images/%EC%95%84%EC%9D%B4%EC%98%A4%EB%8B%89%20%EC%9D%BC%EB%A0%89%ED%8A%B8%EB%A6%AD.jpg" alt="image">
								<p><span>품목명 : </span>아이오닉 일렉트릭</p>
								<p><span>가격 : </span>45,000원</p>
								<p><span>주행거리 : </span>20km</p>
								<p><span>최고속도 : </span>165km/h</p>
								<p><span>대여가능 수량 : </span>2 / 2대</p>
								<button class="btn blueBtn">추가하기</button>
							</div>
						</li>
						<li class="col-md-6">
							<div>
								<img src="./images/%EC%89%90%EB%B3%B4%EB%A0%88%20%EB%B3%BC%ED%8A%B8%20EV.jpg" alt="image">
								<p><span>품목명 : </span>쉐보레 볼트 EV</p>
								<p><span>가격 : </span>55,000원</p>
								<p><span>주행거리 : </span>383km</p>
								<p><span>최고속도 : </span>154km/h</p>
								<p><span>대여가능 수량 : </span>7 / 7대</p>
								<button class="btn blueBtn">추가하기</button>
							</div>
						</li> -->
					</ul>
					
					<span class="line">&nbsp;</span>
					
					<div class="baskets">
						<h1 class="title">장바구니</h1>
						<table>
							<tr>
								<th>품목 이미지</th>
								<th>품목명</th>
								<th>대여/반납지점</th>
								<th>대여일(시간)~반납일(시간)</th>
								<th>품목금액</th>
								<th>상세</th>
							</tr>
							<?php $cartTotal = 0; ?>
							<?php foreach ($cart as $key => $v): ?>
								<tr>
									<td><img src="/resources/images/<?= $v['image'] ?>" alt="image"></td>
									<td><?= $v['name'] ?></td>
									<td><?= $v['begin'] ?>/<?= $v['arrive'] ?></td>
									<td><?= $v['start'] ?> ~ <?= $v['end'] ?></td>
									<td><?= number_format($v['priceInfo']['realPay']) ?>원</td>
									<td><a href="/delete/cart/<?= $v['cart_idx'] ?>" class="btn blueBtn">삭제하기</a></td>
									<?php $cartTotal += $v['priceInfo']['realPay'] ?>
								</tr>
							<?php endforeach ?>
							<!-- <tr>
								<td><img src="./images/24%20%ED%8C%AC%ED%85%80%20CITY.jpg" alt="image"></td>
								<td>24 팬텀 CITY</td>
								<td>여수시/순천시</td>
								<td>2018.04.01 10:00 ~ 2018.04.01 12:00</td>
								<td>20,000원</td>
								<td><a href="#" class="btn blueBtn">삭제하기</a></td>
							</tr>
							<tr>
								<td><img src="./images/24%20%ED%8C%AC%ED%85%80%20CITY.jpg" alt="image"></td>
								<td>24 팬텀 CITY</td>
								<td>여수시/순천시</td>
								<td>2018.04.01 10:00 ~ 2018.04.01 12:00</td>
								<td>20,000원</td>
								<td><a href="#" class="btn blueBtn">삭제하기</a></td>
							</tr>
							<tr>
								<td><img src="./images/24%20%ED%8C%AC%ED%85%80%20CITY.jpg" alt="image"></td>
								<td>24 팬텀 CITY</td>
								<td>여수시/순천시</td>
								<td>2018.04.01 10:00 ~ 2018.04.01 12:00</td>
								<td>20,000원</td>
								<td><a href="#" class="btn blueBtn">삭제하기</a></td>
							</tr> -->

						</table>
						<div class="total">
							<p>총 품목금액 <span class="blue">= <?= number_format($cartTotal) ?> 원</span> </p>
							<a href="/multiple" class="btn blueBtn">결제하기</a>
						</div>
					</div>
					
				</div>
				
			</div>
		</div><!--w100-->
	</div><!--content-->
