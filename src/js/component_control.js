
const category_list = [
				"アクション",
				"アメコミ",
				"アニメ",
				"ミュージカル",
				"ラブロマンス",
				"ミステリー・心理",
				"サスペンス",
				"歴史",
				"SF",
				"犯罪(クライム)",
				"ホラー・スリル",
				"ファンタジー",
				"コメディ",
				"伝記",
				"パニック"
			];

const point_list = [
				1,
				1.5,
				2,
				2.5,
				3,
				3.5,
				4,
				4.5,
				5
			];

const value_list = [
				"レイトショー(TOHO)",
				"レイトショー(横浜ブルク13)",
				"無料鑑賞",
				"ファーストデイ",
				"映画の日",
				"特殊価格(リバイバル,短編他)",
				"MX4D",
				"通常価格(改定前)",
				"IMAX",
				"その他"
			];

const value_data = 	[
						1300, 		//TOHOのレイト料金
						1500,		//横浜ブルクのレイト料金
						0,			//無料鑑賞
						1100,		//TOHOシネマサービス系
						1000,		//映画の日
						1200,		//リバイバル、短編等
						3300,		//MX4D, 4DX関係
						1800,		//通常料金
						2200,		//IMAXの料金
						9999		//未定義
					];

var category_select_control = new Vue({
	el: "#select_box_category",
	data: {
		sel_items: category_list,
	}
});

var point_select_control = new Vue({
	el: "#select_box_point",
	data:{
		sel_items: point_list,
	}
});

var value_select_control = new Vue({
	el: "#select_box_value",
	data: {
		sel_items: value_list,
		sel_idx: value_list[0],
	},
	methods: {
		selected: function(){
			let idx;
			idx = document.add_movie_data.movie_value.selectedIndex;	//選択中の値段のインデックス取得
			value_text_control.text = value_data[idx];
		},
	}
});
