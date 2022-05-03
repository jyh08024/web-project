<?php 
	get("/", function() {
		DB::setDB();
		view("index");
	});

	middleware("not_user", function() {
		get("/member", function() {
			view("member");
		});
	});

	post("/post/login", function() {
		$login = user::find('id = ? && pw = ?', [$_POST['id'], $_POST['pw']]);

		if (!$login) {
			move('back', "아이디 또는 비밀번호를 다시 확인해 주세요.");
		}

		$_SESSION['user'] = $login;
		move('/', "로그인에 성공하였습니다.");
	});

	middleware("is_user", function() {
		get("/logout", function() {
			session_destroy();
			move('/', "로그아웃 되었습니다.");
		});

		get("/mypage/$", function($idx) {
			$orderData = reserve::userRes($idx);
			view("mypage", get_defined_vars());
		});

		get("/contract/$", function($idx) {
			$data = reserve::getContract($idx);
			view("contract", get_defined_vars());
		});
	});

	get("/list/$", function($type) {
		$listData = pro::findAll("category = ?", $type);
		view("list", get_defined_vars());
	});

	get("/detail/$", function($idx) {
		$data = pro::find('idx = ?', $idx);
		$data['detail_img'] = explode(",", $data['detail']);

		view("detail", get_defined_vars());
	});

	middleware("is_owner", function() {
		get("/reservation/$", function($idx) {
			if (@!USER) {
				move("back", "로그인한 회원만 접근 가능합니다.");
			}

			$data = pro::find('idx = ?', $idx);
			view("reservation", get_defined_vars());
		});

		get("/pay", function() {
			$res = $_SESSION['reserv'];
			$pro = pro::find('idx = ?', $_SESSION['reserv']['pro_idx']);

			$res['priceInfo'] = priceCalc($res['start'], $res['end'], $pro['price'], $res['type']);
			view("cardPay", get_defined_vars());
		});

		get("/rental/$/$/$/$/$", function($type, $begin, $arrive, $start, $end) {
			if (!@USER) {
				move('/member', "로그인한 회원만 접근 가능합니다.");
			}

			$rental = pro::getProData($type, $begin, $arrive, $start, $end);

			$cartData = cart::getCart();
			$cart = $cartData['cart'];

			if ($cartData['err']) {
				move("back", "대여 불가능한 품목이 있습니다.");
			}

			$data = $rental['list'];
			$search = $rental['search'];

			view("rental", get_defined_vars());
		});

		get("/multiple", function() {
			if (!@USER) {
				move('/member', "로그인한 회원만 접근 가능합니다.");
			}

			$getData = cart::getCart();
			$data = $getData['cart'];

			$err = $getData['err'] ? true : false;

			if (!count($data)) {
				move("back", "적어도 한개의 품목이 존재해야 결제가 가능합니다.");
			}

			foreach ($data as $key => $v) {
				if ($err) {
					continue;
				}

				$type = $v['category'] == "전기자동차" || $v['category'] == "장거리전기자동차" ? "time" : "date";
				if (timeCk($v['start'], $v['end'], $type)) {
					$err = true;
				}
			}

			if ($err) {
				move("back", "예약이 불가능한 품목이 있습니다.");
			}

			view("multiple", get_defined_vars());
		});
	});

	middleware("not_owner", function() {
		get("/admin", function() {
			$resCare = reserve::getRes();
			view("admin", get_defined_vars());
		});

		get("/item", function() {
			$resData = reserve::resCare();
			view("item", get_defined_vars());
		});

		get("/material/$", function($date) {
			$year = explode("-", $date)[0];
			$month = explode("-", $date)[1];

			if ($month <= 0 || $month > 12) {
	      $year = $month > 12 ? $year + 1 : ($month <= 0 ? $year -1 : $year);
	      $month = $month > 12 ? pad(01) : 12;
	    }

	    $monthData = getMonthData($year, $month);

			view("material", get_defined_vars());
		});	
	});

	post("/post/detailImg/$", function($idx) {
		$file = $_FILES['image'];
		$prod = pro::find('idx = ?', $idx);

		if (exif_imagetype($file['tmp_name']) != 3 && exif_imagetype($file['tmp_name']) != 2) {
			move('back', "이미지는 jpeg png jpg만 업로드 할 수 있습니다.");
		}

		$fileName = microtime().$file['name'];
		move_uploaded_file($file['tmp_name'], ROOT."/resources/images/".$fileName);

		$prod['detail'] = $prod['detail'].",$fileName";
		pro::update($prod, $prod['idx']);

		move('back', "이미지가 등록되었습니다.");
	});

	post("/order", function() {
		foreach ($_POST as $key => $v) {
			if (trim($v) == "") {
				move('back', "모든 예약 정보를 입력해주세요.");
			}
		}

		$timeCk = timeCk($_POST['start'], $_POST['end'], $_POST['type']);

		if ($timeCk) {
			move("back", $timeCk);
		}

		if ($_POST['type'] == "time") {
			$_POST['start'] = date("Y-m-d")." ".$_POST['start'];
			$_POST['end'] = date("Y-m-d")." ".$_POST['end'];
		}

		if ($_POST['type'] == "date") {
			$_POST['start'] = $_POST['start']." 00:00";
			$_POST['end'] = $_POST['end']." 00:00";
		}

		unset($_SESSION['reserv']);
		$_SESSION['reserv'] = $_POST;

		move("/pay");
	});

	post("/post/cardPay", function() {
		if ($_POST['pay_type'] == "card") {
			unset($_POST['bank']);
			unset($_POST['send_user']);
			unset($_POST['phone']);
		}

		if ($_POST['pay_type'] == "bank") {
			unset($_POST['card']);
			unset($_POST['cardNum']);
		}

		foreach ($_POST as $key => $v) {
			if (trim($v) == "") {
				move('back', "모든 정보를 입력해주세요.");
			}
		}

		$res = $_SESSION['reserv'];
		$resPro = pro::find('idx = ?', $res['pro_idx']);

		$insertData = ["start"=> $res['start'], "end"=> $res['end'], "begin"=> $res['begin'], "arrive"=> $res['arrive'], "user_idx"=> USER['idx'], "state"=> "reserv"];

		if ($_POST['pay_type'] == "card") {
			$insertData['card'] = $_POST['card'];
			$insertData['card_num'] = $_POST['cardNum'];
		}

		if ($_POST['pay_type'] == "bank") {
			$insertData['bank'] = $_POST['bank'];
			$insertData['send_user'] = $_POST['send_user'];
			$insertData['phone'] = $_POST['phone'];
		}

		$resId = reserve::insert($insertData);

		$priceInfo = priceCalc($res['start'], $res['end'], $resPro['price'], $res['type']);
		res_pro::insert(["product_idx"=> $resPro['idx'], "res_idx"=> $resId, "pay_price"=> $priceInfo['realPay']]);

		$user = USER['idx'];
		unset($_SESSION['reserv']);
		move("/mypage/$user", "주문이 완료되었습니다.");
	});

	get("/post/cancel/$", function($idx) {
		$res = reserve::find('idx = ?', $idx);
		$res['state'] = "cancel";
		$res['reason'] = USER['level'] == "admin" ? "관리자" : USER['level'];

		reserve::update($res, $res['idx']);
		move("back", "예약이 취소되었습니다.");
	});

	post("/post/rentalSearch", function() {
		$timeType = "";
		$timeCk = "";

		if ($_POST['category']) {
			if ($_POST['category'] == "전기자동차" || $_POST['category'] == "장거리전기자동차") {
				$timeType = "date";
			} else {
				$timeType = "time";
			}

			$timeCk = timeCk($_POST['start'], $_POST['end'], $timeType);
		}

		if ($timeCk) {
			move("back", $timeCk);
		}

		$start = "";
		$end = "";

		if ($timeType == "time") {
			$start = date("Y-m-d")." ".$_POST['start'];
			$end = date("Y-m-d")." ".$_POST['end'];
		}

		if ($timeType == "date") {
			$start = $_POST['start']." 00:00";
			$end = $_POST['end']." 00:00";
		}

		move("/rental/".$_POST['category']."/".$_POST['placeS']."/".$_POST['placeE']."/".$start."/".$end);
	});

	post("/post/cart", function() {
		$_POST['user_idx'] = USER['idx'];
		cart::insert($_POST);
		move("back", "장바구니에 담겼습니다.");
	});

	get("/delete/cart/$", function($idx) {
		cart::delete($idx);
		move("back", "장바구니에서 삭제되었습니다.");
	});

	post("/post/multiPay", function() {
		if ($_POST['pay_type'] == "card") {
			unset($_POST['bank']);
			unset($_POST['send_user']);
			unset($_POST['phone']);
		}

		if ($_POST['pay_type'] == "bank") {
			unset($_POST['card']);
			unset($_POST['cardNum']);
		}

		foreach ($_POST as $key => $v) {
			if ($key != "cart_idx" && trim($v) == "") {
				move('back', "모든 정보를 입력해주세요.");
			}
		}

		foreach ($_POST['cart_idx'] as $key => $v) {
			$data = cart::find('idx = ?', $v);
			$data['state'] = "reserv";
			
			if ($_POST['pay_type'] == "card") {
				$data['card'] = $_POST['card'];
				$data['card_num'] = $_POST['cardNum'];
			}

			if ($_POST['pay_type'] == "bank") {
				$data['bank'] = $_POST['bank'];
				$data['send_user'] = $_POST['send_user'];
				$data['phone'] = $_POST['phone'];
			}

			$findPro = $data['pro_idx'];
			unset($data['pro_idx']);

			$resIdx = reserve::insert($data);
			$pro = pro::find('idx = ?', $findPro);

			$type = $pro['category'] == "전기자동차" || $pro['category'] == "장거리전기자동차" ? "time" : "date";
			$priceInfo = priceCalc($data['start'], $data['end'], $pro['price'], $type);
			res_pro::insert(["product_idx"=> $pro['idx'], "res_idx"=> $resIdx, "pay_price"=> $priceInfo['realPay']]);

			cart::delete($v);
		}

		move("/mypage/".USER['idx']);
	});

	get("/post/resState/$", function($idx) {
		$res = reserve::find('idx = ?', $idx);
		$res['state'] = "payment";

		reserve::update($res, $res['idx']);
		move("back");
	});

	post("/view/html", function() {
		$resCare = reserve::getRes();
		reserve::updateRes();

		view2("admin_load", get_defined_vars());
	});	

	post("/view/mypage/$", function($idx) {
		$orderData = reserve::userRes($idx);
		reserve::updateRes();

		view2("mypage_load", get_defined_vars());
	});
 ?>
