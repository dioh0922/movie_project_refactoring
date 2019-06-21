<?php

function db_connect($query){
	mb_language("ja");
	mb_internal_encoding("UTF-8");

	$json_name = "../setup.json";
	if(file_exists($json_name)){
		$setup_data = file_get_contents($json_name);
		$setup_data_arr = json_decode($setup_data, true);

		$url = $setup_data_arr["connect_url"];
		$user = $setup_data_arr["user_name"];
		$pass = $setup_data_arr["password"];
		$db = $setup_data_arr["target_database"];

		$mysqli = new mysqli($url, $user, $pass, $db);
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

	}else{
		return "設定の読み込みに失敗";
		exit();
	}
}

?>
