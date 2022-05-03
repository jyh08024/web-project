<?php 
  class DB {
    public static $pdo = [];
    
    public static function mq($sql, $arr = []) {
      if (!self::$pdo) {
        self::$pdo = new PDO("mysql:host=localhost; charset=utf8; dbname=2021_nation_gyenggi;", "root", "", [
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

    public static function update($data, $idx, $name = 'idx') {
      $table = get_called_class();
      $sql = "`".implode("` = ?, `", array_keys($data))."` = ?";
      return self::mq("UPDATE $table SET {$sql} WHERE $name = '$idx'", array_values($data));
    }

    public static function delete($idx, $name = 'idx') {
      $table = get_called_class();
      return self::mq("DELETE FROM $table WHERE $name = ?", [$idx]);
    }
  }

  class user extends DB{};
  class bakery_list extends DB{};
  class menu_list extends DB{};
  class review extends DB{};
  class event extends DB{};
  class ad extends DB{};
?>