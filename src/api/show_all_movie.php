<?php
	header('Access-Control-Allow-Origin: *');

	require "database_connect.php";
	
	mb_language("ja");
	mb_internal_encoding("UTF-8");

	$result = ["result" => 0, "list" => []];

	$query = "SELECT title,date,point FROM moviedata;";
	
	$query_result = db_connect($query);
	if($query_result){
		$result["result"] = 1;
		$list = [];
		while($row = $query_result->fetch_assoc() ){
			$list[] = $row;
		}
		$result["result"] = $list;			

	}
	echo json_encode($result, JSON_UNESCAPED_UNICODE);	
?>