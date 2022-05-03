<?php 
	require "lib.php";

	if (@$_POST['type'] == "delete") {
		$alData = ad::find('idx = ?', $_POST['data']); 

		unlink(ROOT.$alData['ad_img']);
		ad::delete($_POST['data']);
		echo json_encode(["data"=> ad::allData(), "type"=> "success"]);
		exit;		
	}


	$file = $_FILES['ad_img'];
	$fileName = "/upload/".microtime().$file['name'];

	move_uploaded_file($file['tmp_name'], ROOT.$fileName);
	ad::insert(["ad_img"=> $fileName]);

	echo json_encode(["data"=> ad::allData(), "type"=> "success"]);
 ?>