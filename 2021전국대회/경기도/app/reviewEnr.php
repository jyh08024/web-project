<?php 
	require "lib.php";

	$file = $_FILES['review_img'];
	$fileName = "/upload/".microtime().$file['name'];

	move_uploaded_file($file['tmp_name'], ROOT.$fileName);
	$_POST['review_img'] = $fileName;

	$reviewData = review::findAll('bakery_idx = ?', $_POST['bakery_idx']);
	$_POST['user_idx'] = USER['idx'];
	review::insert($_POST);
	echo json_encode(["type"=> "success", "idx"=> $_POST['bakery_idx']]);
 ?>