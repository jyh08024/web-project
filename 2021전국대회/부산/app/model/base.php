<?php 
	class DB {
		public static $pdo = [];

		public static function mq($sql, $arr = []) {
			if (!self::$pdo) {
				self::$pdo = new PDO("mysql:host=localhost; charset=utf8; dbname=2021_busan;", "root", "", [
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

		public static function allData($sql = "") {
			$table = get_called_class();
			return self::mq("SELECT * FROM $table $sql")->fetchAll();
		}

		public static function insert($data) {
			$table = get_called_class();
			$sql = "`".implode("` = ?, `", array_keys($data))."` = ?";
			self::mq("INSERT INTO $table SET {$sql}", array_values($data));
			return self::$pdo->lastInsertid();
		}

		public static function update($data, $idx, $name = "idx") {
			$table = get_called_class();
			$sql = "`".implode("` = ?, `", array_keys($data))."` = ?";
			return self::mq("UPDATE $table SET {$sql} WHERE $name = '$idx'", array_values($data));
		}

		public static function delete($idx, $name = "idx") {
			$table = get_called_class();
			return self::mq("DELETE FROM $table WHERE $name = '$idx'");
		}
	}

	class baker_worldcup extends DB{};
	class bread_worldcup extends DB{};
	class bread extends DB{};
	class baker extends DB{};
	class cart extends DB{};
	class order_ extends DB{
		// function getOrder($loopData, $cartSql, $type, $sql1 = "", $sql2 = "") {
		// 	foreach ($loopData as $key => & $v) {
		// 		$cart = cart::findAll($cartSql);

		// 		$v['menuCount'] = count($cart);

		// 		foreach ($cart as $cartkey => & $value) {
		// 			$findBrad = bread::find('idx = ?', [$value['bread_idx']]);
		// 			$findBrad['bakery'] = baker::find('idx = ?', [$value['order_baker']])['name'];

		// 			$findBrad['order_idx'] = $v['idx'];
		// 			$v['bread_info'][$findBrad['bakery']][] = $findBrad;
		// 		}
		// 	}
		// }
	};
	class user extends DB{};
 ?>