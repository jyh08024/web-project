<?php 
	function is_user() {
		err(USER, "back", "로그인한 회원은 접근할 수 없는 페이지입니다.");
	}

	function not_user() {
		err(!USER, "back", "비회원은 접근 불가능한 페이지입니다.");
	}
 ?>