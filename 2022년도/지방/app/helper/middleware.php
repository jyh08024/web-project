<?php 
	function admin() {
		err(!USER || @USER['ID'] != "admin", "/", "관리자 권한이 필요합니다.");
	}
 ?>