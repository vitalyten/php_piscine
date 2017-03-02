#!/usr/bin/php
<?php
function matchday($day)
{
	if (preg_match("/^[Ll]undi$/", $day) ||
		preg_match("/^[Mm]ardi$/", $day) ||
		preg_match("/^[Mm]ercredi$/", $day) ||
		preg_match("/^[Jj]eudi$/", $day) ||
		preg_match("/^[Vv]endredi$/", $day) ||
		preg_match("/^[Ss]amedi$/", $day)||
		preg_match("/^[Dd]imanche$/", $day))
		return (1);
	return (0);
}

function matchmonth($mon)
{
	if (preg_match("/^[Jj]anvier$/", $mon))
		return (1);
	if (preg_match("/^[Ff]evrier$/", $mon))
		return (2);
	if (preg_match("/^[Mm]ars$/", $mon))
		return (3);
	if (preg_match("/^[Aa]vril$/", $mon))
		return (4);
	if (preg_match("/^[Mm]ai$/", $mon))
		return (5);
	if (preg_match("/^[Jj]uin$/", $mon))
		return (6);
	if (preg_match("/^[Jj]uillet$/", $mon))
		return (7);
	if (preg_match("/^[Aa]out$/", $mon))
		return (8);
	if (preg_match("/^[Ss]eptembre$/", $mon))
		return (9);
	if (preg_match("/^[Oo]ctobre$/", $mon))
		return (10);
	if (preg_match("/^[Nn]ovembre$/", $mon))
		return (11);
	if (preg_match("/^[Dd]ecembre$/", $mon))
		return (12);
	return (0);

}

if ($argc != 2)
	return ;
$arr = explode(" ", $argv[1]);
if (count($arr) != 5)
	exit("Wrong Format\n");
if (!matchday($arr[0]) ||
	!($month = matchmonth($arr[2])) ||
	!preg_match("/^([0-9]|[0-2][0-9]|3[01])$/", $arr[1]) ||
	!preg_match("/^[0-9]{4}$/", $arr[3]) ||
	!preg_match("/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/", $arr[4]))
	exit("Wrong Format\n");
date_default_timezone_set("America/Los_Angeles");
$time = strtotime("$arr[1]-$month-$arr[3] $arr[4]");
echo $time . "\n";
?>
