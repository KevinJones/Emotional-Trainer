<?php 
/*

Project Emotional Trainer
Created by Chameleon Designs
Moinak Bandyopadhyay, Jessica Blair, Kevin Jones, Mudit Manu Paliwal and Jacob Solomon.

Filename: login.php
Description: This page contains the code that validates a user login.
*/

session_start();
/*simple checking of the data*/
if(isset($_POST['email']) && isset($_POST['password']))
{
	
	if(isset($_SESSION['name']))
	{
		$host	= $_SERVER['HTTP_HOST'];
		$uri	= rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra	= 'caregiverHomepage.php';
		header("Location: http://$host$uri/$extra");
	}
	
	
	/*Connection to database cs4911_Team46 using your login name and password*/
	$db=mysql_connect('localhost','cs4911_Team46','rmkU1KxJ') or die("Could not connect to Emotional Trainer Database: ". mysql_error());
	mysql_select_db('cs4911_Team46');

	$password = mysql_query("SELECT SHA1('{$_POST['password']}');");
	if (!$password) {
		echo 'Could not run password query: ' . mysql_error();
		exit;
	}

	$realpassword2 = mysql_result($password,0);


	$q = mysql_query("SELECT * FROM Caregiver WHERE Email='{$_POST['email']}' AND Password=SHA1('{$_POST['password']}')");
	

	if (!$q) 
	{
		echo 'Could not run Q query: ' . mysql_error();
		exit;
	}


		
	
	if(mysql_num_rows($q)> 0)
	{
		
		
		$row = mysql_fetch_object($q);
		$_SESSION['name'] = $row ->Name;
		$_SESSION['DOB'] = $row ->DOB ;
		$_SESSION['Picture'] = $row ->Picture;
		$_SESSION['Email'] = $row -> Email;
		$_SESSION['TermsConsent'] = $row -> TermsConsent;
		$_SESSION['EmailConsent'] = $row -> EmailConsent;
		$_SESSION['CaregiverID'] = $row -> CaregiverID;
		$expire=time()+60*60*24*30;
		setcookie("CaregiverID", $row -> CaregiverID, $expire);
		/*Redirects to caregiver home */
		$host	= $_SERVER['HTTP_HOST'];
		$uri	= rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra	= 'caregiverHomepage.php';
		
		session_write_close();
		header("Location: http://$host$uri/$extra");
		exit();

	}
	else
	{
		$login = '<p>Wrong login or password.</p> <a href="index.php">Back</a>';
		echo $login;		
	}

	mysql_close($db);

}
else
{
	$hi1 = 'Login error: email or password not set.';

	echo $hi1;
	echo $_POST['email'];
	echo $_POST['password'];
}
?>