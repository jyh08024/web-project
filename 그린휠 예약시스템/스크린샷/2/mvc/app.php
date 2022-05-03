<?php 
	// 에러를 띄우지 않습니다.
	error_reporting(0);
	// 로그인을 하기위한 세션시작
	session_start();
	// 상수 설정
	define("ROOT", $_SERVER['DOCUMENT_ROOT']);
	define("USER", $_SESSION['user'] ?? []);
	// 타임존 설정
	date_default_timezone_set("Asia/seoul");

	// 페이지 이동함수
	function move($msg = '', $loc = '') {
		if ($msg) {
			echo "<script>alert('$msg')</script>";
		}
		if ($loc) {
			echo "<script>location.href='$loc'</script>";
		}
		echo "<script>history.back()</script>";
		exit;
	}

	// 변수 출력 함수
	function dd(...$val) {
		// echo "<pre>";
		// 	array_map("var_dump", $val);
		// echo "</pre>";
	}

	// implode 확장
	function exjoin($arr, $a=null,$b=null , $c=",") {
		return $b.implode("$b $a$c $b", $arr)."$b $a";
	}

	// date형식 문자열을 다른 date형식 문자열로 바꿔줍니다
	function ds($format, $dt) {
		return date($format, strtotime($dt));
	}

	// 클래스 자동로드
	spl_autoload_register(function($cn) {
		if (file_exists($f = ROOT."/mvc/$cn.php")) {
			require_once $f;
		}
	});


	require_once 'http/web.php';