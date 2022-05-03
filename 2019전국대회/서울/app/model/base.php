<?php 
	class DB {
		public static $pdo = [];

		public static function mq($sql, $arr = []) {
			if (!self::$pdo) {
				self::$pdo = new PDO("mysql:host=localhost; charset=utf8; dbname=seoul_19;", "root", "", [
					19 => 2,
					3 => 2,
				]);
			}

			$q = self::$pdo->prepare($sql);

			$q ->execute(is_array($arr) ? $arr : [$arr]);

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

		public static function allData($sql, $arr = []) {
			$table = get_called_class();
			return self::mq("SELECT * FROM $table $sql", $arr)->fetchAll();
		}

		public static function insert($data) {
			$table = get_called_class();
			$sql = "`".implode("`= ?, `", array_keys($data))."` = ?";
			self::mq("INSERT INTO $table SET {$sql}", array_values($data));
			return self::$pdo->lastInsertid();
		}

		public static function update($data, $idx) {
			$table = get_called_class();
			$sql = "`".implode("`= ?, `", array_keys($data))."` = ?";
			return self::mq("UPDATE $table SET {$sql} WHERE idx = '$idx'", array_values($data));
		}

		public static function delete($idx, $name = 'idx') {
			$table = get_called_class();
			return self::mq("DELETE FROM $table WHERE $name = ?", [$idx]);
		}

		public static function dbSet() {
			$user = user::allData('');

			if ($user) {
				return;
			}

			$file = file_get_contents(ROOT."/resources/data/data2.json");

			$data = json_decode($file, true);

			foreach ($data['videos'] as $key => $v) {
				$v['date'] = date('Y-m-d H:i:s', $v['date']/1000);
				$v['video'] = "/resources/video/".$v['video'];
				$v['thumbnail'] = "/resources/img/".$v['thumbnail'];
				
				videos::insert($v);
			}

			foreach ($data['users'] as $key => $v) {
				$v['img'] = "/resources/img/".$v['img'];

				user::insert($v);
			}

			foreach ($data['follow'] as $key => $v) {
				follow::insert($v);
			}

			foreach ($data['comments'] as $key => $v) {
				$v['date'] = date('Y-m-d H:i:s', $v['date']/1000);

				comments::insert($v);
			}

			foreach ($data['recommends'] as $key => $v) {
				recommends::insert($v);
			}

			foreach ($data['view_history'] as $key => $v) {
				view_history::insert($v);
			}
		}
	}

	class user extends DB{};

	class videos extends DB{};

	class recommends extends DB{};

	class follow extends DB{};

	class comments extends DB{};

	class view_history extends DB{};
 ?>