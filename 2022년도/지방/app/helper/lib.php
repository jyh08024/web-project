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

	function resJSON($json, $code = 200) {
		http_response_code($code);
		header("Content-Type: application/json");
		echo json_encode($json);
	}

	function err($err, $loc, $msg) {
		if ($err) {
			move($loc, $msg);
		}
	}

	function resize($file) {
		$tmp = $file;
		$info = @getimagesize($file);

		[$w, $h] = $info;
		$img = imagecreatefromjpeg($tmp);

		$rate = 500 / max($w, $h);
		$imageWidth = $w * $rate;
		$imageHeight = $w * $rate;

		$newImage = imagecreatetruecolor($imageWidth, $imageHeight);
		imagecopyresampled($newImage, $img, 0, 0, 0, 0, $imageWidth, $imageHeight, $w, $h);

		return $newImage;
	}

	function water(&$img) {
		$water = imagecreatefrompng(ROOT."/resources/water.png");
		$x = imagesx($img) / 2; $y = imagesy($img) / 2;
		$w = imagesx($water) / 2; $h = imagesy($water) / 2;

		imagecopy($img, $water, $x - $w, $y - $h, 0, 0, $w * 2, $h * 2);
		return $img;
	}
 ?>