
var AddMovie = "";
var sel_idx;
var alert_text;
const json_addr = "http://dioh09.php.xdomain.jp/MovieData.json";	//phpサーバ上のjson

//アクセスするサーバ名称
var svr_domain = "";

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

//値段設定定数

const TOHO_night_val = 1300;
const KINEZO_night_val = 1400;
const normal_val = 1800;
const TOHO_point_val = 0;
const TOHO_service_val = 1100;
const GuP_special_val= 1200;	//ガルパン最終章特別価格

const LOGOUT_FLG_ON = 1;

function add_data(){

	var Json = {};

	Json["title"] = document.add_movie_data.title.value;
	Json["scrTime"] = document.add_movie_data.scrTime.value;
	Json["date"] = document.add_movie_data.date.value;
	//Json["value"] = document.add_movie_data.value.value;
	Json["value"] = value_text_control.text;

	sel_idx = document.add_movie_data.point.selectedIndex;
	Json["point"] = movie_point[sel_idx];

	//カテゴリIDは1から割り振られている
	Json["cate"] = document.add_movie_data.Category.selectedIndex + 1;

	let cnf_POST = confirm(Json["title"] + "\n" + Json["date"] + "\n" + "を追加します");

	if(cnf_POST){
		//オブジェクトを送信(追加)
		PUT_json(Json);
	}
}

//PHPに追記要求
function PUT_json(add_data){
	$.ajax({
		type:"POST",
		url:svr_domain + "/src/php/add_movie_data.php",
		cacha:false,
		data: add_data
	})
	.done(function(){
		alert_dialog_open("追記要求の送信に成功しました");
	})
	.fail(function(){
		alert_dialog_open("DBとの通信に失敗しました");
	});
}

//値段設定系
function select_value_items(){
	console.log("値段のセレクトボックス");
	console.log("Vueのオブジェクトに書き換えさせる");
}

var value_text_control = new Vue({
	el: "#value_textbox",
	data:{
		text: "0"
	}
});

/*

function TOHO_night(){
	document.add_movie_data.value.value = TOHO_night_val;
}

function KINEZO_night(){
	document.add_movie_data.value.value = KINEZO_night_val;
}

function normal_value(){
	document.add_movie_data.value.value = normal_val;
}

function TOHO_spend_point(){
	document.add_movie_data.value.value = TOHO_point_val;
}

function TOHO_service(){
	document.add_movie_data.value.value = TOHO_service_val;
}
*/

//タイトル入力フォーム操作時
function add_movie_title_form_on_select(){
	document.add_movie_data.title.value = "";
}

//全データ登録はPHPにやらせるように要修正
//json全データをデータベースに登録
function json_all_cnv_db(){
	let movie_data;

	let cnf_result;
	cnf_result = confirm("jsonファイルを全てデータベースに登録します");

	if(cnf_result){
	}
}

//入力したタイトルのデータを削除 (間違い修正用)
function delete_data(){
	let str = document.Delete.delete_title.value;
	let query = "query=";
	query += str;

	let del_cnf;

	//DelCnf = confirm("「" + str + "」を削除しますか?\n(同じ名前はすべて消えます。誤入力の修正用です。)");
	//if(DelCnf){
	del_cnf = confirm("「" + str + "」を削除しますか?\n(同じ名前はすべて消えます。誤入力の修正用です。)");
	if(del_cnf){
		$.ajax({
			type:"POST",
			url:svr_domain + "/src/php/delete_data.php",
			cacha:false,
			data:query
		})
		.done(function(){
			//成功時処理
			alert_dialog_open("データの削除に成功しました");
		})
		.fail(function(ajaxDat){
			//失敗時処理
			alert_dialog_open("サーバとの通信に失敗しました");
		});
	}
}

//ログアウトしてセッションを消す
function logout_admin_user(){
	let logout_data = {};
	logout_data["logout"] = LOGOUT_FLG_ON;

	$.ajax({
		type: "POST",
		url: svr_domain + "/src/php/Login.php",
		cacha: false,
		data: logout_data
	})
	.done(function(result){
		if(result == "logout"){
			$(window).trigger("killed_session");
		}
	})
	.fail(function(){
		alert("POSTで通信に失敗");
	});
}

$(window).on("killed_session", goto_index_page);

function goto_index_page(){
		location.href = svr_domain + "/login_page.html";
}

$(function(){

	$("#login_failed").hide();
	$("#alert_dialog").dialog({autoOpen: false});

	$("#alert_dialog").dialog({
		modal: true,
		title: "アラート表示",
		buttons:{
			"閉じる":	function(){
				$(this).dialog("close");
			}
		}
	});

});

//ログインフォームのPW入力欄初期化
function login_form_init_PW(){
	document.login_form.pass.value = "";
}

//ログインフォームのID入力欄初期化
function login_form_init_ID(){
	document.login_form.userId.value = "";
}

//アラートのダイアログを表示する
function alert_dialog_open(err_str){
	alert_text.innerHTML = err_str;
	$("#alert_dialog").dialog("open");
}


//全データをjsonファイルに書き出す
function all_data_save_json(){
	//直接phpからファイルを書き出させてDLする
	window.location.href = svr_domain + "/src/php/all_data_save_json.php";
}

(window.onload = function(){
	//結果表示用のダイアログに結果(主に失敗)を表示できるようにする
	alert_text = document.getElementById("alert_dlg_txt");
	$.getJSON("/movie_project/src/setup.json", function(data){
		svr_domain = data["domain"];
	});
});
