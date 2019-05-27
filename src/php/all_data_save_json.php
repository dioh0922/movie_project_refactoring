<?php
	require "database_connect.php";

	mb_language("ja");
	mb_internal_encoding("UTF-8");

	//以下データベース接続 -> クエリ(INSERT) -> 切断を行う
	
	$json_name = "db_backup.json";
	
	//DBから全データを持ってくる
	$query = "SELECT * FROM moviedata;";
	
	$Str = [];
	
	$query_result = db_connect($query);
	
	if($query_result){
		//DBから結果を取得できれば1こずつ出力していく
		while($row = $query_result->fetch_assoc() ){
			//文字列に変換する前にそのまま確保
			array_push($Str, $row);
		}
	}else{
		exit();
	}
	
	if(file_exists($json_name)){
		//php実行時にファイルを生成してクライアントで取得するため古いのは削除しておく
		unlink($json_name);
	}
	$out_put = "[\n";
	file_put_contents($json_name, $out_put, FILE_APPEND | JSON_PRETTY_PRINT | LOCK_EX);
	
	$length = count($Str);
	//最後に","つけないように1つ手前まで
	for($i = 0; $i < $length - 1; $i++){
		//データごとに","で区切って追記
		$out_put = json_encode($Str[$i], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		$out_put .= ",\n";
		file_put_contents($json_name, $out_put, FILE_APPEND | JSON_PRETTY_PRINT | LOCK_EX);
	}
	//最後のデータは内容のみ追記
	$out_put = json_encode($Str[$length - 1], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	$out_put .= "\n]";
	file_put_contents($json_name, $out_put, FILE_APPEND | JSON_PRETTY_PRINT | LOCK_EX);
	
	//受信したパスのデータをファイル名でダウンロードする
	
	$file_path = "db_backup.json";
	$file_name = "db_backup.json";
	
	//文字列エンコーディングを変更する
	$file_name = mb_convert_encoding($file_name, "SJIS", "UTF8");
	
	//ヘッダでhttpヘッダ自体を生成する
	//クライアントに返されたコンテンツの種別を設定
	header("Content-Disposition: application/octet-stream");
	//ダイアログに表示する文字列を設定
	header("Content-Disposition: attachment; filename = $file_name");
	
	//ファイルを読み込んで標準出力に書き出し
	readfile($file_path);
	exit();
?>