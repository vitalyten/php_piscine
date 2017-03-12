<?php
session_start();
if (isset($_POST["buy"]))
{
	if ($_SESSION["cart"] && file_exists("./private/user"))
	{
		$user = unserialize(file_get_contents("./private/user"));
		for ($i = 0; $i < count($user); $i++)
			if ($_SESSION["loggued_on_user"] === $user[$i]["email"])
			{
				$user[$i]["orders"][] = $_SESSION["cart"];
				unset($_SESSION["cart"]);
				file_put_contents("./private/user", serialize($user));
				header("Location: index.php");
				exit();
			}
	}
}
if (isset($_POST["clear"]))
{
	unset($_SESSION["cart"]);
	header("Location: index.php");
	exit();
}
header("Location: error.php");
	exit();
?>