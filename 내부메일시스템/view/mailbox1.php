	<!-- content -->
	<article id="content">
		<section class="mail-section">

			<div class="mail-content">
						<?php $rec_mail = array_filter($mailAll, function($v) {
							return $v['receive_user'] == USER['idx'];
						}) ?>

						<?php $rec = array_filter($rec_mail, function($v) {
							return $v['owner'] == USER['idx'];
						}) ?>
				<div class="mail-title">
					<div>받은 메일함</div>
					<div>
						<span>받은 메일함 전체 메일 개수 : <?= count(array_filter($rec, function($v) {
							return $v['type'] == "posting" && $v['is_trash'] == "false" && $v['state'] == "posting";
						})) ?>개</span>
					</div>
				</div>

				<form action="/state_post" method="POST">
					
				<div class="mail-skill-btn-group">
					<div class="btn-group">
						<button name="update_btn" value="read" class="btn btn-default">읽음</button>
					</div>
					<div class="btn-group">
						<button name="update_btn" value="trash" class="btn btn-default">삭제</button>
						<button name="update_btn" value="spam" class="btn btn-default">스팸신고</button>
					</div>
					<div class="btn-group">
						<button name="update_btn" value="reply" class="btn btn-default">답장</button>
						<button name="update_btn" value="relay" class="btn btn-default">전달</button>
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
						<?php foreach ($rec as $key => $v): ?>
							<?php if ($v['state'] != 'spam' && $v['is_trash'] == 'false'): ?>
								
								<tr class="<?= $v['is_read'] == "true" ? "read" : "" ?>">
									<td><input type="checkbox" name="mail_idx" value="<?= $v['mail_idx'] ?>"></td>
									<td><?= $v['user_name'] ?></td>
									<td>
										<a href="/view/<?= $v['mail_idx'] ?>"><?= $v['title'] ?></a></td>
									<td><?= $v['date'] ?></td>
									<td><?= rand(0.1, 20) ?></td>
								</tr>
								
							<?php endif ?>
						<?php endforeach ?>
						<!-- <tr>
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

				</form>

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