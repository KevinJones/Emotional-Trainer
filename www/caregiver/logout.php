<?php
/*

Project Emotional Trainer
Created by Chameleon Designs
Moinak Bandyopadhyay, Jessica Blair, Kevin Jones, Mudit Manu Paliwal and Jacob Solomon.

Filename: logout.php
Description: This file contains the code to logout a user.

*/

session_start();
/*
if(isset($_SESSION['name']))
{
unset $_SESSION['name'];
}
if(isset($_SESSION['DOB'] ))
{
unset $_SESSION['DOB'];
}
if(isset($_SESSION['Picture']))
{
unset $_SESSION['Picture'];
}
if(isset($_SESSION['Email']))
{
unset $_SESSION['Email'];
}
*/
session_destroy();
setcookie("CaregiverID", "", time()-3600);
setcookie("ChildID", "", time()-3600);
header("Location: index.php");
?>