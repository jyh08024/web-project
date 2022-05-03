<?php 
	get("/", function() {
		DB::setData();
		view("index");
	});

	get("/sub1", function() {
		view("sub1");
	});

	get("/sub2", function() {
		view("sub2");
	});

	get("/sub3", function() {
		view("sub3");
	});

	get("/admin", function() {
		view("admin");
	});

	post("/login", function() {
		if ($_POST['ID'] == "admin" && $_POST['Password'] == "1234") {
			$_SESSION['user'] = $_POST;
			move("/", "로그인에 성공하였습니다.");
		} else {
			move("back", "아이디 또는 비밀번호를 다시 확인해 주세요.");
		}
	});

	middleware("admin", function() {
		get("/productCare", function() {
			view("productCare");
		});

		post("/productAll", function() {
			return resJSON(product::allData());
		});

		post("/update/product", function() {
			if (trim($_POST['itemList']) == "") {
				return resJSON(["message"=> "누락된 값이 있습니다."]);
			}

			$file = $_FILES['image'];
			$data = product::find("idx = ?", $_POST['idx']);
			$data['itemList'] = $_POST['itemList'];

			$path = $data['image'];

			if ($file['size'] > 0 || $file['name']) {
				if (explode("/", $file['type'])[0] != "image") {
					return resJSON(["message"=> "사진은 이미지만 업로드 가능합니다."]);
				}

				$path = "/resources/upload/".md5($file['name'].microtime()).$file['name'];
				move_uploaded_file($file['tmp_name'], ROOT.$path);
			}

			$data['image'] = $path;
			product::update($data, $data['idx']);
			return resJSON(["message"=> "수정되었습니다."]);
		});

		get("/eventCare/$", function($date) {
			$data = $date == 0 ? [] : event::findAll('date = ?', $date);

			for ($i=0; $i < count($data); $i++) { 
				$now = $data[$i];
				$data[$i]['dur'] = 0;
				$c = count(event::mq("SELECT * FROM event WHERE phone = ?", $data[$i]['phone'])->fetchAll());

				$chain = true;

				for ($j=0; $j < $c; $j++) { 
					if (!$chain) {
						continue;
					}

					$nowDate = strtotime($data[$i]['date']."-$j days");
					$searchDate = date("Y-m-d", $nowDate);
					$ck = event::find("phone = ? && date = '$searchDate'", $data[$i]['phone']);

					if ($ck) {
						$data[$i]['dur'] += 1;
					} else {
						$chain = false;
					}
				}
			}

			view("eventCare", get_defined_vars());
		});
	});

	post("/api/event/applicants", function() {
		extract($_POST);

		try {
			if (!isset($name) || !isset($phone) || !isset($score)) {
				throw new Exception("Error Processing Request", 1);
			}

			if ((trim($name == "") || trim($phone == "")) || (!preg_match("/^[ㄱ-힣A-Za-z]{2,50}$/u", $name) || !preg_match("/^\d{3}-\d{4}-\d{4}$/", $phone))) {
				throw new Exception("Error Processing Request", 1);
			}

			$today = date("Y-m-d");
			$ck = event::find('phone = ? && date = ?', [$_POST['phone'], $today]);

			if ($ck) {
				return resJSON(["message"=> "하루에 한번만 참여할 수 있습니다."], 401);
			}

			$_POST['date'] = $today;
			event::insert($_POST);
			return resJSON(["message"=> "이벤트에 참여해 주셔서 감사합니다."]);
		} catch (Exception $e) {
			return resJSON(["message"=> "오류가 발생했습니다. 다시 시도해 주세요."], 401);			
		}
	});

	get("/api/event/$/stamps", function($phone) {
		try {
			if (!$phone || !preg_match("/^\d{3}-\d{4}-\d{4}$/", $phone)) {
				throw new Exception("Error Processing Request", 1);
			}

			$ck = event::findAll('phone = ? ORDER BY date DESC', $phone);

			if (!$ck) {
				return resJSON(["message"=> "출석 정보가 없습니다."], 404);
			}

			$today = date("Y-m-d");
			$stamps = [""];

			for ($i=0; $i < count($stamps); $i++) { 
				$date = date("Y-m-d", strtotime("-$i day"));
				$yesterday = event::find('phone = ? && date = ?', [$phone, $date]);

				if (!$yesterday) break;
				array_unshift($stamps, $date);
			}

			if (!count($stamps)) {
				throw new Exception("Error Processing Request", 1);
			}

			unset($stamps[count($stamps) -1]);

			if (count($stamps) == 2) {
				$stamps[] = "";
			}

			if (count($stamps) == 1) {
				$stamps[] = "";
				$stamps[] = "";
			}

			$arr = array_slice($stamps, count($stamps) - 3, 3);
			return resJSON(["stamps"=> $arr]);
		} catch (Exception $e) {
			return resJSON(["message"=> "오류가 발생했습니다. 다시 시도해 주세요."], 401);
		}
	});

	get("/api/reviews", function() {
		try {
			$key = @$_GET['last-key'];
			$reviews = review::mq("SELECT * FROM review ORDER BY idx DESC")->fetchAll();

			if (!$key) {
				throw new Exception("Error Processing Request", 1);
			}

			$reviews = array_slice($reviews, $key - 10, 10);
			$data = [
				"reviews"=> [],
			];

			foreach ($reviews as $key => $v) {
				$image = image::find('review_idx = ?', $v['idx']);

				if ($image) {
					$v['photo'] = $image['file'];
				} else {
					$v['photo'] = "";
				}

				$v['key'] = $v['idx'];
				$v['contents'] = mb_substr($v['contents'], 0, 50);
				unset($v['idx']);

				$data['reviews'][] = ["key"=> $v['key'], "name"=> $v['name'], "product"=> $v['product'], "shop"=> $v['shop'], "purchase-date"=> $v['purchase-date'], "contents"=> $v['contents'], "score"=> $v['score'], "photo"=> $v['photo']];
			}

			return resJSON($data);
		} catch (Exception $e) {
			return resJSON(["message"=> "오류가 발생했습니다."]);	
		}
	});

	get("/api/reviews/$", function($key) {
		try {
			if (!$key) {
				throw new Exception("Error Processing Request", 1);
			}

			$review = review::find('idx = ?', $key);

			if (!$review) {
				throw new Exception("Error Processing Request", 1);
			}

			$review['photo'] = [];

			$image = image::findAll('review_idx = ?', $key);

			foreach ($image as $key => $v) {
				$review['photo'][] = ["file"=> $v['file']];
			}

			return resJSON(["name"=> $review['name'], "product"=> $review['product'], "shop"=> $review['shop'], "purchase-date"=> $review['purchase-date'], "contents"=> $review['contents'], "score"=> $review['score'], "photos"=> $review['photo']]);
		} catch (Exception $e) {
			return resJSON(["message"=> "구매 후기를 찾을 수 없습니다."], 404);
		}
	});

	post("/api/reviews", function() {
		$file = @$_FILES['photo'];

		try {
			$err = false;

			foreach ($_POST as $key => $v) {
				if ($err) {
					break;
				}

				if (trim($v) == "") {
					$err = true;
				}

				if ($err) {
					break;
				}

				if ($key == "name" && !preg_match("/^[ㄱ-힣A-Za-z]{2,50}$/u", $v)) {
					$err = true;
				}

				if ($key == "contents" && strlen($v) < 100) {
					$err = true;
				}
			}

			if ($err) {
				throw new Exception("Error Processing Request", 1);
			}

			$data = array_map(function($v) {return htmlspecialchars($v);}, $_POST);
			$fileRes = [];

			if ($file) {
				for ($i=0; $i < count($file['name']); $i++) { 
					$fileName = $file['name'][$i];

					if (!$fileName) {
						continue;
					}

					$path = "/resources/upload/".md5($fileName.microtime()).$fileName;
					$uploadPath = ROOT.$path;

					$resize = resize($file['tmp_name'][$i]);
					$marked = water($resize);

					imagejpeg($marked, $uploadPath);
					$fileRes[] = $path;
				}
			}

			$reviewIdx = review::insert($_POST);
			foreach ($fileRes as $key => $v) {
				image::insert(["file"=> $v, "review_idx"=> $reviewIdx]);
			}

			return resJSON(["message"=> "구매 후기가 등록되었습니다."]);
		} catch (Exception $e) {
			return resJSON(["message"=> "오류가 발생했습니다. 다시 시도해 주세요."]);
		}
	});

	post("/search", function() {
		$date = $_POST['date'];
		move("/eventCare/".$date);
	});
 ?>