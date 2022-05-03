<?php 
	class DB {
		public static $pdo = [];

		public static function mq($sql, $arr = []) {
			if (!self::$pdo) {
				self::$pdo = new PDO("mysql:host=localhost; charset=utf8; dbname=18_chungnam;", "root", "", [
					19 => 2,
					3 => 2,
				]);
			}

			$q = self::$pdo->prepare($sql);
			$q->execute(is_array($arr) ? $arr : [$arr]);
			return $q;
		}

		public static function find($sql, $arr = []) {
			$table = get_called_class();
			return self::mq("SELECT * FROM $table WHERE $sql", $arr)->fetch();
		}

		public static function findAll($sql, $arr = []) {
			$table = get_called_class();
			return self::mq("SELECT * FROM $table WHERE $sql", $arr)->fetchAll();
		}

		public static function allData() {
			$table = get_called_class();
			return self::mq("SELECT * FROM $table")->fetchAll();
		}

		public static function insert($data) {
			$table = get_called_class();
			$sql = "`".implode("` = ?, `", array_keys($data))."` = ?";
			self::mq("INSERT INTO $table SET {$sql}", array_values($data));
			return self::$pdo->lastinsertId();
		}

		public static function update($data, $id, $name = 'idx') {
			$table = get_called_class();
			$sql = "`".implode("` = ?, `", array_keys($data))."` = ?";
			return self::mq("UPDATE $table SET {$sql} WHERE $name = '$id'", array_values($data));
		}

		public static function delete($id, $name = 'idx') {
			$table = get_called_class();
			return self::mq("DELETE FROM $table WHERE $name = '$id'");
		}

		public static function setDB() {
			$info = json_decode(file_get_contents("resources/data/info.json"), true);
			$user = json_decode(file_get_contents("resources/data/member.json"), true);

			$userCk = user::mq("SELECT * FROM user")->fetch();
			$proCk = pro::mq("SELECT * FROM pro")->fetch();

			if (!$userCk) {
				user::insert(["name"=> "admin", "id"=> "admin", "pw"=> "1234", "level"=> "admin"]);

				foreach ($user as $key => $v) {
					user::insert($v);
				}
			}

			if (!$proCk) {
				foreach ($info as $key => $v) {
					pro::insert($v);
				}
			}
		}
	}

	class user extends DB {};
	class pro extends DB {
		public static function getProData($type, $begin, $arrive, $start, $end) {
			$cate = $type ? "WHERE category = '$type'" : "";

			$data = pro::mq("
				SELECT 
				* 
				FROM pro 
				{$cate}
				")->fetchAll();

			$res = reserve::mq("
				SELECT 
				reserve.*,
				reserve.idx `reserv_index`,
				res_pro.*,
				res_pro.idx `res_pro_index`
				FROM reserve 
				LEFT JOIN res_pro 
				ON reserve.idx = res_pro.res_idx 
				WHERE reserve.start <= '$start' && reserve.end >= '$end'
				")->fetchAll();

			$list = array_map(function($v) use($res) {
				$v['now_quantity'] = @$v['now_quantity'] ? $v['now_quantity'] : $v['quantity'];
				$key = array_search($v['idx'], array_column($res, 'product_idx'));

				foreach (array_column($res, 'product_idx') as $key => $col) {
					$col == $v['idx'] ? $v['now_quantity'] -- : "";
				}

				return $v;
			}, $data);

			$search = $type || $begin || $arrive || $start || $end ? true : false;

			return ["list"=> $list, "search"=> $search];
		}
	};
	class reserve extends DB {
		public static function userRes($idx) {
			$res = reserve::mq("
				SELECT 
				reserve.*,
				reserve.idx `reserv_idx`,
				pro.*,
				pro.idx `product_index`,
				res_pro.*,
				res_pro.idx `res_pro_idx`
				FROM reserve 
				LEFT JOIN res_pro
				ON reserve.idx = res_pro.res_idx 
				LEFT JOIN pro 
				ON pro.idx = res_pro.product_idx
				WHERE user_idx = ? 
				ORDER BY payment_date DESC
				", $idx)->fetchAll();

			$state = ["reserv"=> "대기중", "payment"=> "결제완료", "cancel"=> "", "return"=> "반납완료"];

			foreach ($res as $key => & $v) {
				$v['view_state'] = $state[$v['state']];

				if ($v['state'] == "cancel") {
					$user = USER['name'];
					$v['view_reason'] = $v['reason'] == "관리자" ? "관리자에 의해 취소되었습니다." : "[$user]님의 의해 취소 되었습니다.";
				}
			}

			$list = array_filter($res, function($v) {
				return $v['state'] != "cancel";
			});

			$cancel = array_filter($res, function($v) {
				return $v['state'] === "cancel";
			});

			return [
				"list"=> $list,
				"cancel"=> $cancel,
			];
		}

		public static function getContract($idx) {
			$res = reserve::mq("
				SELECT 
				reserve.*,
				reserve.idx `reserv_idx`,
				pro.*,
				pro.idx `product_index`,
				res_pro.*,
				res_pro.idx `res_pro_idx`
				FROM reserve 
				LEFT JOIN res_pro
				ON reserve.idx = res_pro.res_idx 
				LEFT JOIN pro 
				ON pro.idx = res_pro.product_idx
				WHERE reserve.idx = ? 
				ORDER BY payment_date DESC
				", $idx)->fetch();

			$type = $res['category'] == "전기자동차" || $res['category'] == "장거리전기자동차" ? "time" : "date";
			$res['priceInfo'] = priceCalc($res['start'], $res['end'], $res['price'], $type);
			$res['user'] = user::find('idx = ?', $res['user_idx']);

			return $res;
		}

		public static function getRes() {
			$resData = reserve::mq("
				SELECT 
				reserve.*,
				reserve.idx `reserv_index`,
				res_pro.*,
				res_pro.idx `res_pro_idx`,
				pro.*,
				pro.idx `product_index`,
				pro.name `product_name`,
				user.*,
				user.idx `user_index`,
				user.id `user_id`,
				user.name `user_name`
				FROM reserve 
				LEFT JOIN res_pro ON reserve.idx = res_pro.res_idx 
				LEFT JOIN pro ON pro.idx = res_pro.product_idx 
				LEFT JOIN user ON reserve.user_idx = user.idx 
				WHERE state != 'cancel'
				ORDER BY state DESC, payment_date ASC
				")->fetchAll();

			usort($resData, function($a, $b) {
				$a = ($a['state'] == "return") ? 0 : ($a['state'] == "payment" ? 2 : 3);
				$b = ($b['state'] == "return") ? 0 : ($b['state'] == "payment" ? 2 : 3);

				return $b <=> $a;
			});

			return $resData;
		}

		public static function updateRes() {
			reserve::mq("UPDATE `reserve` SET `state` = 'return' WHERE `end` < ? && `state` = 'payment'", [date("Y-m-d H:i:s")]);
			reserve::mq("UPDATE `reserve` SET `state` = 'cancel', `reason` = '관리자' WHERE `start` < ? && `state` = 'reserv'", [date("Y-m-d H:i:s")]);
		}

		public static function resCare() {
			$resData = reserve::mq("
				SELECT 
				reserve.*,
				reserve.idx `reserv_index`,
				res_pro.*,
				res_pro.idx `res_pro_idx`,
				pro.*,
				pro.idx `product_index`,
				pro.name `product_name`,
				user.*,
				user.idx `user_index`,
				user.id `user_id`,
				user.name `user_name`
				FROM reserve 
				LEFT JOIN res_pro ON reserve.idx = res_pro.res_idx 
				LEFT JOIN pro ON pro.idx = res_pro.product_idx 
				LEFT JOIN user ON reserve.user_idx = user.idx 
				WHERE state = 'reserv' || state = 'cancel'
				ORDER BY state DESC, payment_date ASC
				")->fetchAll();

			usort($resData, function($a, $b) {
				$a = $a['state'] == "cancel" ? 0 : 2;
				$b = $b['state'] == "cancel" ? 0 : 2;

				return $b <=> $a;
			});

			return $resData;
		}
	};
	class res_pro extends DB {};
	class cart extends DB{
		public static function getCart() {
			$err = false;
			$cart = cart::mq("
				SELECT 
				cart.*,
				cart.idx `cart_idx`,
				pro.*, 
				pro.idx `product_idx`
				FROM cart 
				LEFT JOIN pro 
				ON cart.pro_idx = pro.idx
				WHERE user_idx = ?
				", USER['idx'])->fetchAll();

			foreach ($cart as $key => & $v) {
				$type = $v['category'] == "전기자동차" || $v['category'] == "장거리전기자동차" ? "time" : "date";
				$v['priceInfo'] = priceCalc($v['start'], $v['end'], $v['price'], $type);
				
				$res = reserve::mq("
					SELECT 
					reserve.*,
					reserve.idx `reserv_index`,
					res_pro.*,
					res_pro.idx `res_pro_index`
					FROM reserve 
					LEFT JOIN res_pro 
					ON reserve.idx = res_pro.res_idx 
					WHERE reserve.start <= ? && reserve.end >= ?
					", [$v['start'], $v['end']])->fetchAll();

				$v['now_quantity'] = in_array('now_quantity', $v) ? $v['now_quantity'] : $v['quantity'];

				foreach ($res as $key => $r) {
					$key = array_column($v['product_idx'], array_column($r, 'pro_idx'));

					if (!empty($res) && $res[$key] && is_numeric($key)) {
						$v['now_quantity'] = $v['now_quantity'] - 1;
					}
				}

				if ($v['now_quantity'] == 0) {
					$err = true;
				}
			}

			return ["cart"=> $cart, "err"=> $err];
		}
	};
 ?>