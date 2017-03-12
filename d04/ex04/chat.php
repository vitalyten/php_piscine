<?php
session_start();
date_default_timezone_set('America/Los_Angeles');
if ($_SESSION['loggued_on_user'])
{
	if (file_exists('../private/chat'))
	{
		$chat = unserialize(file_get_contents('../private/chat'));
		foreach ($chat as $val) {
			echo "[".date('H:i', $val['time'])."] <b>".$val['login']."</b>: ".$val['msg']."<br />";
		}
	}
}
else
	echo "ERROR\n";
?>