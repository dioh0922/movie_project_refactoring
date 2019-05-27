<?php
	require "database_connect.php";
	
	mb_language("ja");
	mb_internal_encoding("UTF-8");
	
	header('Access-Control-Allow-Origin: *');
	
	$del_title = $_POST["query"];
	$query = sprintf("DELETE FROM moviedata WHERE title=\"%s\";", $del_title);
	$query_result = db_connect($query);
	if(!$query_result){
			print "削除時に異常が発生しました";
	}
?>
