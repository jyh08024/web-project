	<div id="content">
		<div class="w100">
			<div class="reserv">
				<h1 class="title">예약하기</h1>
				<div class="col-md-4">
					<img src="/resources/images/<?= $data['image'] ?>" alt="image" title="image">
				</div>

				<div class="col-md-8 choose">
					<form action="/order" method="post">
						<?php if ($data['category'] == "전기자동차" || $data['category'] == "장거리전기자동차"): ?>
							<div class="date">
								<h3>기간</h3>
								<input type="text" name="start" id="start" placeholder="대여일">
								
								<input type="text" name="end" id="end" placeholder="반납일">
							</div><!--date-->
						<?php endif ?>

						<?php if ($data['category'] != "전기자동차" && $data['category'] != "장거리전기자동차"): ?>
							<div class="time">
								<h3>시간</h3>
								<select name="start" id="">
									<option selected value="">대여시간</option>
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
								<select name="end" id="">
									<option selected value="">반납시간</option>
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
							</div><!--time-->
						<?php endif ?>
						
						<div class="place">
							<h3>지점</h3>
							<select name="begin" id="">
								<option value="" selected>대여지점</option>
								<option>여수시</option>
								<option>순천시</option>
								<option>목포시</option>
								<option>담양군</option>
								<option>보성군</option>
								<option>완도군</option>
								<option>해남군</option>
								<option>구례군</option>
							</select>
							<select name="arrive" id="">
								<option value="" selected>반납지점</option>
								<option>여수시</option>
								<option>순천시</option>
								<option>목포시</option>
								<option>담양군</option>
								<option>보성군</option>
								<option>완도군</option>
								<option>해남군</option>
								<option>구례군</option>
							</select>
						</div><!--place-->

						<input type="hidden" name="type" value="<?= $data['category'] == "전기자동차" || $data['category'] == "장거리전기자동차" ?  "date" : "time" ?>">
						<input type="hidden" name="pro_idx" value="<?= $data['idx'] ?>">
						
						<button class="btn blueBtn">결제하기</button>
					</form>
				</div><!--choose-->
			</div><!--reserv-->
		</div><!--w100-->
	</div><!--content-->
