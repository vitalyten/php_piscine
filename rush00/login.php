<?php
session_start();

if (isset($_POST["submit"]))
{
	if ($_POST["email"] != "" && $_POST["passwd"] != "")
	{
		$email = strtolower($_POST["email"]);
		$_SESSION["loggued_on_user"] = "";
		if (file_exists("./private/user"))
		{
			$passwd = hash("whirlpool", $_POST["passwd"]);
			$tab = unserialize(file_get_contents("./private/user"));
			foreach ($tab as $user)
				if ($email === $user["email"] && $passwd === $user["passwd"] && !$user["banned"])
				{
					$_SESSION["loggued_on_user"] = $email;
					$_SESSION["fname"] = strtoupper($user["fname"]);
					$_SESSION["lname"] = strtoupper($user["lname"]);
					$_SESSION["admin"] = $user["admin"];
					if ($user["cart"] && !$_SESSION["cart"])
						$_SESSION["cart"] = $user["cart"];
					header("Location: index.php");
					exit();
				}
		}
	}
	header("Location: error.php");
	exit();
}
include("header.php");
?>
<div class="login">
	<div class="login-triangle"></div>
	<h2 class="login-header">Log in</h2>
	<form class="login-container" action="login.php" method="POST">
		<p><input type="email" placeholder="Email" name="email" value=""></p>
		<p><input type="password" placeholder="Password" name="passwd" value=""></p>
		<p><input type="submit" name="submit" value="log in"></p>
	</form>
</div>
<?php include("footer.php"); ?>
