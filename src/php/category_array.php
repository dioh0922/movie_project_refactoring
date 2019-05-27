<?php
	require "database_connect.php";
	
	mb_language("ja");
	mb_internal_encoding("UTF-8");
	
	header('Access-Control-Allow-Origin: *');

	$str = "";
	
	//カテゴリは1：アクション～13：コメディまで
	for($i = 1; $i <= 14; $i++){
		$query = sprintf("SELECT COUNT(title) FROM moviedata WHERE category=%d", $i);
		
		$query_result = db_connect($query);
		if($query_result){
			while($row = $query_result->fetch_assoc()){
				$str .= $row["COUNT(title)"];
				$str .= ",";
			}
		}else{
			exit();
		}
	}
	
	print $str;
?>