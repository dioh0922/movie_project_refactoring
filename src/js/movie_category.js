
//カテゴリ情報の配列
var category_dat_arr = [];

//カテゴリ名の一覧
var category_label = [];

//平均値データ
var avg_point_arr = [];


//アクセスするサーバ名称
//const svr_domain = "http://dioh09.php.xdomain.jp";
const svr_domain = "http://localhost/movie_project";

//グラフ表示処理
function graph_display(){

	let ctx = document.getElementById("myChart").getContext('2d');

	let data_arr_max = 0;
	data_arr_max =	Math.max.apply(null, category_dat_arr) + 5;//配列の最大でスケールの調整を行う

	let graph_option;

	graph_option = {
		maintainAspectRatio: false,
		responsive: true,
		scales: {
			yAxes: [{
				//id: "PointAxis",
				id: "point_axis",
				type: "linear",
				position: "left",
				ticks: {
					max: 5.5,
					min: 0.5,
					stepSize: 0.5
				}
			},{
				//id: "DataArrAxis",
				id: "data_arr_axis",
				type: "linear",
				position: "right",
				ticks: {
					//max: DataArrMax,
					max: data_arr_max,
					min: 0,
					stepSize: 10
				},
				gridLines: {
					drawOnChartArea: false
				}
			}]
		}
	};

	let me_chart = new Chart(ctx, {
		type: "bar",
		options: graph_option,
		data: {
			labels: category_label,
			datasets: [
			{
				type: "bar",
				label: "鑑賞した本数",
				data: category_dat_arr,
				backgroundColor: "rgba(153, 255, 51, 0.4)",
				yAxisID: "data_arr_axis"
			},
			{
				type: "line",
				label: "評価平均",
				data: avg_point_arr,
				borderColor: "rgba(200, 51, 153, 0.4)",
				backgroundColor: "rgba(255, 51, 153, 0.4)",
				lineTension: 0,
				fill: false,
				yAxisID: "point_axis"
			}]
		}//data
	});

}

function get_category_data(){
	$.ajax({
		type: "GET",
		url: svr_domain + "/src/php/category_array.php",
		cacha: false
	})
	.done(function(ajaxDat){
		category_dat_arr = ajaxDat.split(",");

		//末尾のデータの","で区切られた余分な要素を削除
		category_dat_arr.pop();

		$(window).trigger("recv_DB");
	})
	.fail(function(){
		alert("カテゴリ情報取得失敗");
	});
}

function get_category_table(){
	$.ajax({
		type: "GET",
		url: svr_domain + "/src/php/get_category_table.php",
		cacha: false
	})
	.done(function(ajaxDat){
		category_label = ajaxDat.split(",");

		//末尾のデータの","で区切られた余分な要素を削除
		category_label.pop();

		$(window).trigger("recv_DB");
	})
	.fail(function(){
		alert("カテゴリ一覧の取得に失敗");
	});
}

function get_avg_point(){
	$.ajax({
		type: "GET",
		url: svr_domain + "/src/php/get_avg_point.php",
		cacha: false
	})
	.done(function(ajaxDat){
		avg_point_arr = ajaxDat.split(",");

		avg_point_arr.pop();

		$(window).trigger("recv_DB");
	})
	.fail(function(){
		alert("カテゴリ別評価平均を取得に失敗");
	});
}

function recv_result_event(){

	if( (category_dat_arr.length > 0)
	&&  (category_label.length > 0)
	&&  (avg_point_arr.length > 0) ){
		//表示内容を受信済みなら表示させる
		$(window).trigger("ready_display");
	}
}

//データ受信イベント：受信完了ごとにそろったか確認
$(window).on("recv_DB", recv_result_event);

//描画準備完了イベント
$(window).on("ready_display", graph_display);

//起動時の処理
(window.onload = function(){
	get_category_data();
	get_category_table();
	get_avg_point();
});
