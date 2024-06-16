<?php
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	
	require "database_connect.php";

	mb_language("ja");
	mb_internal_encoding("UTF-8");

	//$result = ["result" => 0, "list"];

	$query = "SELECT AVG(point) as point, category FROM(SELECT DISTINCT point, title, category FROM moviedata) AS d_table GROUP BY category ORDER BY category";
	
	$str = [];

	$query_result = db_connect($query);
	if($query_result){
		while($row = $query_result->fetch_assoc()){
			$str[] = ["point" => $row["point"], "category" => $row["category"]];
		}
	}else{
		exit();
	}
	echo json_encode($str, JSON_UNESCAPED_UNICODE);
?>
