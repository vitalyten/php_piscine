<?php
$ret = array();
$fd = fopen("todo.csv", "r");
while ($fd && !feof($fd))
	$ret[] = fgets($fd);
echo json_encode($ret);
fclose($fd);
?>
