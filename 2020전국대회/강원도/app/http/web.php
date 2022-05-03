<?php 
	get("/", function() {
		$adminCk = user::find('user_id = ? && user_pass = ?', ["admin", "1234"]);

		if (!$adminCk) {
			user::insert(["user_id"=> "admin", "user_pass"=> "1234", "user_type"=> "admin", "user_name"=> "admin"]);
		}

		view("index");
	});

	middleware("shop", function() {
		get("/store", function() {
			view("store");
		});
	});

	middleware("notUser", function() {
		get("/login", function() {
			view("login");
		});

		get("/join", function() {
			view("join");
		});
	});

	middleware("req", function() {
		get("/request", function() {
			$reqData = request::findAll('user_idx = ? && (state = "요청" || state = "제안") ORDER BY date DESC', USER['idx']);
			view("request", get_defined_vars());
		});

		get("/reqDetail/$", function($idx) {
			$data = suggest::mq("
				SELECT 
					suggest.*,
					user.user_id,
					request.req_name 
				FROM suggest 
				LEFT JOIN user ON suggest.user_idx = user.idx
				LEFT JOIN request ON request.idx = '$idx'
				WHERE request_idx = ?
				GROUP BY suggest.idx 
				ORDER BY suggest.date DESC
				", $idx)->fetchAll();

			view("reqDetail", get_defined_vars());
		});

		get("/buySug/$", function($id) {
			$sug = suggest::find('idx = ?', $id);
			$req = request::find('idx = ?', $sug['request_idx']);

			$sug['state'] = "구매";
			$req['state'] = "구매";

			suggest::update($sug, $sug['idx']);
			request::update($req, $req['idx']);

			$buyItem = json_decode($sug['item'], true);
			$buyTotal = array_reduce($buyItem, function($acc, $v) {
				$acc += $v['totalCost'] * 1;
				return $acc;
			}, 0);

			$buyData = ["total"=> $buyTotal, "user_idx"=> USER['idx'], "item"=> $sug['item']];
			store::insert($buyData);
			move("/request", "구매가 완료되었습니다.");
		});
	});

	middleware("sug", function() {
		get("/suggest", function() {
			$data = request::mq("
				SELECT 
					request.*,
					user.user_id 
				FROM request 
				LEFT JOIN user ON user.idx = request.user_idx 
				WHERE state = '요청'
				GROUP BY request.idx 
				ORDER BY date DESC 
				")->fetchAll();

			view("suggest", get_defined_vars());
		});

		get("/suggestStore/$", function($idx) {
			$sugData = request::find('idx = ?', $idx);

			if ($sugData['state'] != "요청") {
				move("back", "이미 제안, 또는 구매가 완료된 제안요청입니다.");
			}
			
			view("suggestStore", get_defined_vars());
		});
	});

	middleware("admin", function() {
		get("/admin", function() {
			view("admin");
		});
	});

	// 제안하기
	post("/post/sugData", function() {
		$insert = [];
		$insert['item'] = json_encode($_POST['sug']);
		$insert['user_idx'] = USER['idx'];
		$insert['request_idx'] = $_POST['req'];
		$insert['state'] = "제안";
		$reqData = request::find('idx = ?', $_POST['req']);

		if ($reqData['state'] != "요청") {
			move("/suggest", "이미 상대가 구매 혹은 제안을 완료한 제안요청입니다.");
		}

		suggest::insert($insert);
		$reqData['state'] = "제안";

		request::update($reqData, $reqData['idx']);
		echo "제안이 완료되었습니다.";
	});

	// 제안요청
	post("/post/req", function() {
		$err = false;

		foreach ($_POST as $key => $v) {
			if (trim($v) == "") {
				$err = true;
			}
		}

		if ($err) {
			echo "모든 값을 입력해주세요.";
			exit;
		}

		if (!preg_match("/^[0-9]+$/u", $_POST['max']) && !preg_match("/^[0-9]+$/u", $_POST['price_Range'])) {
			echo "가격 한도와 오차 범위는 숫자만 입력 가능합니다.";
			exit;
		}

		if ($_POST['priceRange'] > 10000 || $_POST['priceRange'] > $_POST['max']*1 / 2 ) {
			echo "오차범위는 10000을 넘을수 없고 가격 한도의 50% 범위를 넘을 수 없습니다.";
			exit;
		}

		$_POST['user_idx'] = USER['idx'];
		$_POST['state'] = "요청";

		request::insert($_POST);
		$request = request::findAll('user_idx = ? && (state = "요청" || state = "제안") ORDER BY date DESC', USER['idx']);
		view2("request", ["req"=> $request]);
	});

	// 구매하기
	post("/post/buy", function() {
		unset($_POST['info']['user_name']);
		unset($_POST['info']['user_code']);
		unset($_POST['info']['user_call']);
		unset($_POST['info']['user_ad']);
		unset($_POST['info']['user_detail_ad']);

		$_POST['info']['item'] = $_POST['info']['product'];
		$_POST['info']['user_idx'] = USER['idx'];
		unset($_POST['info']['product']);
		store::insert($_POST['info']);

		$cart = user::find('idx = ?', USER['idx']);
		$cart['cart'] = "";
		user::update($cart, USER['idx']);

		return responseJSON(store::allData());
	});

	// 카트 리스트 업데이트
	post("/insertCart", function() {
		$data = user::find('idx = ?', USER['idx']);
		$data['cart'] = json_encode($_POST['list']);

		user::update($data, USER['idx']);
	});

	// 카트데이터
	post("/post/cartData", function() {
		$cartData = user::find('idx = ?', USER['idx']);
		$returnData = $cartData['cart'] ? json_decode($cartData['cart'], true) : [];

		return responseJSON($returnData);
	});

	//구매 데이터
	post("/getBuydata", function() {
		return responseJSON(store::mq("
			SELECT 
				store.*,
				user.user_id,
				user.user_name
			FROM store 
			LEFT JOIN user ON store.user_idx = user.idx 
			GROUP BY store.idx 
			")->fetchAll());
	});

	// 회원가입
	post("/post/join", function() {
		$vali = [];
		$err = false;

		foreach ($_POST as $key => $v) {
			if (trim($v) == "") {
				$err = true;
			}
		}

		if ($err) {
			move('back', "모든 값을 입력해주세요");
		}

		$idCk = user::find('user_id = ?', $_POST['user_id']);

		if (!preg_match("/^[가-힣ㄱ-ㅎㅏ-ㅣ]{2,7}+$/u", $_POST['user_name'])) {
			$vali[] = "이름이 입력 조건에 일치하지 않습니다.";
		}

		if (!preg_match("/^\d{3}-\d{4}-\d{4}+$/u", $_POST['user_call'])) {
			$vali[] = "올바른 전화번호 형태는 000-0000-0000입니다.";
		}

		if (!preg_match("/^[0-9]{5}+$/u", $_POST['user_code'])) {
			$vali[] = "우편번호는 5자리 숫자만 가능합니다.";
		}

		if ($_POST['user_pass'] != $_POST['user_pass_ck']) {
			$vali[] = "비밀번호와 비밀번호 확인이 일치하지 않습니다.";
		}

		if ($idCk) {
			$vali[] = "이미 사용중인 아이디 입니다.";
		}

		if (count($vali)) {
			move('back', $vali);
		}

		unset($_POST['user_pass_ck']);
		user::insert($_POST);
		move("/", "회원가입이 완료되었습니다.");
	});

	post("/post/login", function() {
		$login = user::find('user_id = ? && user_pass = ?', [$_POST['user_id'], $_POST['user_pass']]);

		if (!$login) {
			move("back", "아이디 또는 비밀번호를 다시 확인해 주세요.");
		}

		$_SESSION['user'] = $login;
		move("/", "로그인에 성공하였습니다.");
	});

	get("/logout", function() {
		session_destroy();
		move("/", "로그아웃 되었습니다.");
	});
 ?>