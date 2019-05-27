<?php
	require "database_connect.php";
	
	mb_language("ja");
	mb_internal_encoding("UTF-8");
	
	header('Access-Control-Allow-Origin: *');
	
	$query = sprintf("INSERT INTO `moviedata` (`title`, `scrTime`, `date`, `value`, `point`, `category`) VALUES(\"%s\", \"%s\", \"%s\", \"%s\", \"%s\", \"%s\");",
					$_POST["title"],
					$_POST["scrTime"],
					$_POST["date"],
					$_POST["value"],
					$_POST["point"],
					$_POST["cate"]
					);
	
	$query_result = db_connect($query);
	if(!$query_result){
			print "追記時に異常が発生しました";
	}
?>