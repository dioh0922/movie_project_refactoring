<?php
	require "database_connect.php";
	mb_language("ja");
	mb_internal_encoding("UTF-8");

	header('Access-Control-Allow-Origin: *');

	session_start();

	if(isset($_POST["logout"]) ){
		if($_POST["logout"] == "1"){
			session_destroy();
			print "logout";
			exit;
		}
	}

	$in_ID = $_POST["userID"];
	$password = $_POST["pass"];

	$query = sprintf("SELECT accept FROM login WHERE userID = \"%s\" AND pass = \"%s\"; ",
						$in_ID,
						$password);

	//クエリ実行して比較情報とる
	$query_result = db_connect($query);
	if($query_result){
		$row = $query_result->fetch_assoc();
		if($row["accept"] == "1"){
			$_SESSION["login_user"] = $in_ID;
			print "success";
		}else{
			print "Login Failed";
		}
		//許可情報acceptが許可ならセッション情報を追加してページ遷移
	}
?>
