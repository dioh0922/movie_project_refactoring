<?php
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	
	require "database_connect.php";
	db_init();

	mb_language("ja");
	mb_internal_encoding("UTF-8");

	//$result = ["result" => 0, "list"];

	$query = "SELECT AVG(point) as point, category FROM(
	SELECT DISTINCT point, title, category FROM moviedata
	) AS d_table GROUP BY category ORDER BY category";

	$list = ORM::for_table("moviedata")
	->raw_query($query)
	->find_many();
	
	$data = [];
	foreach($list as $idx => $key){
		$data[] = ["point" => $key->point, "category" => $key->category];
	}
	$result = $data;

	echo json_encode($result, JSON_UNESCAPED_UNICODE)		

?>
