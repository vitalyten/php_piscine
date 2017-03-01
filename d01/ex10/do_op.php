#!/usr/bin/php
<?php
if ($argc == 4)
{
	$str = $argv[1] . $argv[2] . $argv[3];
	eval("echo $str;");
	echo "\n";
}
?>
