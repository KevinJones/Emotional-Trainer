/*

Project Emotional Trainer
Created by Chameleon Designs
Moinak Bandyopadhyay, Jessica Blair, Kevin Jones, Mudit Manu Paliwal and Jacob Solomon.

Filename: sessionManagement.php
Description: This file contains the code for session Management.

*/

<?php
session_start();

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