<?php 
	require "lib.php";

	$eventData = event::find('idx = ?', $_POST['idx']);

	foreach (json_decode($eventData['bakery_idx']) as $key => $v) {
		$eventData['bakery_data'][] = json_encode(bakery_list::find('idx = ?', $v));
	}

	echo json_encode($eventData);
 ?>