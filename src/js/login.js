
var AddMovie = "";
var sel_idx;
var alert_text;
const json_addr = "http://dioh09.php.xdomain.jp/MovieData.json";	//phpサーバ上のjson

//アクセスするサーバ名称
var svr_domain = "";

function try_login(){
	var user_data = {};
	user_data["userID"] = document.login_form.userId.value;
	user_data["pass"] = document.login_form.pass.value;
	//ログインページから情報とってきてログイン処理にPOSTする
	//ログイン処理側でセッション情報追加してからページを再び遷移

	$.ajax({
		type:"POST",
		url:svr_domain + "/src/php/Login.php",
		cacha:false,
		data: user_data
	})
	.done(function(ajax_data){
		let Result = ajax_data;
		if(Result == "success"){
			location.href = svr_domain + "/add_movie.php";
		}
	})
	.fail(function(ajax_data){
		console.log(ajax_data);
	});
}

//ログインフォームのPW入力欄初期化
function login_form_init_PW(){
	document.login_form.pass.value = "";
}

//ログインフォームのID入力欄初期化
function login_form_init_ID(){
	document.login_form.userId.value = "";
}

(window.onload = function(){
	$.getJSON("/movie_project/src/svr.json", function(data){
		svr_domain = data["domain"];
	});
});
