<?php

/*

Project Emotional Trainer
Created by Chameleon Designs
Moinak Bandyopadhyay, Jessica Blair, Kevin Jones, Mudit Manu Paliwal and Jacob Solomon.

Filename: registerSubmit.php
Description: This page contains the code that submits the user input from the register form and creates a new caregiver account.

*/
session_start();

/*simple checking of the data*/
if(isset($_POST['email']) && isset($_POST['password']))
{
	$name = $_POST['name'];
	$day = $_POST['element_6_1'];
	$month = $_POST['element_6_2'];
	$year = $_POST['element_6_3'];
	$date = $year.'-'.$month.'-'.$day;
	$data =0;
	/* Do necessary validations */

	/*Connection to database cs4911_Team46 using your login name and password*/
	$db=mysql_connect('localhost','cs4911_Team46','rmkU1KxJ') or die("Could not connect to Emotional Trainer Database: ". mysql_error());
	mysql_select_db('cs4911_Team46');
	
	
	if (isset($_FILES['element_7']) && $_FILES['element_7']['size'] > 0) 
	{ 
	
      // Temporary file name stored on the server
      $tmpName  = $_FILES['element_7']['tmp_name'];  
      // Read the file 
      $fp      = fopen($tmpName, 'r');
      $data = fread($fp, filesize($tmpName));
      $data = addslashes($data);
      fclose($fp);
      // Print results
      print "Thank you, your file has been uploaded.";
      
	}

	$duplicate = 0;
	$query1 = mysql_query("SELECT * FROM Caregiver where Email= '{$_POST['email']}'");
	if(!$query1)
	{
			echo mysql_error();
			exit;
			//header("Location: register.php");

	}
	
	
	if(mysql_affected_rows()<=0)
	{
		$duplicate =0;
		print("Email is good<br>\n");
	}
	else
	{
		$duplicate =1;
		print("Duplicate Email Address. Please enter a unique email address.<br>\n");
		echo 'Duplicate Email Address. Please enter a unique email address.';
		header("Location: duplicateEmail.php");
	} 

	
	$query = mysql_query("INSERT INTO Caregiver (Email,Password,Name,DOB,TermsConsent,EmailConsent,Picture) VALUES ('{$_POST['email']}',SHA1('{$_POST['password']}'),'$name','$date','{$_POST['termsConsent']}','{$_POST['emailConsent']}','$data');" );

	if($duplicate ==0)
	{
			if (!$query) 
			{
				echo 'Could not run insert query: ' . mysql_error();
				header("Location: duplicateEmail.php");
				exit;
			}

			if(mysql_affected_rows()>0 )
			{
				$_SESSION['name'] = $name;
				$_SESSION['DOB'] = $date ;
				$_SESSION['Picture'] = $data;
				$_SESSION['Email'] = $_POST['email'];
				
				$string = "SELECT CaregiverID from Caregiver WHERE Email = '{$_POST['email']}';";
				$childSelectionResource = mysql_query($string);
					
				if (!$childSelectionResource) 
				{
					echo 'Could not retrieve a child selection resource: ' . mysql_error();
					exit;
				}
					
				if(mysql_num_rows($childSelectionResource)> 0)
				{
					$row = mysql_fetch_object($childSelectionResource);
					$expire=time()+60*60*24*30;
					setcookie("CaregiverID", $row -> CaregiverID, $expire);
				} 
				
				header("Location: caregiverHomepage.php");
			}
			else
			{
				print "Email already exists in system.";
				$result = 'Sorry, try again ' ;
				header("Location: duplicateEmail.php");

				echo $result;
			}


			mysql_close($db);
	}
	
	else
	{
	header("Location: duplicateEmail.php");
	}
	
}
else
{
echo 'Not set';
header("Location: index.php");

}
?>