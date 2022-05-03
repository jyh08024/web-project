<?php 
	class DB {
		public static $pdo = [];
		
		public static function mq($sql, $arr = []) {
			if (!self::$pdo) {
				self::$pdo = new PDO("mysql:host=localhost; charset=utf8mb4; dbname=21_jeonnam;", "root", "", [
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
			return self::$pdo->lastInsertid();
		}

		public static function update($data, $id, $name = 'id') {
			$table = get_called_class();
			$sql = "`".implode("` = ?, `", array_keys($data))."` = ?";
			return self::mq("UPDATE $table SET {$sql} WHERE $name = '$id'", array_values($data));
		}

		public static function delete($id, $name = 'id') {
			$table = get_called_class();
			return self::mq("DELETE FROM $table WHERE $name = '$id'");
		}
	}

	class users extends DB{
		public static function userOrder() {
			$order = deliveries::findAll('orderer_id = ? ORDER BY order_at DESC', USER['id']);
			$state = ["order"=> "주문 대기", "accept"=> "상품 준비 중", "reject"=> "주문 거절", "taking"=> "배달 중", "complete"=> "배달 완료"];

			foreach ($order as $key => & $v) {
				$v['store'] = stores::find('id = ?', $v['store_id']);
				$v['store']['owner'] = users::find('id = ?', $v['store']['user_id']);
				$v['store']['loc'] = locations::find('id = ?', $v['store']['owner']['location_id']);
				$v['view_state'] = $state[$v['state']]; 

				$v['rider'] = users::find('id = ?', $v['driver_id']);

				$v['review'] = reviews::find('store_id = ? && user_id = ?', [$v['store']['id'], USER['id']]);
				$v['grade'] = grades::find('store_id = ? && user_id = ?', [$v['store']['id'], USER['id']]);

				$v['items'] = delivery_items::findAll('delivery_id = ?', $v['id']);

				foreach ($v['items'] as $key => & $val) {
					$info = breads::find('id = ?', $val['bread_id']);

					$name = $info['name'];
					$price = $val['price'];
					$c = $val['cnt'];

					$v['view_menu'][] = "$name $price 원 $c 개";
				}
			}

			return $order;
		}

		public static function userRes() {
			$res = reservations::findAll('user_id = ? ORDER BY request_at DESC', USER['id']);
			$state = ["order"=> "신청", "accept"=> "승인", "reject"=> "거절"];

			foreach ($res as $key => & $v) {
				$v['store'] = stores::find('id = ?', $v['store_id']);
				$v['view_state'] = $state[$v['state']]; 
			}

			return $res;
		}

		public static function riderOrder() {
			$order = deliveries::findAll('state = ? || driver_id = ? ORDER BY order_at DESC', ["accept", USER['id']]);
			$state = ["accept"=> "", "taking"=> "", "complete"=> "배달완료"];

			foreach ($order as $key => & $v) {
				$v['store'] = stores::find('id = ?', $v['store_id']);
				$v['store']['owner'] = users::find('id = ?', $v['store']['user_id']);
				$v['store']['loc'] = locations::find('id = ?', $v['store']['owner']['location_id']);

				$v['orderer'] = users::find('id = ?', $v['orderer_id']);
				$v['orderer']['loc'] = locations::find('id = ?', $v['orderer']['location_id']);

				$v['view_state'] = $state[$v['state']];

				$v['items'] = delivery_items::findAll('delivery_id = ?', $v['id']);

				foreach ($v['items'] as $key => & $val) {
					$info = breads::find('id = ?', $val['bread_id']);

					$name = $info['name'];
					$price = $val['price'];
					$c = $val['cnt'];

					$v['view_menu'][] = "$name $price 원 $c 개";
				}
			}

			return $order;
		}
	};
	class stores extends DB{
		public static function ownerOrder() {
			$store = USER['store'];
			$order = deliveries::findAll('store_id = ? ORDER BY order_at DESC', $store['id']);

			$state = ["order"=> "", "accept"=> "수락한 주문", "reject"=> "거절한 주문", "taking"=> "배달 중", "complete"=> "배달 완료"];

			foreach ($order as $key => & $v) {
				$v['orderer'] = users::find('id = ?', $v['orderer_id']);
				$v['orderer']['loc'] = locations::find('id = ?', $v['orderer']['location_id']);
				$v['driver'] = users::find('id = ?', $v['driver_id']);

				$v['view_state'] = $state[$v['state']];

				$v['items'] = delivery_items::findAll('delivery_id = ?', $v['id']);

				foreach ($v['items'] as $key => & $val) {
					$info = breads::find('id = ?', $val['bread_id']);

					$name = $info['name'];
					$price = $val['price'];
					$c = $val['cnt'];

					$v['view_menu'][] = "$name $price 원 $c 개";
				}
			}

			return $order;
		}

		public static function ownerRes() {
			$store = USER['store'];
			$res = reservations::findAll('store_id = ? ORDER BY request_at DESC', $store['id']);

			$state = ["order"=> "", "accept"=> "승인한 예약", "reject"=> "거절한 예약"];

			foreach ($res as $key => & $v) {
				$v['user'] = users::find('id = ?', $v['user_id']);
				$v['view_state'] = $state[$v['state']];
			}

			return $res;
		}

		public static function menuList() {
			$store = USER['store'];

			$bread = breads::findAll('store_id = ?', $store['id']);

			foreach ($bread as $key => & $v) {
				$v['allSel'] = delivery_items::mq("SELECT SUM(cnt) `c` FROM delivery_items WHERE bread_id = ?", [$v['id']])->fetch();
				$v['sale_price'] = number_format(round($v['price'] * ((100 - $v['sale']) / 100)));
				$v['price'] = number_format($v['price']);
			}

			return $bread;
		}

		public static function dajeonBaker($type, $search, $limit) {
			$sql = $type && $search ? "WHERE $type LIKE '%$search%'" : "";

			if ($type == "locations") {
				$sql = "WHERE locations.name LIKE '%$search%' || locations.borough LIKE '%$search%' || CONCAT(locations.borough, ' ', locations.name) LIKE '%$search%'";				
			}

			$baker = stores::mq("
				SELECT 
				stores.*,
				stores.id `store_index`,
				stores.name `store_name`,
				deliveries.*,
				(SELECT SUM(cnt) FROM delivery_items WHERE delivery_id = deliveries.id) `allSel`,
				(SELECT AVG(score) FROM grades WHERE store_id = stores.id) `score`,
				(SELECT COUNT(store_id) FROM reviews WHERE store_id = stores.id) `rev_cnt`,
				locations.*,
				locations.id `loc_id`,
				locations.name `loc_name`,
				users.location_id
				FROM stores 
				LEFT JOIN users 
				ON stores.user_id = users.id 
				LEFT JOIN deliveries 
				ON deliveries.store_id = stores.id 
				LEFT JOIN locations
				ON locations.id = users.location_id 
				LEFT JOIN breads
				ON breads.store_id = stores.id
				{$sql}
				GROUP BY stores.id 
				ORDER BY allSel DESC, stores.name ASC
				LIMIT $limit
				")->fetchAll();

			return $baker;
		}

		public static function getInfo($id) {
			$store = stores::find('id = ?', $id);

			$store['owner'] = users::find('id = ?', $store['user_id']);
			$store['menu'] = breads::findAll('store_id = ?', $store['id']);
			
			$store['review'] = reviews::mq("
				SELECT 
				reviews.*,
				reviews.id `rev_id`,
				(SELECT COUNT(review_id) FROM likes WHERE review_id = reviews.id) `likes`,
				users.*,
				users.id `user_id`
				FROM reviews 
				LEFT JOIN users
				ON reviews.user_id = users.id 
				WHERE store_id = ?
				GROUP BY reviews.id 
				ORDER BY likes DESC 
				", $store['id'])->fetchAll();

			foreach ($store['review'] as $key => & $v) {
				$v['contents'] = htmlspecialchars($v['contents']);
				$v['title'] = htmlspecialchars($v['title']);

				$v['reple'] = replies::findAll('review_id = ?', $v['rev_id']);

				foreach ($v['reple'] as $key => & $val) {
					$val['contents'] = htmlspecialchars($val['contents']);
				}
			}

			return $store;
		}
	};
	class breads extends DB{
		public static function getMenus($search) {
			$sql = "WHERE breads.sale > 0";

			if ($search) {
				$sql .= " && breads.name LIKE '%$search%'";
			}

			$bread = breads::mq("
				SELECT 
				breads.*,
				breads.id `bread_id`,
				breads.name `bread_name`,
				breads.image `bread_image`,
				stores.*,
				stores.id `store_id`,
				stores.name `store_name`,
				stores.image `store_image`
				FROM breads
				LEFT JOIN stores 
				ON breads.store_id = stores.id 
				{$sql} 
				GROUP BY breads.id 
				ORDER BY sale DESC 
				")->fetchAll();

			return $bread;
		}
	};
	class reviews extends DB{};
	class likes extends DB{};
	class deliveries extends DB{};
	class delivery_items extends DB{};
	class distances extends DB{};
	class grades extends DB{};
	class reservations extends DB{};
	class replies extends DB{};
	class locations extends DB{};
 ?>