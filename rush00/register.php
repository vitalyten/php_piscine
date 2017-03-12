<?php
session_start();
if (isset($_POST["submit"]))
{
	if ($_POST["fname"] != "" && $_POST["lname"] != "" && $_POST["email"] != "" && $_POST["passwd"] != "")
	{
		$user["fname"] = $_POST["fname"];
		$user["lname"] = $_POST["lname"];
		$user["email"] = strtolower($_POST["email"]);
		$user["passwd"] = hash("whirlpool", $_POST["passwd"]);
		$user["admin"] = 0;
		$user["banned"] = 0;
		$user["id"] = 0;
		if (!file_exists("./private"))
			mkdir("./private");
		if (file_exists("./private/user"))
		{
			$tab = unserialize(file_get_contents("./private/user"));
			foreach ($tab as $val)
			{
				$user["id"] = $val["id"] + 1;
				if ($user["email"] === $val["email"])
				{
					header("Location: error.php");
					exit();
				}
			}
		}
		$tab[] = $user;
		file_put_contents("./private/user", serialize($tab));
		header("Location: index.php");
		exit();
	}
	header("Location: error.php");
	exit();
}
include("header.php");
?>
<div class="login">
	<div class="login-triangle"></div>
	<h2 class="login-header">CREATE ACCOUNT</h2>
	<form class="login-container" action="register.php" method="POST">
		<p><input type="text" name="fname" placeholder="First Name" value=""></p>
		<p><input type="text" name="lname" placeholder="Last Name" value=""></p>
		<p><input type="email" name="email" placeholder="Email" value=""></p>
		<p><input type="password" name="passwd" placeholder="Password" value=""></p>
		<p><input type="submit" name="submit" value="Register"></p>
	</form>
</div>
<?php include("footer.php"); ?>
