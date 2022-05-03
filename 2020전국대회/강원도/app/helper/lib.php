<?php 
	session_start();
	date_default_timezone_set("Asia/Seoul");

	define("ROOT", $_SERVER['DOCUMENT_ROOT']);
	define("USER", @$_SESSION['user']);

	function dd() {
		echo "<pre>";
		var_dump(...func_get_args());
		echo "</pre>";
	}

	function move($url, $msg = false) {
		if (is_array($msg)) {
			$msg = implode("\\n", $msg);
		}

		if ($msg) {
			echo "<script>alert('$msg')</script>";
		}

		$url = $url == "back" ? "history.back()" : "location.href='$url'";

		echo "<script>$url</script>";
		exit;
	}

	function view($loc, $data = []) {
		extract($data);

		require ROOT."/view/header.php";
		require ROOT."/view/$loc.php";
		require ROOT."/view/footer.php";
	}

	function view2($loc, $data = []) {
		extract($data);

		require ROOT."/view/template/$loc.php";
	}

	function responseJSON($json) {
		header("Content-Type: application/json");
		echo json_encode($json);
	}

	function err($err, $loc, $msg) {
		if ($err) {
			move($loc, $msg);
		} 
	}
 ?>