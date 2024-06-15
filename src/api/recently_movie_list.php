<?php
	header('Access-Control-Allow-Origin: *');
	require "database_connect.php";
	
	mb_language("ja");
	mb_internal_encoding("UTF-8");
	
	//日時で最後から10個を抜く、クエリはPHP内で生成
	$query = "SELECT title,date,point FROM moviedata ORDER BY date DESC LIMIT 10";
	
	$res = array();
	
	$query_result = db_connect($query);
	if($query_result){
		while($row = $query_result->fetch_assoc() ){
			//HTMLで表示するため<br>で改行
			$res[] = $row;
		}
	}

	echo json_encode($res, JSON_UNESCAPED_UNICODE)		

?>