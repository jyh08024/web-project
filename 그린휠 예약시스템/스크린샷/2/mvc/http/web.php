<?php 
	use \bundle\route;
	use \model\_base as DB; 


	route::get("", function() {
		$db = new DB();
		$db->init();

		return ["index"];
	});

	if (USER) {
		route::get("logout", function() {
			session_destroy();
			return ["로그아웃되었습니다", "/"];
		});

		route::get("cancle", function($idx) {
			$data = DB::reserve()->for($idx);
			$data['stat'] = "예약취소";
			if (USER['id'] == "admin") {
				$data['cancle'] = "관리자의 의해 취소되었습니다.";
			} else {
				$data['cancle'] = USER['name']."님의 의해 취소되었습니다.";
			}

			DB::reserve()->save($data);
			return ["취소되었습니다.", ""];
		});

		route::get("chk", function($idx) {
			$data = DB::reserve()->for($idx);
			$data['stat'] = "결제완료";
			DB::reserve()->save($data);

			return ["결제완료되었습니다.", ""];
		});

		if (USER['id'] == "admin") {
			route::get("material", function() {
				$date = $_GET['date'] ?? date("Y-m-01");

				return ['material',[
					'date' => $date,
					'next' => date("Y-m-01", strtotime($date)+3546000),
					'prev' => date("Y-m-01", strtotime($date)-1456000),
					'list' => DB::reserve()->priceList($date)
				]];
			});

			route::get("admin", function() {
				return ["admin", [
					'admin' => DB::reserve()->admin()
				]];
			});

			route::get("item", function() {
				return ["item", [
					'admin' => DB::reserve()->admin()
				]];
			});

			route::post("addImg", function() {
				$file = $_FILES['file'];
				$ext = strtolower(pathinfo($file['name'])['extension'] ?? '');

				if ($file['name'] == '') {
					return ["사진을 선택해주세요.", ""];
				}
				if (!in_array($ext, ["jpeg", "jpg", "png"])) {
					return ["사진은 jpeg, jpg, png만 업로드 가능합니다.", ""];
				}

				$data = DB::info()->getItem($_POST['idx']);
				$name = md5($file['name'].microtime()).".$ext";
				move_uploaded_file($file['tmp_name'], ROOT."/images/".$name);

				$data['detail'][] = $name;
				$data['detail'] = implode(',', $data['detail']);

				unset($data['type']);	
				DB::info()->save($data);

				return ["사진이 등록되었습니다.", "/detail/".$data['idx']];
			});

			route::get("chart", function($date) {
				$list = DB::reserve()->priceList($date);
				$max = max(array_column($list, "num"));
				$w = 1440;
				$h = 450;
				$image = imagecreatetruecolor($w, $h);
				$font = ROOT."/font/malgun.ttf";
				$x_bet = ($w-100) / count($list);

				imagefilledrectangle($image, 0, 0, $w, $h, 0xffffff);

				$i = 0;
				foreach ($list as $key => $value) {
					imagettftext($image, 9, 0, ($x_bet*$i++) + 50, $h-20, 0x000000, $font, str_replace(".", "/", $key));
				}

				for ($i=0; $i < 6; $i++) { 
					$y = $h - (50*$i+100);

					imageline($image, 35, $y, $w-50, $y, 0xaaaaaaa);
				}

				$max = ceil($max + $max/6);
				for ($i=0; $i <= 7; $i++) { 
					$y = ($h - 150) / 6 * $i + 50;
					$re = $max / 7 * (7-$i);
					imagettftext($image, 9, 0, 0, $y+5, 0x000000, $font, round($re, 1) );
				}

				$i = 0;
				foreach ($list as $key => $value) {
					$rect = ($max == 0) ? 0 : $value['num'] / $max;
					$x = $x_bet*$i+50;
					$y = 350 - ($rect * 350);


					imagefilledrectangle($image, $x, $y + 50, $x+30, 400, 0x00b2ff);
					$i++;
				}

				imagerectangle($image, 35, 50, $w-50, 400, 0x000000);

				header("Content-type: image/png");
				imagepng($image);
			});
		} else {
			route::get("rental", function() {
				$type = '';
				$list = DB::info()->get();

				if ($_GET['category'] ?? '') {
					$type = "기간";
					$start = $_GET['start'];
					$end = $_GET['end'];

					if (in_array($_GET['category'], ["전기자전거", "미니전기자동차", "전기스쿠터"])) {
						$type = "시간";
					}

					if ($type == "시간") {
						$start = date("Y-m-d ").$start.":00";
						$end = date("Y-m-d ").$end.":00";

						$ok = DB::info()->isOk($start, $end, 3600);
					} else {
						$start = $start." 00:00:00";
						$end = $end." 00:00:00";

						$ok = DB::info()->isOk($start, $end, 86400);
					}

					if ($ok != "") {
						return [$ok, ""];
					}

					$list = DB::info()->getList($_GET['category'], $start, $end);
				}

				return ['rental',
					[
						'memo' => DB::info()->getMemo(),
						'type' => $type,
						'list' => $list,
						'start' => $start ?? '',
						'end' => $end ?? '',
						'start_place' => $_GET['start_place'] ?? '',
						'end_place' => $_GET['end_place'] ?? ''
					]
				];
			});


			route::post("addMemo", function() {
				$_POST['user_idx'] = USER['idx'];
				DB::info()->table("memo")->save($_POST);

				return ["장바구니에 추가되었습니다.", ""];
			});

			route::get("delMemo", function($idx) {
				DB::info()->table("memo")->del($idx);
				return ["삭제되었습니다.", ""];
			});

			route::get("multiple", function() {
				$memo = DB::info()->getMemo();
				if (!$memo) {
					return ["장바구니에 최소 한개 이상 등록해주세요.", ""];
				}
				$idxs = [];

				foreach ($memo as $key => $value) {
					$ok = DB::info()->isOk($value['start'], $value['end'], ($value['info']['type'] == "시간") ? 3600 : 86400);

					if ($ok != '') {
						return move("예약이 불가능한 품목이 있습니다.", "/rental");
					}
				}

				$chk = true;

				foreach ($memo as $key => $value) {
					$data = [
						'info_idx' => $value['info']['idx'],
						'user_idx' => USER['idx'],
						'start' => $value['start'],
						'end' => $value['end'],
						'start_place' =>  $value['start_place'],
						'end_place' => $value['end_place'],
						'stat' => "머기중"
					];
					DB::reserve()->save($data);
					$idxs[] = DB::$pdo->lastInsertId();
					$quan = $value['info']['quantity'] - DB::info()->rowCount("SELECT * FROM `reserve` WHERE (`stat` = '결제완료' || `stat` = '머기중' || `stat` = '대기중') && `info_idx` = ?  && !(? < `start` || `end` < ?) ", [$value['info']['idx'], $value['end'], $value['start']]);

					if ($quan < 0) {
						$chk = false;
					}
				}

				if ($chk) {
					DB::mq("UPDATE `reserve` SET `stat` = '결제대기' WHERE `stat` = '머기중'");
				} else {
					DB::mq("DELETE FROM `reserve` WHERE `stat` = '머기중'");
					return ["예약이 불가능한 품목이 있습니다.", ""];
				}

				DB::mq("DELETE FROM `reserve` WHERE `stat` = '머기중'");

				return ["", "/multi/".implode(',', $idxs)];
			});

			route::get("multi", function($idxs) {
				$datas = [];
				foreach (explode(',', $idxs) as $key => $value) {
					$datas[] = DB::reserve()->getItem($value);
				}

				return ['multiple',[
					'data' => $datas
				]];
			});

			route::post("multi", function() {
				if ($_POST['type'] == "card") {
					if ($_POST['card'] == '' || $_POST['cardNum'] == '') {
						return ["결제정보를 모두 입력해주세요.", ""];
					}
				} else {
					if ($_POST['bank'] == '' || $_POST['sender'] == '' || $_POST['phone'] == '') {
						return ["결제정보를 모두 입력해주세요.", ""];
					}
				}

				foreach ($_POST['idxs'] as $key => $value) {
					$data = DB::reserve()->for($value);
					$data['card'] = $_POST['card'];
					$data['cardNum'] = $_POST['cardNum'];
					$data['bank'] = $_POST['bank'];
					$data['sender'] = $_POST['sender'];
					$data['phone'] = $_POST['phone'];
					$data['type'] = $_POST['type'];
					$data['stat'] = "대기중";

					DB::reserve()->save($data);
				}

				DB::mq("DELETE FROM `memo` WHERE `user_idx` = ?", [$_SESSION['user']['idx']]);

				return ["결제가 완료되었습니다.", "/mypage"];
			});

			route::get("mypage", function() {
				return ["mypage", [
					'list' => DB::reserve()->myList()
				]];
			});

			route::get("reserve" ,function($idx) {

				return ['reservation', [
					'data' => DB::info()->getItem($idx)
				]];
			});

			route::post("pay", function() {
				foreach ($_POST as $key => $value) {
					if ($value == '') {
						return move("모든 예약정보를 입력해주세요.");
					}
				}
				$info = DB::info()->getItem($_POST['info_idx']);

				if ($info['type'] == "시간") {
					$_POST['start'] = date("Y-m-d ").$_POST['start'].":00";
					$_POST['end'] = date("Y-m-d ").$_POST['end'].":00";

					$ok = DB::info()->isOk($_POST['start'], $_POST['end'], 3600);
				} else {
					$_POST['start'] = $_POST['start']." 00:00:00";
					$_POST['end'] = $_POST['end']." 00:00:00";

					$ok = DB::info()->isOk($_POST['start'], $_POST['end'], 86400);
				}

				if ($ok != '') {
					return [$ok, ""];
				}


				$_POST['user_idx'] = USER['idx'];
				$_POST['stat'] = "결제대기";

				$curQuan = $info['quantity'] - DB::rowCount("SELECT * FROM `reserve` WHERE (`stat` = '결제완료' || `stat` = '대기중') && `info_idx` = ?  && !(? < `start` || `end` <= ?) ", [$info['idx'], $_POST['end'], $_POST['start']]);
				if ($curQuan <= 0) {
					return ["예약가능한 수량이 없습니다.", ""];
				}
				DB::info()->table("reserve")->save($_POST);

				return ["", "/cardPay/".DB::$pdo->lastInsertId()];
			});

			route::post("cardPay", function() {
				if ($_POST['type'] == "card") {
					if ($_POST['card'] == '' || $_POST['cardNum'] == '') {
						return ["결제정보를 모두 입력해주세요.", ""];
					}
				} else {
					if ($_POST['bank'] == '' || $_POST['sender'] == '' || $_POST['phone'] == '') {
						return ["결제정보를 모두 입력해주세요.", ""];
					}
				}

				$data = DB::reserve()->for($_POST['reserve_idx']);
				$data['card'] = $_POST['card'];
				$data['cardNum'] = $_POST['cardNum'];
				$data['bank'] = $_POST['bank'];
				$data['sender'] = $_POST['sender'];
				$data['phone'] = $_POST['phone'];
				$data['type'] = $_POST['type'];
				$data['stat'] = "대기중";

				DB::reserve()->save($data);

				return ["결제가 완료되었습니다.", "/mypage"];
			});

			route::get("cardPay", function($idx) {

				return ["cardPay", [
					'data' => DB::reserve()->getItem($idx)
				]];
			});

			route::get("rentals", function($idx) {

				return ["contract", [
					'data' => DB::reserve()->getItem($idx)
				]];
			});

			route::post('rentalDownload', function() {
				header("Content-Disposition:attachment; filename=\"렌탈계약서.xls\";");
				header("Content-Type:file/unknown");
				echo '<meta http-equiv="content-type" content="application/vnd.ms-excel;" charset="UTF-8">';
				echo '<meta charset="UTF-8">';
				echo $_POST['table'];
			});
		}
	} else {
		route::get("login", function() {
			return ["member"];
		});

		route::post("login", function() {
			if ($_POST['id'] == '' || $_POST['pw'] == '') {
				return ["모든 입력란을 입력해주세요.", ""];
			}
			$over = DB::fetch("SELECT * FROM `member` WHERE `id` = ? && `pw` = ?", [$_POST['id'], $_POST['pw']]);

			if ($over) {
				$_SESSION['user'] = $over;
				return ["로그인되었습니다. ", "/"];
			} else {
				return ["아이디 혹은 비밀번호가 알맞지 않습니다. ", ""];
			}
		});

		route::get("reserve" ,function($idx) {
			return ["로그인 후 이용해주세요", "/login"];
		});
		route::get("rental" ,function() {
			return ["로그인 후 이용해주세요", "/login"];
		});
	}



	route::get("list", function($cate) {
		return ["list", [
			'data' => DB::info()->getList($cate)
		]];
	});

	route::get("detail", function($idx) {
		return ['detail', [
			'data' => DB::info()->getItem($idx)
		]];
	});



	new route($_GET['url'] ?? '');