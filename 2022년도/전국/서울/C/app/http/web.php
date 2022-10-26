<?php 
	get("/", function() {
		view("index");
	});

	get("/restaurant", function() {
		view("rest", get_defined_vars());
	});

	post("/post/res1", function() {
		view("resReq", get_defined_vars());
	});

	post("/post/res2", function() {
		view("resCk", get_defined_vars());
	});

	post("/post/res3", function() {
		res::insert($_POST);
		move("/restaurant", "예약되었습니다.");
	});

	get("/restRead", function() {
		view("restRead");
	});

	post("/post/resRead", function() {
		return responseJSON(res::findAll("email = ? && pw = ?", [$_POST['email'], $_POST['pw']]));
	});

	get("/post/res2", function() {
		move("/restaurant", "만료된 페이지입니다.");
	});

	get("/form/del", function() {
		header("location:". "/restaurant");
		// move("/restaurant");
	});

	get("/qna", function() {
    $q = q::allData();
		view("qna", get_defined_vars());
	});

	post("/post/isRes", function() {
		$res = res::find("email = ? && pw = ?", [$_POST['email'], $_POST['pw']]);

		if (!$res) {
			move("back", "식당 이용자가 아닙니다.");
		}

		$_SESSION['user'] = $res;
		move("back", "식당 이용이 확인되었습니다.");
	});

	get("/qWrite", function() {
		view("write", get_defined_vars());
	});

	post("/post/write", function() {
		empCk($_POST);

    $file = $_FILES['file'];
    $_POST['file'] = "";

    if ($file['size'] > 0) {
      $fileName = md5(microtime()).$file['name'];
      $uploadRoot = "/resources/upload/";

      move_uploaded_file($file['tmp_name'], ROOT.$uploadRoot.$fileName);
      $_POST['file'] = $uploadRoot.$fileName;
      $_POST['type'] = explode("/", $file['type'])[0];
    }

    $_POST['email'] = USER['email'];
    $_POST['pw'] = USER['pw'];

    q::insert($_POST);
    move("/qna", "질문이 작성되었습니다.");
	});

	get("/q/$", function($idx) {
    $q = q::find('idx = ?', $idx);
    $a = a::findAll('q_idx = ? ORDER BY issel DESC', $idx);
    view("qView", get_defined_vars());
  });

  post("/post/answer", function() {
  	empCk($_POST);
    a::insert($_POST);

    $back = $_POST['q_idx'];
    move("/q/$back", "작성되었습니다.");
  });

  post("/sel/answer", function() {
  	$q = q::find('idx = ?', $_POST['q_idx']);
  	$nowA = a::find("idx = ?", $_POST['idx']);
  	$selA = a::find("q_idx = ? && issel = ?", [$_POST['q_idx'], "selected"]);

  	if ($q['pw'] != $_POST['pw']) {
  		return responseJSON("");
  	}

  	$nowA['issel'] = "selected";

  	if ($selA) {
	  	$selA['issel'] = "";
	  	a::update($selA, $selA['idx']);
  	}

  	a::update($nowA, $nowA['idx']);

    $a = a::findAll('q_idx = ? ORDER BY issel DESC', $_POST['q_idx']);

		view2("a_load", get_defined_vars());
  });
 ?>