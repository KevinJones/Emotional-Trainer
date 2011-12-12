<?php
/*

Project Emotional Trainer
Created by Chameleon Designs
Moinak Bandyopadhyay, Jessica Blair, Kevin Jones, Mudit Manu Paliwal and Jacob Solomon.

Filename: delete.php
Description: This file contains code to delete images.

*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="refresh" 
content="5;URL=https://academic-php.cc.gatech.edu/groups/cs4911_Team46/caregiver/register.php">
<title>Duplicate Email - Please Re-Register</title>
<link href="registerStyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="view.js"></script>
<script type="text/javascript" src="calendar.js"></script>
<SCRIPT language="JavaScript" SRC="caregiver.js"></SCRIPT>
<script language="JavaScript" SRC="validation.js"></script>

</head>

<body>

<div class="container">
  <div class="header">
  <?php include("../caregiver/include/header.php"); ?>
  </div>
<br />
<?php

 



  
  echo 'The Email Address you have entered is already existent in our system. ';
  echo '<br />';
  echo 'Please click <a href="/groups/cs4911_Team46/caregiver/register.php">Register page </a> to go back and re-register with another email address.';
  echo '<br />You will be re-directed in 5 seconds.';
  
  
 // sleep(100000000);
  header("Refresh: 5; URL:https://academic-php.cc.gatech.edu/groups/cs4911_Team46/caregiver/register.php");


?>

  
</div>  
</body>

</html>
