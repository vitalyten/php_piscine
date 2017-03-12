<?php
if ($_POST["submit"] === "OK")
{
	if ($_POST["login"] != "" && $_POST["oldpw"] != "" && $_POST["newpw"] != "")
	{
		$login = $_POST["login"];
		$oldpw = hash("whirlpool", $_POST["oldpw"]);
		if (file_exists("../private/passwd"))
		{
			$tab = unserialize(file_get_contents("../private/passwd"));
			foreach ($tab as $i => $val)
			{
				if ($login === $val["login"] && $oldpw === $val["passwd"])
				{
					$tab[$i]["passwd"] = hash("whirlpool", $_POST["newpw"]);
					file_put_contents("../private/passwd", serialize($tab));
					echo "OK\n";
					// header("Location: index.html");
					// exit();
				}
			}
		}
	}
	echo "ERROR\n";
}
?>
