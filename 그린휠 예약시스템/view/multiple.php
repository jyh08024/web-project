	<div id="content">
		<div class="w100">
			<div class="card">			
				<h1 class="title">다중 결제 페이지</h1>
				<form action="/post/multiPay" method="post">
					<ul class="info multiple">
						<?php foreach ($data as $key => $v): ?>
							<input type="hidden" name="cart_idx[]" value="<?= $v['cart_idx'] ?>">
							<li>
								<p>
									<label>품목명: </label>
									<span><?= $v['name'] ?></span>
								</p>
								<p>
									<label>대여/반납일(시간): </label>
									<span><?= $v['start'] ?> ~ <?= $v['end'] ?></span>
								</p>
								<p>
									<label>대여/반납지점: </label>
									<span><?= $v['begin'] ?>/<?= $v['arrive'] ?></span>
								</p>
								<p>
									<label>품목금액: </label>
									<span><?= number_format($v['price']) ?></span> 원
								</p>
								<p>
									<label>할인/할증금액: </label>
									<span><?= number_format(-$v['priceInfo']['sale']) ?></span> 원
								</p>
								<p>
									<label>결제금액: </label>
									<span>= <?= number_format($v['priceInfo']['salePrice']) ?></span> 원
								</p>
								<p>
									<label>회원 할인금액: </label>
									<span>- <?= number_format($v['priceInfo']['userSale']) ?></span> 원
								</p>
								<p>
									<label>총 결제금액: </label>
									<span>= <?= number_format($v['priceInfo']['realPay']) ?></span> 원
								</p>
							</li>

						<?php endforeach ?>
					</ul>

					<input type="hidden" class="pay_type" name="pay_type" value="card">

					<div class="pay">
						<ul class="row">
							<li class="col-md-6 active" onclick="$(`.pay_type`).val('card')"><a href="#cardpay" data-toggle="tab" class="col-md-12 blueBtn">카드결제</a></li>
							<li class="col-md-6" onclick="$(`.pay_type`).val('bank')"><a href="#cashpay" data-toggle="tab" class="check col-md-12">무통장입금</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="cardpay">
								<ul class="cardPay">
									<li>
										<label>카드선택 :</label>
										<input type="radio" name="card" value="농협"><span>농협</span>
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
										<select name="bank" id="">
											<option selected>::은행선택::</option>
											<option value="우리은행">우리은행 : 9876-6543-6543-7890</option>
											<option value="기업은행">기업은행 : 3210-6549-1234</option>
											<option value="농협">농협 : 1234-7891-9876</option>
											<option value="신한은행">신한은행 : 6543-9876-7412</option>
										</select>
									</li>
									<li>
										<label>송금자명 : </label>
										<input type="text" name="send_user" value="<?= USER['name'] ?>" readonly>
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
