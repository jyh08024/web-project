	
	<div id="content">
		<div class="w100">
			<div class="card">			
				<h1 class="title">결제 페이지</h1>
				<form action="/cardPay" method="post">
					<input type="hidden" name="type" class="cardType" value="card">
					<input type="hidden" name="reserve_idx" value="<?php echo $data['idx'] ?>">
					<ul class="info">
						<li>
							<label>품목명 :</label>
							<span><?php echo $data['info']['name'] ?></span>
						</li>
						<li>
							<label>렌탈일(시간) :</label>
							<span><?php echo $data['start'] ?> ~ <?php echo $data['end'] ?></span>
						</li>
						<li>
							<label>렌탈/반납지점</label>
							<span><?php echo $data['start_place'] ?>/<?php echo $data['end_place'] ?></span>
						</li>
						<li>
							<label>품목금액 :</label>
							<span><?php echo number_format($data['pay']['ori']) ?></span> 원
						</li>
						<li>
							<label>할인/할증금액 :</label>
							<span><?php echo number_format(-$data['pay']['sale']) ?></span> 원
						</li>
						<li>
							<label>결제금액 :</label>
							<span>= <?php echo number_format($data['pay']['salePay']) ?></span> 원
						</li>
						<li>
							<label>회원 할인금액 :</label>
							<span><?php echo number_format(-$data['pay']['member']) ?></span> 원
						</li>
						<li>
							<label>총 결제금액 :</label>
							<h2>= <?php echo number_format($data['pay']['realPay']) ?></h2> 원
						</li>
					</ul>
					
					<div class="pay">
						<ul class="row">
							<style type="text/css">
								.active > a {
									background: #0090d0 !important;
								}
							</style>
							<li onclick="$('.cardType').val('card')" class="col-md-6 active"><a href="#cardpay" data-toggle="tab" class="col-md-12">카드결제</a></li>
							<li onclick="$('.cardType').val('mu')" class="col-md-6"><a href="#cashpay" data-toggle="tab" class="check col-md-12">무통장입금</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="cardpay">
								<ul class="cardPay">
									<li>
										<label>카드선택 :</label>
										<input type="radio" name="card" value="농협" checked=""><span>농협</span>
										<input type="radio" name="card" value="하나"><span>하나</span>
										<input type="radio" name="card" value="신한"><span>신한</span>
										<input type="radio" name="card" value="국민"><span>국민</span>
										<input type="radio" name="card" value="우리"><span>우리</span>
									</li>
									<li>
										<label>카드번호 :</label>
										<input type="text" maxlength="16" name="cardNum" size="30" id="cardNum">
										<span class="ex">카드번호 16자리</span>
									</li>
								</ul>
							</div><!--cardpay-->
							
							<div role="tabpanel" class="tab-pane" id="cashpay">
								<ul class="cashPay">
									<li>
										<label>입금은행 : </label>
										<select name="bank" id="bank">
											<option value="" selected>::은행선택::</option>
											<option>우리은행 : 9876-6543-6543-7890</option>
											<option>기업은행 : 3210-6549-1234</option>
											<option>농협 : 1234-7891-9876</option>
											<option>신한은행 : 6543-9876-7412</option>
										</select>
									</li>
									<li>
										<label>송금자명 : </label>
										<input type="text" name="sender" value="<?php echo USER['name'] ?>" readonly>
									</li>
									<li>
										<label>전화번호 : </label>
										<input type="text" maxlength="11" name="phone" size="30" id="phone">
									</li>
								</ul>
							</div><!--cashpay-->
						</div><!--tab-content-->
					</div><!--pay-->
					<button class="btn blueBtn payment">결제하기</button>
				</form>
			</div><!--card-->
		</div><!--w100-->
	</div><!--content-->
</body>
</html>