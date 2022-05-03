			<aside class="mail-aside" style="z-index: 99999999999999;">
				<div class="mail-btn-group">
					<a href="/write" class="mail-btn">메일쓰기</a>
					<a href="/write_me" class="mail-btn">내게쓰기</a>
				</div>
				<?php $rec_mail = array_filter($mailAll, function($v) {
					return $v['receive_user'] == USER['idx'];
				}) ?>

				<?php $rec = array_filter($rec_mail, function($v) {
					return $v['owner'] == USER['idx'];
				}) ?>

				<?php $none_read = array_filter($rec, function($v) {
					return $v['is_read'] == 'false';
				}) ?>

				<?php $uri = $_SERVER['REQUEST_URI'] ?>

				<ul class="mail-menu">
					<li class="<?= $uri == "/receive_mail" ? 'active' : '' ?>">
						<a href="/receive_mail">받은 메일함 <span><?= count($none_read) ?></span></a>
					</li>
					<li class="<?= $uri == "/spam_mail" ? 'active' : '' ?>">
						<a href="/spam_mail">스팸 메일함 <span></span></a>
					</li>
					<li class="<?= $uri == "/sending_mail" ? 'active' : '' ?>">
						<a href="/sending_mail">보낸 메일함</a>
					</li>
					<li class="<?= $uri == "/temp_mail" ? 'active' : '' ?>">
						<a href="/temp_mail">임시 메일함</a>
					</li>
					<li class="<?= $uri == "/self_mail" ? 'active' : '' ?>">
						<a href="/self_mail">내게쓴메일함</a>
					</li>
					<li class="<?= $uri == "/trash_mail" ? 'active' : '' ?>">
						<a href="/trash_mail">휴지통 <span></span></a>
					</li>
				</ul>
			</aside>