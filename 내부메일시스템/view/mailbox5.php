

	<!-- content -->
	<article id="content">
		<section class="mail-section">
			<?php $my_mail = array_filter($mailAll, function($v) {
				return $v['owner'] == USER['idx'];
			}) ?>
			<div class="mail-content">
				<div class="mail-title">
					<div>내게쓴메일함</div>
					<div>
						<span>내게쓴메일함 전체 메일 개수 : <?= count(array_filter($my_mail, function($v) {
							return $v['type'] == "self";
						})) ?></span>
					</div>
				</div>
				<div class="mail-skill-btn-group">
					<div class="btn-group">
						<a class="btn btn-default">삭제</a>
					</div>
					<div class="btn-group">
						<a class="btn btn-default">전달</a>
					</div>
				</div>
				<table class="table">
					<thead>
						<tr>
							<th><input type="checkbox"></th>
							<th>보낸사람</th>
							<th>제목</th>
							<th>날짜</th>	
							<th>크기</th>
						</tr>
					</thead>
					<tbody>

						<?php foreach ($my_mail as $key => $v): ?>
							<?php if ($v['type'] == "self"): ?>

						<tr>
							<td><input type="checkbox"></td>
							<td><?= $v['user_name'] ?></td>
							<td><?= $v['title'] ?></td>
							<td><?= $v['date'] ?></td>	
							<td><?= rand(0.1, 15) ?></td>
						</tr>

							<?php endif ?>
						<?php endforeach ?>
<!-- 						<tr>
							<td><input type="checkbox"></td>
							<td>유저1</td>
							<td>유저1은 기능대회를 열심히 준비했습니다.</td>
							<td>2018-04-03</td>	
							<td>13.7KB</td>
						</tr>
						<tr>
							<td><input type="checkbox"></td>
							<td>유저1</td>
							<td>유저1은 기능대회를 열심히 준비했습니다.</td>
							<td>2018-04-03</td>	
							<td>13.7KB</td>
						</tr>
						<tr>
							<td><input type="checkbox"></td>
							<td>유저1</td>
							<td>유저1은 기능대회를 열심히 준비했습니다.</td>
							<td>2018-04-03</td>	
							<td>13.7KB</td>
						</tr>
						<tr>
							<td><input type="checkbox"></td>
							<td>유저1</td>
							<td>유저1은 기능대회를 열심히 준비했습니다.</td>
							<td>2018-04-03</td>	
							<td>13.7KB</td>
						</tr>
						<tr>
							<td><input type="checkbox"></td>
							<td>유저1</td>
							<td>유저1은 기능대회를 열심히 준비했습니다.</td>
							<td>2018-04-03</td>	
							<td>13.7KB</td>
						</tr>
						<tr>
							<td><input type="checkbox"></td>
							<td>유저1</td>
							<td>유저1은 기능대회를 열심히 준비했습니다.</td>
							<td>2018-04-03</td>	
							<td>13.7KB</td>
						</tr>
						<tr>
							<td><input type="checkbox"></td>
							<td>유저1</td>
							<td>유저1은 기능대회를 열심히 준비했습니다.</td>
							<td>2018-04-03</td>	
							<td>13.7KB</td>
						</tr>
						<tr>
							<td><input type="checkbox"></td>
							<td>유저1</td>
							<td>유저1은 기능대회를 열심히 준비했습니다.</td>
							<td>2018-04-03</td>	
							<td>13.7KB</td>
						</tr>
						<tr>
							<td><input type="checkbox"></td>
							<td>유저1</td>
							<td>유저1은 기능대회를 열심히 준비했습니다.</td>
							<td>2018-04-03</td>	
							<td>13.7KB</td>
						</tr> -->
					</tbody>
				</table>
			</div>
		</section>
		<aside class="search-aside">
			<div class="form-group">
				<h4 class="search-title">검색 영역</h4>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" placeholder="검색">
			</div>
			<div class="form-group">
				<h4 class="search-subtitle">날짜</h4>
			</div>
			<div class="form-group">
				<label for=""><small>시작 날짜</small></label>
				<input type="date" class="form-control">
			</div>
			<div class="form-group">
				<label for=""><small>끝 날짜</small></label>
				<input type="date" class="form-control">
			</div>
			<div class="form-group">
				<button class="search-btn">검색</button>
			</div>
		</aside>
	</article>
	<!-- //content -->

