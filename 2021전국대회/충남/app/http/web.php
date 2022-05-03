<?php 
	post("/getBaker", function() {
		return responseJSON(baker::allData());
	});

	post("/getMenu", function() {
		$menu = menu::mq("
			SELECT 
			menu.*,
			baker.name `name`
			FROM menu
			LEFT JOIN baker
			ON menu.baker_idx = baker.idx
			")->fetchAll();

		return responseJSON($menu);
	});

	post("/getBasket", function() {
		$userInfo = USER['user_type'] == "member" ? USER['idx'] : USER['user_name'];
		$cartData = cart::mq("
			SELECT 
			cart.*,
			menu.*,
			baker.name `name`,
			cart.idx `cart_idx`,
			menu.idx `menu_idx`
			FROM cart
			LEFT JOIN menu 
			ON cart.menu_idx = menu.idx
			LEFT JOIN baker 
			ON menu.baker_idx = baker.idx
			WHERE state = ? && user_info = ?
		", ["cart", $userInfo])->fetchAll();

		return responseJSON($cartData);
	});

	post("/get/review", function() {
		$idx = $_POST['idx'];
		$review = review::findAll('order_bread_idx = ? ORDER BY idx DESC', $idx);

		foreach ($review as $key => & $v) {
			if ($v['user_info'] != "member") {
				return;
			}

			$v['user_name'] = user::mq("SELECT user_name FROM user WHERE idx = ?", [$v['writer']])->fetch()['user_name'];
		}

		return responseJSON($review);
	});

	get("/", function() {
		$bakerCk = baker::mq("SELECT * FROM baker")->fetch();
		$menuCk = menu::mq("SELECT * FROM menu")->fetch();

		if (!$bakerCk) {
			$bakerData = json_decode(file_get_contents(ROOT.'/resources/json/data.json'), true);

			foreach ($bakerData as $key => $v) {
				$v['images'] = json_encode($v['images']);

				baker::insert($v); 
			}
		}

		if (!$menuCk) {
			$menuData = json_decode(file_get_contents(ROOT.'/resources/json/menus.json'), true);

			foreach ($menuData as $key => $v) {
				$bakerName = baker::find('name = ?', $v['name'])['idx'];
				$v['baker_idx'] = $bakerName;

				unset($v['name']);
				menu::insert($v);
			}
		}	

		$baker = baker::mq("SELECT name FROM baker")->fetchAll();

		$selData = cart::mq("
			SELECT 
			cart.*,
			menu.menuname `menu_name`,
			baker.name `name`,
			cart.idx `cart_idx`,
			menu.idx `menu_idx`
			FROM cart
			LEFT JOIN menu 
			ON cart.menu_idx = menu.idx
			LEFT JOIN baker 
			ON menu.baker_idx = baker.idx
			GROUP BY cart_idx
		", )->fetchAll();

		$resArr = [];

		foreach ($baker as $key => $v) {
			$v['selCount'] = 0;
			$name = $v['name'];

			foreach ($selData as $key => $value) {
				$value['name'] == $name ? $v['selCount'] += 1 : "";
			}

			if ($v['selCount'] > 0) {
				$resArr[$v['name']] = $v['selCount'];
			}
		}

		arsort($resArr);

		view('index', ["sel"=> $resArr]);
	});

	get("/storeList", function() {
		view2('storeList');
	});

	middleware("userCk", function() {
		get("/detail/$", function($idx) {
			view2('view');
		});

		get("/basket", function() {
			view2('basket');
		});

		get("/order", function() {
			view2('order');
		});

		get("/inquire/$/$/$", function($type, $con1 = "", $con2 = "") {
			$sql = 'user_name = ? && user_idx = ?';
			$joinSql = '';
			$menuSql = '';

			switch ($type) {
				case 'visit_time':
					$sql = $sql." && '$con1' <= `visit_date` && `visit_date` <= '$con2'";
					break;

				case 'res_baker':
					$joinSql = " && baker.name LIKE '%$con1%'";
					break;

				case 'menu_search':
					$menuSql = $menuSql." && menu.menuname LIKE '%$con1%'";
					break;
			}

			$order = order_list::findAll("{$sql} ORDER BY visit_date DESC, visit_time DESC", [USER['user_name'], USER['user_type'] == "member" ? USER['idx'] : USER['user_name']]);

			foreach ($order as $key => & $v) {
				$cartData = cart::mq("
					SELECT 
					cart.*,
					menu.*,
					cart.idx `cart_idx`,
					menu.idx `menu_idx`,
					baker.name `baker_name` 
					FROM cart 
					LEFT JOIN menu
					ON cart.menu_idx = menu.idx {$menuSql}
					LEFT JOIN baker
					ON menu.baker_idx = baker.idx {$joinSql}
					WHERE state = ? && order_idx = ?
					", ["order", $v['idx']])->fetchAll();

				if ($cartData) {
					$v['order_menu'] = $cartData;
				}

				$v['baker_list'] = array_unique(array_map(function ($v) {
						return $v['baker_name'];
					} ,cart::mq("
					SELECT 
					cart.*,
					menu.*,
					cart.idx `cart_idx`,
					menu.idx `menu_idx`,
					baker.name `baker_name` 
					FROM cart 
					LEFT JOIN menu
					ON cart.menu_idx = menu.idx
					LEFT JOIN baker
					ON menu.baker_idx = baker.idx
					WHERE state = ? && order_idx = ?
					", ["order", $v['idx']])->fetchAll()));
			}


			view2('inquire', get_defined_vars());
		});
	});


	post("/post/idCk", function() {
		$idCk = user::find("user_id = ?", [$_POST['id']]);

		if ($idCk) {
			echo json_encode(["err"=> true, "msg"=> "이미 사용중인 아이디입니다."]);
		} else {
			echo json_encode(["err"=> false, "msg"=> "사용 가능한 아이디입니다."]);
		}
	});

	post("/post/join", function() {
		$err = false;
		$vali = [];

		if (trim($_POST['user_id']) == "" || !preg_match("/^[a-zA-Z0-9]{0,20}+$/u", $_POST['user_id'])) {
			$vali[] = "아이디는 최대 20자 영문자 및 숫자만 입력되어야 합니다.";
		}

		if ($_POST['id_ck'] == "true") {
			$vali[] = "아이디 중복을 확인해주세요.";
		}

		$passCk = strVali($_POST['user_pass']);
		
		if (trim($_POST['user_pass']) == "" || $passCk || !preg_match("/^(?=.*[0-9!@#$%^&*()_+,.])[0-9!@#$%^&*()_+,.a-zA-Z]{0,9}+$/", $_POST['user_pass'])) {
			$vali[] = "비밀번호는 최대 10자 키보드의 알파벳, 숫자의 연속된 문자 3개미만, 1개의 숫자 또는 특수문자를 포함해야합니다.";
		}

		if (trim($_POST['user_name']) == "" || !preg_match("/^[가-힣a-zA-Z]{0,20}+$/", $_POST['user_name'])) {
			$vali[] = "이름은 최대 20자 올바른 형태의 한글 및 영문자만 입력가능합니다.";
		}

		if (trim($_POST['user_email']) == "" || !filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL) || mb_strlen($_POST['user_email']) > 100) {
			$vali[] = "이메일은 이메일 형식으로 최대 100자 입력 가능합니다";
		}

		if (count($vali)) {
			$err = true;
		}

		if ($err) {
			echo json_encode(["type"=> "join", "err"=> true, "msg"=> $vali]);
		}

		if (!$err) {
			unset($_POST['id_ck']);
			user::insert($_POST);

			echo json_encode(["type"=> "join", "err"=> false, "msg"=> "회원가입이 완료되었습니다."]);
		}
	});

	post("/post/login", function() {
		$login = "";

		if ($_POST['login_type'] == "member") {
			$login = user::find('user_id = ? && user_pass = ? && user_code = ?', [$_POST['user_id'], $_POST['user_pass'], $_POST['user_code']]);
		} else {
			$login = ["user_name"=> $_POST['reserver'], "user_call"=> $_POST['reserv_call']];
		}

		if ($login) {
			$login['user_type'] = $_POST['login_type'];
			$_SESSION['user'] = $login;
		}

		if (!$login) {
			echo json_encode(["type"=> "login", "msg"=> "아이디, 또는 비밀번호를 확인해주세요.", "err"=> true]);
		} else {
			echo json_encode(["type"=> "login", "msg"=> "로그인에 성공하였습니다", "err"=> false]);
		}
	});

	get("/get/logout", function() {
		session_destroy();
		move('/', "로그아웃되었습니다");
	});

	post("/post/insertBasket", function() {
		$menu = $_POST['data'];
		$userInfo = USER['user_type'] == "member" ? USER['idx'] : USER['user_name'];
		$cartData = ["menu_idx"=> $menu['idx'], "count"=> $menu['count'], "price"=> $menu['price'], "subtotal"=> $menu['totalPrice'], "state"=> "cart", "order_idx"=> "", "user_info"=> $userInfo, "is_review"=> "false"];

		$findCart = cart::find('menu_idx = ? && state = ? && user_info = ?', [$menu['idx'], "cart", $userInfo]);

		if ($findCart) {
			$findCart['count'] = $findCart['count'] + $cartData['count'];
			$findCart['subtotal'] = $findCart['subtotal'] + $cartData['subtotal'];

			cart::update($findCart['idx'], $findCart);
			exit;
		}

		cart::insert($cartData);
	});

	post("/post/order", function() {
		$_POST['user_idx'] = USER['user_type'] == "member" ? USER['idx'] : "";

		$orderIdx = order_list::insert($_POST);
		$cartOrder = cart::findAll('state = ? && user_info = ?', ["cart", USER['user_type'] == "member" ? USER['idx'] : USER['user_name']]);

		foreach ($cartOrder as $key => $v) {
			$v['state'] = "order";
			$v['order_idx'] = $orderIdx;

			cart::update($v['idx'], $v);
		}

		move('/order', "예약이 완료되었습니다");
	});

	get("/remove/order/$", function($idx) {
		cart::delete($idx);
		move('back', "예약이 취소되었습니다.");
	});

	post("/post/search", function() {
		$url = "/inquire/all//";

		switch ($_POST['search_type']) {
			case 'res_baker':
				$type = $_POST['search_type'];
				$key = $_POST['baker_sel']."/";
				break;

			case 'menu_search':
				$type = $_POST['search_type'];
				$key = $_POST['search_key']."/";
				break;

			case 'visit_time':
				$type = $_POST['search_type'];
				$key = $_POST['start_date']."/".$_POST['end_date'];
				break;

			case 'all':
				$type = "all";
				$key = "/";
				break;
		}

		$url = "/inquire/$type/$key";

		move($url);
	});

	post("/post/reviewEnr", function() {
		$userInfo = USER['user_type'] == "member" ? USER['idx'] : USER['name'];
		$vali = "";

		foreach ($_POST['review_content'] as $key => $v) {
			$arr = ["order_idx"=> $_POST['order_idx'], "order_bread_idx"=> $_POST['target_cart'][$key], "review_con"=> $v, "rev_grade"=> $_POST['rev_grade'][$key], "writer"=> $userInfo, "user_info"=> USER['user_type']];

			if (mb_strlen($v) < 20) {
				$vali = "후기 내용은 20자 이상입력되어야 합니다.";
			}

			$cartInfo = cart::find('idx = ?', $_POST['target_cart'][$key]);

			$cartInfo['is_review'] = "true";


			if (!$vali) {
				review::insert($arr);
				cart::update($cartInfo['idx'], $cartInfo);
			}
		}

		echo json_encode(["type"=> "review", "err"=> false, "msg"=> "리뷰가 작성되었습니다", "vali"=> $vali, "order_index"=> $_POST['order_idx']]);
	});
 ?>