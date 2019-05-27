<?php
	require "database_connect.php";
	
	mb_language("ja");
	mb_internal_encoding("UTF-8");
	
	//日時で最後から10個を抜く、クエリはPHP内で生成
	$query = "SELECT title,date,point FROM moviedata ORDER BY date DESC LIMIT 10";
	
	$resStr = array();
	
	$query_result = db_connect($query);
	if($query_result){
		while($row = $query_result->fetch_assoc() ){
		
			//HTMLで表示するため<br>で改行
			$res_str[] = "「".$row["title"]."」 ".$row["date"]." ".$row["point"]."<br>";
		}
	}

	$length = count($res_str);
	for($i = $length - 1; $i >= 0; $i--){
		//最後尾から出力していく -> 日付の最後から10取得で先頭が最新のため
		print $res_str[$i];
	}
		

?>