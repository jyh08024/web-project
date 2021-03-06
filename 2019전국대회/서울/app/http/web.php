<?php 
	post("/userAll/$", function($type) {
		$userData = user::allData($type == "DESC" || $type == "ASC" ? '' : $type);
		$sort = [];

		if ($type == "DESC" || $type == "ASC") {
			$userData = user::allData("ORDER BY idx DESC");
		}

		foreach ($userData as $key => $v) {
			$v['videos'] = videos::findAll('users_id = ?', $v['idx']);
			$totalView = 0;

			foreach ($v['videos'] as $key => $value) {
				$totalView += $value['view'] * 1;
			}

				if ($totalView === 0) {
					$v['pop'] = 0;
				} else {
					$v['pop'] = $totalView / count($v['videos']) * $v['follows'];
				}
			$sort[] = $v['pop'];
		}

		if ($type == "DESC" || $type == "ASC") {
			array_multisort($sort, $type == "DESC" ? SORT_DESC : SORT_ASC, $userData);
		}

		view2('userList', ["userData" => $userData]);
	});

	post("/pro/video/$/$", function($idx, $type) {
		$proVideo = videos::findAll("users_id = ? $type", $idx);

		view2('pro_movie', ["videoData" => $proVideo]);
	});

	post("/sub", function() {
		if (@USER) {
			return responseJSON(follow::find('follower = ?', [USER['idx']]));
		}
	});	

	post("/profile/$", function($idx) {
		$userData = user::find('idx = ?', $idx);

		view2('profile', get_defined_vars());
	});

	get("/", function() {
		DB::dbSet();

		view("index");
	});

	middleware("user", function() {
		get("/login", function() {
			view("login");
		});
	
			get("/join", function() {
				view("join");
		});
	});

	middleware("guest", function() {
		get("/my_page", function() {
			$myVideo = videos::findAll('users_id = ?', USER['idx']);

			view("my_page", ["video" => $myVideo]);
		});

		get("/recommend", function() {
			view("recommend");
		});

		get("/uploadPage", function() {
			view("upload");
		});
	});


	get("/provide_list", function() {
		view("provide_list");
	});

	get("/provider/$", function($idx) {
		$userData = user::find('idx = ?', $idx);

		$data = videos::mq("
			SELECT 
			*
			FROM videos 
			WHERE users_id = ?
			ORDER BY date DESC
			", [$idx])->fetchAll();

		view("provider", get_defined_vars());
	});


	get("/video/$", function($idx) {
		$videoInfo = videos::find('idx = ?', $idx);

		$videoData = videos::mq("
			SELECT 
				videos.*,
				videos.idx `video_idx`,
				user.idx `user_index`,
				user.id `user_id`,
				user.name `user_name`,
				user.follows `user_follow`,
				user.img `user_img`
			FROM videos 
			LEFT JOIN user 
			ON videos.users_id = user.idx
			WHERE videos.idx = ?
			", [$idx])->fetch();

		$videoInfo['view'] =+ 1;

		videos::update($videoInfo, $idx);
		view("video", ["video" => $videoData]);
	});

	post("/comment/list/$", function($idx) {
		$comment = comments::mq("
			SELECT 
				comments.*,
				videos.idx `video_index`,
				user.name `user_name`,
				user.img `user_img`
			FROM comments
			LEFT JOIN videos 
			ON videos.idx = comments.video_idx 
			LEFT JOIN user 
			ON comments.user_idx = user.idx
			WHERE videos.idx = ?
			GROUP BY comments.idx 
			ORDER BY comments.date DESC
			", [$idx])->fetchAll();

		view2('comment_load', ["comment" => $comment]);
	});

	post("/comment/care/$", function($idx) {
		$comment = comments::mq("
			SELECT 
				comments.*,
				user.img `user_img`,
				user.name `user_name`
			FROM comments 
			LEFT JOIN user 
			ON comments.user_idx = user.idx 
			WHERE comments.video_idx = ?
			", $idx)->fetchAll();

		view2('comment_care', get_defined_vars());
	});

	get("/video_setting/$", function($idx) {
		$videoData = videos::find("idx = ?", $idx);

		$comment = comments::mq("
			SELECT 
				comments.*,
				user.img `user_img`,
				user.name `user_name`
			FROM comments
			LEFT JOIN user 
			ON comments.user_idx = user.idx 
			WHERE comments.video_idx = ?
			", [$videoData['idx']])->fetchAll();

		view("/video_setting", get_defined_vars());
	});

	post("/join/post", function() {
		$idCk = user::find('id = ? && name = ?', [$_POST['id'], $_POST['name']]);

		$vali = [];
		$img = $_FILES['img'];

		if ($idCk) {
			move('back', "????????? ????????? ?????? ???????????????.");
		}

		if (trim($_POST['id']) == "" || trim($_POST['password']) == "" || trim($_POST['name']) == "") {
			move('back', "?????? ?????? ????????? ?????????.");
		}

		if (!preg_match("/^(?=.*[A-z]+)(?=.*\d*).{4,8}$/", $_POST['id'])) {
			$vali[] = "???????????? ?????? ?????? 4~8??? ????????? ??????????????? ??????.";
		}

		if (!preg_match("/^(?=.*[A-z]+)(?=.*\d+).{8,12}$/", $_POST['password'])) {
			$vali[] = "??????????????? ?????? ?????? ?????? ?????? 8~12??? ????????? ??????????????? ??????.";
		}

		if (!preg_match("/^[A-z0-9???-??? ]{2,10}$/u", $_POST['name'])) {
			$vali[] = "????????? ?????? ?????? ?????? ?????? 2~10?????? ????????? ??????????????? ?????????.";
		}	

		if ($img['size'] > 1024000 || !preg_match("/jpg|png|jpeg/u", $img['type'])) {
			$vali[] = "???????????? PNG, JPG 1MB ????????? ????????? ?????????????????????.";
		}

		if (count($vali)) {
			move('back', $vali);
		}

		$fileName = "/upload/".microtime().$img['name'];
		move_uploaded_file($img['tmp_name'], ROOT.$fileName);

		$_POST['img'] = $fileName;

		user::insert($_POST);
		move('/', "??????????????? ?????????????????????.");
	});

	post("/login/post", function() {
		$id = user::find('id = ?', $_POST['id']);
		$pass = user::find('password = ?', $_POST['password']);

		if ($id && $pass) {
			$_SESSION['user'] = $id;
			move('/', "????????? ???????????????.");
		}

		if (!$id) {
			move('back', "???????????? ???????????? ????????????.");
		}

		if (!$pass) {
			move('back', "??????????????? ???????????? ????????????.");
		}
	});

	get("/logout", function() {
		session_destroy();
		move('/', "???????????? ???????????????");
	});

	post("/upload/post", function() {
		$vali = [];
		$file = $_FILES['video'];
		$thumb = $_FILES['thumbnail'];

		if ($_POST['tu'] == "" || $_FILES['thumbnail'] == "") {
			$vali[] = "???????????? ??????????????????.";
		}

		if (trim($_POST['title']) == "") {
			$vali[] = "?????? ????????? ??????????????????.";
		}

		if (trim($_POST['description']) == "") {
			$vali[] = "????????? ??????????????????.";
		}

		if (count($vali)) {
			move('back', $vali);
		}

		if (!trim($thumb['name']) == "") {
			$thum = "/upload/".microtime().$thumb['name'];
			// move_uploaded_file($thumb['tmp_name'], ROOT.$thum);
			$_POST['thumbnail'] = $thum;
		} else {
			$_POST['thumbnail'] = $_POST['tu'];
		}

		$fileName = "/upload/".microtime().$file['name'];
		move_uploaded_file($file['tmp_name'], ROOT.$fileName);

		$_POST['users_id'] = USER['idx'];
		$_POST['date'] = date("Y-m-d H:i:s");
		$_POST['duration'] = floor($_POST['duration']);
		$_POST['video'] = $fileName;

		unset($_POST['tu']);
		videos::insert($_POST);
		move('/my_page', '????????? ???????????????.');
	});

	post("/comment/post/$", function($idx) {
		$_POST['comment'] = $_POST['result'];
		$_POST['user_idx'] = USER['idx'];
		$_POST['date'] = date("Y-m-d H:i:s");
		$_POST['video_idx'] = $idx;
		dd($idx);
		unset($_POST['result']);

		comments::insert($_POST);
	});

	get("/download/video/$", function($idx) {
		$file = videos::find('idx = ?', $idx);

		header("Content-Disposition:attachment; filename=".$file['video']);

		return readfile(ROOT.$file['video']);
	});

	post("/follow", function() {
		dd($_POST['follow']);

		$folUser = user::find("idx = ?", $_POST['follow']);

		$_POST['user_idx'] = $_POST['follow'];
		$_POST['follower'] = USER['idx'];
		unset($_POST['follow']);

		$folUser['follows'] += 1;

		user::update($folUser, $folUser['idx']);
		follow::insert($_POST);		
	});

	post("/follow/del", function() {
		$fol = user::find("idx = ?", [$_POST['follow']]);

		$myFollow = follow::find('follower = ? && user_idx = ?', [USER['idx'], $_POST['follow']]);

		$fol['follows'] = $fol['follows'] - 1;

		user::update($fol, $fol['idx']);
		follow::delete($myFollow['idx']);
	});

	post("/video/update/detail/$", function($idx) {
		$video = videos::find("idx = ?", $idx);

		$video['title'] = $_POST['video_title'];
		$video['description'] = $_POST['video_explain'];

		videos::update($video, $video['idx']);
		move('back', "?????????????????????.");
	});

	post("/del/com/$", function($idx) {
		$comment = comments::find("idx = ?", [$idx]);

		comments::delete($comment['idx']);
	});
 ?>