<?php 
	function isUser() {
		err(!@USER, "back", "로그인한 회원만 접근 가능한 페이지입니다.");
	}

	function notUser() {
		err(USER, "back", "로그인한 회원은 접근 불가능한 페이지입니다.");
	}

	function shop() {
		err(@USER['user_type'] != "normal" && @USER['user_type'] != "consumer", "back", "해당 페이지는 로그인한 일반, 컨슈머 회원만 접근가능합니다.");
	}

	function req() {
		err(!@USER || @USER['user_type'] != "normal", "back", "해당 페이지는 로그인한 일반회원만 접근 가능합니다.");
	}

	function sug() {
		err(!@USER || @USER['user_type'] != "consumer", "back", "해당 페이지는 로그인한 컨슈머 회원만 접근 가능합니다.");
	}

	function admin() {
		err(!@USER || @USER['user_type'] != "admin", "back", "해당 페이지는 관리자 회원만 접근 가능합니다.");
	}
 ?>