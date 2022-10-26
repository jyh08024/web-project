<?php 
  session_start();
  date_default_timezone_set("Asia/Seoul");

  define("ROOT", $_SERVER['DOCUMENT_ROOT']);
  define("MANAGER", @$_SESSION['own_garden']);
  define("USER", @$_SESSION['user']);

  function dd() {
    echo "<pre>";
    var_dump(...func_get_args());
    echo "</pre>";
  }

  function move($url, $msg = false) {
    if (is_array($msg)) {
      $msg = implode("\\n", $msg);
    }

    if ($msg) {
      echo "<script>alert('$msg')</script>";
    }

    $url = $url == "back" ? "history.back();" : "location.href='$url'";
    echo "<script>$url</script>";
    exit;
  }

  function view($loc, $data = []) {
    extract($data);

    require ROOT."/view/header.php";
    require ROOT."/view/$loc.php";
    require ROOT."/view/footer.php";
  }

  function responseJSON($json) {
    header("Content-Type: application/json");
    echo json_encode($json);
  }

  function err($err, $loc, $msg) {
    if ($err) {
      move($loc, $msg);
    }
  }

  function empCk($data) {
    foreach ($data as $key => $v) {
      if (trim($v) == "") {
        move("back", "모든 값을 입력해주세요.");
      }
    }
  }

  function timeFormat($dateTime) {
    $at = new DateTime($dateTime);
    $today = new DateTime(date("Y-m-d H:i:s"));

    $diff = date_diff($at, $today);
    $viewTime = explode(" ", $dateTime);
    return $diff->h <= 24 ? $viewTime[1] : $viewTime[0];
  }

  function readImage($idx) {
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Pragma: no-cache");

    if (!isset($_SERVER['HTTP_REFERER'])) {
      move("back", "잘못된 접근입니다.");
    }

    $image = image::find('idx = ?', $idx);
    readfile(ROOT.$image['src']);
  }

  function zipDown($idx) {
    $images = image::findAll("owner_idx = ? && type = ?", [$idx, "news"]);
    $path = ROOT."/resources/upload/";
    $zip = new ZipArchive();
    
    $zipName = time().".zip";

    if (!$zip->open($zipName, ZipArchive::CREATE)) {
      exit('error');
    }

    foreach ($images as $fileName) {
      $downLoadFile = explode("/", $fileName['src'])[3];
      $zip->addFile($path.$downLoadFile, $downLoadFile);
    }

    $zip->close();
    $downLoadName = board::mq('SELECT title FROM board WHERE idx = ?', $idx)->fetch()['title'];
    header("Content-type: application/zip");
    header("Content-Disposition: attachment; filename=$downLoadName.zip"); 
    readfile($zipName);

    unlink($zipName);
  }
?>