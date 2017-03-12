<?php
class Tyrion extends Lannister
{
	public function sleepWith($person)
	{
		if ($person instanceof Lannister)
			echo "Not even if I'm drunk !\n";
		else
			echo "Let's do this.\n";
	}
}
?>
