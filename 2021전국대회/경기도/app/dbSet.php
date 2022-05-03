<?php
  require "lib.php";

  $data = json_decode($_POST['data'], true);

  $userCk = user::find('idx', 1);
  $bakeryCk = bakery_list::find('idx', 1);
  $menuCk = menu_list::find('idx', 1);

  if (!$userCk) {
    user::insert([
      "user_id"=> "admin",
      "user_pass"=> "1234",
    ]);
  }

  if (!$bakeryCk) {
    foreach ($data['bakeries'] as $key => $v) {
      $v['hashTag'] = json_encode($v['hashTag']);
      $v['subImage'] = json_encode($v['subImage']);

      bakery_list::insert($v);
    }
  }

  if (!$menuCk) {
    foreach ($data['menuList'] as $key => $v) {
      menu_list::insert($v);
    }
  }
?>