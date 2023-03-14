<?php
	$user = "root";
	$pass = "";
	$data   = "lesson-study.local";

	$db = mysql_connect("localhost", $user, $pass, $data);

	mysql_select_db($data, $db);
	mysql_set_charset("utf8");
?>