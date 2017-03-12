<?php
$table = fopen('todo.csv','r');
$temp_table = fopen('todo_temp.csv','w');

while (($data = fgetcsv($table, 0, ";")) !== FALSE)
{
	if($data[0] === $_GET["id"])
		continue;
	fputcsv($temp_table, $data, ";");
}
fclose($table);
fclose($temp_table);
rename('todo_temp.csv', 'todo.csv');
?>
