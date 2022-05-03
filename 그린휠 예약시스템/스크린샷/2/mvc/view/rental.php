				<form action="" method="GET">
	<div id="content">
		<div class="w100">
			<div class="cart">
					<div class="search form-inline">
						<label>품목구분</label>
						<select class="form-control" name="category" id="category" required="">
							<option value="" disabled="" selected>품목구분</option>
							<option data-category="자전거" value="전기자전거">전기자전거</option>
							<option data-category="자전거" value="미니전기자동차">미니전기자동차</option>
							<option data-category="자전거" value="전기스쿠터">전기스쿠터</option>
							<option data-category="자동차" value="전기자동차">전기자동차</option>
							<option data-category="자동차" value="장거리전기자동차">장거리전기자동차</option>
						</select>
						<?php if ($_GET['category'] ?? ''): ?>
							<script type="text/javascript">
								$(function() {
									$("#category").val("<?php echo $_GET['category'] ?>");
									$("#category").change();
								});
							</script>
						<?php endif ?>
						<?php if (!($_GET['category'] ?? '')): ?>
							<script type="text/javascript">
								$(function() {
									$("#category").val('')
									
								})
							</script>
						<?php endif ?>
						<label>대여지점</label>
							<select name="start_place" id="placeS" class="place" required="">
									<option value="" selected>대여지점</option>
									<option <?php echo (($_GET['start_place'] ?? '') == "여수시") ? "selected" : "" ?> value="여수시">여수시</option>
									<option <?php echo (($_GET['start_place'] ?? '') == "순천시") ? "selected" : "" ?> value="순천시">순천시</option>
									<option <?php echo (($_GET['start_place'] ?? '') == "목포시") ? "selected" : "" ?> value="목포시">목포시</option>
									<option <?php echo (($_GET['start_place'] ?? '') == "담양군") ? "selected" : "" ?> value="담양군">담양군</option>
									<option <?php echo (($_GET['start_place'] ?? '') == "보성군") ? "selected" : "" ?> value="보성군">보성군</option>
									<option <?php echo (($_GET['start_place'] ?? '') == "완도군") ? "selected" : "" ?> value="완도군">완도군</option>
									<option <?php echo (($_GET['start_place'] ?? '') == "해남군") ? "selected" : "" ?> value="해남군">해남군</option>
									<option <?php echo (($_GET['start_place'] ?? '') == "구례군") ? "selected" : "" ?> value="구례군">구례군</option>
								</select>
								<label>반납지점</label>
								<select name="end_place" id="placeE" class="place" required="">
									<option value="" selected>반납지점</option>
									<option <?php echo (($_GET['end_place'] ?? '') == "여수시") ? "selected" : "" ?> value="여수시">여수시</option>
									<option <?php echo (($_GET['end_place'] ?? '') == "순천시") ? "selected" : "" ?> value="순천시">순천시</option>
									<option <?php echo (($_GET['end_place'] ?? '') == "목포시") ? "selected" : "" ?> value="목포시">목포시</option>
									<option <?php echo (($_GET['end_place'] ?? '') == "담양군") ? "selected" : "" ?> value="담양군">담양군</option>
									<option <?php echo (($_GET['end_place'] ?? '') == "보성군") ? "selected" : "" ?> value="보성군">보성군</option>
									<option <?php echo (($_GET['end_place'] ?? '') == "완도군") ? "selected" : "" ?> value="완도군">완도군</option>
									<option <?php echo (($_GET['end_place'] ?? '') == "해남군") ? "selected" : "" ?> value="해남군">해남군</option>
									<option <?php echo (($_GET['end_place'] ?? '') == "구례군") ? "selected" : "" ?> value="구례군">구례군</option>
								</select>
						<div class="form-group div-category" data-category="자동차" style="display: none;">
							<?php if (($_GET['category'] ?? '') && $type == "기간"): ?>
								<label>대여가능일</label>
								<input type="text" id="start2" name="start" class="form-control" readonly="" value="<?php echo $_GET['start'] ?? '' ?>">
								<label>반납가능일</label>
								<input type="text" id="end2" name="end" class="form-control" readonly="" value="<?php echo $_GET['end'] ?? '' ?>">
							<?php else: ?>
								<label>대여가능일</label>
								<input type="text" id="start2" name="start" class="form-control" readonly="" value="">
								<label>반납가능일</label>
								<input type="text" id="end2" name="end" class="form-control" readonly="" value="">
							<?php endif ?>
						</div>
						<div class="form-group div-category" data-category="자전거">
							<label>대여가능시간</label>
							<select class="Rtime form-control" name="start">
								<option value="" selected>대여시간</option>
								<option <?php echo (($_GET['start'] ?? '') == "01:00") ? 'selected' : ''; ?> >01:00</option>
								<option <?php echo (($_GET['start'] ?? '') == "02:00") ? 'selected' : ''; ?> >02:00</option>
								<option <?php echo (($_GET['start'] ?? '') == "03:00") ? 'selected' : ''; ?> >03:00</option>
								<option <?php echo (($_GET['start'] ?? '') == "04:00") ? 'selected' : ''; ?> >04:00</option>
								<option <?php echo (($_GET['start'] ?? '') == "05:00") ? 'selected' : ''; ?> >05:00</option>
								<option <?php echo (($_GET['start'] ?? '') == "06:00") ? 'selected' : ''; ?> >06:00</option>
								<option <?php echo (($_GET['start'] ?? '') == "07:00") ? 'selected' : ''; ?> >07:00</option>
								<option <?php echo (($_GET['start'] ?? '') == "08:00") ? 'selected' : ''; ?> >08:00</option>
								<option <?php echo (($_GET['start'] ?? '') == "09:00") ? 'selected' : ''; ?> >09:00</option>
								<option <?php echo (($_GET['start'] ?? '') == "10:00") ? 'selected' : ''; ?> >10:00</option>
								<option <?php echo (($_GET['start'] ?? '') == "11:00") ? 'selected' : ''; ?> >11:00</option>
								<option <?php echo (($_GET['start'] ?? '') == "12:00") ? 'selected' : ''; ?> >12:00</option>
								<option <?php echo (($_GET['start'] ?? '') == "13:00") ? 'selected' : ''; ?> >13:00</option>
								<option <?php echo (($_GET['start'] ?? '') == "14:00") ? 'selected' : ''; ?> >14:00</option>
								<option <?php echo (($_GET['start'] ?? '') == "15:00") ? 'selected' : ''; ?> >15:00</option>
								<option <?php echo (($_GET['start'] ?? '') == "16:00") ? 'selected' : ''; ?> >16:00</option>
								<option <?php echo (($_GET['start'] ?? '') == "17:00") ? 'selected' : ''; ?> >17:00</option>
								<option <?php echo (($_GET['start'] ?? '') == "18:00") ? 'selected' : ''; ?> >18:00</option>
								<option <?php echo (($_GET['start'] ?? '') == "19:00") ? 'selected' : ''; ?> >19:00</option>
								<option <?php echo (($_GET['start'] ?? '') == "20:00") ? 'selected' : ''; ?> >20:00</option>
								<option <?php echo (($_GET['start'] ?? '') == "21:00") ? 'selected' : ''; ?> >21:00</option>
								<option <?php echo (($_GET['start'] ?? '') == "22:00") ? 'selected' : ''; ?> >22:00</option>
								<option <?php echo (($_GET['start'] ?? '') == "23:00") ? 'selected' : ''; ?> >23:00</option>
							</select>
							<label>반납가능시간</label>
							<select class="Rtime form-control" name="end">
								<option value="" selected>반납시간</option>
								<option <?php echo (($_GET['end'] ?? '') == "02:00") ? "selected" : ""; ?>>02:00</option>
								<option <?php echo (($_GET['end'] ?? '') == "03:00") ? "selected" : ""; ?>>03:00</option>
								<option <?php echo (($_GET['end'] ?? '') == "04:00") ? "selected" : ""; ?>>04:00</option>
								<option <?php echo (($_GET['end'] ?? '') == "05:00") ? "selected" : ""; ?>>05:00</option>
								<option <?php echo (($_GET['end'] ?? '') == "06:00") ? "selected" : ""; ?>>06:00</option>
								<option <?php echo (($_GET['end'] ?? '') == "07:00") ? "selected" : ""; ?>>07:00</option>
								<option <?php echo (($_GET['end'] ?? '') == "08:00") ? "selected" : ""; ?>>08:00</option>
								<option <?php echo (($_GET['end'] ?? '') == "09:00") ? "selected" : ""; ?>>09:00</option>
								<option <?php echo (($_GET['end'] ?? '') == "10:00") ? "selected" : ""; ?>>10:00</option>
								<option <?php echo (($_GET['end'] ?? '') == "11:00") ? "selected" : ""; ?>>11:00</option>
								<option <?php echo (($_GET['end'] ?? '') == "12:00") ? "selected" : ""; ?>>12:00</option>
								<option <?php echo (($_GET['end'] ?? '') == "13:00") ? "selected" : ""; ?>>13:00</option>
								<option <?php echo (($_GET['end'] ?? '') == "14:00") ? "selected" : ""; ?>>14:00</option>
								<option <?php echo (($_GET['end'] ?? '') == "15:00") ? "selected" : ""; ?>>15:00</option>
								<option <?php echo (($_GET['end'] ?? '') == "16:00") ? "selected" : ""; ?>>16:00</option>
								<option <?php echo (($_GET['end'] ?? '') == "17:00") ? "selected" : ""; ?>>17:00</option>
								<option <?php echo (($_GET['end'] ?? '') == "18:00") ? "selected" : ""; ?>>18:00</option>
								<option <?php echo (($_GET['end'] ?? '') == "19:00") ? "selected" : ""; ?>>19:00</option>
								<option <?php echo (($_GET['end'] ?? '') == "20:00") ? "selected" : ""; ?>>20:00</option>
								<option <?php echo (($_GET['end'] ?? '') == "21:00") ? "selected" : ""; ?>>21:00</option>
								<option <?php echo (($_GET['end'] ?? '') == "22:00") ? "selected" : ""; ?>>22:00</option>
								<option <?php echo (($_GET['end'] ?? '') == "23:00") ? "selected" : ""; ?>>23:00</option>
								<option <?php echo (($_GET['end'] ?? '') == "24:00") ? "selected" : ""; ?>>24:00</option>
							</select>
						</div>
						<button class="btn greenBtn">검색</button>
					</div>
				</form>

				
				<div class="cartList">
					<ul class="col-md-12">
						<?php foreach ($list as $key => $value): ?>
							<form action="/addMemo" method="POST">
								<input type="hidden" name="start_place" value="<?php echo $start_place ?>">
								<input type="hidden" name="end_place" value="<?php echo $end_place ?>">
								<input type="hidden" name="start" value="<?php echo $start ?>">
								<input type="hidden" name="end" value="<?php echo $end ?>">
								<input type="hidden" name="info_idx" value="<?php echo $value['idx'] ?>">
								<li class="col-md-6">
									<div>
										<img src="/images/<?php echo $value['image'] ?>" alt="image">
										<p><span>품목명 : </span><?php echo $value['name'] ?></p>
										<p><span>가격 : </span><?php echo number_format($value['price']) ?>원</p>
										<p><span>주행거리 : </span><?php echo $value['distance'] ?>km</p>
										<p><span>최고속도 : </span><?php echo $value['speed'] ?>km/h</p>
										<p>
											<span>대여가능 수량 : </span>
											<?php if (!($_GET['start'] ?? '')): ?>
												검색 후 확인 가능합니다.
											<?php else: ?>
												<?php echo $value['curQuan'] < 0 ? 0 : $value['curQuan'] ?> / <?php echo $value['quantity'] ?>대
											<?php endif ?>
										</p>
										<?php if (isset($value['curQuan']) && ($value['curQuan'] > 0) ): ?>
											<button class="btn blueBtn">추가하기</button>
										<?php endif ?>
									</div>
								</li>
							</form>
						<?php endforeach ?>
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
							<?php $price = 0 ?>
							<?php foreach ($memo as $key => $value): ?>
								<tr>
									<td><img src="/images/<?php echo $value['info']['image'] ?>" alt="image"></td>
									<td><?php echo $value['info']['name'] ?></td>
									<td><?php echo $value['start_place'] ?>/<?php echo $value['end_place'] ?></td>
									<td><?php echo $value['start'] ?> ~ <?php echo $value['end'] ?></td>
									<td><?php echo number_format($value['pay']['ori']) ?>원</td>
									<td><a href="/delMemo/<?php echo $value['idx'] ?>" class="btn blueBtn">삭제하기</a></td>
								</tr>
								<?php $price += $value['pay']['ori'] ?>
							<?php endforeach ?>

						</table>
						<div class="total">
							<p>총 품목금액 <span class="blue">= <?php echo number_format($price) ?> 원</span> </p>
							<a href="/multiple" class="btn blueBtn">결제하기</a>
						</div>
					</div>
					
				</div>
				
			</div>
		</div><!--w100-->
	</div><!--content-->
	
</body>
</html>