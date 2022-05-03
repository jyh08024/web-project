<?php 
	get("/", function() {
		view("index");
	});

	get("/stamp", function() {
		view("stamp");
	});

	get("/daejeon/$/$", function($type, $search) {
		$rank = stores::dajeonBaker($type, $search, "5");
		$length = count($rank);
		$normal = stores::dajeonBaker($type, $search, "$length, 9999999999");

		view("sub", get_defined_vars());
	});

	get("/sale/$", function($search) {
		$bread = breads::getMenus($search);
		view("sale", get_defined_vars());
	});

	middleware("not_user", function() {
		get("/login", function() {
			view("login");
		});

		post("/post/login", function() {
			$login = users::find('id = ? && pw = ?', [$_POST['id'], $_POST['pw']]);

			if (!$login) {
				move('back', "아이디 혹은 비밀번호를 다시 확인해주세요.");
			}

			if ($login['type'] == "owner") {
				$login['store'] = stores::find('user_id = ?', $login['id']);
			}

			$_SESSION['user'] = $login;
			move('/', "로그인에 성공하였습니다.");
		});
	});

	middleware("is_user", function() {
		get("/mypage", function() {
			$location = locations::allData();
			view("mypage", get_defined_vars());
		});

		get("/order/$/$/$", function($id, $id2, $page) {
			$baker = stores::getInfo($id);

	    $reviews = $baker['review'];
	    $page = $page ? $page : 1;

	    $block = array_chunk($reviews, 2);
	    $board = array_chunk($block, 2);

	    $now = ceil($page / 2);
	    $end = count($block) == $page;

			view("order", get_defined_vars());
		});
		
		get("/logout", function() {
			unset($_SESSION['user']);
			move('/', "로그아웃에 성공하였습니다.");
		});
	});

	post("/post/userInfo", function() {
		$_SESSION['user']['location_id'] = $_POST['location_id'];
		$_SESSION['user']['transportation'] = $_POST['transportation'];

		users::update($_SESSION['user'], USER['id']);
		move('back', "반영되었습니다.");
	});	

	post("/post/orderState/$", function($id) {
		dd($_POST['state']);
		$order = deliveries::find('id = ?', $id);
		$order['state'] = $_POST['state'];

		if ($_POST['state'] == "taking") {
			$order['taking_at'] = date("Y-m-d H:i:s");
			$order['driver_id'] = USER['id'];
		}

		deliveries::update($order, $id);
	});

	post("/post/resState/$", function($res) {
		$res = reservations::find('id = ?', $res);
		$res['state'] = $_POST['state'];

		reservations::update($res, $res['id']);
	});

	post("/post/sale", function() {
		$bread = breads::find('id = ?', $_POST['bread_id']);
		$bread['sale'] = $_POST['sale'];

		breads::update($bread, $bread['id']);
		return responseJSON(["type"=> "sale", "msg"=> "할인율이 반영되었습니다."]);
	});

	post("/post/review", function() {
		if ($_FILES['image']['size'] > 0) {
			if (!exif_imagetype($_FILES['image']['tmp_name'])) {
				return responseJSON(["type"=> "err", "msg"=> "파일은 이미지만 업로드 가능합니다."]);
				exit;
			}

			$fileName = microtime().$_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'], ROOT.$fileName);

			$_POST['image'] = "/image/review/".$fileName;
		}

		$_POST['user_id'] = USER['id'];

		reviews::insert($_POST);
		return responseJSON(["type"=> "review", "msg"=> "리뷰가 작성되었습니다."]);
	});	

	post("/post/score", function() {
		$_POST['user_id'] = USER['id'];

		grades::insert($_POST);
		return responseJSON(["type"=> "score", "msg"=> "평점이 반영되었습니다."]);
	});

	post("/html/mypage", function() {
		$t_label = $_SESSION['label'][USER['type']];

		view2("mypageLoad", get_defined_vars());
	});

	post("/post/search", function() {
		$type = ["store"=> "stores.name", "menu"=> "breads.name", "loc"=> "locations"][$_POST['search_type']];
		$val = $_POST['search_val'];

		move("/daejeon/$type/$val");
	});

	post("/html/dajeon/$/$", function($type, $search) {
		$rank = stores::dajeonBaker($type, $search, "5");
		$length = count($rank);
		$normal = stores::dajeonBaker($type, $search, "$length, 9999999999");

		view2("subLoad", get_defined_vars());
	});

	post("/post/saleSearch", function() {
		$search = $_POST['search_val'];
		move("/sale/$search");
	});

	post("/post/reserve/$", function($id) {
		if (USER['type'] == "owner" || USER['type'] == "rider") {
			move('back', "가게의 주인이나 라이더는 예약할 수 없습니다.");
		}

		$_resTime = $_POST['date']." ".$_POST['time'];

		if (strtotime($_resTime) < strtotime(date("Y-m-d H:i"))) {
			move('back', "예약 시간은 현재 시간보다 빠를 수 없습니다.");
		}

		$data = ["store_id"=> $id, "user_id"=> USER['id'], "reservation_at"=> $_resTime, "state"=> "order"];

		reservations::insert($data);
		move('back', "예약 되었습니다.");
	});

	post("/post/order/$", function($store) {
		if (USER['type'] == "owner" || USER['type'] == "rider") {
			return responseJSON('주인이나 라이더는 주문을 할 수 없습니다.');
		}

		$deliver = deliveries::insert(["store_id"=> $store, "orderer_id"=> USER['id'], "state"=> "order"]);
		$return = [0, 0];

		foreach ($_POST['arr'] as $key => $v) {
			$return[0] += $v['cnt'];
			$return[1] += $v['price'] * $v['cnt'];

			$menu = ["delivery_id"=> $deliver, "bread_id"=> $v['bread'], "price"=> $v['price'], "cnt"=> $v['cnt']];
			delivery_items::insert($menu);
		}

		return responseJSON(["msg"=> "총 <$return[0]>개, <$return[1]>원이 주문되었습니다."]);
	});

	post("/html/saleLoad/$", function($search) {
		$bread = breads::getMenus($search);
		view2("saleLoad", get_defined_vars());
	});

	post("/post/reple/$", function($id) {
		$_POST['review_id'] = $id;
		replies::insert($_POST);
		move('back', "답글이 작성되었습니다.");
	});

	post("/post/like/$", function($id) {
		$overlap = likes::find('user_id = ? && review_id = ?', [USER['id'], $id]);

		if ($overlap) {
			move('back', "이미 공감을 누른 게시물 입니다.");
		}

		likes::insert(["user_id"=> USER['id'], "review_id"=> $id]);
		move('back');
	});

	post("/load/price/$", function($id) {
		$bread = breads::findAll('store_id = ?', $id);
		return responseJSON($bread);
	});
 ?>