<?php
  require "lib.php";

  $idCk = user::find('user_id = ?', $_POST['user_id']);

  if ($idCk) {
    echo json_encode(['msg'=> "중복된 아이디 입니다.", 'type'=> "error"]);
    exit;
  }

  user::insert($_POST);
  echo json_encode(['move'=> 'index.php', "type"=> "success"]);
?>