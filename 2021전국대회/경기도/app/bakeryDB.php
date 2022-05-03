<?php 
	require "lib.php";

	$bakeryData = bakery_list::allData();

	echo json_encode($bakeryData);
 ?>