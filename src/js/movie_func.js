
var file_select;
var json_text;
var data;
var special = "";

var movie_data;

var svr_domain = "";	//アクセスするサーバ名称

const MX4D_value = 3300;	//MX4D系の判断に使用

/*
const value_data = 	[	1300, 		//TOHOのレイト料金
						1400,		//横浜ブルクのレイト料金
						0,			//無料鑑賞
						1100,		//TOHOシネマサービス系
						1000,		//映画の日
						1200,		//リバイバル、短編等
						3300,		//MX4D, 4DX関係
						1800,		//通常料金
						2200,		//IMAXの料金
						9999		//未定義
					];
*/

//結果表示操作オブジェクト
var text_area_control = new Vue({
	el: "#result_text_area",
	data:{
		text: [
			"DBから結果表示"
		]
	}
});

//起動時の処理
(window.onload = function(){
	$("#page_top").hide();
	$.getJSON("/movie_project/src/setup.json", function(data){
		svr_domain = data["domain"];
	});
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

//選択した評価度を探して表示する
//「評価別」
function sort_point(){
	let idx = 0;
	idx = document.input_data.point.selectedIndex;	//選択中の評価のインデックス取得

	let send_data = {};
	send_data["kind"] = "Point";
	send_data["point"] = point_select_control.sel_items[idx];

	let disp_PHP = svr_domain + "/src/php/show_detail.php";

	//クエリ文字列と対象URLを渡して関数でPOSTする
	POST_query(send_data, disp_PHP);
}

//総時間と総金額を計算して表示する関数
//「各合計」
function total_calc(){
	let total_time = 0;
	let total_money = 0;
	let dialog_result_arr = [];

	$.ajax({
		type:"GET",
		url:svr_domain + "/src/php/calc_total.php",
		cacha:false,
	})
	.done(function(get_data){
		dialog_result_arr = get_data;
	})
	.fail(function(){
		dialog_result_arr = "通信に失敗しました";
	})
	.always(function(){
		//jqueryUIでダイアログ表示する
		var str = $("<div></div>").dialog({autoOpen: true});
		str.html('<h1 id="calc_all_dialog">'+dialog_result_arr+'</h1>');
		str.dialog("option", {
			title: "総計",
			buttons:	{
				"閉じる":	function(){
					$(this).dialog("close");
				}
			}
		});
		str.dialog("open");
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
		//func_result.innerHTML = ajax_data;
		let data_arr = ajax_data.split("<br>");
		text_area_control.text = data_arr;
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
			//func_result.innerHTML = ajax_data;
			let data_arr = ajax_data.split("<br>");
			text_area_control.text = data_arr;
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
