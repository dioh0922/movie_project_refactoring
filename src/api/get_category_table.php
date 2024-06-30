<?php
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	
	require "database_connect.php";
	db_init();	

	$result = ["result" => 0, "category" => []];

	$list = ORM::for_table("category_table")
	->select_many("category_name", "id")
	->find_many();
	
	$data = [];
	foreach($list as $idx => $key){
		$data[] = ["category" => $key->id, "label"=> $key->category_name];
	}
	$result["category"] = $data;

	echo json_encode($result, JSON_UNESCAPED_UNICODE)		
?>