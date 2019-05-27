<?php
//login.phpからセッションしてるかみる
//ログインしてなければログイン画面のhtml
//ログインしてたら追記ページ
session_start();

if(!isset($_SESSION["login_user"])){
  //セッションなければログイン画面表示
  $no_login_url = "login_page.html";
  header("Location: {$no_login_url}");
  exit;
}
?>

<!DOCTYPE html>

<html lang = "ja">
<head>
	<meta charset = "UTF-8">
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<script type="text/javascript" src="./src/js/jquery-1.12.1.min.js"></script>
	<script type="text/javascript" src="./src/js/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="./src/css/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="./src/css/page_button_style.css">
	<link rel="stylesheet" type="text/css" href="./src/css/add_movie.css">
	<title>データベースに映画情報を入力</title>
</head>

<body>
	<div class="all_page_layout">
		<div class="change_page_btn">
			<a href = "../index.html" class="goto_main">メインページへ</a><br>
			<a href = "./movie_calc.html" class="goto_calc">検索ページへ</a><br>
			<a href = "./movie_category.html" class="goto_graph">グラフページへ</a><br>
		</div>

		<div class="input_data_layout">
			<form name="add_movie_data" >
			<a id="input_guide_title">タイトル名：</a><input type="text" name="title" id="title_textbox" value="タイトルを入力" onclick="add_movie_title_form_on_select()"/><br>
			<a id="input_guide_ScrTime">上映時間：</a><input type="number" id="ScrTime_textbox" name="scrTime" value="1"/><br>
			<a id="input_guide_date">日時：</a><input type="date" id="date_textbox" name="date"><br>
			<a id="input_guide_value">値段：</a><input type="number" name="value" id="value_textbox" value="0"/><br>
			<input type="button" value="TOHOシネマズ レイト" class="value_select_btn_style" onclick="TOHO_night()"/>
			<input type="button" value="横浜ブルク13 レイト" class="value_select_btn_style" onclick="KINEZO_night()"/>
			<input type="button" value="通常料金" class="value_select_btn_style" onclick="normal_value()"/>
			<input type="button" value="TOHO 無料鑑賞" class="value_select_btn_style" onclick="TOHO_spend_point()"/>
			<input type="button" value="TOHO サービスデー" class="value_select_btn_style" onclick="TOHO_service()"/>

			<br/>

			<a id="input_guide_point">評価：</a>
				<select name="Point" id="point_selectbox">
					<option value ="">1</option>
					<option value ="">1.5</option>
					<option value ="">2</option>
					<option value ="">2.5</option>
					<option value ="">3</option>
					<option value ="">3.5</option>
					<option value ="">4</option>
					<option value ="">4.5</option>
					<option value ="">5</option>
				</select>

			<br/>

			<a id="input_guide_category">カテゴリ：</a>
				<select name="Category" id="category_selectbox">
					<option value="">アクション</option>
					<option value="">アメコミ</option>
					<option value="">アニメ</option>
					<option value="">ミュージカル</option>
					<option value="">ラブロマンス</option>
					<option value="">ミステリー・心理</option>
					<option value="">サスペンス</option>
					<option value="">歴史</option>
					<option value="">SF</option>
					<option value="">犯罪(クライム)</option>
					<option value="">ホラー・スリル</option>
					<option value="">ファンタジー</option>
					<option value="">コメディ</option>
				</select>
			</form>

			<input type = "button" value = "追加" id="confirm_add_data_btn" onclick = "add_data()" /><br>
		</div>

		<div class="referance_website">

			<a href = "https://filmarks.com/" target="_blank" id="refer_site_btn">
				<div id="refer_site_txt">
					上映時間検索(外部サイト)
					<br>
				</div>
			</a>

			<div class="admin_form">
				<form name = "Delete">
					<input type = "text" name = "delete_title" value = "削除タイトルを入力"/>
					<input type = "button" class="admin_btn" value = "タイトルで削除" onclick="delete_data()"/><br>
				</form>
				<input type="button" name="all_data_save" class="admin_btn" value="全データjson化" onclick="all_data_save_json()"/><br>
				<input type="button" name="sql_test" class="admin_btn" value="全json -> DB化" onclick="json_all_cnv_db()"/><br>
        <input type="button" name="logout_btn" class="admin_btn" value="ログアウト" onclick="logout_admin_user()"/><br>
    	</div>
		</div>
		<div id="button_padding">

		</div>

		<div id="alert_dialog">
			<div id="alert_dlg_txt"> </div>
		</div>

	</div>
	<script src="./src/js/add_movie.js"></script>
</body>

</html>
