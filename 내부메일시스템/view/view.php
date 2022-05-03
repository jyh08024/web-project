	<!-- content -->
	<article id="content">
		<section class="mail-section">
			
			<div class="mail-content">
				<div class="mail-title">메일 보기</div>
				<div class="mail-write">
					<div class="form-group input-group">
						<h3 class="content-title"><?= $mail_con['title'] ?></h3>
					</div>
					<div class="form-group input-group">
           	<p class="content-title"><?= $mail_con['acc_time'] ?></p>
					</div>
					<div class="form-group">
						<p>
							<?php 
								$content = $mail_con['content'];

						    $a = "/&lt;(\/?(a|img)(.*?))&gt;/u";
						    		//정규식에 돌려서 만약 a태그나 img태그면 콜백해서 띄우고 아님 htmlspecialchars_decode로 그냥 문자로 띄움
								echo preg_replace_callback([$a], function($a) {
									return htmlspecialchars_decode($a[0]);
								}, nl2br(htmlspecialchars($content, ENT_NOQUOTES)));
							?>

						</p>
						<br><br><br><br><br>
						<strong>파일 :</strong><br>
						<?php foreach ($file as $key => $v): ?>
							<a href="/download/<?= $v['idx'] ?>" class="download-file"><?= $v['name'] ?> (<?= floor($v['size'] / 1024 ** 2) ?>MB)</a>
						<?php endforeach ?>
						<!-- <a href="#" class="download-file">다운로드.png (15MB)</a> -->
						<!-- <a href="#" class="download-file">다운로드.hwp (15MB)</a> -->
						<!-- <a href="#" class="download-file">다운로드.html (15MB)</a> -->
					</div>
				</div>
			</div>
		</section>
		<aside class="search-aside">
		</aside>
	</article>
