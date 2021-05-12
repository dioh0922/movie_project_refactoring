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
	<script src="https://cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.js"></script>
	<script
		src="https://code.jquery.com/jquery-3.4.1.js"
		integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
		crossorigin="anonymous">
	</script>
	<script
		src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
		crossorigin="anonymous">
	</script>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
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
			<a id="input_guide_title">タイトル名：</a><input type="text" name="title" id="title_textbox" placeholder="タイトルを入力" onclick="add_movie_title_form_on_select()"/><br>
			<a id="input_guide_ScrTime">上映時間：</a><input type="number" id="ScrTime_textbox" name="scrTime" value="1"/><br>
			<a id="input_guide_date">日時：</a><input type="date" id="date_textbox" name="date"><br>
			<a id="input_guide_value">値段：</a>

			<input type="text" id="value_textbox" v-model="text"></br>
			<select name = "movie_value" class="select_box_style"
			id="select_box_value"
			v-on:change="selected"
			v-model="sel_idx">
				<option v-for="(value, key) in sel_items">
					{{value}}
				</option>
			</select>

			<br/>

			<a id="input_guide_point">評価：</a>
			<select name="point" class="select_box_style" id="select_box_point">
				<option v-for="(value, key) in sel_items">
					{{value}}
				</option>
			</select>
			<br/>
			<a id="input_guide_category">カテゴリ：</a>
			<select name="Category" class="select_box_style" id="select_box_category">
				<option v-for="(value, key) in sel_items">
					{{value}}
				</option>
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
					<input type = "text" name = "delete_title" placeholder = "削除タイトルを入力"/>
					<input type = "button" class="admin_btn" value = "タイトルで削除" onclick="delete_data()"/><br>
				</form>
				<input type="button" name="all_data_save" class="admin_btn" value="全データjson化" onclick="all_data_save_json()"/><br>
				<input type="button" name="sql_test" class="admin_btn" value="全json -> DB化" onclick="json_all_cnv_db()"/><br>
        <input type="button" name="logout_btn" class="admin_btn" value="ログアウト" onclick="logout_admin_user()"/><br>
    	</div>
		</div>
		<div id="button_padding">

		</div>

	</div>
	<script type="text/javascript" src="./src/js/component_control.js"></script>
	<script src="./src/js/add_movie.js"></script>
</body>

</html>
