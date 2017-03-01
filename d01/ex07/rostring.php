#!/usr/bin/php
<?php
function ft_split($str)
{
	if (!$str)
		return (NULL);
	$spl = explode(" ", $str);
	$clean = array_filter($spl);
	return ($clean);
}

if ($argc > 1)
{
	$arr = ft_split($argv[1]);
	$first = array_shift($arr);
	array_push($arr, $first);
	$str = implode(" ", $arr);
	echo $str . "\n";
}
?>
