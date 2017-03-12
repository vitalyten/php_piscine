<?php
if ($_GET["action"] === "set")
{
	if ($_GET["name"] && $_GET["value"])
		setcookie($_GET["name"], $_GET["value"]);
}
if ($_GET["action"] === "get")
{
	if ($_GET["name"] && !$_GET["value"])
		if ($_COOKIE[$_GET["name"]])
			echo $_COOKIE[$_GET["name"]] . "\n";
}
if ($_GET["action"] === "del")
{
	if ($_GET["name"] && !$_GET["value"])
		setcookie($_GET["name"], "", time()-3600);
}
?>
