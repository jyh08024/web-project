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

		$url = $url == "back" ? "history.back()" : "location.href = '$url'";

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

		require ROOT."/view/load/$loc.php";
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

	function pad($num) {
		return $num < 10 ? "0".$num : $num;
	}

	function timeCk($start, $end, $type) {
		$startTime = $type == "date" ? strtotime($start) : strtotime(date("Y-m-d ").$start.":00");
		$endTime = $type == "date" ? strtotime($end) : strtotime(date("Y-m-d ").$end.":00");

		if ($startTime < strtotime(date("Y-m-d H:i:s"))) {
			return "대여 시간이 현재 시간보다 빠릅니다.";		
		}		

		if ($startTime >= $endTime) {
			return "반납시간이 대여시간보다 이전입니다.";
		}

		if ($startTime <= date("Y-m-d H:i:s", strtotime($end) + 3600)) {
			return "반납시간은 대여시간기준으로 1시간 이후부터 반납 가능합니다.";
		}
		
		return "";
	}

	function priceCalc($start, $end, $price, $type) {
		$startTime = new DateTime($start);
		$endTime = new DateTime($end);

		$diff = date_diff($startTime, $endTime);
		$dateDiff = $type == "time" ? $diff->h : $diff->days + 1;

		$sales = [-20, 0, 30, 30, 30, -20, -20];
		$userSale = ["일반회원"=> 5, "멤버십회원"=> 10, "VIP회원"=> 15];

		$sale = [];

		for ($i=1; $i <= $dateDiff + 1; $i++) {
			$stamp = strtotime("+ $i days");
			$salePer = $sales[date('w' , strtotime($start) + $stamp)];

			$sale[] = $salePer;
		}
		
		$sales = array_unique($sale);
		$saleSum = array_sum($sales) / count($sales);

		if (count($sales) == 3) {
			$saleSum = 5;
		}

		$result['payPrice'] = $price * $dateDiff;
		$result['sale'] = $result['payPrice'] * ($saleSum / 100);
		$result['salePrice'] = $result['payPrice'] - $result['sale'];
		$result['userSale'] = $result['payPrice'] * ($userSale[USER['level']] / 100);
		$result['realPay'] = $result['salePrice'] - $result['userSale'];

		return $result;
	}

	function getMonthData($year, $month) {
		$result = [];

		$time = strtotime("$year-$month-01");
		$days = date("t", $time);

		for ($i = 1; $i <= $days; $i++) {
			$start = date("Y-m-d 00:00", strtotime("$year-$month-$i"));
			$end = date("Y-m-d 24:00", strtotime("$year-$month-$i"));

			$res = reserve::mq("
				SELECT 
				reserve.*,
				reserve.idx `reserve_idx`,
				res_pro.*,
				res_pro.idx `res_pro_idx`
				FROM reserve 
				LEFT JOIN res_pro ON reserve.idx = res_pro.res_idx 
				WHERE `start` >= ? && `start` <= ? && (state = 'return' || state = 'payment')
				", [$start, $end])->fetchAll();

			$result[date("m.d", strtotime("$year-$month-$i"))]['count'] = count($res);
			$result[date("m.d", strtotime("$year-$month-$i"))]['total'] = 0;

			foreach ($res as $key => $v) {
				$result[date("m.d", strtotime("$year-$month-$i"))]['total'] += $v['pay_price'];
			}
		}

		return $result;
	}

	function drawGraph($date) {
		$year = explode("-", $date)[0];
		$month = explode("-", $date)[1];

		if ($month <= 0 || $month > 12) {
      $year = $month > 12 ? $year + 1 : ($month <= 0 ? $year -1 : $year);
      $month = $month > 12 ? pad(01) : 12;
    }

    $monthData = getMonthData($year, $month);
    $max = max(array_column($monthData, "count"));

		$w = 1440;
		$h = 450;
		$image = imagecreatetruecolor($w, $h);
		$font = ROOT."/font/malgun.ttf";

		$xW = ($w - 100) / count($monthData);
		$color = imagecolorallocate($image, 0, 0, 0);

		imagefilledrectangle($image, 0, 0, $w, $h, 0xffffff);

		$i = 0;
		foreach ($monthData as $key => $v) {
			imagestring($image, 4, ($xW * $i++) + 45, $h - 40, str_replace(".", "/", $key), $color);
		}

		for ($i=0; $i < 6; $i++) { 
			$y = $h - (50 * $i + 100);

			imageline($image, 35, $y, $w - 50, $y, 0xaaaaaaa);
		}

		$max = ceil($max + $max/6);
		for ($i=0; $i <= 7; $i++) { 
			$y = ($h - 150) / 6 * $i + 50;
			$re = $max / 7 * (7-$i);

			imagestring($image, 4, 0, $y, round($re, 1), $color);
		}

		$i = 0;
		foreach ($monthData as $key => $val) {
			$rect = ($max == 0) ? 0 : $val['count'] / $max;
			$x = $xW * $i + 50;
			$y = 350 - ($rect * 350);

			imagefilledrectangle($image, $x, $y + 50, $x+30, 400, 0x00b2ff);
			$i++;
		}

		imagerectangle($image, 35, 50, $w-50, 400, 0x000000);

   	ob_start(); 

			imagepng($image);
		  $imageData = ob_get_contents(); 

		ob_end_clean(); 

		$imageUrl = base64_encode($imageData);  
		echo "data:image/jpeg;base64,$imageUrl";
	}
 ?>
