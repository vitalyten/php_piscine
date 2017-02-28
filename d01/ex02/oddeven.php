#!/usr/bin/php
<?PHP
function isnum($str)
{
	$i = 0;
	$len = strlen($str);

	if ($len == 0)
		return (0);
	while ($i < $len)
	{
		if ($str[$i] > "9" || $str[$i] < "0")
			return (0);
		$i++;
	}
	return (1);
}

while (42)
{
	echo "Enter a number: ";
	$str = fgets(STDIN);
	if (!$str)
		return ;
	$str = trim($str);
	if (!isnum($str))
		echo "'$str' is not a number\n";
	else if ($str % 2 == 1)
		echo "The number $str is odd\n";
	else
		echo "The number $str is even\n";
}
?>
