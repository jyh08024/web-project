
	<div id="content">
		<div class="w100">
			<div class="detail">
				<h1 class="title">상세정보</h1>
				
				<div class="details">
					 <img src="/images/<?php echo $data['image'] ?>" alt="image" title="image">
					 
					<table>
						<tr>
							<th>품목명</th>
							<td><?php echo $data['name'] ?></td>
						</tr>
						<tr>
							<th>품목금액</th>
							<td><?php echo number_format($data['price']) ?>원</td>
						</tr>
						<tr>
							<th>주행거리</th>
							<td><?php echo $data['distance'] ?>km</td>
						</tr>
						<tr>
							<th>최고속도</th>
							<td><?php echo $data['speed'] ?>km/h</td>
						</tr>
						<tr>
							<th>충전시간</th>
							<td><?php echo $data['chargTime'] ?>시간</td>
						</tr>
						<tr>
							<th>인승</th>
							<td><?php echo $data['passenger'] ?>인승</td>
						</tr>
						<tr>
							<th>중량</th>
							<td><?php echo $data['weight'] ?>kg</td>
						</tr>
					</table>
					
					<div>
						<a href="/list/<?php echo $data['category'] ?>" class="btn blueBtn">목록</a>
						<a href="/reserve/<?php echo $data['idx'] ?>" class="btn blueBtn">예약하기</a>
					</div>
					
				</div><!--details-->
				
				<div class="detailImg col-md-12">
					<h2 class="title">상세이미지</h2>
					
					<?php if ((USER['id'] ?? '') == "admin"): ?>
						<form action="/addImg" class="file" enctype="multipart/form-data" method="POST">
							<input type="hidden" name="idx" value="<?php echo $data['idx'] ?>">
							<button class="btn blueBtn">사진추가</button>
							<input type="file" name="file">
						</form>
					<?php endif ?>
					
					<ul>
						<?php foreach ($data['detail'] as $key => $value): ?>
							<li class="col-md-3"><img src="/images/<?php echo $value ?>" alt=""></li>
						<?php endforeach ?>
					</ul>
				</div><!--detailImg-->
			</div><!--detail-->
		</div><!--w100-->
	</div><!--content-->
    
	
</body>
</html>