	<div id="content">
		<div class="w100">
			<div class="list">
				<h1 class="title">예약 품목 리스트</h1>
				<ul>
					<?php foreach ($listData as $key => $v): ?>
						<li>
							<img src="/resources/images/<?= $v['image'] ?>" alt="image" title="image">
							<h4>이름 : <span><?= $v['name'] ?></span></h4>
							<h4>기본렌탈료 : <span><?= number_format($v['price']) ?></span>원</h4>
							<h4>월, 금 할인/할증률 : <span>0</span>%</h4>
							<h4>화, 수, 목 할인률 : <span>30</span>%</h4>
							<h4>토, 일 할증률 : <span>20</span>%</h4>
							<div class="right">
								<a href="/detail/<?= $v['idx'] ?>" class="btn infor blueBtn">상세정보</a>
								<a href="/reservation/<?= $v['idx'] ?>" class="btn Reserv blueBtn">예약하기</a>
							</div>
						</li>
					<?php endforeach ?>
					<!-- <li>
						<img src="images/24%20%ED%8C%AC%ED%85%80%20CITY.jpg" alt="image" title="image">
						<h4>이름 : <span>24 팬텀 CITY</span></h4>
						<h4>기본렌탈료 : <span>10,000</span>원</h4>
						<h4>월, 금 할인/할증률 : <span>0</span>%</h4>
						<h4>화, 수, 목 할인률 : <span>30</span>%</h4>
						<h4>토, 일 할증률 : <span>20</span>%</h4>

						<div class="right">
							<a href="detail.html" class="btn infor blueBtn">상세정보</a>
							<a href="reservation.html" class="btn Reserv blueBtn">예약하기</a>
						</div>
					</li>
					<li>
						<img src="images/24%20%ED%8C%AC%ED%85%80%20CITY.jpg" alt="image" title="image">
						<h4>이름 : <span>24 팬텀 CITY</span></h4>
						<h4>기본렌탈료 : <span>10,000</span>원</h4>
						<h4>월, 금 할인/할증률 : <span>0</span>%</h4>
						<h4>화, 수, 목 할인률 : <span>30</span>%</h4>
						<h4>토, 일 할증률 : <span>20</span>%</h4>

						<div class="right">
							<a href="detail.html" class="btn infor blueBtn">상세정보</a>
							<a href="reservation.html" class="btn Reserv blueBtn">예약하기</a>
						</div>
					</li>
					<li>
						<img src="images/24%20%ED%8C%AC%ED%85%80%20CITY.jpg" alt="image" title="image">
						<h4>이름 : <span>24 팬텀 CITY</span></h4>
						<h4>기본렌탈료 : <span>10,000</span>원</h4>
						<h4>월, 금 할인/할증률 : <span>0</span>%</h4>
						<h4>화, 수, 목 할인률 : <span>30</span>%</h4>
						<h4>토, 일 할증률 : <span>20</span>%</h4>

						<div class="right">
							<a href="detail.html" class="btn infor blueBtn">상세정보</a>
							<a href="reservation.html" class="btn Reserv blueBtn">예약하기</a>
						</div>
					</li> -->
					<!--<li>-->
						<!--<img src="images/24%20%ED%8C%AC%ED%85%80%20CITY.jpg" alt="image" title="image">-->
						<!--<h4>이름 : <span>24 팬텀 CITY</span></h4>-->
						<!--<h4>기본렌탈료 : <span>10,000</span>원</h4>-->
						<!--<h4>월,금 할인/할증률 : <span>0</span>%</h4>-->
						<!--<h4>화,수,목 할인률 : <span>30</span>%</h4>-->
						<!--<h4>토,일 할증률 : <span>20</span>%</h4>-->
						<!--<h4 class="last">대여가능 수량 : <span>10</span> / 10 대</h4>-->
						<!---->
						<!--<div class="right">-->
							<!--<a href="detail.html" class="btn infor blueBtn">상세정보</a>-->
							<!--<a href="reservation.html" class="btn Reserv blueBtn">예약하기</a>-->
						<!--</div>-->
					<!--</li>-->
					<!--<li>-->
						<!--<img src="images/24%20%ED%8C%AC%ED%85%80%20CITY.jpg" alt="image" title="image">-->
						<!--<h4>이름 : <span>24 팬텀 CITY</span></h4>-->
						<!--<h4>기본렌탈료 : <span>10,000</span>원</h4>-->
						<!--<h4>월,금 할인/할증률 : <span>0</span>%</h4>-->
						<!--<h4>화,수,목 할인률 : <span>30</span>%</h4>-->
						<!--<h4>토,일 할증률 : <span>20</span>%</h4>-->
						<!--<h4 class="last">대여가능 수량 : <span>10</span> / 10 대</h4>-->
						<!---->
						<!--<div class="right">-->
							<!--<a href="detail.html" class="btn infor blueBtn">상세정보</a>-->
							<!--<a href="reservation.html" class="btn Reserv blueBtn">예약하기</a>-->
						<!--</div>-->
					<!--</li>-->
					<!--<li>-->
						<!--<img src="images/24%20%ED%8C%AC%ED%85%80%20CITY.jpg" alt="image" title="image">-->
						<!--<h4>이름 : <span>24 팬텀 CITY</span></h4>-->
						<!--<h4>기본렌탈료 : <span>10,000</span>원</h4>-->
						<!--<h4>월,금 할인/할증률 : <span>0</span>%</h4>-->
						<!--<h4>화,수,목 할인률 : <span>30</span>%</h4>-->
						<!--<h4>토,일 할증률 : <span>20</span>%</h4>-->
						<!--<h4 class="last">대여가능 수량 : <span>10</span> / 10 대</h4>-->
												<!---->
						<!--<div class="right">-->
							<!--<a href="detail.html" class="btn infor blueBtn">상세정보</a>-->
							<!--<a href="reservation.html" class="btn Reserv blueBtn">예약하기</a>-->
						<!--</div>-->
					<!--</li>-->
					
				</ul>
				
			</div><!--list-->
		</div><!--w100-->
	</div><!--content-->
	
