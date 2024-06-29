<?php
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	require "database_connect.php";
	db_init();

	$json = file_get_contents('php://input');
	$array = json_decode($json, true);
	
	$kind = $array["kind"] ?? null;
	$list = null;

	if($kind !== null && strcmp($kind, "LastData") == 0){
		//最後に見たデータを探す
		$title = ORM::for_table("moviedata")
		->select("title")
		->order_by_desc("date")
		->find_one();
		$list[] = ["title" => $title->title];
	}else if($kind !== null && strcmp($kind, "Value") == 0){
		//価格別として選択した値段がPOSTされる
		$list = ORM::for_table("moviedata")
		->select("title")
		->where("value", $array["value"])
		->find_many();
	}else if($kind !== null && strcmp($kind, "Value_MX4D") == 0){
		//価格別でもMX4Dだけ一致ではなく値段以上のデータを探す
		$list = ORM::for_table("moviedata")
		->select("title")
		->where_gte("value", $array["value"])
		->find_many();
	}else if($kind !== null && strcmp($kind, "Point") == 0){
		//重複削除で評価度と一致するもの取得
		$list = ORM::for_table("moviedata")
		->select("title")
		->where("point", $array["point"])
		->find_many();
	}else if($kind !== null && strcmp($kind, "Category") == 0){
		//重複削除で指定したカテゴリIDのデータを探す
		$list = ORM::for_table("moviedata")
		->select("title")
		->where("category", $array["value"])
		->find_many();
	}else{
		//一致する抽出区分がない (JavaScript側が正しく設定してきていない)
		print "異常なデータが与えられました<br>";
		exit();
	}

	$data = [];
	foreach($list as $idx => $key){
		$data[] = $key;
	}
	$result = $data;

	echo json_encode($result, JSON_UNESCAPED_UNICODE);

?>
