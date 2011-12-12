<?php
/*

Project Emotional Trainer
Created by Chameleon Designs
Moinak Bandyopadhyay, Jessica Blair, Kevin Jones, Mudit Manu Paliwal and Jacob Solomon.

Filename: globals.php
Description: This file contains the code to connect with the Emotional Trainer database.

*/

    $db = mysql_connect('localhost','cs4911_Team46','rmkU1KxJ') or die("Could not connect to Emotional Trainer Database: ". mysql_error());
	mysql_select_db('cs4911_Team46');
 
?>
