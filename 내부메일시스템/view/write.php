

	<!-- content -->
	<form action="/write_post" method="POST" enctype="multipart/form-data" class="write_form" id="write_form">
		
	<article id="content">
		<section class="mail-section">
			<div class="mail-content">
				<div class="mail-title">메일쓰기</div>
				<div class="mail-skill-btn-group">
					<div class="btn-group">
						<button type="submit" class="btn btn-default" name="type" value="posting">보내기</button>
					</div>
					<div class="btn-group">
						<a class="btn btn-default">미리보기</a>
					</div>
					<div class="btn-group">
						<button type="submit" class="btn btn-default" name="type" value="temp">임시저장</button>
					</div>
				</div>
				<div class="mail-write">
					<div class="form-group input-group">
						<label for="">받는 사람</label>
						<input type="text" class='form-control' name="receive_user">
					</div>
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
		</section>
		<aside class="search-aside">
		</aside>
	</article>

	</form>

<!-- <script>
	temp_btn.onclick = function(){
		write_form.action = "/write_temp"
	}
</script> -->