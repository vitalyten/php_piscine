#!/usr/bin/php
<?php

function ft_toupper($match)
{
	return (strtoupper($match[0]));
}

if ($argc != 2)
	return ;
$str = file_get_contents($argv[1]);
echo preg_replace_callback("/<a.*?\/a>/si", function($match)
	{
		return (preg_replace_callback("/(?<=title=\").*?\"|>.*?</si", 'ft_toupper', $match[0]));
	}, $str);
?>
