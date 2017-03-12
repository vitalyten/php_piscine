<?php
session_start();
if ($_SESSION['loggued_on_user'] != "")
{
	if ($_POST['msg'])
	{
		if (!file_exists('../private/chat'))
			file_put_contents('../private/chat', null);
        $chat = unserialize(file_get_contents('../private/chat'));
		$fd = fopen('../private/chat', "w");
		flock($fd, LOCK_EX);
		$env['login'] = $_SESSION['loggued_on_user'];
		$env['time'] = time();
		$env['msg'] = $_POST['msg'];
		$chat[] = $env;
		file_put_contents('../private/chat', serialize($chat));
		fclose($fd);
	}
}
else
	echo "ERROR\n";
?>
<html>
<head>
	<script langage="javascript">top.frames['chat'].location = 'chat.php';</script>
</head>
<body>
	<form action="speak.php" method="POST">
		<input type="text" name="msg" value=""/>
		<input type="submit" name="submit" value="Send"/>
	</form>
    <a href="logout.php">log out</a>
</body>
