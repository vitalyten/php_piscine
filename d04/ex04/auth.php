<?php
function auth($login, $passwd)
{
	if (file_exists("../private/passwd"))
	{
		$passwd = hash("whirlpool", $passwd);
		$tab = unserialize(file_get_contents("../private/passwd"));
		foreach ($tab as $val)
			if ($login === $val["login"] && $passwd === $val["passwd"])
				return (TRUE);
	}
	return (FALSE);
}
?>