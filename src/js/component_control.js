
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
				"通常価格",
				"IMAX",
				"その他"
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
	el: "#value_select_box",
	data:{
		sel_items: value_list,
	}
});
