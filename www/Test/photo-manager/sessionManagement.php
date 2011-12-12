<?php
session_start();
/*This is the Session management file. It is included in every page to make sure is the user is not logged in, the page cannot be accessed.*/

if(isset($_SESSION['name']))
{}
else
{
	$host	= $_SERVER['HTTP_HOST'];
	$uri	= rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra	= 'index.php';
	header("Location: http://$host$uri/$extra");
}
?>