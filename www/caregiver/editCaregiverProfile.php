<?php
/*
Project Emotional Trainer
Created by Chameleon Designs
Moinak Bandyopadhyay, Jessica Blair, Kevin Jones, Mudit Manu Paliwal and Jacob Solomon.

Filename: editCaregiverProfile.php
Description: This page allows a caregiver to edit their profile.

*/

include("../caregiver/include/sessionManagement.php"); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8; NO-CACHE"/>
<title>Edit Profile - Emotional Trainer</title>
<link href="registerStyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="view.js"></script>
<script type="text/javascript" src="calendar.js"></script>
<SCRIPT language="JavaScript" SRC="caregiver.js"></SCRIPT>
<script language="JavaScript" src="validation.js"></script>
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
    <div class="form_description"><p><big><u>Edit your profile</u></big><br><small>Please fill out the following form to create a new child profile. <br>Fields with an asterisk (*) are required.</small></p>
    </div>
</td>

<td>
<p align="right">&nbsp;</p></td>
</tr>
</table>


<form id="registerForm" class="appnitro" enctype="multipart/form-data" method="post" action="editCaregiverProfileSubmit.php" onSubmit="return ValidateEditCaregiverProfile()">

<ul>
<li id="li_3" >
    <label class="description" for="element_3">Name </label>
		<span>
			<input id="name" name= "name" class="element text" maxlength="255" size="24" value="<?php 
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
			?>"/>
		</span>
		</li>	
		
		<li id="li_5" >
		<label class="description" for="email">* Email </label>
		<div>
			<input id="email" name="email" class="element text medium" type="text" maxlength="255" 
			value="<?php  //echo $_SESSION['Email']; 
			$db=mysql_connect('localhost','cs4911_Team46','rmkU1KxJ') or die("Could not connect to Emotional Trainer Database: ". mysql_error());
			mysql_select_db('cs4911_Team46');
			$string = "SELECT Email from Caregiver WHERE CaregiverID = '{$_COOKIE["CaregiverID"]}';";
			$childSelectionResource = mysql_query($string);
			
			if (!$childSelectionResource) 
			{
				echo 'Could not retrieve a child selection resource: ' . mysql_error();
				exit;
			}
			
			if(mysql_num_rows($childSelectionResource)> 0)
			{
				$row = mysql_fetch_object($childSelectionResource);
				echo $row->Email;
			} 
			
			
			
			?>"/> 
		</div><p class="guidelines" id="guide_5"><small>Input your email address. Please make sure this address one you're able to check, since we may need it to contact you.</small></p> 
		</li>
		
		
		
		<li id="li_2" >
		<label class="description" for="password">* Password </label>
		<div>
			<input id="password" name="password" class="element text small" type="password" maxlength="255" value=""/> 
		</div><p class="guidelines" id="guide_2"><small>Passwords must be at least 6 characters long, and may use letters, numbers, and special characters like !@#$%^&*.</small></p> 
		</li>		<li id="li_4" >
		<label class="description" for="confirmPass">* Confirm Password </label>
		<div>
			<input id="confirmPass" name="confirmPass" class="element text small" type="password" maxlength="255" value=""/> 
		</div> 
		</li>		
		<li id="li_5.5"><i>
		Your current date of birth is : <?php  
			$db=mysql_connect('localhost','cs4911_Team46','rmkU1KxJ') or die("Could not connect to Emotional Trainer Database: ". mysql_error());
			mysql_select_db('cs4911_Team46');
			$string = "SELECT DOB from Caregiver WHERE CaregiverID = '{$_COOKIE["CaregiverID"]}';";
			$childSelectionResource = mysql_query($string);
			
			if (!$childSelectionResource) 
			{
				echo 'Could not retrieve a child selection resource: ' . mysql_error();
				exit;
			}
			
			if(mysql_num_rows($childSelectionResource)> 0)
			{
				$row = mysql_fetch_object($childSelectionResource);
				echo $row->DOB;
			} 
			?>		
		<br />
		If you would like to change it, please re-enter below.</i>
		<br />
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
	</li>	
        
<li id="li_7" >
<label class="description" for="element_7">Upload a Picture </label>
<div>
<input id="element_7" name="element_7" class="element file" type="file" /> 
</div> <p class="guidelines" id="guide_7"><small>Upload a picture for your profile.</small></p> 
</li>

<p>&nbsp;</p>

<li id="li_8" >
<label class="description" for="element_8">Terms and Conditions Consent </label>
<span>
<input id="termsConsent" name="termsConsent" class="element checkbox" type="checkbox" value="1" 

<?php session_start(); 
if( $_SESSION['TermsConsent'] ==1)
 ?> checked="yes"
/>
<label class="choice" for="termsConsent">* I consent to the Terms and Conditions</label>
<input id="emailConsent" name="emailConsent" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="emailConsent">I consent to be contacted via Email</label>
</span> 
</li>	
			
<li class="buttons">
<input type="hidden" name="form_id" value="268084" />
			    
<p align="right"><input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
<INPUT TYPE="BUTTON" VALUE="Cancel" ONCLICK="window.location.href='../caregiver/caregiverHomepage.php'">   
</p>  
</li>
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