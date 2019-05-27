<?php
	require "database_connect.php";

	mb_language("ja");
	mb_internal_encoding("UTF-8");
	

	//アクセスするのは合計取得のためのみ、そのためクエリはPHP側で生成する
	$query = "SELECT SUM(scrTime),SUM(value) FROM moviedata;";	//合計データ計算クエリ

	//金額と時間の合計取得
	$sum_result = db_connect($query);
	
	if($sum_result){
		$sum_row = $sum_result->fetch_assoc();
		
		//HTML側のダイアログ(jQueryUI)で表示するため<br>タグに開業を変更
		print "総時間:".$sum_row["SUM(scrTime)"]."分<br>"."総金額:".$sum_row["SUM(value)"]."円<br>";
	}else{
		print "データの受信に失敗しました";
		exit();
	}

	//行数(見た数)取得
	$count_query =  "SELECT COUNT(title) FROM moviedata;";	//行数取得クエリ
	
	$count_result = db_connect($count_query);
	if($count_result){
		$count_row = $count_result->fetch_assoc();
		print "総鑑賞数:".$count_row["COUNT(title)"]."回<br>";
	}else{
		print "データの受信に失敗しました";
		exit();
	}
?>