<?php
/*
Project Emotional Trainer
Created by Chameleon Designs
Moinak Bandyopadhyay, Jessica Blair, Kevin Jones, Mudit Manu Paliwal and Jacob Solomon.

Filename: addChildSubmit.php
Description: This file is run after a caregiver submits a reuqest to create a child account. It takes the input from the add
Child and creates a new entry in the Child database with the inputted data.
*/

?>

<?php include("../caregiver/include/sessionManagement.php"); ?>

<?php

/*simple checking of the data*/
if(isset($_POST['username']) && isset($_POST['password']))
{
	$name = $_POST['realName'];
	$day = $_POST['element_6_1'];
	$month = $_POST['element_6_2'];
	$year = $_POST['element_6_3'];
	$date = $year.'-'.$month.'-'.$day;
	
	/* Do necessary validations */

	/*Connection to database cs4911_Team46 using your login name and password*/
	$db=mysql_connect('localhost','cs4911_Team46','rmkU1KxJ') or die("Could not connect to Emotional Trainer Database: ". mysql_error());
	mysql_select_db('cs4911_Team46');

	$fileUpload = 0;
	//if the user has inserted a file into the form...
	if (isset($_FILES['element_7']) && $_FILES['element_7']['size'] > 0) 
	{ 
      $fileUpload = 1;
      // Temporary file name stored on the server
      $tmpName  = $_FILES['element_7']['tmp_name'];
	  
	  //get size of img
	  $info = getImageSize($tmpName);
	  $fileType =  mysql_real_escape_string($info['mime']);
      // Read the file 
      $fp      = fopen($tmpName, 'r');
      $data = fread($fp, filesize($tmpName));
      $data = addslashes($data);
      fclose($fp);
	}
	else
	{
		//initialize the data and filetype to null
		$data= NULL;
		$fileType= NULL;
	}
	if(! isset ($_COOKIE["CaregiverID"]))
	{
		echo 'Caregiver ID is is not set';
	}
	
	$string = "INSERT INTO Child (CaregiverID, Username, Password,Name,DOB,AutisticSpec,Picture,imgType) VALUES ('{$_COOKIE['CaregiverID']}','{$_POST['username']}',SHA1('{$_POST['password']}'),'$name','$date','{$_POST['autismClassification']}','$data', '$fileType');";
	
	$query = mysql_query( $string);
	

	if (!$query) 
	{
		echo $string;
		echo '<br />';
		echo $_COOKIE["CaregiverID"];
		echo '<br />';
		if(! isset ($_COOKIE["CaregiverID"]))
		{
			echo 'It is not set';
		}
	
		echo 'Could not run insert query: ' . mysql_error();
		exit;
	}

	if(mysql_affected_rows()>0)
	{
		$result = $realName.'added';
		header("Location: caregiverHomepage.php");
		echo $result;
	}
	else
	{
		$result = 'Sorry, try again ' ;
		echo $result;
	}


	mysql_close($db);

}

?>