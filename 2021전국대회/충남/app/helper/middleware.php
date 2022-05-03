<?php 
	function userCk() {
		err(@!USER, "back", "로그인 한 회원만 접근 가능한 페이지입니다.");
	}
 ?>