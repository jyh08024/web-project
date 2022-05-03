<?php 
	post("/get/bakerData", function() {
		return responseJSON(baker::allData());
	});

	get("/", function() {
		view("index");
	});

	post("/post/dbSet", function() {
		$is_baker = baker::mq("SELECT * FROM baker LIMIT 1, 1")->fetchAll();
		$is_bread = baker::mq("SELECT * FROM bread LIMIT 1, 1")->fetchAll();
		$is_user = baker::mq("SELECT * FROM user LIMIT 1, 1")->fetchAll();

		if (!$is_baker || !$is_user) {
			$baker = $_POST['baker'];

			foreach ($baker as $key => $v) {
				$v['item'] = json_encode($v['item']);
				unset($v['w_score']);
				unset($v['round']);
				unset($v['idx']);
				unset($v['baker_idx']);
				unset($v['winCount']);

				if (!$is_user) {
					$userData = ["user_name"=> $v['name'], "id"=> $v['admin_id'], "pass_word"=> 1234];
					user::insert($userData);
				}

				if (!$is_baker) {
					baker::insert($v);
				}
			}
		}

		if (!$is_bread) {
			$bread = $_POST['bread'];

			foreach ($bread as $key => $v) {
				bread::insert($v);
			}
		}
	});

	get("/bakeryMap", function() {
		view("bakeryMap");
	});

	get("/intro", function() {
		view("intro");
	});

	get("/bakerPick", function() {
		view("bakerPick");
	});

	get("/famousBakery", function() {
		view("famousBakery");
	});

	middleware("is_user", function() {
		get("/login", function() {
			view("login");
		});

		get("/join", function() {
			view("join");
		});

	});

	middleware('not_user', function() {

		get("/pickUpOrder", function() {
			$shopList = baker::mq("
				SELECT 
				*,
				baker.idx `idx`,
				COUNT(baker_worldcup.baker_idx) `winCount`
				FROM baker
				LEFT JOIN baker_worldcup
				ON baker.idx = baker_worldcup.baker_idx
				GROUP BY baker.idx
				ORDER BY winCount DESC, name ASC
				")->fetchAll();

			$shopList2 = [];

			foreach ($shopList as $key => & $v) {
				$v['item'] = json_decode($v['item'], true); 

				if ($v['winCount'] <= 0) {
					$shopList2[] = @array_slice($shopList, $key, 1)[0];

					array_splice($shopList, $key, 1);
				}
			}

			$sortAr = [];

			foreach ($shopList2 as $key => $v) {
				if (!@is_array($v['item'])) {
					$v['item'] = json_decode($v['item'], true); 
				}

				$sortAr[$v['idx']] = count($v['item']);
			}

			arsort($sortAr);

			$nor = [];
			foreach ($sortAr as $key => $v) {
				$searchKey = array_search($key, array_column($shopList2, 'idx'));
				$nor[] = $shopList2[$searchKey];
			}

			$shopList = array_merge($shopList, $nor);

			view("pickOrder", get_defined_vars());
		});

		get("/shop/detail/$", function($idx) {
			$nowShop = baker::find('idx = ?', [$idx]);
			$nowShop['item'] = json_decode($nowShop['item'], true);

			$bread;
			foreach ($nowShop['item'] as $key => $v) {
				$bread[] = bread::find('idx = ?', [$v]);
			}

			$sortArr = [];

			foreach ($bread as $key => $v) {
				$sortArr[$v['idx']] = $v['name'];
			}

			asort($sortArr);

			$sortRes = [];

			foreach ($sortArr as $key => $v) {
				$searchKey = array_search($key, array_column($bread, 'idx'));
				$sortRes[] = $bread[$searchKey];
			}

			$nowShop['bread'] = $sortRes;

			$cartList = cart::mq("
				SELECT
				*,
				cart.idx `cart_idx`,
				baker.idx `baker_id`,
				bread.idx `bread_id`,
				bread.name `bread_name`
				FROM cart
				LEFT JOIN bread
				ON cart.bread_idx = bread.idx
				LEFT JOIN baker
				ON cart.order_baker = baker.idx
				WHERE state = 'save' && user_idx = ?
				ORDER BY cart.idx DESC
				", USER['idx'])->fetchAll();

			view("shopDetail", get_defined_vars());
		});

		//주문내역
		get("/pickUpHistory", function() {
			$orderList = order_::findAll('order_user = ? ORDER BY order_date DESC', USER['idx']);

			foreach ($orderList as $key => & $v) {
				$cart = cart::findAll('order_idx = ?', [$v['idx']]);

				$v['menuCount'] = count($cart);

				foreach ($cart as $cartkey => & $value) {
					$findBrad = bread::find('idx = ?', [$value['bread_idx']]);
					$findBrad['bakery'] = baker::find('idx = ?', [$value['order_baker']])['name'];

					$findBrad['order_idx'] = $v['idx'];
					$findBrad['od_state'] = $value['state'];
					$v['bread_info'][$findBrad['bakery']][] = $findBrad;
				}
			}

			view("orderHistory", get_defined_vars());
		});
	});

	//매장관리
	//기본 정보관리
	get("/storeCare/$", function($idx) {
		$shopInfo = baker::find('idx = ?', $idx);

		view('storeCare', get_defined_vars());
	});

	get("/productCare/$", function($idx) {
		$shopInfo = baker::find('idx = ?', $idx);
		$breadList = [];

		foreach (json_decode($shopInfo['item'], true) as $key => $v) {
			$bread = bread::find('idx = ?', $v);
			$worldCupWin = count(bread_worldcup::findAll('winner = ?', $bread['idx'])) * 3;
			$worldCupSe = count(bread_worldcup::findAll('second = ?', $bread['idx'])) * 2;

			$bread['nowSel'] = "sale";
			$bread['score'] = $worldCupWin + $worldCupSe;

			$breadList[] = $bread;
		}

		if (json_decode($shopInfo['notsel'], true)) {
			foreach (json_decode($shopInfo['notsel'], true) as $key => $v) {
				$bread = bread::find('idx = ?', $v);
				$worldCupWin = count(bread_worldcup::findAll('winner = ?', $bread['idx'])) * 3;
				$worldCupSe = count(bread_worldcup::findAll('second = ?', $bread['idx'])) * 2;

				$bread['nowSel'] = "not";
				$bread['score'] = $worldCupWin + $worldCupSe;

				$breadList[] = $bread;
			}
		}

		$sortArr = [];

		foreach ($breadList as $key => $v) {
			$sortArr[$v['name']] = $v['score'];
		}

		ksort($sortArr);
		arsort($sortArr);

		$res = [];

		foreach ($sortArr as $key => $v) {
			$searchKey = array_search($key, array_column($breadList, 'name'));
			$res[] = $breadList[$searchKey];
		}

		view('productCare', get_defined_vars());
	});
	//
	//주문관리
	get("/orderCare/$", function($idx) {
		$bakerData = baker::find('idx = ?', $idx);
		// $orderData = order_::getOrder(order_::allData(), "order_idx = {$v['idx']} && order_baker = {$bakerData['idx']}", )
		$orderData = order_::findAll('order_state = ? || order_state = ? || order_state = ? ORDER BY order_date DESC', ["order", "waiting", "pickUp"]);

		foreach ($orderData as $key => & $v) {
			$cart = cart::findAll("order_idx = ? && order_baker = ? && state != ?", [$v['idx'], $bakerData['idx'], "cancel"]);

			$v['menuCount'] = count($cart);

			foreach ($cart as $key => & $value) {
				$findBrad = bread::find('idx = ?', [$value['bread_idx']]);
				$findBrad['orderer'] = user::find('idx = ?', [$value['user_idx']])['user_name'];

				$findBrad['state'] = $value['state'];
				$findBrad['order_idx'] = $v['idx'];
				$v['bread_info'][$findBrad['orderer']][] = $findBrad;
			}
		}

		view("orderCare", get_defined_vars());
	});

	//로그인 로그아웃 회원가입
	post("/post/join", function() { 
		valid($_POST, "back", "모든 값을 입력해주세요");

		$idCk = user::find('id = ?', $_POST['id']);
		if ($idCk) {
			move('back', "이미 사용중인 아이디입니다.");
		}
		if ($_POST['pass_word'] != $_POST['user_pass_ck']) {
			move("back", "비밀번호와 비밀번호 확인이 일치하지 않습니다.");
		}

		unset($_POST['user_pass_ck']);
		user::insert($_POST);
		move("/", "회원가입이 완료되었습니다");
	});

	post("/post/login", function() {
		$login = user::find('id = ? && pass_word = ?', [$_POST['id'], $_POST['pass_word']]);

		if (!$login) {
			move('back', "아이디 또는 비밀번호가 틀립니다.");
		}

		$is_owner = baker::find('admin_id = ?', $_POST['id']);
		$_SESSION['user'] = $login;

		$idx = @$is_owner['idx'];
		$loc = $is_owner ? "/storeCare/$idx" : "/";

		move($loc, "로그인이 완료되었습니다.");
	});

	get("/logout", function() {
		session_destroy();
		move('/', "로그아웃되었습니다.");
	});
	//

	// 빵드컵 데이터
	//빵
	post("/data/worldCup/bread", function() {
		$_bread = bread::allData();

		return responseJSON($_bread);
	});

	//빵집
	post("/data/worldCup/baker", function() {
		$_baker = baker::mq("
			SELECT 
			*,
			baker_worldcup.baker_idx,
			baker.idx `idx`,
			COUNT(baker_worldcup.baker_idx) `winCount`
			FROM baker
			LEFT JOIN baker_worldcup
			ON baker.idx = baker_worldcup.baker_idx
			GROUP BY baker.idx
			")->fetchAll();

		foreach ($_baker as $key => & $v) {
			$v['item'] = json_decode($v['item']);
		}

		return responseJSON($_baker);
	});
	//

	//월드컵 결과
		post("/post/worldcupResult", function() {
			$_POST['type'];
			switch ($_POST['type']) {
				case 'store':
					$set = ["baker_idx" => $_POST['result']['idx']];
					baker_worldcup::insert($set);
					break;
				
				case 'bread':
					$set = ["winner" => $_POST['result'][0]['idx'], "second"=> $_POST['result'][1]['idx']];
					bread_worldcup::insert($set);
					break;
			}
		});
	//

	//카트에 아이템 등록
		post("/post/cart", function() {
			if (!is_numeric($_POST['count']) || $_POST['count'] <= 0) {
				move('back', "상품개수는 1개이상 숫자만 입력 가능합니다.");
			}

			$is_cart = cart::find('bread_idx = ? && state = ? && user_idx = ?', [$_POST['bread_idx'], "save", USER['idx']]);

			if ($is_cart && $is_cart['order_baker'] == $_POST['order_baker']) {
				$is_cart['count'] += $_POST['count'];
				cart::update($is_cart, $is_cart['idx']);
				move('back', "카트에 상품이 담겼습니다.");
			}

			$_POST['order_idx'] = "";
			$_POST['state'] = "save";
			$_POST['user_idx'] = USER['idx'];

			cart::insert($_POST);
			move("back", "카트에 상품이 담겼습니다.");
		});
	//

	// 카트 비우기, 주문하기
		post("/post/updateCart/$", function($idx) {
			if ($_POST['type'] == "empty") {
				$cartIdx = cart::findAll('state = ? && user_idx = ?', ["save", USER['idx']]);

				foreach ($cartIdx as $key => $v) {
					cart::delete($v['idx']);
				}

				move('back', "카트를 비웠습니다");
				die;
			}

			$order = order_::insert(["order_user" => USER['idx'], "order_state" => "order"]);

			$nowCart = cart::findAll('state = ? && user_idx = ?', ["save", USER['idx']]);
			
			foreach ($nowCart as $key => $v) {
				$v['order_idx'] = $order;
				$v['state'] = "order";

				cart::update($v, $v['idx']);
			}

			move("/pickUpHistory", "주문이 완료되었습니다.");
		});	

		//주문상태 변경
		post("/post/orderState/$", function($idx) {
			$order = order_::find('idx = ?', [$idx]);
			$cart = cart::findAll('order_idx = ?', [$order['idx']]);
			$store = baker::find('name = ?', $_POST['store']);

			foreach ($cart as $key => $v) {
				if ($v['order_baker'] == $store['idx']) {
					
					if ($v['state'] != "order") {
						move('back', "취소할수 없는 상품입니다");
					}

					$v['state'] = "cancel";
					cart::update($v, $v['idx']);
				}
			}

			move('back', "주문이 취소되었습니다");
		});

		//매장 정보 변경
		post("/post/storeUpdate/$", function($idx) {
			$file = $_FILES['image'];
			$storeData = baker::find('idx = ?', $idx);

			if ($_FILES['image']['size'] > 0 && file_exists(ROOT.'/resources/store/'.$storeData['image'])) {
				unlink(ROOT.'/resources/store/'.$storeData['image']);
			}

			if ($_FILES['image']['size'] > 0) {
				$fileName = microtime().$file['name'];
				move_uploaded_file($file['tmp_name'], ROOT."/resources/store/".$fileName);
				$storeData['image'] = $fileName;
			}

			$storeData['contents'] = $_POST['contents'];

			baker::update($storeData, $storeData['idx']);
			move("/storeCare/$idx", "수정되었습니다");
		});	

		//상품 관리 업데이트
		post("/post/productCare/$", function($idx) {
			$baker = baker::find('idx = ?', $idx);

			$selItem = $baker['item'] ? $baker['item'] : "[]";
			$notSelItem = $baker['notsel'] ? $baker['notsel'] : "[]";

			$breads = array_merge(json_decode($selItem, true), json_decode($notSelItem, true));

			$nowsale = [];
			$notsale = [];

			foreach ($breads as $key => $v) {
				if (@$_POST[$v]) {
					$nowsale[] = $v;
					continue;
				}

				$notsale[] = $v;
			}

			$baker['item'] = json_encode($nowsale); 
			$baker['notsel'] = json_encode($notsale);

			baker::update($baker, $baker['idx']);
			move("/productCare/$idx", "수정이 완료되었습니다");
		});

		post("/post/orderCare/$", function($idx) {
			$order = order_::find('idx = ?', [$idx]);
			$cart = cart::findAll('order_idx = ?', [$order['idx']]);

			foreach ($cart as $key => $v) {
				if ($v['order_baker'] == $_POST['store'] && $v['state'] == "cancel") {
					move('back', "이미 취소된 주문입니다.");
				}

				if ($v['order_baker'] != $_POST['store']) {
					continue;
				}

				$v['state'] = "order" ? "waiting" : ("waiting" ? "pickUp" : "");
				cart::update($v, $v['idx']);
			}

			move('back', "주문상태가 변경되었습니다");
		});

		//빵집 등록
		post("/post/bakerSave", function() {
			$baker = $_POST['data'];

			unset($baker['w_score']);
			unset($baker['idx']);
			$baker['item'] = json_encode($baker['item']);
			$baker['notsel'] = "";

			baker::insert($baker);
			user::insert(["id"=> $baker['admin_id'], "pass_word"=> "1234", "user_name"=> $baker['name']]);
			echo json_encode(['type'=> 'success', 'msg'=> "등록이 완료되었습니다."]);
		});
 ?>