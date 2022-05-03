<?php 
	get("/", function() {
		DB::dbSet();
		view("index");
	});

	get("/schedule", function() {
		$movieList = [];

		foreach (movielist::getMovie("") as $key => $v) {
			$movieList[$v['day']][] = $v;
		}

		view("schedule", get_defined_vars());
	});

	get("/movieDetail/$", function($idx) {
		$movie = movie::find('idx = ?', $idx);
		$info = movielist::mq("
			SELECT 
				movielist.*,
				theater.*
			FROM movielist, theater 
			WHERE movielist.movieCode = ? && theater.code = movielist.theaterCode
			", $movie['code'])->fetchAll();
		$comment = comment::mq("
			SELECT 
				*,
				comment.idx `com_idx`,
				user.idx `user_idx`,
				user.user_name
			FROM comment 
			LEFT JOIN user ON user.idx = comment.user
			WHERE movieCode = ? 
			ORDER BY timestamp DESC
			", $idx)->fetchAll();

		view("movieDetail", get_defined_vars());
	});

	middleware("nor", function() {
		get("/ticketing", function() {
			view("ticketing");
		});
	});

	middleware("isUser", function() {
		get("/ticketinfo", function() {
			$type = USER['user_id'];
			$ticketInfo = ticket::mq("
				SELECT 
					ticket.*,
					movielist.time,
					movielist.day,
					movie.title,
					theater.name `theater`,
					user.user_id 
				FROM ticket 
				LEFT JOIN movielist ON ticket.scheduleCode = movielist.code 
				LEFT JOIN movie ON movie.code = movielist.movieCode
				LEFT JOIN theater ON theater.code = movielist.theaterCode 
				LEFT JOIN user ON ticket.user = user.idx 
				WHERE ticket.user = ? || '$type' = 'admin'
				GROUP BY ticket.idx 
				ORDER BY ticket.timestamp DESC
				", USER['idx'])->fetchAll();

			view("ticketinfo", get_defined_vars());
		});

		post("/data/ticket/detail", function() {
			extract($_POST);
			$data['seat'] = seat::findAll('ticket_idx = ?', $data['idx']);
			return responseJSON($data);
		});

		get("/ticket/cancel/$", function($idx) {
			ticket::delete($idx);
			seat::delete($idx, "ticket_idx");
			move("back", "취소되었습니다.");
		});
	});

	post("/post/seatInfo", function() {
		extract($_POST);

		$seat = seat::mq("
			SELECT 
				seat.*,
				ticket.scheduleCode,
				ticket.state
			FROM seat
			LEFT JOIN ticket ON seat.ticket_idx = ticket.idx
			WHERE ticket.scheduleCode = ? && state = '예매완료'
			GROUP BY seat.idx
			", $schedule)->fetchAll();

		$movie = movielist::getMovie("WHERE day = '$day'");

		foreach ($movie as $key => &$v) {
			$v['seat'] = 164 - ticket::seatCount($v['code']);
		}

		return responseJSON(["seat"=> $seat, "movie"=> $movie]);
	});

	post("/post/ticekting", function() {
		extract($_POST);

		$ticket['user'] = USER['idx'];
		$ticketIdx = ticket::insert($ticket);

		foreach ($seat as $key => $v) {
			$insert = ["ticket_idx"=> $ticketIdx, "seat"=> $v];
			seat::insert($insert);
		}

		echo "예매가 완료되었습니다.";
	});

	post("/html/seatList", function() {
		extract($_POST);
		return responseJSON(seat::mq("
			SELECT 
				seat.*,
				ticket.scheduleCode,
				ticket.state 
			FROM seat
			LEFT JOIN ticket ON seat.ticket_idx = ticket.idx
			WHERE ticket.scheduleCode = ? && state = '예매완료'
			GROUP BY seat.idx
			", $schedule)->fetchAll());
	});

	post("/post/ticketingData", function() {
		$day = $_POST['day'];
		$movie = movielist::getMovie("WHERE day = '$day'");

		foreach ($movie as $key => &$v) {
			$v['seat'] = 164 - ticket::seatCount($v['code']);		
		}

		view2("movielist", get_defined_vars());
	});

	// 댓글 삭제
	get("/delete/comment/$", function($idx) {
		$user = comment::find('idx = ?', $idx)['user'];

		if (USER['idx'] != $user && USER['user_id'] != "admin") {
			move("back", "잘못된 접근입니다.");
		}

		comment::delete($idx);
		move("back", "삭제되었습니다.");
	});

	// 댓글작성
	post("/commentWrite", function() {
		$_POST['user'] = USER['idx'];

		if (trim($_POST['comment']) == "") {
			move("back", "댓글 내용을 입력해주세요.");
		}

		comment::insert($_POST);
		move("back", "댓글이 작성되었습니다.");
	});

	// 시간표 정렬
	post("/post/schedule", function() {
		$key = $_POST['sortKey'];
		$sort = $_POST['sortType'];

		$sql = "";
		$order = "code";

		switch ($sort) {
			case 'day':
				 $sql = "WHERE movielist.day = '$key'";
				 $order = "theaterName";
				break;
			
			case 'theater_detail':
				 $sql = "WHERE movielist.theaterCode = '$key'";
				 $order = "day";
				break;

			case 'section':
				 $sql = "WHERE movie.section LIKE '%$key%'";
				 $order = "title";
				break;
		}

		$data = movielist::getMovie($sql);
		$returnData = [];

		foreach ($data as $i => $v) {
			$dataKey = $sort == "section" ? $key : $v[$order];
			$returnData[$dataKey][] = $v;
		}

		return responseJSON([$returnData, $sort]);
	});

	// 상영관 이름
	post("/post/getName", function() {
		return responseJSON(theater::allData());
	});

	// 아이디 체크
	post("/post/idCk", function() {
		return responseJSON(user::find('user_id = ?', $_POST['id']));
	});

	// 회원가입
	post("/post/join", function() {
		unset($_POST['user_pass_ck']);
		$pass = passHash($_POST['user_pass'], rand());

		$_POST['user_pass'] = $pass[0];
		$_POST['salt'] = $pass[1];

		user::insert($_POST);
		echo "회원가입이 완료되었습니다.";
	});

	// 로그인
	post("/post/login", function() {
		$login = user::find('user_id = ?', $_POST['user_id']);

	 	if (!$login) {
	 		echo "아이디 또는 비밀번호가 틀립니다";
	 		exit;
	 	}

	 	$passCk = passHash($_POST['user_pass'], $login['salt']);

	 	if ($passCk[0] != $login['user_pass']) {
	 		echo "아이디 또는 비밀번호가 틀립니다";
	 		exit;
	 	}

	 	$_SESSION['user'] = $login;
	 	echo "로그인에 성공하였습니다.";
	});

	get("/logout", function() {
		session_destroy();
		move("/", "로그아웃 되었습니다.");
	});
 ?>