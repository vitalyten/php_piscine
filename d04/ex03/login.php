<?php
session_start();
include("./auth.php");
if ($_GET["login"] != "" && $_GET["passwd"] != "")
{
	$_SESSION["loggued_on_user"] = "";
	if (auth($_GET["login"], $_GET["passwd"]))
	{
		$_SESSION["loggued_on_user"] = $_GET["login"];
		echo "OK\n";
		return ;
	}
}
echo "ERROR\n";
?>
