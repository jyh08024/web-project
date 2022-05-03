<?php 
	get("/", function() {
		view('index');

		if (USER) {
			move('/receive_mail');
		}

		move('/login');
	});

	get("/login", function() {
		view('login');
	});

	get("/join", function() {
		view('join');
	});

	get("/receive_mail", function() {
		view('mailbox1');
	});

	get("/spam_mail", function() {
		view('mailbox2');
	});

	get("/sending_mail", function() {
		view('mailbox3');
	});

	get("/temp_mail", function() {
		view('mailbox4');
	});

	get("/self_mail", function() {
		view('mailbox5');
	});

	get("/trash_mail", function() {
		view('mailbox6');
	});

	get("/write", function() {
		view('write');
	});

	get("/write_me", function() {
		view('write_to_me');
	});

	get("/view/$", function($idx) {
		$mail = mail::find("idx = ?", $idx);
		$mail_detail = mail::mq("
			SELECT 
			mail.*,
			content.*,
			mail.idx as `mail_idx`
			FROM mail
			LEFT JOIN content
			ON mail.content_idx = content.idx
			WHERE mail.idx = ?
		", $idx)->fetch();

		$file = file::findAll("content_idx = ?", $mail_detail['content_idx']);

		if ($mail['is_read'] = 'false') {
			$mail['is_read'] = 'true';
			mail::update($mail, $idx);
		}

		view('view', [
			"mail_con" => $mail_detail, 
			"file" => $file,
		]);
	});

	post("/join_post", function() {
		$idCk = user::find('email = ?', [$_POST['email']]);
		$vali = [];

		if ($idCk) {
			$vali[] = "중복된 이메일 입니다.";
		}

		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$vali[] = "이메일 형식이 아닙니다.";
		}	

		if ($_POST['password'] != $_POST['password2']) {
			$vali[] = "비밀번호와 비밀번호 확인이 일치하지 않습니다.";
		}

		if (count($vali)) {
			move('back', $vali);
		}

		unset($_POST['password2']);

		user::insert($_POST);
		move('/login', "회원가입 되었습니다");
	});

	post("/login_post", function() {
		$login = user::find('email = ? && password = ?', [$_POST['email'], $_POST['password']]);

		if (!$login) {
			move('back' ,'이메일 또는 비밀번호가 일치하지 않습니다.');
		}

		$_SESSION['user'] = $login;

		move('/receive_mail', "로그인에 성공했습니다.");		
	});

	get("/logout", function() {
		session_destroy();

		move('/', "로그아웃 되었습니다.");
	})
;
	post("/write_post", function() {
		if ($_POST['type'] != 'self') {
			$receive_user = user::find('email = ?', $_POST['receive_user']);
		}
		
		$vali = [];

		$test = content::insert([
			'title'=> $_POST['title'],
			'content'=> $_POST['content'],
			'date' => date('Y-m-d'),
		]);

		$file = $_FILES['files'];

		$max = count($file['name']);

		if ($max > 20) {
			$vali[] = "파일은 최대 20개를 넘길 수 없습니다."; 
		}

		if (array_sum($file['size']) > 1024 ** 2 * 20) {
			$vali[] = "파일 사이즈는 최대 20MB입니다.";
		}

		for ($i=0; $i < $max; $i++) { 
			$file_name = microtime().$file['name'][$i];
			move_uploaded_file($file['tmp_name'][$i], ROOT."/upload/".$file_name);

			file::insert([
				'content_idx' => $test,
				'name' => $file['name'][$i],
				'upload_name' => $file_name,
				'upload_url' => "/upload/".$file_name,
				'size' => $file['size'][$i],
			]);
		}

		switch ($_POST['type']) {
			case 'temp':
				mail::insert([
					'content_idx' => $test,
					'send_user' => USER['idx'],
					'receive_user' => '',
					'type' => $_POST['type'],
					'state' => $_POST['type'],
					'is_read' => 'false',
					'is_trash' => 'false',
					'owner' => USER['idx'],
				]);
				move('/', "임시저장 되었습니다.");
				break;

				case 'self':
					unset($_POST['receive_user']);

					mail::insert([
						'content_idx' => $test,
						'send_user' => USER['idx'],
						'type' => $_POST['type'],
						'state' => $_POST['type'],
						'is_read' => 'false',
						'is_trash' => 'false',
						'owner' => USER['idx'],
					]);

					move("/", "내게 쓰기가 완료되었습니다.");
					break;

			case 'posting':
				if (!$_POST['receive_user']) {
					$vali[] = "받을 사람의 이메일은 필수 입력입니다.";
				}

				if ($receive_user['idx'] == USER['idx']) {
					move('back', '내게 쓰기를 이용해주세요');
				}

				mail::insert([
					'content_idx' => $test,
					'send_user' => USER['idx'],
					'receive_user'=> $receive_user['idx'],
					'type' => $_POST['type'],
					'state' => $_POST['type'],
					'is_read' => 'false',
					'is_trash' => 'false',
					'owner' => USER['idx'],
				]);

				mail::insert([
					'content_idx' => $test,
					'send_user' => USER['idx'],
					'receive_user'=> $receive_user['idx'],
					'type' => $_POST['type'],
					'state' => $_POST['type'],
					'is_read' => 'false',
					'is_trash' => 'false',
					'owner' => $receive_user['idx'],
				]);

				move('/', "메일이 보내졌습니다.");
				break;
			}
	});

	get("/download/$", function($idx) {
		$file = file::find("idx = ?", $idx);

		header("Content-Disposition:attachment; filename=".$file['name']);

		return readfile(ROOT.$file['upload_url']);
	});

	post("/state_post", function() {
		$mail_info = mail::find("idx = ?", $_POST['mail_idx']);

		switch ($_POST['update_btn']) {
			case 'read':
				$mail_info['is_read'] = "true";

				mail::update($mail_info, $_POST['mail_idx']);
				break;	
			
			case 'trash':
				$mail_info['is_trash'] = "true";

				mail::update($mail_info, $_POST['mail_idx']);				
				break;

			case 'spam':
				$mail_info['state'] = "spam";
				dd($mail_info);
				mail::update($mail_info, $_POST['mail_idx']);
				break;
		}
	});
 ?>