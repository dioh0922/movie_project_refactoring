<?php
	//require "DatabaseConnect.php";
	require "database_connect.php";
	
	mb_language("ja");
	mb_internal_encoding("UTF-8");

	$kind = $_POST["kind"];

	if(strcmp($kind, "LastData") == 0){
		//最後に見たデータを探す
		$query = "SELECT title FROM moviedata ORDER BY date DESC LIMIT 1;";
	}else if(strcmp($kind, "Value") == 0){
		//価格別として選択した値段がPOSTされる
		$query = sprintf("SELECT title FROM moviedata WHERE value = %d;", $_POST["value"]);
	}else if(strcmp($kind, "Value_MX4D") == 0){
		//価格別でもMX4Dだけ一致ではなく値段以上のデータを探す
		$query = sprintf("SELECT title FROM moviedata WHERE value > %d;", $_POST["value"]);
	}else if(strcmp($kind, "Point") == 0){
		//重複削除で評価度と一致するもの取得
		$query = sprintf("SELECT DISTINCT title FROM moviedata WHERE point = %f;", $_POST["point"]);
	}else if(strcmp($kind, "Category") == 0){
		//重複削除で指定したカテゴリIDのデータを探す
		$query = sprintf("SELECT DISTINCT title FROM moviedata WHERE category = %d;", $_POST["value"] + 1);
	}else{
		//一致する抽出区分がない (JavaScript側が正しく設定してきていない)
		print "異常なデータが与えられました<br>";
		exit();
	}
	
	$query_result = db_connect($query);
	if($query_result){
		while($row = $query_result->fetch_assoc() ){
			
			//HTMLで結果表示するため<br>タグで改行
			print $row["title"]."<br>";
		}
	}
	
?>