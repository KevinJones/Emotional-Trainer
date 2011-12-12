<?php
/*
Project Emotional Trainer
Created by Chameleon Designs
Moinak Bandyopadhyay, Jessica Blair, Kevin Jones, Mudit Manu Paliwal and Jacob Solomon.

Filename: childProfile.php
Description: This page defines the child profile that a caregiver sees for a particular child. It gives the caregiver options to edit the child's
profile and manage the child's media settings. the caregiver can also track the child's performance on this page.
*/
?>

<?php include("../caregiver/include/sessionManagement.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <SCRIPT language="JavaScript" SRC="caregiver.js"></SCRIPT>
    <script src="jquery.tools.min.js"></script>
    
    <title>Child Profile - Emotional Trainer</title>
    <link href="indexStyle.css" rel="stylesheet" type="text/css" />
    </head>
    
    <body>
    <div class="container">
    <div class="header">
    
     <?php include("../caregiver/include/header.php"); ?>
      <p align="center"> 
       <a href="media.php" class="myButton">Manage Media</a>
       <a href="editChildProfile.php" class="myButton">Edit Child Profile</a> 
      </p>
        <!-- end .header --></div>
   
	<div class="content2">
                <!-- accordion -->
        <div id="accordionHor">
        
            <h2 class="current">Child Profile</h2>             
            <div class="pane" style="display:block">
            	
                <?php
            
                $db=mysql_connect('localhost','cs4911_Team46','rmkU1KxJ') or die("Could not connect to Emotional Trainer Database: ". mysql_error());
                mysql_select_db('cs4911_Team46');
                $string = "SELECT ChildID, Name, DOB, AutisticSpec, Picture from Child WHERE CaregiverID = '{$_COOKIE['CaregiverID']}';";
                $anotherQuery = mysql_query($string);
                
                if (!$anotherQuery) 
                {
                    echo 'Could not run Q query: ' . mysql_error();
                    exit;
                }
                
                if(mysql_num_rows($anotherQuery)> 0)
                {
                    $row = mysql_fetch_object($anotherQuery);
					$childID = $row -> ChildID;
					$childName = $row -> Name;
					$childDOB = $row -> DOB;
					$childSpec = $row -> AutisticSpec;
					
                    echo "
						<p> <img src=\"viewChildProfilePic.php?id=$childID\"  width=120 height=120 align=\"left\" alt=\"Child Picture\" </p>                    	
						<p><b> <font size=5px> $childName </b> </font></p>
                   		<br/>
						<p><font size=3px> Date of Birth:  $childDOB</font></p>
						<p><font size=3px> Autistic Specification: $childSpec </font></p>
					"
					;
                    
                }
                
                else
                {
                    echo 'You have no children added as of now.';
                }
                ?>		
         
                
                
                
            </div>
            
            <h2>Recent Activity</h2>
            
            <div class="pane">
         
         
            </div>
        
            <h2>Child Performance Tracker</h2>
            
            <div class="pane">
     
     
                
            </div>	
        	
           
            
        </div>
      
        <!-- activate tabs with JavaScript -->
        <script>
			$(function tab() { 
			
			$("#accordionHor").tabs("#accordionHor div.pane", {tabs: 'h2', effect: 'slide', initialIndex: null});
			});
			
        </script>

    </div>
    
    <div class="footer">
    <p></p>
    </div>
    
    </div>
    </body>
    
</html>