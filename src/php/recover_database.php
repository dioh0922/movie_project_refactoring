<?php
  require "database_connect.php";

  mb_language("ja");
  mb_internal_encoding("UTF-8");

  $file_data = file_get_contents("db_backup.json");

  $arr = json_decode($file_data, true);
  foreach ($arr as $arr_iter) {
      // code...
    $query = sprintf("INSERT INTO `moviedata` (`title`, `scrTime`, `date`, `value`, `point`, `category`) VALUES(\"%s\", \"%s\", \"%s\", \"%s\", \"%s\", \"%s\");",
            $arr_iter["title"],
            $arr_iter["scrTime"],
            $arr_iter["date"],
            $arr_iter["value"],
            $arr_iter["point"],
            $arr_iter["category"]
            );
    $result = db_connect($query);
  }
  //$result = db_connect($query);

?>
