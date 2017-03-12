<?php
$fd = fopen("todo.csv", "a+");
fputcsv($fd, array($_GET["id"], $_GET["todo"]), ";");
fclose($fd);
?>
