<?php 
  session_start();
  date_default_timezone_set("Asia/Seoul");

  define("ROOT", $_SERVER['DOCUMENT_ROOT']);
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

    $url = $url == "back" ? "history.back()" : "location.href='$url'";
    echo "<script>$url</script>";
    exit;
  }

  function view($loc, $data = []) {
    extract($data);

    require ROOT."/view/header.php";
    require ROOT."/view/$loc.php";
    require ROOT."/view/footer.php";
  }

  function view2($loc, $data = []) {
    extract($data);

    require ROOT."/view/$loc.php";
  }

  function responseJSON($json) {
    header("Content-Type: application.json");
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
        move("back", "필수 값을 입력해주세요.");
      }
    }
  }

  function pad($num) {
    return $num < 10 ? "0".$num : $num;
  }

  function setDate() {
    return date("Y-m-d", strtotime(implode("-", func_get_args())));
  }

  function calendar($year, $month, $garden) {
    $time = strtotime("$year-$month-01");
    $monthHtml = "";

    [$totalDay, $day] = explode("-", date("t-w", $time));
    $last = strtotime("$year-$month-$totalDay");
    $colorArr = ["6"=> "blue", "0"=> "red"];

    for ($i = 1; $i <= 42; $i++) {
      $d = $i > $day && $totalDay >= $i - $day ? $i - $day : "";
      $date = setDate($year, $month, $d);
      $dayCk = date("w", strtotime($date));

      $class = !$d ? "blackCol" : (@$colorArr[$dayCk] ? $colorArr[$dayCk] : "");

      $viewD = pad($d);
      $isSchedule = buskings::findAll('garden_id = ? && date = ?', [$garden, $date]);

      $scheduleId = array_map(function($v) {
        return $v['id'];
      }, $isSchedule);

      $idList = str_replace('"', "'", json_encode($scheduleId));

      $isBtn = count($isSchedule) ? "<button class='btn' style='padding: .3rem 1.6rem;' onclick=ScheduleView($idList)>일정 보기</button>" : "";

      $monthHtml .=
        $d
        ? 
        "
        <div class='$class'>
          <p style='margin-bottom: .4rem;'>$viewD</p>
          $isBtn
        </div>
        "
        : 
        "
          <div></div>
        ";
    }

    return $monthHtml;
  }
?>