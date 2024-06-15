<?php
	header('Access-Control-Allow-Origin: *');
	require "database_connect.php";

	mb_language("ja");
	mb_internal_encoding("UTF-8");
	

	//アクセスするのは合計取得のためのみ、そのためクエリはPHP側で生成する
	$query = "SELECT SUM(scrTime),SUM(value) FROM moviedata;";	//合計データ計算クエリ

	$result = ["result" => 0, "scrTime" => 0, "value" => 0, "count" => 0];

	//金額と時間の合計取得
	$sum_result = db_connect($query);
	
	if($sum_result){
		$sum_row = $sum_result->fetch_assoc();
		
		$result["scrTime"] = $sum_row["SUM(scrTime)"];
		$result["value"] = $sum_row["SUM(value)"];
	}else{
		$result["result"] = -1;
		$result["msg"] = "データの受信に失敗しました";
		echo json_encode($result, JSON_UNESCAPED_UNICODE);
		exit();
	}

	//行数(見た数)取得
	$count_query =  "SELECT COUNT(title) FROM moviedata;";	//行数取得クエリ
	
	$count_result = db_connect($count_query);
	if($count_result){
		$count_row = $count_result->fetch_assoc();
		$result["count"] = $count_row["COUNT(title)"];
	}else{
		$result["result"] = -1;
		$result["msg"] = "データの受信に失敗しました";
		echo json_encode($result, JSON_UNESCAPED_UNICODE);
		exit();
	}

	$result["result"] = 1;
	echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>