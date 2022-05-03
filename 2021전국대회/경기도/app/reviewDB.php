<?php 
	require "lib.php";

	$reviewData = review::findAll('bakery_idx = ? ORDER BY date DESC', $_POST['idx']);

	echo json_encode($reviewData);
 ?>