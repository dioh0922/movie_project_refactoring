<?php

function db_init(){
	require_once(dirname(__FILE__)."/../vendor/autoload.php");

    $env = Dotenv\Dotenv::createImmutable(dirname(__FILE__)."/../../../env");
    $env->load();
	mb_language("ja");
	mb_internal_encoding("UTF-8");

	ORM::configure("mysql:host=".$_ENV["DB_HOST"].";port=".$_ENV["DB_PORT"]."charset=utf8;dbname=".$_ENV["DB_DB"]);
    ORM::configure("username", $_ENV["DB_USER"]);
    ORM::configure("password", $_ENV["DB_PASS"]);
}

function db_connect($query){
	require_once(dirname(__FILE__)."/../vendor/autoload.php");

    $env = Dotenv\Dotenv::createImmutable(dirname(__FILE__)."/../../../env");
    $env->load();
	mb_language("ja");
	mb_internal_encoding("UTF-8");

	$mysqli = new mysqli($_ENV["DB_HOST"], $_ENV["DB_USER"], $_ENV["DB_PASS"], $_ENV["DB_DB"]);
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
