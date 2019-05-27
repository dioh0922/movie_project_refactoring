<?php
	require "database_connect.php";

	mb_language("ja");
	mb_internal_encoding("UTF-8");

	header('Access-Control-Allow-Origin: *');

	//カテゴリごとの評価の平均を取得
	//$query = "SELECT AVG(point) FROM moviedata GROUP BY category";

	//同一タイトルを複数回見ても平均に含まないようにクエリの調整
	//グループ化する前にサブクエリで重複タイトルをまとめたテーブルを取得
	$query = "SELECT AVG(point) FROM(SELECT DISTINCT point, title, category FROM moviedata) AS d_table GROUP BY category";
	$str = "";

	$query_result = db_connect($query);
	if($query_result){
		while($row = $query_result->fetch_assoc()){
			$str .= $row["AVG(point)"];
			$str .= ",";
		}
	}else{
		exit();
	}

	print $str;
?>
