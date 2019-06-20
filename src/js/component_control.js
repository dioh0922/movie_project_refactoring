
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

var category_select_control = new Vue({
	el: "#select_box_category",
	data: {
		sel_items: category_list,
	}
});


//起動時の処理
(window.onload = function(){
	category_select_control.sel_items = category_list;
});
