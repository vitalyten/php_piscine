<?php
if ($_POST["submit"] === "OK")
{
	if ($_POST["login"] != "" && $_POST["passwd"] != "")
	{
		$user["login"] = $_POST["login"];
		$user["passwd"] = hash("whirlpool", $_POST["passwd"]);
		if (!file_exists("../private"))
			mkdir("../private");
		if (file_exists("../private/passwd"))
		{
			$tab = unserialize(file_get_contents("../private/passwd"));
			foreach ($tab as $val)
			{
				if ($user["login"] === $val["login"])
				{
					echo "ERROR\n";
					return ;
				}
			}
		}
		$tab[] = $user;
		file_put_contents("../private/passwd", serialize($tab));
		echo "OK\n";
	}
	else
		echo "ERROR\n";
}
?>
