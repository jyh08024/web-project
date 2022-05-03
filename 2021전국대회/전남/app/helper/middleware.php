<?php 
	function is_user() {
		err(!@USER, "back", "로그인한 회원만 접근 가능합니다.");
	}

	function not_user() {
		err(USER, "back", "로그인한 회원은 접근 할 수 없습니다.");
	}
 ?>