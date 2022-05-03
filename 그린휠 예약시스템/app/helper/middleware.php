<?php 
	function is_user() {
		err(@!USER, "back", "로그인한 회원만 접근가능한 페이지입니다.");
	}

	function not_user() {
		err(USER, "/", "로그인한 회원은 접근 불가능한 페이지입니다.");
	}

	function is_owner() {
		err(USER['level'] == "admin", "/", "관리자는 접근할 수 없는 페이지입니다.");
	}

	function not_owner() {
		err(USER['id'] != "admin", "back", "관리자만 접근 가능한 페이지입니다.");
	}
 ?>