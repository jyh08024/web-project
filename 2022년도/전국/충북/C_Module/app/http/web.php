<?php
  get("/", function() {
    user::userset();
    art::artSet();
    view("index");
  });

  get("/signList", function() {
    view("signList");
  });

  get("/invest", function() {
    view("invest");
  });

  get("/enr", function() {
    view("enr");
  });

  get("/partici", function() {
    view("partici");
  });

  middleware("isAdmin", function() {
    post("/post/deleteArt", function() {
      art::delete($_POST['del']);
      return responseJSON("삭제되었습니다.");
    });

    post("/artMod", function() {
      $updateId = $_POST['idx'];

      $file = $_FILES['image'];

      if ($file['size'] > 0) {
        if (explode("/", $file['type'])[0] != "image") {
          return responseJSON(["artMod", "작품사진은 이미지파일만 업로드 가능합니다.", "back"]);
        }

        $upName = md5($file['name'].microtime()).$file['name'];
        $path = "/resources/C/이미지/".$_POST['type']."/";

        move_uploaded_file($file['tmp_name'], ROOT.$path.$upName);
        $_POST['product_img'] = $upName;
      }

      unset($_POST['idx']);
      art::update($_POST, $updateId);
      return responseJSON(["artMod", "수정되었습니다.", "pass"]);
    });

    post("/get/artList", function() {
      $art = art::allData();
      view2("artListLoad", get_defined_vars());
    });

    post("/get/artCare/$", function($field) {
      $sql = $field != "all" ? "ORDER BY $field ASC" : "";
      $search = preg_split("/\s*\+\s*/", $_POST['data']);
      $regex = array_reduce($search, function($a,$b){
        return "{$a}(?=.*{$b}).*";
      }, ".*");

      $nameSearch = "WHERE art_name REGEXP ? OR type REGEXP ?";

      $art = art::mq("SELECT * FROM art $nameSearch $sql", [$regex, $regex])->fetchAll();
      view2("artCareLoad", get_defined_vars());
    });

    get("/artCare", function() {
      $art = art::allData();
      $cateList = art::getCate();
      view("artCare", get_defined_vars());
    });

    get("/artEnr", function() {
      $cateList = art::getCate();
      view("artEnr", get_defined_vars());
    });

    post("/post/artEnr", function() {
      $artId = ["한국화"=> "KO", "회화"=> "PA", "공예"=> "CR", "조각"=> "SC", "서예"=> "CA"];

      $file = $_FILES['image'];

      if ($file['size'] > 0) {
        if (explode("/", $file['type'])[0] != "image") {
          move("back", "작품사진은 이미지만 업로드 가능합니다.");
        }

        $upName = md5($file['name'].microtime()).$file['name'];
        $path = "/resources/C/이미지/".$_POST['type']."/";

        move_uploaded_file($file['tmp_name'], ROOT.$path.$upName);
        $_POST['product_img'] = $upName;
      }

      $_POST['art_id'] = $artId[$_POST['type']]."-".substr(implode("", range('0','9')), 0, 4);
      art::insert($_POST);
      move("/artEnr", "작품이 등록되었습니다.");
    });
  });

  get("/artList", function() {
    $art = art::allData();
    view("artList", get_defined_vars());
  });

  get("/art/$", function($idx) {
    $art = art::find('idx = ?', $idx);
    view("art", get_defined_vars());
  });

  post("/post/buy", function() {
    if (!@USER) {
      move("back", "로그인 해주세요.");
    }

    $randStr = randStr();

    $_POST['buy_num'] = $randStr;
    $_POST['user_idx'] = USER['idx'];
    
    buy::insert($_POST);
    move("back", "구매가 완료되었습니다.");
  });

  post("/post/cart", function() {
    if (!@USER) {
      move("back", "로그인 해주세요.");
    }

    $_POST['user_idx'] = USER['idx'];
    cart::insert($_POST);
    move("back", "장바구니에 담겼습니다.");
  });

  get("/leaseStat", function() {
    $youth = lease::leaseList("youth");
    $future = lease::leaseList("future");

    view("leaseStat", get_defined_vars());
  });

  middleware("isUser", function() {
    get("/cart", function() {
      $cart = cart::mq("
        SELECT 
          cart.*,
          art.*,
          cart.idx `cart_idx`
        FROM cart 
        LEFT JOIN art ON cart.art_idx = art.idx
        WHERE user_idx = ?
      ", USER['idx'])->fetchAll();

      $buyList = buy::buyHistory();

      view("cart", get_defined_vars());
    });

    post("/post/cartBuy", function() {
      if (!count($_POST)) {
        move("back", "한개 이상의 상품을 선택해주세요.");
      }

      $randStr = randStr();

      foreach ($_POST as $key => $v) {
        $cartItem = cart::find('idx = ?', $key);
        $insert = [];

        $insert['buy_num'] = $randStr;
        $insert['user_idx'] = $cartItem['user_idx'];
        $insert['art_idx'] = $cartItem['art_idx'];

        buy::insert($insert);
        cart::delete($key);
      }

      move("back", "구매가 완료되었습니다.");
    });
    
    get("/lease", function() {
      view("lease");
    });

    post("/post/lease", function() {
      $rooms = explode(",", $_POST['room']);
      $build = explode(",", $_POST['build']);
      $_POST['user_idx'] = USER['idx'];

      $future = "";
      $youth = "";

      foreach ($build as $key => $v) {
        if ($v == "future") {
          $future .= $rooms[$key].",";
          continue;
        }

        $youth .= $rooms[$key].",";
      }

      if ($future) {
        $_POST['room'] = $future;
        $_POST['build'] = "future";

        lease::insert($_POST);
      }
      
      if ($youth) {
        $_POST['build'] = "youth";
        $_POST['room'] = $youth;

        lease::insert($_POST);
      }
      
      move("back", "임대등록되었습니다.");
    });

    post("/check/room", function() {
      $start = $_POST['date'][0];
      $end = $_POST['date'][1];
      
      return responseJSON(lease::findAll("!(end < ? || start > ?)", [$start, $end]));
    });
  });

  get("/logout", function() {
    session_destroy();
    move("back", "로그아웃 되었습니다.");
  });

  post("/post/login", function() {
    $login = user::find('id = ? && pass = ?', [$_POST['id'], $_POST['password']]);

    if (!$login) {
      return responseJSON(["login", "아이디 혹은 비밀번호를 확인해주세요."]);
    }

    $_SESSION['user'] = $login;
    return responseJSON(["login", "로그인에 성공하였습니다."]); 
  });
?>