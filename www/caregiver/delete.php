<?php
/*

Project Emotional Trainer
Created by Chameleon Designs
Moinak Bandyopadhyay, Jessica Blair, Kevin Jones, Mudit Manu Paliwal and Jacob Solomon.

Filename: delete.php
Description: This file contains code to delete images.

*/
	 $db=mysql_connect('localhost','cs4911_Team46','rmkU1KxJ') or die("Could not connect to Emotional Trainer Database: ". 						mysql_error());
	mysql_select_db('cs4911_Team46');

	$medID = $_POST['id'];
	$childID = (int) $_GET['child'];;
	
	$string = "DELETE FROM ChildHasMedia WHERE ChildID=$childID AND MediaID=$medID";
	$string2 = "DELETE FROM Media WHERE MediaID=$medID AND TypeID=2";
	$anotherQuery = mysql_query($string);
    $anotherQuery2 = mysql_query($string2);            
	if (!$anotherQuery) 
    {
    	echo 'Could not run Q query: ' . mysql_error();
        exit;
    }

?>