
var file_select;
var json_text;
var data;
var special = "";

//各ボタンの結果を表示する
var	func_result = document.getElementById("result_area");

var form = document.forms.text_form;	//結果表示のテキストエリア指定

var movie_data;
const json_addr = "http://dioh09.php.xdomain.jp/MovieData.json";	//phpサーバ上のjson そのままだとjQueryで取れない

//アクセスするサーバ名称
//const svr_domain = "http://dioh09.php.xdomain.jp";
const svr_domain = "http://localhost/movie_project";

const movie_point = [	'1',
						'1.5',
						'2',
						'2.5',
						'3',
						'3.5',
						'4',
						'4.5',
						'5'
					];

const MX4D_value = 3300;	//MX4D系の判断に使用

const value_data = 	[	1300, 		//TOHOのレイト料金
						1400,		//横浜ブルクのレイト料金
						0,			//無料鑑賞
						1100,		//TOHOシネマサービス系
						1000,		//映画の日
						1200,		//リバイバル、短編等
						3300,		//MX4D, 4DX関係
						1800,		//通常料金
						2300,		//IMAXの料金
						9999		//未定義
					];

//起動時の処理
(window.onload = function(){
	func_result.innerHTML = "DBから抽出結果を表示する";
	$("#page_top").hide();
});

$(function(){
	$("#calc_al_dialog").dialog({autoOpen:false});
	$("#page_top").click(function(){
		//クリックされたら
		$("html,body").animate({scrollTop:0}, "300");
	});

	$(window).scroll(function(){
		if($(window).scrollTop() > 0){
			$("#page_top").slideDown(600);
		}else{
			$("#page_top").slideUp(600);
		}
	});

});

//評価度リスト選択時処理
function set_point_index(){

}

//選択した評価度を探して表示する
//「評価別」
function sort_point(){
	let idx = 0;
	idx = document.input_data.point.selectedIndex;	//選択中の評価のインデックス取得

	let send_data = {};
	send_data["kind"] = "Point";
	send_data["point"] = movie_point[idx];

	let disp_PHP = svr_domain + "/src/php/show_detail.php";

	//クエリ文字列と対象URLを渡して関数でPOSTする
	POST_query(send_data, disp_PHP);
}

//総時間と総金額を計算して表示する関数
//「各合計」
function total_calc(){
	let total_time = 0;
	let total_money = 0;

	let alert_word = "";

	let dialog_str = document.getElementById("all_dialog_result");
	dialog_str.innerHTML = "";

	$.ajax({
		type:"GET",
		url:svr_domain + "/src/php/calc_total.php",
		cacha:false,
	})
	.done(function(get_data){
		dialog_str.innerHTML = get_data;
	})
	.fail(function(){
		dialog_str.innerHTML = "通信に失敗しました\n";
	})
	.always(function(){
		//jqueryUIでダイアログ表示する
		$("#calc_all_dialog").dialog({
			modal:	true,
			title:	"総計",
			autoOpen:	true,

			buttons:	{
				"閉じる":	function(){
					$(this).dialog("close");
				}
			}
		});
	});

}

//10件を日付の新しい順に表示する
//「最新１０個」
function recently_movie_check(){
	let dist_PHP = svr_domain + "/src/php/recently_10Movie.php";
	request_PHP_result(dist_PHP);
}

//選択した価格と一致するデータを表示する
//「価格別
function search_value(){
	let str = "";
	let idx;
	idx = document.input_data.movie_value.selectedIndex;	//選択中の値段のインデックス取得
	let dist_PHP = svr_domain + "/src/php/show_detail.php";

	//選択した値段と一致するもの取得

	let send_data = {};
	send_data["kind"] = "Value";
	send_data["value"] = value_data[idx];

	if(value_data[idx] == MX4D_value){
		//MX4Dだけ値段以上のクエリに書き換える
		send_data["kind"]  = "Value_MX4D";
	}

	//クエリ文字列と対象URLを渡して関数でPOSTする
	POST_query(send_data, dist_PHP);
}

//データ全体表示
//「全部」
function show_all(){
	let dist_PHP = svr_domain + "/src/php/show_all_movie.php";

	request_PHP_result(dist_PHP);
}

//最後のデータ表示
//「最後に見たもの」
function last_data(){
	//titleをdateの最大1つまで表示する -> 最新の映画を表示
	let dist_PHP = svr_domain + "/src/php/show_detail.php";
	let kind = "kind=LastData";

	//引き出す内容種別と対象URLを渡して関数でPOSTする
	POST_query(kind, dist_PHP);
}

//引数なしでPHPから結果返すだけ
function request_PHP_result(url){
	$.ajax({
		type:"GET",
		url:url,
		cacha:false
	})
	.done(function(ajax_data){
		func_result.innerHTML = ajax_data;
	})
	.fail(function(){
		alert("PHPへの通信が失敗しました。");
	});
}

//渡されたクエリ文字列と対象のPHP(URL)にPOSTする
function POST_query(query_str, url){
		$.ajax({
			type:"POST",
			url:url,
			cacha:false,
			data: query_str
		})
		.done(function(ajax_data){
			func_result.innerHTML = ajax_data;
		})
		.fail(function(){
			alert("POSTで通信が失敗");
		});
}

//カテゴリ別に抽出する
function sort_category(){
	let dist_PHP = svr_domain + "/src/php/show_detail.php";

	//選択した値段と一致するもの取得
	let send_data = {};
	send_data["kind"] = "Category";
	send_data["value"] = document.input_data.Category.selectedIndex;

	POST_query(send_data, dist_PHP);
}
