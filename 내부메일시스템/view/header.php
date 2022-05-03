<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>메일관리시스템</title>
	<link rel="stylesheet" type="text/css" href="/app.css">
</head>
<body>

	<!-- header -->
	<header>
		<div id="logo">
			<a href="/">메일 시스템</a>
		</div>
		<nav>
			<ul>
				<?php if (USER): ?>
				<li><a href="/logout">로그아웃</a></li>
				<?php else: ?>
				<li><a href="/join">회원가입</a></li>
				<li><a href="/login">로그인</a></li>
				<?php endif ?>
			</ul>
		</nav>
	</header>
	<!-- //header -->

	<?php $mailAll = mail::mq("
		SELECT
		mail.*,
		content.*,
		user.*,
		mail.idx as `mail_idx`, 
		content.idx as `content_idx`,
		user.idx as `user_idx`
		FROM mail
		LEFT JOIN content 
		ON mail.content_idx = content.idx
		LEFT JOIN user
		ON mail.send_user = user.idx
		ORDER BY mail.idx DESC
		")->fetchAll()
	?>

	<style>
		.read {
			color: rgba(0, 0, 0, .7);
		}
	</style>

