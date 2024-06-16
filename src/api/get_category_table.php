<?php
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	
	require "database_connect.php";
	
	mb_language("ja");
	mb_internal_encoding("UTF-8");
	
	$result = ["result" => 0, "category" => []];

	//各カテゴリの名称をとっていく
	$query = "SELECT category_name FROM category_table;";
	$str = "";
	
	$query_result = db_connect($query);
	if($query_result){
		$result["result"] = 1;
		while($row = $query_result->fetch_assoc()){
			$result["category"][] = $row["category_name"];
		}
	}else{
		$result["result"] = -1;
	}
	
	echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>