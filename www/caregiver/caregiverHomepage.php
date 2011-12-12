<?php
/* 
Project Emotional Trainer
Created by Chameleon Designs
Moinak Bandyopadhyay, Jessica Blair, Kevin Jones, Mudit Manu Paliwal and Jacob Solomon.

Filename: caregiverHomepage.php
Description: This page contains the code for the Caregiver Homepage. This is the landing page that is reached when a caregiver
logs into the Emotional Trainer system.

*/

?>

<?php include("../caregiver/include/sessionManagement.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<SCRIPT language="JavaScript" SRC="caregiver.js"></SCRIPT>
<link href="indexStyle.css" rel="stylesheet" type="text/css" />
<title>Emotional Trainer</title>
</head>

<body>
<div class="container">
	  <div class="header">
  <?php include("../caregiver/include/header.php"); ?>

    <!-- end .header -->
    </div>
<p></p>
    <p align="center"> 
    	<a href="editCaregiverProfile.php" class="myButton">Edit my Profile</a>
     	<a href="addChild.php" class="myButton">Add Child</a> 
    </p>
   
    <div class="content">
	
    <?php 
	echo 'Welcome ';
	?>
	<b>
	<?php 
			$db=mysql_connect('localhost','cs4911_Team46','rmkU1KxJ') or die("Could not connect to Emotional Trainer Database: ". mysql_error());
			mysql_select_db('cs4911_Team46');
			$string = "SELECT Name from Caregiver WHERE CaregiverID = '{$_COOKIE["CaregiverID"]}';";
			$childSelectionResource = mysql_query($string);
			
			if (!$childSelectionResource) 
			{
				echo 'Could not retrieve a child selection resource: ' . mysql_error();
				exit;
			}
			
			if(mysql_num_rows($childSelectionResource)> 0)
			{
				$row = mysql_fetch_object($childSelectionResource);
				echo $row->Name;
			} 
			?>
	</b>
	<br />
	<br />
	
	<?php
	$db=mysql_connect('localhost','cs4911_Team46','rmkU1KxJ') or die("Could not connect to Emotional Trainer Database: ". mysql_error());
	mysql_select_db('cs4911_Team46');
	$string = "SELECT ChildID, Name, Picture, AutisticSpec from Child WHERE CaregiverID = '{$_COOKIE["CaregiverID"]}';";
	$childSelectionResource = mysql_query($string);
	
	if (!$childSelectionResource) 
	{
		echo 'Could not retrieve a child selection resource: ' . mysql_error();
		exit;
	}
	
	if(mysql_num_rows($childSelectionResource)> 0)
	{
		$row = mysql_fetch_object($childSelectionResource);
		$_SESSION['ChildID'] = $row ->ChildID;
		$_SESSION['ChildName'] = $row ->Name;
		$_SESSION['childPicture'] = $row ->Picture;
		$_SESSION['AutisticSpec'] = $row -> AutisticSpec;
		$expire=time()+60*60*24*30;
		setcookie("ChildID", $row -> ChildID, $expire);
		echo '<html>Go to <a href="childProfile.php">'.$row->Name.'</a>\'s profile </html>';
	}
	
	else
	{
	echo 'You have no children added as of now.';
	}
	
	?>

    <div align="left">
      <!-- end .homecontent -->    </div>
  </div>

  <div class="footer">
    <p></p>
  <!-- end .footer --></div>
<!-- end .container --></div>
</body>

</html>