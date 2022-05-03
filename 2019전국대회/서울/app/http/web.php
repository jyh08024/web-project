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
			move('back', "중복된 아이디 또는 이름입니다.");
		}

		if (trim($_POST['id']) == "" || trim($_POST['password']) == "" || trim($_POST['name']) == "") {
			move('back', "모든 값을 입력해 주세요.");
		}

		if (!preg_match("/^(?=.*[A-z]+)(?=.*\d*).{4,8}$/", $_POST['id'])) {
			$vali[] = "아이디는 영문 숫자 4~8자 이내로 이루어져야 한다.";
		}

		if (!preg_match("/^(?=.*[A-z]+)(?=.*\d+).{8,12}$/", $_POST['password'])) {
			$vali[] = "패스워드는 영문 숫자 모두 포함 8~12자 이내로 이루어져야 한다.";
		}

		if (!preg_match("/^[A-z0-9ㄱ-힣 ]{2,10}$/u", $_POST['name'])) {
			$vali[] = "이름은 영문 한글 숫자 공백 2~10글자 이내로 이루어져야 합니다.";
		}	

		if ($img['size'] > 1024000 || !preg_match("/jpg|png|jpeg/u", $img['type'])) {
			$vali[] = "이미지는 PNG, JPG 1MB 이하인 파일만 사용가능합니다.";
		}

		if (count($vali)) {
			move('back', $vali);
		}

		$fileName = "/upload/".microtime().$img['name'];
		move_uploaded_file($img['tmp_name'], ROOT.$fileName);

		$_POST['img'] = $fileName;

		user::insert($_POST);
		move('/', "회원가입이 완료되었습니다.");
	});

	post("/login/post", function() {
		$id = user::find('id = ?', $_POST['id']);
		$pass = user::find('password = ?', $_POST['password']);

		if ($id && $pass) {
			$_SESSION['user'] = $id;
			move('/', "로그인 되었습니다.");
		}

		if (!$id) {
			move('back', "아이디가 일치하지 않습니다.");
		}

		if (!$pass) {
			move('back', "비밀번호가 일치하지 않습니다.");
		}
	});

	get("/logout", function() {
		session_destroy();
		move('/', "로그아웃 되었습니다");
	});

	post("/upload/post", function() {
		$vali = [];
		$file = $_FILES['video'];
		$thumb = $_FILES['thumbnail'];

		if ($_POST['tu'] == "" || $_FILES['thumbnail'] == "") {
			$vali[] = "썸네일을 선택해주세요.";
		}

		if (trim($_POST['title']) == "") {
			$vali[] = "영상 제목을 입력해주세요.";
		}

		if (trim($_POST['description']) == "") {
			$vali[] = "설명을 입력해주세요.";
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
		move('/my_page', '업로드 되었습니다.');
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
		move('back', "수정되었습니다.");
	});

	post("/del/com/$", function($idx) {
		$comment = comments::find("idx = ?", [$idx]);

		comments::delete($comment['idx']);
	});
 ?>