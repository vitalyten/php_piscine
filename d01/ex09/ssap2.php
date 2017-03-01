#!/usr/bin/php
<?php
function ft_split($str)
{
	if (!$str)
		return (NULL);
	$spl = explode(" ", $str);
	$clean = array_filter($spl);
	natcasesort($clean);
	return ($clean);
}

$i = 0;
while (++$i < $argc)
	$str .= " " . $argv[$i];
$spl = ft_split($str);
foreach ($spl as $val)
{
	if (is_numeric($val[0]))
		$arrnum[] = $val;
	else if (ctype_alpha($val[0]))
		$arralph[] = $val;
	else
		$arrelse[] = $val;
}
sort($arrnum, SORT_STRING);
foreach ($arralph as $value)
	echo $value . "\n";
foreach ($arrnum as $value)
	echo $value . "\n";
foreach ($arrelse as $value)
	echo $value . "\n";
?>
