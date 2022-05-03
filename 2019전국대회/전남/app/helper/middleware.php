<?php 
	function isUser() {
		err(!USER, "/", "로그인한 회원만 접근 가능합니다.");
	}

	function nor() {
		err(USER['user_id'] == "admin", "/", "일반회원만 접근가능합니다.");
	}
 ?>