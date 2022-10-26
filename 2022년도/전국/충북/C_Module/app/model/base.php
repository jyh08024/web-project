<?php 
  Class DB {
    public static $pdo = [];
    
    public static function mq($sql, $arr = []) {
      if (!self::$pdo) {
        self::$pdo = new PDO("mysql:host=localhost; charset=utf8; dbname=22_choongbook;", "root", "", [
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
      return self::mq("DELETE FROM $table WHERE $name ='$idx'");
    }
  }

  Class user extends DB {
    public static function userset() {
      $userCk = user::mq("SELECT * FROM user LIMIT 0,1")->fetch();

      if ($userCk) {
        return;
      }

      $pass = "1234";

      for ($i=0; $i < 5; $i++) { 
        if ($i == 0) {
          user::insert(["id"=> "admin", "pass"=> $pass, "name"=> "관리자", "type"=> "admin"]);
          continue;
        }

        user::insert(["id"=> "user".$i, "pass"=> $pass, "type"=> "user", "name"=> "회원".$i, "color"=> sprintf('#%06X', mt_rand(0, 0xFFFFFF))]);
      }
    }
  };

  Class lease extends DB {
    public static function getLease() {
      $today = date("Y-m-d");
      return lease::findAll("end > ? && start < ?", [$today, $today]);
    }

    public static function leaseList($build) {
      return lease::mq("
      SELECT
        lease.*,
        user.*,
        user.idx `user_id`,
        user.name `user_name`
      FROM lease 
      LEFT JOIN user ON user.idx = lease.user_idx
      WHERE end >= ? && build = ?
      ORDER BY lease.idx DESC"
      , [date("Y-m-d"), $build])->fetchAll();
    }
  }

  Class art extends DB {
    public static function artSet() {
      $artCk = art::mq("SELECT * FROM art LIMIT 0,1")->fetchAll();

      if ($artCk) {
        return;
      }

      $json = json_decode(file_get_contents(ROOT."/resources/C/art.json"), true);

      foreach ($json as $type => $v) {
        foreach ($v as $key => $art) {
          $art['art_id'] = $key;
          $art['type'] = $type;

          art::insert($art);
        }
      }
    }

    public static function getCate() {
      return art::mq("SELECT type FROM art GROUP BY type")->fetchAll();
    }
  }

  Class buy extends DB{
    public static function buyHistory() {
      $buy = buy::mq("
      SELECT
        buy.*,
        art.art_name `art_name`,
        art.price `price`
      FROM buy 
      LEFT JOIN art ON buy.art_idx = art.idx
      WHERE user_idx = ?
      ", USER['idx'])->fetchAll();
      $group = [];

      foreach ($buy as $key => $v) {
        $group[$v['buy_num']][] = $v;
      }

      return $group;
    }
  };
  Class cart extends DB{};
?>