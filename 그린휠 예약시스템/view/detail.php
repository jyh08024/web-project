	<div id="content">
		<div class="w100">
			<div class="detail">
				<h1 class="title">상세정보</h1>
				
				<div class="details">
					 <img src="/resources/images/<?= $data['image'] ?>" alt="image" title="image">
					 
					<table>
						<tr>
							<th>품목명</th>
							<td><?= $data['name'] ?></td>
						</tr>
						<tr>
							<th>품목금액</th>
							<td><?= number_format($data['price']) ?>원</td>
						</tr>
						<tr>
							<th>주행거리</th>
							<td><?= $data['distance'] ?>km</td>
						</tr>
						<tr>
							<th>최고속도</th>
							<td><?= $data['speed'] ?>km/h</td>
						</tr>
						<tr>
							<th>충전시간</th>
							<td><?= $data['chargTime'] ?>시간</td>
						</tr>
						<tr>
							<th>인승</th>
							<td><?= $data['passenger'] ?>인승</td>
						</tr>
						<tr>
							<th>중량</th>
							<td><?= $data['weight'] ?>kg</td>
						</tr>
					</table>
					
					<div>
						<a href="/list/<?= $data['category'] ?>" class="btn blueBtn">목록</a>
						<a href="/reservation/<?= $data['idx'] ?>" class="btn blueBtn">예약하기</a>
					</div>
					
				</div><!--details-->
				
				<div class="detailImg col-md-12">
					<h2 class="title">상세이미지</h2>
					
					<?php if (@USER['level'] == "admin"): ?>
					<form action="/post/detailImg/<?= $data['idx'] ?>" method="POST" enctype="multipart/form-data" class="file">
						<button class="btn blueBtn">사진추가</button>
						<input type="file" name="image" required="">
					</form>
					<?php endif ?>
					<ul>
						<?php foreach ($data['detail_img'] as $key => $v): ?>
							<li class="col-md-3"><img src="/resources/images/<?= $v ?>" alt=""></li>
						<?php endforeach ?>
					</ul>
				</div><!--detailImg-->
			</div><!--detail-->
		</div><!--w100-->
	</div><!--content-->
