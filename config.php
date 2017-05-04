<?php

	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = 'password';
	$dbname = 'crud050217';

	$link = @mysql_connect($dbhost, $dbuser, $dbpass) or die('Could not connect: ' . @mysql_error());
	@mysql_select_db($dbname, $link) or die('Could not select database');
	
?>