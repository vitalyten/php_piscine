#!/usr/bin/php
<?php

if ($argc == 2)
{
	$str = trim($argv[1]);
	$spl = explode(" ", $str);
	$spl = array_filter($spl);
	$str = implode(" ", $spl);
	echo $str."\n";
}
?>
