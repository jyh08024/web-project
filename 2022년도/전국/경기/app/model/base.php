<?php 
  Class DB {
    public static $pdo = [];

    public static function mq($sql, $arr = []) {
      if (!self::$pdo) {
        self::$pdo = new PDO("mysql:host=localhost; charset=utf8; dbname=22_gyenggi;", "root", "", [
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
  }

  Class user extends DB {};
  Class garden extends DB {
    public static function guide() {
      $garden = garden::allData();

      $garden = array_map(function($v) {
        $v['star'] = review::mq("SELECT AVG(star) `star` FROM review WHERE garden = ?", $v['idx'])->fetch()['star'];
        $v['star'] = $v['star'] == NULL ? 0 : $v['star'];
        $v['themes'] = implode(", ", json_decode($v['themes']));
        return $v;
      }, $garden);

      return $garden;
    }

    public static function sortGuide($type) {
      $garden = garden::allData();

      $garden = array_map(function($v) {
        $v['star'] = review::mq("SELECT AVG(star) `star` FROM review WHERE garden = ?", $v['idx'])->fetch()['star'] * 1;
        $v['star'] = $v['star'] == NULL ? 0 : $v['star'];
        $v['themes'] = implode(", ", json_decode($v['themes']));

        $v['reserve'] = count(res::findAll("garden = ?", $v['idx']));
        $v['review'] = count(review::findAll("garden = ?", $v['idx']));

        return $v;
      }, $garden);

      usort($garden, function($a, $b) use($type) {
        return $a[$type] > $b[$type] ? -1 : ($a[$type] == $b[$type] ? 0 : 1);
      });

      return $garden;
    }
  };
  Class image extends DB {};
  Class res extends DB {};
  Class review extends DB {};
  Class no_res extends DB {};
  Class board extends DB {};
  Class comment extends DB {};
?>