<?php
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	require "database_connect.php";
	db_init();

	$json = file_get_contents('php://input');
	$array = json_decode($json, true);

	$scrTime = ORM::for_table("moviedata")->sum("scrTime");
	$value = ORM::for_table("moviedata")->sum("value");
	$count = ORM::for_table("moviedata")->count("title");

	if($scrTime != null && $value != null && $count != null){
		$result = ["result" => 1, "scrTime" => $scrTime, "value" => $value, "count" => $count];
	}else{
		$result["result"] = -1;
		$result["msg"] = "データの受信に失敗しました";
	}

	echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>