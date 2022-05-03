<?php 
	class DB {
		public static $pdo = [];

		public static function mq($sql, $arr = []) {
			if (!self::$pdo) {
				self::$pdo = new PDO("mysql:host=localhost; charset=utf8; dbname=mail_care;", "root", "", [
					19 =>2,
					3 =>2,
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

		public static function update($data, $idx) {
			$table = get_called_class();
			$sql = implode("= ?,", array_keys($data))."= ?";
			return self::mq("UPDATE $table SET {$sql} WHERE idx = '$idx'", array_values($data));
		}

		public static function delete($idx, $name = 'idx') {
			$table = get_called_class();
			return self::mq("DELETE FROM $table WHERE $name = ?", [$idx]);
		}
	}

	class user extends DB{};

	class mail extends DB{};

	class content extends DB{};

	class file extends DB{};
 ?>