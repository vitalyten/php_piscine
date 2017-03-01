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
if (count($spl) > 0)
	foreach ($spl as $val)
	{
		if (is_numeric($val[0]))
			$arrnum[] = $val;
		else if (ctype_alpha($val[0]))
			$arralph[] = $val;
		else
			$arrelse[] = $val;
	}
if (count($arrnum) > 0)
	sort($arrnum, SORT_STRING);
if (count($arralph) > 0)
	foreach ($arralph as $value)
		echo $value . "\n";
if (count($arrnum) > 0)
	foreach ($arrnum as $value)
		echo $value . "\n";
if (count($arrelse) > 0)
	foreach ($arrelse as $value)
		echo $value . "\n";
?>
