<?php 
	namespace model;
	use \PDO;

	/**
	 * 
	 */
	class _base
	{
		public static $pdo = null;
		public $table = '';

		public static function __callStatic($name, $args)
		{
			$model = "Model\\$name";

			if (class_exists($model)) {
				$inst = new $model();
				$inst->table($name);
				return $inst;
			} else {
				$db = new self();
				return $db->{$name}(...$args);
			}
		}

		public function __call($name, $args)
		{
			return $this->mq(...$args)->{$name}(); 
		}

		public function mq($sql, $data = [])
		{
			if (!self::$pdo) {
				self::$pdo = new PDO("mysql:host=localhost;charset=utf8;dbname=web002", "root", "", [
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
				]);
			}
			$q = self::$pdo->prepare($sql);
			$q->execute($data);

			return $q;
		}

		public function find($sql, $data = [])
		{
			return $this->fetch("SELECT * from `{$this->table}` WHERE ".$sql ,$data);
		}

		public function get($sql = '', $data = [])
		{
			return $this->fetchAll("SELECT * FROM `{$this->table}` ".$sql, $data);
		}

		public function del($idx)
		{
			return $this->mq("DELETE FROM `{$this->table}` WHERE `idx` = ? ", [$idx]);	
		}

		public function save($save)
		{
			$k = array_keys($save);
			$v = array_values($save);

			$up = exjoin($k, "= ?", "`");
			$ik = exjoin($k);
			$iv = exjoin(array_fill(0, count($k), "?"));

			return $this->mq(
				(isset($save['idx'])) ?
					"UPDATE `{$this->table}` SET $up WHERE `idx` = '{$save['idx']}'" :
					"INSERT INTO `{$this->table}` ($ik) values ($iv)", $v
			);
		}

		public function for($val, $key = 'idx')
		{
			return $this->find("{$key} = ?", [$val]);
		}

		public function table($t)
		{
			$this->table = $t;

			return $this;
		}

		public function init()
		{
			// $member = json_decode(file_get_contents(ROOT."/data/member.json"));

			// foreach ($member as $key => $value) {
			// 	$val = (array) $value;

			// 	$this->table("member")->save($val);
			// }
			// $member = json_decode(file_get_contents(ROOT."/data/info.json"));

			// foreach ($member as $key => $value) {
			// 	$val = (array) $value;

				// $this->table("info")->save($val);
			// }
		}
	}