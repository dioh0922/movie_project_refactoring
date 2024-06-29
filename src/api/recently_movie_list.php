<?php
	header('Access-Control-Allow-Origin: *');
	require "database_connect.php";
	db_init();
	
	$result = ["result" => 0, "list" => []];

	$list = ORM::for_table("moviedata")
	->select("title")
	->order_by_desc("date")
	->limit(10)
	->find_many();
	
	$data = [];
	foreach($list as $idx => $key){
		$data[] = ["title" => $key->title];
	}
	$result = $data;

	echo json_encode($result, JSON_UNESCAPED_UNICODE)		

?>