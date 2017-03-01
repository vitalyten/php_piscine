#!/usr/bin/php
<?PHP

function ft_split($str)
{
	if (!$str)
		return (NULL);
	$spl = explode(" ", $str);
	$clean = array_filter($spl);
	sort($clean);
	return ($clean);
}
?>
