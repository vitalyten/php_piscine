#!/usr/bin/php
<?php
function ft_split($str)
{
	if (!$str)
		return (NULL);
	$spl = explode(" ", $str);
	$clean = array_filter($spl);
	sort($clean);
	return ($clean);
}

$i = 0;
while (++$i < $argc)
	$str .= " " . $argv[$i];
$spl = ft_split($str);
$i = -1;
while (++$i < count($spl))
	echo $spl[$i] . "\n";
?>
