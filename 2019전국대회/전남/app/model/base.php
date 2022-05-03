<?php 
	class DB {
		public static $pdo = [];

		public static function mq($sql, $arr = []) {
			if (!self::$pdo) {
				self::$pdo = new PDO("mysql:host=localhost; charset=utf8; dbname=19_jeon;", "root", "", [
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

		public static function update($data, $id, $name = 'idx') {
			$table = get_called_class();
			$sql = "`".implode("` = ?, `", array_keys($data))."` = ?";
			self::mq("UPDATE $table SET {$sql} WHERE $name = '$id'", array_values($data));
			return self::$pdo->lastInsertid();
		}

		public static function delete($id, $name = 'idx') {
			$table = get_called_class();
			return self::mq("DELETE FROM $table WHERE $name = '$id'");
		}

		public static function dbSet() {
			$userCk = user::find('user_id = ?', ["admin"]);
			$movieCk = movie::mq("SELECT * FROM movie")->fetch();

			if (!$userCk) {
				$pass = passHash("1234", rand());
				user::insert(["user_id"=> "admin", "user_pass"=> $pass[0], "salt"=> $pass[1]]);
			}

			if (!$movieCk) {
				$dataName = ["movie", "movieList", "theater"];

				foreach ($dataName as $key => $v) {
					$findData = json_decode(file_get_contents(ROOT."/resources/data/$v.json"), true);

					foreach ($findData as $key => $val) {
						strtolower($v)::insert($val);
					}
				}
			}
		}
	}

	class movie extends DB{};
	class user extends DB{};
	class movielist extends DB{
		public static function getMovie($sql) {
			return movielist::mq("
				SELECT 
					movielist.*,
					movie.title,
					movie.posterImage,
					theater.name `theaterName`
				FROM movielist 
				LEFT JOIN movie ON movielist.movieCode = movie.code
				LEFT JOIN theater ON theater.code  = movielist.theaterCode
				{$sql}
				GROUP BY movielist.code 
				ORDER BY movielist.day ASC, movielist.time ASC
				")->fetchAll();
		}
	};
	class theater extends DB{};
	class ticket extends DB{
		public static function seatCount($code) {
			return ticket::mq("SELECT SUM(cnt) `seat_cnt` FROM ticket WHERE scheduleCode = '$code' && state = '예매완료'")->fetch()['seat_cnt'];
		} 
	};
	class seat extends DB{};
	class comment extends DB{};
 ?>