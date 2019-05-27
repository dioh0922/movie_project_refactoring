<?php
	require "database_connect.php";
	
	mb_language("ja");
	mb_internal_encoding("UTF-8");

	$query = "SELECT title,date,point FROM moviedata;";
	
	$query_result = db_connect($query);
	if($query_result){
		while($row = $query_result->fetch_assoc() ){
			
			//HTMLで結果表示するため<br>タグで改行
			print "「".$row["title"]."」 ".$row["date"]." ".$row["point"]."<br>";
		}
	}
	
?>