#!/usr/bin/php
<?php
	date_default_timezone_set("America/Los_Angeles");
	$fd = fopen("/var/run/utmpx", "r");
	while ($line = fread($fd, 628))
	{
		$data = unpack("a256user/a4id/a32line/ipid/itype/I2time/a256host/i16pad", $line);
		$tab[$data["type"]] = $data;
		ksort($tab);
		foreach ($tab as $val)
		{
			if ($val["type"] == 7)
			{
				echo $val["user"] . " ";
				echo $val["line"] . "  ";
				echo date("M  j H:i", $val["time1"]) . "\n";
			}
		}
	}
?>
