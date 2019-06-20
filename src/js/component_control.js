
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
