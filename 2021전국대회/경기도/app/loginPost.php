<?php
  require "lib.php";

  $idCk = user::find('user_id = ? && user_pass = ?', [$_POST['user_id'], $_POST['user_pass']]);

  if (!$idCk) {
    echo json_encode(["msg"=> "아이디 또는 비밀번호를 확인해주세요.", "type"=> "error"]);
    exit;
  }

  $_SESSION['user'] = $idCk;
  echo json_encode(["move"=> "index.php", "type"=> "success", "user"=> $idCk]);
?>