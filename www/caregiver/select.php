<?php 
/*

Project Emotional Trainer
Created by Chameleon Designs
Moinak Bandyopadhyay, Jessica Blair, Kevin Jones, Mudit Manu Paliwal and Jacob Solomon.

Filename: select.php
Description: This page contains the code to select images.

*/
	 $db=mysql_connect('localhost','cs4911_Team46','rmkU1KxJ') or die("Could not connect to Emotional Trainer Database: ". 						mysql_error());
	mysql_select_db('cs4911_Team46');
	
	
	
	$medIDs = $_POST;
	$values = $medIDs['fcbklist_values'];
	$childID = (int) $_GET['child'];
	
		
	/* Use tab and newline as tokenizing characters as well  */
	$tok =  strtok($values, ":,{}\"");
	
	while ($tok !== false) {
		if (is_numeric($tok)){
			$id = (int) $tok;
			
			$query2 = sprintf(
				"insert into ChildHasMedia (ChildID, MediaID)
					values ('%d', '%d')",
				$childID, $id			
			);		
			mysql_query($query2, $db);
					
		}
		$tok = strtok(":,{}\"");
	}
	
	   // finally, redirect the user to view the new image
        header('Location: redirect.html');
        exit;
?>