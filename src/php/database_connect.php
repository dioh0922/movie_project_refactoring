<?php

function db_connect($query){
	require(dirname(__FILE__)."/../../../env/connection_setting.php");
	mb_language("ja");
	mb_internal_encoding("UTF-8");

	$mysqli = new mysqli($SQL_HOST, $SQL_USER, $SQL_PASS, $SQL_DB);
	if($mysqli->connect_error){
		return $mysqli->connect_error;
		exit();
	}else{
		$mysqli->set_charset("utf8");
	}

	$query_result = $mysqli->query($query);

	$close_result = $mysqli->close();
	if($close_result){
		//print "closeした";
	}else{
		return $mysqli->connect_error;
	}

	return $query_result;
}

?>
