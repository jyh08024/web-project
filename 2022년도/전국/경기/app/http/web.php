<?php 
  get("/", function() {
    // $json = json_decode(file_get_contents(ROOT."/resources/JSON/garden.json"), true)['gardens'];

    // foreach ($json as $key => $v) {
    //   $v['themes'] = json_encode($v['themes']);
    //   unset($v['score']);
    //   garden::insert($v);

    //   user::insert(["id"=> $v['manager_id'], "pass"=> "1234", "name"=> $v['name'], "type"=> "manager"]);
    // }

    // user::insert(["id"=> "admin", "pass"=> "1234", "name"=> "admin", "type"=> "admin"]);
    view("index");
  });

  get("/all", function() {
    view("allGarden");
  });

  get("/guide", function() {
    $garden = garden::guide();
    view("guide", get_defined_vars());
  });

  post("/get/sortGarden", function() {
    $type = $_POST['type'];
    return responseJSON(garden::sortGuide($type));
  });

  get("/news/$/$", function($garden, $page) {
    $last = $page * 10;
    $start = $last - 10;
    $sql = $garden != "all" ? "is_notice = ? && cate = $garden ORDER BY date DESC" : "is_notice = ? ORDER BY date DESC";
    $norSql = $sql." "."LIMIT $start, 10";

    $notice = board::findAll($sql.' LIMIT 0, 5', "on");
    $normal = board::findAll($norSql, false);
    $allGarden = garden::allData();

    $dataC = board::mq("SELECT COUNT(*) `cnt` FROM board WHERE cate = ?", $garden)->fetchAll()[0]['cnt'];
    $pageList = [];

    for ($i = 1; $i <= $dataC; $i++) { 
      $pageList[] = $i;
    }

    $block = array_chunk($pageList, 10);
    $btnBlock = array_chunk($block, 5, true);
    $now = ceil($page / 5);
    $end = count($block) == 0 ? 1 : count($block);

    view("news", get_defined_vars());
  });

  get("/view/$", function($idx) {
    $board = board::find('idx = ?', $idx);
    $gardenName = garden::find('idx = ?', $board['cate']);
    $images = image::findAll('owner_idx = ? && type = ?', [$idx, "news"]);
    $comment = comment::findAll("board = ? ORDER BY date DESC", $idx);

    $board['view'] += 1;
    board::update($board, $board['idx']);

    view("view", get_defined_vars());
  });

  post("/post/comment", function() {
    err(!@USER, "back", "로그인한 회원만 댓글을 달 수 있습니다.");
    empCk($_POST);
    $_POST['user_idx'] = USER['idx'];
    dd($_POST);
    comment::insert($_POST);
    move("back", "작성되었습니다.");
  });

  get("/download/$", function($idx) {
    zipDown($idx);
  });

  get("/images/$", function($idx) {
    readImage($idx);
  });
  
  middleware("isAdmin", function() {
    get("/delete/$", function($idx) {
      board::delete($idx);
      comment::delete($idx, "board");

      move("/news/all/1", "삭제되었습니다.");
    });

    post("/post/write", function() {
      empCk(["title"=> $_POST['title'], "content"=> $_POST['content']]);

      $file = $_FILES['images'];

      $_POST['user_idx'] = USER['idx'];
      $_POST['view'] = 0;
      $isGal = isset($_POST['gal_view']) ? $_POST['gal_view'] : "";
      unset($_POST['gal_view']);

      $boardIdx = board::insert($_POST);

      if (trim($file['name'][0]) != "") {
        if (count($file['name']) > 5) {
          move("back", "이미지는 최대 5장 업로드 가능합니다.");
        }

        for ($i=0; $i < count($file['name']); $i++) { 
          if ($file['size'][$i] > 5000000 || !exif_imagetype($file['tmp_name'][$i])) {
            move("back", "5MB이하인 이미지 파일만 업로드 가능합니다.");
          }
        }

        for ($i=0; $i < count($file['name']); $i++) { 
          $path = "/resources/upload/".md5($file['name'][$i].microtime()).$file['name'][$i];
          move_uploaded_file($file['tmp_name'][$i], ROOT.$path);
          $imgInfo = ["owner_idx"=> $boardIdx, "type"=> "news", "src"=> $path, "gal"=> $isGal];
          image::insert($imgInfo);
        }
      }

      $befBoard = $_POST['cate'];
      move("/news/$befBoard/1", "글이 작성되었습니다.");
    });

    get("/write/$", function($garden) {
      view("write", get_defined_vars());
    });
  });

  get("/search", function() {
    view("search");
  });

  get("/detail/$", function($idx) {
    $garden = garden::find('idx = ?', $idx);
    $review = review::findAll("garden = ?", $idx);
    view("detail", get_defined_vars());
  });

  get("/logout", function() {
    session_destroy();
    move("/", "로그아웃 되었습니다.");
  });

  middleware("isUser", function() {
    post("/post/noRes", function() {
      $_POST['month'] = explode("-", $_POST['date'])[1];
      $ck = no_res::find('garden = ? && date = ?', [$_POST['garden'], $_POST['date']]);
      
      $ck ? no_res::delete($ck['idx']) : no_res::insert($_POST);
      move("back", "저장되었습니다.");
    });

    post("/post/ownerCancel", function() {
      $res = res::find('idx = ?', $_POST['idx']);
      $res['state'] = "취소";
      res::update($res, $_POST['idx']);
      move("back", "취소되었습니다.");
    });

    post("/post/review", function() {
      $_POST['user'] = USER['idx'];
      $revIdx = review::insert($_POST);

      $file = $_FILES['userFile'];

      for ($i=0; $i < count($file['name']); $i++) { 
        $path = "/resources/upload/".md5($file['name'][$i].microtime()).$file['name'][$i];
        move_uploaded_file($file['tmp_name'][$i], ROOT.$path);
        
        $imgInfo = ["owner_idx"=> $revIdx, "src"=> $path, "type"=> "review", "gal"=> "true"];
        image::insert($imgInfo);
      }

      return responseJSON(["후기가 등록되었습니다.", $_POST['res']]);  
    });

    post("/post/cancel", function() {
      $res = new DateTime($_POST['date']);
      $today = new DateTime(date("Y-m-d"));
      $dateDiff =  date_diff($today, $res);

      if ($dateDiff->days <= 6) {
        move("back", "예약취소는 방문 7일전 까지 가능합니다.");
      }

      $res = res::find('idx = ?', $_POST['idx']);
      $res['state'] = "취소";
      res::update($res, $res['idx']);
      move("back", "취소되었습니다.");
    });

    get("/resList", function() {
      $resList = [];
      $endList = [];
      $noList = [];

      if (USER['type'] == "normal") {
        $resList = res::findAll('user_idx = ? && state = ? ORDER BY date DESC', [USER['idx'], "대기"]);
        $endList = res::findAll("user_idx = ? && (state = ? || state = ?) ORDER BY date DESC", [USER['idx'], "방문", "취소"]);
      }

      if (USER['type'] == "manager") {
        $resList = res::findAll('garden = ? && state = ? ORDER BY date DESC', [MANAGER['idx'], "대기"]);
        $endList = res::findAll("garden = ? && (state = ? || state = ?) ORDER BY date DESC", [MANAGER['idx'], "방문", "취소"]);
        $noList = no_res::findAll("garden = ? && month = ?", [MANAGER['idx'], date("m")]);
      }

      $today = date("Y-m-d");
      $end = res::findAll("date < ? && (state = ? || state = ?)", [$today, "대기", "accept"]);

      foreach ($end as $key => $v) {
        $v['state'] = "visit";
        res::update($v, $v['idx']);
      }

      view("resList", get_defined_vars());
    });
  });

  middleware("norUser", function() {
    post("/post/res", function() {
      $_POST['state'] = "대기";
      $_POST['user_idx'] = USER['idx'];
      res::insert($_POST);
      move("/resList", "예약되었습니다.");
    });

    post("/resCk", function() {
      return responseJSON(no_res::findAll("date = ? && garden = ?", [$_POST['date'], $_POST['garden']]));
    });

    get("/res/$", function($idx) {
      $garden = garden::find('idx = ?', $idx);
      view("reserve", get_defined_vars());
    });
  });

  middleware("notUser", function() {
    post("/post/login", function() {
      $login = user::find("id = ? && pass = ?", [$_POST['id'], $_POST['pass']]);

      if (!$login) {
        move("back", "아이디 혹은 비밀번호를 확인해주세요.");
      }

      $_SESSION['user'] = $login;
      
      if ($login['type'] == "manager") {
        $_SESSION['own_garden'] = garden::find('manager_id = ?', $login['id']);
      }

      move("/", "로그인에 성공했습니다.");
    });

    get("/login", function() {
      view("login");
    });

    post("/post/join", function() {
      empCk($_POST);

      $idCk = user::find("id = ?", $_POST['id']);
      $nameCk = user::find("name = ?", $_POST['name']);

      if ($idCk) {
        move("back", "중복된 아이디입니다. 다시 입력해주세요.");
      }

      if ($nameCk) {
        move("back", "중복된 이름입니다 다시 입력해주세요.");
      }

      $_POST['type'] = "normal";
      user::insert($_POST);
      move("/", "회원가입이 완료되었습니다.");
    });
    
    get("/join", function() {
      view("join");
    });
  });
?>