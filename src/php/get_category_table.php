<?php
	require "database_connect.php";
	
	mb_language("ja");
	mb_internal_encoding("UTF-8");
	
	header('Access-Control-Allow-Origin: *');

	//各カテゴリの名称をとっていく
	$query = "SELECT category_name FROM category_table;";
	$str = "";
	
	$query_result = db_connect($query);
	if($query_result){
		while($row = $query_result->fetch_assoc()){
			$str .= $row["category_name"];
			$str .= ",";
		}
	}else{
		exit();
	}
	
	print $str;
?>