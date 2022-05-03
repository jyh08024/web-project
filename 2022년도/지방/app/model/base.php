<?php 
	Class DB {
		public static $pdo = [];

		public static function mq($sql, $arr = []) {
			if (!self::$pdo) {
				self::$pdo = new PDO("mysql:host=localhost; charset=utf8; dbname=22_fifth;", "root", "", [
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
			return self::$pdo->lastinsertid();
		}

		public static function update($data, $idx, $name = 'idx') {
			$table = get_called_class();
			$sql = "`".implode("` = ?, `", array_keys($data))."` = ?";
			return self::mq("UPDATE $table SET {$sql} WHERE $name = '$idx'", array_values($data));
		}

		public static function delete($idx, $name = 'idx') {
			$table = get_called_class();
			return self::mq("DELETE FROM $table WHERE $name = '$idx'");
		}

		public static function setData() {
			$ck = product::mq("SELECT * FROM product LIMIT 0,1")->fetch();

			if ($ck) {
				return;
			}

			$file = file_get_contents(ROOT."/resources/특산품/★경상남도_시군별_특산품.txt");
			$line = '-----------------------------------------------------------------------------------------------
';

			foreach (explode("\n", str_replace("\t\t", "\t", explode($line, $file)[1])) as $key => $v) {
				if ($key == 18) {
					return;
				}

				$item = explode("\t", $v);

				product::insert(['idx'=> $key + 1, 'code'=> $item[0], 'location'=> $item[1], 'product'=> $item[2], 'itemList'=> $item[3], 'image'=> '/resources/특산품/'.$item[1].'_'.$item[2].'.jpg']);
			}	
		}
	}

	Class product extends DB{};
	Class event extends DB{};
	Class review extends DB{};
	Class image extends DB{};
 ?>