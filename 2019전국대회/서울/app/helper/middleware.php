<?php 
	function user() {
		err(USER, "/", "로그인한 사용자는 접근할 수 없습니다.");
	}

	function guest() {
		err(!USER, "/", "비회원은 접근할 수 없습니다.");
	}
 ?>