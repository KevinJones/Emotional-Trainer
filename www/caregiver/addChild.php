<?php
/*
Project Emotional Trainer
Created by Chameleon Designs
Moinak Bandyopadhyay, Jessica Blair, Kevin Jones, Mudit Manu Paliwal and Jacob Solomon.

Filename: addChild.php
Description: This file defines the add child page on the Caregiver site. The caregiver can use this page to create a child account
associated with their account.
*/
?>

<?php include("../caregiver/include/sessionManagement.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add a Child - Emotional Trainer</title>
<link href="registerStyle.css" rel="stylesheet" type="text/css" />
<!--TODO: Do we need view.js and calendar.js? -->
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



<div class="content">
<table colspan="2">
<tr>
<td>
    <div class="form_description"><p><big><u>Add a new child</u></big><br><small>Please fill out the following form to create a new child profile. <br>Fields with an asterisk (*) are required.</small></p>
    </div>
</td>
</tr>
</table>
 
<form id="newChild" name="newChild" class="appnitro" method="post" enctype="multipart/form-data" action="addChildSubmit.php" onSubmit="return ValidateChildProfile()">
 
 
 <ul>
 <li id="li_1" >
 <label class="description" for="username">* Username </label><input id="username" name= "username" class="element text" maxlength="255" value=""/>
 <p class="guidelines" id="guide_5"><small>Input the username your child will use to log into Emotional Trainer. Usernames may include letters, numbers, and the underscore (_). They must be at least 4 characters long.</small></p> 
 </li>
	
 <li id="li_2" >
 <label class="description" for="password">* Password </label><input id="password" name= "password" class="element text" maxlength="255" type="password" value=""/>
 <p class="guidelines" id="guide_5"><small>Input a password for your child's account. Your child will need this to log in, so make sure to write it down some place safe in case they forget. Passwords may include any symbol on the keyboard, and must be at least 6 characters long.</small></p> 
 </li>		

 <li id="li_3" >
 <label class="description" for="confirmPass">* Confirm Password </label><input id="confirmPass" name= "confirmPass" class="element text" maxlength="255" type="password" value=""/>
 <p class="guidelines" id="guide_5"><small>Re-enter the password for confirmation.</small></p> 
 </li>
  
   <li id="li_3" >
 <label class="description" for="realName">Given Name</label><input id="realName" name= "realName" class="element text" maxlength="255" value=""/>
 <p class="guidelines" id="guide_5"><small>Enter your child's name.</small></p> 
 </li>
 <li id="li_6" >
		<label class="description" for="element_6">* Date of Birth </label>
		<span>
			<input id="element_6_1" name="element_6_1" class="element text" size="2" maxlength="2" value="" type="text"> /
			<label for="element_6_1">MM</label>
		</span>
		<span>
			<input id="element_6_2" name="element_6_2" class="element text" size="2" maxlength="2" value="" type="text"> /
			<label for="element_6_2">DD</label>
		</span>
		<span>
	 		<input id="element_6_3" name="element_6_3" class="element text" size="4" maxlength="4" value="" type="text">
			<label for="element_6_3">YYYY</label>
		</span>
	
		<span id="calendar_6">
			<img id="cal_img_6" class="datepicker" src="img/calendar.gif" alt="Pick a date.">	
		</span>
		<script type="text/javascript">
			Calendar.setup({
			inputField	 : "element_6_3",
			baseField    : "element_6",
			displayArea  : "calendar_6",
			button		 : "cal_img_6",
			ifFormat	 : "%B %e, %Y",
			onSelect	 : selectDate
			});
		</script>
		<p class="guidelines" id="guide_6"><small>Input your child's date of birth. Emotional Trainer is designed for use by children with autism between the ages of 4 and 8.</small></p> 
		</li>
 
 <li id="li_4" >
 <label class="description" for="autismClassification">Autism Classification</label>
<select name="autismClassification" id="autismClassification">
      <option value="0" selected="selected"></option>
      <option>Classic autism</option>
      <option>Asperger syndrome</option>
      <option value ="Retts Syndrome">Rett's Syndrome</option>
	  <option>Childhood Disintegrative Disorder</option>
	  <option>PDD-NOS</option>
	  <option>My child has not been diagnosed with any developmental disability.</option>
    </select>
 <p class="guidelines" id="guide_5"><small>Select the Autism Classification of the child.</small></p> 
 </li> 
<p>&nbsp;</p>
 <li id="li_5" >
		<label class="description" for="element_7">Upload a Picture </label>
		<div>
			<input id="element_7" name="element_7" class="element file" type="file"/> 
		</div> <p class="guidelines" id="guide_7"><small>Upload a picture for your child's profile.</small></p> 
</li>

<p>&nbsp;</p>
 <div>
 <p align="right"><input id="saveForm" class="button_text" type="submit" name="submit" value="Create Profile" />
     <INPUT TYPE="BUTTON" VALUE="Cancel" ONCLICK="window.location.href='../caregiver/caregiverHomepage.php'"></p>
 </div>
 </ul>
</form>

<img id="bottom" src="img/bottom.png" alt="">


    <!-- end .content --></div>
  <div class="footer">
<p>&nbsp;</p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>

</html>
