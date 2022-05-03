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
			$msg = implode('\\n', $msg);
		}

		if ($msg) {
			echo "<script>alert('$msg')</script>";
		}

		$url = $url == 'back' ? "history.back()" : "location.href='$url'";

		if ($url) {
			echo "<script>$url</script>";
		}
		exit;
	}

	function view($loc, $data = []) {
		extract($data);

		require ROOT."/view/header.php";
		
		if (USER) {
			require ROOT."/view/mailside.php";
		}

		require ROOT."/view/$loc.php";
		require ROOT."/view/footer.php";
	}

	function err($error, $loc, $msg) {
		if ($error) {
			return move($loc, $msg);
		}
	}

	function responseJSON($json) {
		header("Content-type: application/json");
		echo json_encode($json);
	}

	function valid($loc, $msg) {
		if (in_array('', $_POST)) {
			return move($loc, $msg);
		}
	}
 ?>