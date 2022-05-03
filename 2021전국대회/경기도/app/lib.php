<?php 
  session_start();
  date_default_timezone_set("Asia/Seoul");
  
  define("ROOT", $_SERVER['DOCUMENT_ROOT']);
  define("USER", @$_SESSION['user']);
  require "base.php";

  function dd() {
    echo "<pre>";
    var_dump(...func_get_args());
    echo "</pre>";
  }

  function move($url, $msg = false) {
    if (is_array($msg)) {
      $msg = implode("\\n", $msg);
    }

    echo json_encode(["msg"=> $msg, "url"=> $url]);
  }

  function view($loc, $data = []) {
    echo json_encode(["loc"=> $loc, "data"=> $data]);
  }

  function responseJSON($json) {
    header("Content-Type: application/json");
    echo json_encode($json);
  }
?>