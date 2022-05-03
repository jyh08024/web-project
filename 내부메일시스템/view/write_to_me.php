	<!-- content -->
	<article id="content">
		<section class="mail-section">
			<form action="/write_post" method="POST" enctype="multipart/form-data">
				
			<div class="mail-content">
				<div class="mail-title">내게쓰기</div>
				<div class="mail-skill-btn-group">
					<div class="btn-group">
						<button name="type" value="self" class="btn btn-default">저장</button>
					</div>
					<div class="btn-group">
						<button class="btn btn-default" name="type" value="temp">임시저장</button>
					</div>
				</div>
				<div class="mail-write">
					<div class="form-group input-group">
						<label for="">제목</label>
						<input type="text" class='form-control' name="title">
					</div>
					<div class="form-group input-group">
						<label for="">파일첨부</label>
						<input type="file" class='form-control' multiple name="files[]">
					</div>
					<div class="form-group">
						<textarea class="form-control" name="content"></textarea>
					</div>
				</div>
			</div>

			</form>
		</section>
		<aside class="search-aside">
		</aside>
	</article>