<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>메인페이지</title>
	<link rel="stylesheet" href="/resources/css/css.css">
	<script src="/resources/js/jquery/jquery-1.12.3.min.js"></script>
	<script src="/resources/js/jquery/jquery-ui-1.11.4/jquery-ui.js"></script>
	<link rel="stylesheet" href="/resources/js/jquery/jquery-ui-1.11.4/jquery-ui.css">
	<script src="/resources/js/script.js"></script>
	<link rel="stylesheet" href="/resources/js/bootstrap-3.3.7-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="/resources/js/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css">
	<script src="/resources/js/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</head>
<body>
	
	<header>
		<div class="w100">
			<a href="/" class="home"><img src="/resources/images/logo.png" alt="Green wheel" title="Green wheel"></a>
			
			<ul>
				<?php if (USER): ?>
				<li><a href="/logout">로그아웃</a></li>
				<li><a href="/rental/////">검색예약</a></li>
				<li><a href="/mypage/<?= USER['idx'] ?>">마이페이지</a></li>
				<?php if (USER['level'] == "admin"): ?>
				<li class="subMenu">
					<a href="/admin">관리자</a>
					<div class="sub">
						<a href="/admin">결제관리</a>
						<a href="/item">예약관리</a>
						<a href="/material/<?= date("Y-m") ?>">통계자료</a>
					</div>
				</li>
				<?php endif ?>
				<?php else: ?>
				<li><a href="/member">로그인</a></li>
				<?php endif ?>
			</ul>
		</div><!--w100-->
	</header>