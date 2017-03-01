#!/usr/bin/php
<?PHP
while (42)
{
	echo "Enter a number: ";
	if ($n = fgets(STDIN))
	{
		$n = rtrim($n);
		if (!is_numeric($n))
			echo "'$n' is not a number\n";
		else if ($n % 2 == 0)
			echo "The number $n is even\n";
		else
			echo "The number $n is odd\n";
	}
	else
	{
		echo "\n";
		return ;
	}
}
?>
