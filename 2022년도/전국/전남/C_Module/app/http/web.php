<?php 
  get("/", function() {
    view("index");
  });

  get("/info", function() {
    view("info");
  });

  get("/sub/$", function($search) {
    $search = urldecode($search);
    $sql = $search != "all" ? "WHERE name LIKE '%$search%' ORDER BY name DESC" : "ORDER BY name DESC";

    $garden = gardens::mq("SELECT * FROM gardens $sql")->fetchAll();
    view("sub", get_defined_vars());
  });

  post("/post/search", function() {
    $search = $_POST['search'];
    move("/sub/$search");
  });

  middleware("isUser", function() {
    get("/recDetail/$", function($id) {
      $rec = recruitments::mq("
        SELECT
          recruitments.*,
          users.name `user_name`,
          categories.category `category`,
          count(recruitment_applications.id) `accept_person`
        FROM recruitments 
        LEFT JOIN users ON users.id = recruitments.user_id
        LEFT JOIN categories ON categories.id = recruitments.category_id
        LEFT JOIN recruitment_applications ON recruitment_applications.recruitment_id = recruitments.id && state = ?
        WHERE recruitments.id = ?
      ", ["accept", $id])->fetch();

      if ($rec['accept_person'] == $rec['personnel']) {
        $all = recruitment_applications::mq("SELECT * FROM recruitment_applications WHERE recruitment_id = ? && state = ?", [$rec['id'], "wait"]);
        
        foreach ($all as $key => $v) {
          $v['state'] = "reject";
          recruitment_applications::update($v, $v['id']);
        }
      }

      $applications = recruitment_applications::mq('
        SELECT 
        recruitment_applications.*,
        users.name `user_name`,
        users.image `image`
        FROM recruitment_applications
        LEFT JOIN users ON users.id = recruitment_applications.user_id
        WHERE recruitment_id = ? && state != ?
      ', [$rec['id'], "reject"])->fetchAll();

      $writer = users::find('id = ?', $rec['user_id']);

      view("detail", get_defined_vars());
    });

    get("/comu/$/$", function($nowCate, $page) {
      $nowCate = urldecode($nowCate);
      $cate = categories::allData();

      $last = $page * 10;
      $start = $last - 10;
      $cates = $nowCate != "all" ? "WHERE recruitments.category_id = $nowCate"." " : "";

      $sql = $cates;
      $sql .= "ORDER BY create_dt DESC";
      $sql .= " "."LIMIT $start, 10";

      $recruit = recruitments::mq("
        SELECT 
          recruitments.*,
          users.name `user_name`
        FROM recruitments
        LEFT JOIN users ON recruitments.user_id = users.id
        $sql
      ")->fetchAll();

      $dataC = recruitments::mq("SELECT COUNT(*) `cnt` FROM recruitments $cates")->fetchAll()[0]['cnt'];
      $pageList = [];

      for ($i = 1; $i <= $dataC; $i++) { 
        $pageList[] = $i;
      }

      $block = array_chunk($pageList, 10);
      $btnBlock = array_chunk($block, 5, true);
      $now = ceil($page / 5);
      $end = count($block);

      view("comu", get_defined_vars());
    });

    post("/post/recruit", function() {
      $reqURL = "/getRec/".$_POST['category']."/".$_POST['page'];

      unset($_POST['category']);
      unset($_POST['page']);

      $_POST['user_id'] = USER['id'];
      $_POST['create_dt'] = date("Y-m-d");
      recruitments::insert($_POST);
      return responseJSON(["recruit", "등록이 완료되었습니다.", $reqURL]);
    });

    post("/getRec/$/$", function($category, $viewPage) {
      $last = $viewPage * 10;
      $start = $last - 10;
      $cates = $category != "all" ? "WHERE recruitments.category_id = $category"." " : "";
      $sql = $cates;
      $sql .= "ORDER BY create_dt DESC";
      $sql .= " "."LIMIT $start, 10";

      $recruit = recruitments::mq("
        SELECT
          recruitments.*,
          users.name `user_name`,
          categories.category `category`
        FROM recruitments 
        LEFT JOIN users ON users.id = recruitments.user_id
        LEFT JOIN categories ON categories.id = recruitments.category_id
        $sql
      ")->fetchAll();

      return responseJSON($recruit);
    });

    get("/garden/$", function($idx) {
      $garden = gardens::find('id = ?', $idx);

      $calendar = calendar(date("Y"), date("m"), $garden['id']);
      
      view("garden", get_defined_vars());
    });

    post("/get/buskings", function() {
      $idList = $_POST['data'];

      return responseJSON(array_map(function($v) {
        $main = buskings::find('id = ?', $v);
        $main['category'] = categories::getCate($main['category_id']);
        return $main;
      }, $idList));
    });
  });

  get("/logout", function() {
    session_destroy();
    move("/", "로그아웃 되었습니다.");
  });
  
  post("/post/login", function() {
    $login = users::find("id = ? && pw = ?", [$_POST['id'], $_POST['pw']]);

    if (!$login) {
      return responseJSON(["login", "err"]);
    }

    $_SESSION['user'] = $login;
    $gardenKey = "";

    if ($login['type'] == "garden") {
      $_SESSION['ownGarden'] = gardens::find('user_id = ?', $login['id']);
      $gardenKey = $_SESSION['ownGarden']['id'];
    }

    return responseJSON(["login", "로그인에 성공하였습니다.", $gardenKey]);
  });

  post("/post/join", function() {
    unset($_POST['captcha']);
    
    $file = $_FILES['image'];
    $_POST['image'] = md5($file['name'].microtime()).$file['name'];

    $upPath = "/resources/C/user/".$_POST['image'];
    move_uploaded_file($file['tmp_name'], ROOT.$upPath);
    
    $_POST['type'] = "normal";

    users::insert($_POST);
    return responseJSON(["join", "회원가입이 완료되었습니다."]);
  });

  post("/post/idCk", function() {
    return responseJSON(users::find("id = ?", $_POST['input']));
  });
?>