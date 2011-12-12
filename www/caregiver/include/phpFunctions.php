/*

Project Emotional Trainer
Created by Chameleon Designs
Moinak Bandyopadhyay, Jessica Blair, Kevin Jones, Mudit Manu Paliwal and Jacob Solomon.

Filename: phpFunctions.php
Description: This file contains php functions.

*/

<?php
session_start();
/*This is the file to check whether the email address that a new user wants to register with, is already in the database.*/

function connectDB()
{
	/*Connection to database cs4911_Team46 using your login name and password*/
	$db=mysql_connect('localhost','cs4911_Team46','rmkU1KxJ') or die("Could not connect to Emotional Trainer Database: ". mysql_error());
	mysql_select_db('cs4911_Team46');	
	return $db;
}

function checkEmail($Email)
{   
	$query1 = mysql_query("SELECT * FROM Caregiver where Email= '$Email'");
	if(mysql_affected_rows() <= 0)

	{
		$duplicate = 0;
		print("Email is good<br>\n");
	}
	else
	{
		$duplicate = 1;
		print("Duplicate Email Address. Please enter a unique email address.<br>\n");
		echo 'Duplicate Email Address. Please enter a unique email address.';
		header("Location: register.php");
	} 
	return($duplicate);
}
?>