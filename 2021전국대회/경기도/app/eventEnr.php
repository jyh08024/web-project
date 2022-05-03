<?php 
	require "lib.php";

	$bakerIdx = [];

	foreach ($_POST as $key => $v) {
		if ($v == "on") {
			array_push($bakerIdx, $key);
			unset($_POST[$key]);
		}
	}


	$_POST["bakery_idx"] = json_encode($bakerIdx, true);

	$file = $_FILES['banner_img'];
	$fileName = "/upload/".microtime().$file['name'];

	if (@$_POST['postType'] != "delete" && !@$_POST['banner_img']) {
		move_uploaded_file($file['tmp_name'], ROOT.$fileName);
		$_POST['banner_img'] = $fileName;
	}

	if (@$_POST['postType'] == "update") {
		$postTarget = $_POST['postTarget'];
		unset($_POST['postTarget']);
		unset($_POST['postType']);
		event::update($_POST, $postTarget);
		echo json_encode(["move"=> "index.php", "type"=> "success"]);
		exit;
	}

	if (@$_POST['postType'] == "delete") {
		$img = event::find('idx = ?', $_POST['postTarget']);

		unlink(ROOT.$img['banner_img']);
		event::delete($_POST['postTarget']);
		echo json_encode(["move"=> "index.php", "type"=> "success"]);
		exit;
	}

	unset($_POST['postType']);
	unset($_POST['postTarget']);
	event::insert($_POST);
	echo json_encode(["move"=> "index.php", "type"=> "success"]);
 ?>