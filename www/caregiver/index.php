
<?php

/*
Project Emotional Trainer
Created by Chameleon Designs
Moinak Bandyopadhyay, Jessica Blair, Kevin Jones, Mudit Manu Paliwal and Jacob Solomon.

Filename: index.php
Description: This page contains the landing page for the Emotional Trainer system. It provides information about the system and allows
users to login and register for a new account.

*/

session_start();
if(isset($_SESSION['name']))
	{
		$host	= $_SERVER['HTTP_HOST'];
		$uri	= rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra	= './caregiver/caregiverHomepage.php';
		header("Location: http://$host$uri/$extra");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<SCRIPT language="JavaScript" SRC="caregiver.js"></SCRIPT>
<SCRIPT language="JavaScript" SRC="validation.js"></SCRIPT>
<link href="indexStyle.css" rel="stylesheet" type="text/css" />
<title>Login - Emotional Trainer</title>

</head>

<body>

<div class="container">
  <div class="header"><img src="img/header.png" alt="Insert Logo Here" name="Insert_logo" width="500px" height="100px" id="Insert_logo" style="background: #F5F5DC; display:block;"/> 
    <!-- end .header --></div>
  <div class="sidebar1">
   <form method="post" action="login.php" onSubmit="return ValidateLogin()" name="loginForm" id="loginForm">
    <p> 
    
     </p>
  <p align="justify">
    <label for="email">Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
    <input type="text" name="email" id="email" />
  </p>
  <p align="justify">
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" />
   </p>
   <font size=3>
   <p>
    <input name="Login" type="submit" value="Login" />
   </p>
</form>
   <p>
    Not a Member?  <input name="Register" type="button" value="Register" onclick="window.location.href='register.php'"/>
  </p>
  </font>
  </div>
  <div class="content">

    <h1>Instructions</h1>
    <p align="justify">Emotional Trainer is an online tool designed to teach children with autism how to interpret emotions in facial expressions. Utilizing the principles of transference and cognitive association, Emotional Trainer helps children build on their existing knowledge to better understand what different emotions mean. It is currently being developed by Chameleon Designs as a computer science senior design project at the Georgia Institute of Technology.</p>
	<p> Click here to access the <a href="../child/index.html">Kids Emotional Trainer Site</a></p>
    <!-- end .content --></div>
  <div class="footer">
    <p>Emotional Trainer is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.</p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
</html>