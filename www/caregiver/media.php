<?php
/*

Project Emotional Trainer
Created by Chameleon Designs
Moinak Bandyopadhyay, Jessica Blair, Kevin Jones, Mudit Manu Paliwal and Jacob Solomon.

Filename: media.php
Description: This file contains the code for the media page. A caregiver can use this page to look at the media
associated with a child. It also has the options of adding and editing media for the child.

*/
?>

<?php include("../caregiver/include/sessionManagement.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- include the Tools -->
	<script src="jquery.tools.min.js"></script>
	<script src="jquery.colorbox.js"></script>
    <script type="text/javascript" src="highslide-with-gallery.js"></script>
    <link rel="stylesheet" type="text/css" href="highslide.css" />
    
    <script type="text/javascript">

	hs.graphicsDir = 'graphics/';
	hs.align = 'center';
	hs.transitions = ['expand', 'crossfade'];
	hs.outlineType = 'rounded-white';
	hs.fadeInOut = true;
	//hs.dimmingOpacity = 0.75;
	
	// Add the controlbar
	hs.addSlideshow({
		//slideshowGroup: 'group1',
		interval: 5000,
		repeat: false,
		useControls: true,
		fixedControls: 'fit',
		overlayOptions: {
			opacity: 0.75,
			position: 'bottom center',
			hideOnMouseOut: true
		}
	});
	</script>
    
    
    <script type="text/javascript">
	$(document).ready(function() {
	$('#load').hide();
	});
	
	$(function() {
	$(".delete").click(function() {
	$('#load').fadeIn();
	var commentContainer = $(this).parent();
	var id = $(this).attr("id");
	var string = 'id='+ id ;
		
	$.ajax({
	   type: "POST",
	 <?php
	 	 $db=mysql_connect('localhost','cs4911_Team46','rmkU1KxJ') or die("Could not connect to Emotional Trainer Database: ". 						mysql_error());
		mysql_select_db('cs4911_Team46');
		 $string = "SELECT ChildID from Child WHERE CaregiverID = '{$_COOKIE['CaregiverID']}';";
		 $anotherQuery = mysql_query($string);
		 $row = mysql_fetch_object($anotherQuery);
		 $childID = $row -> ChildID;
 	   echo "url: \"delete.php?child=$childID\", ";
	   
	   ?>  
	   data: string,
	   cache: false,
	   success: function(){
		commentContainer.slideUp('slow', function() {$(this).remove();});
		$('#load').fadeOut();
	  }
	   
	 });
	
	return false;
		});
	});
	</script>


	<style>
    .box {
        padding:3px;
        background-color:#dedede;
        margin:2px;
        
        border-bottom:2px solid #ccc;
        width:126px;
        float: left;
        
    }
    .box:hover{background-color:#ccc;}
    
    #load {
        position:absolute;
        left:225px;
        background-image:url(img/images/loading-bg.png);
        background-position:center;
        background-repeat:no-repeat;
        width:159px;
        color:#999;
        font-size:18px;
        font-family:Arial, Helvetica, sans-serif;
        height:40px;
        font-weight:300;
        padding-top:14px;
        top: 23px;
    }
    #container {
        position:relative;
        float: left;
        
    }
    .avatar {
        float:left;
    }
    
    .delete {
        float:right;
    }
    a.delete {
        padding:3px;
        text-align:center;
        font-size:18px;
        font-weight:700;
        text-decoration:none;
        color:#C00;
    }
    a.delete:hover {
        background-color:#900;
        color:#FFF;
    }
    .date {
        padding-top:10px;
        font-weight:700;
        color:#333;
        font-size:12px;
    }
    </style>
    

    <script type="text/javascript" src="highslide/highslide-with-gallery.js"></script>
    
    <link rel="stylesheet" href="colorbox.css" />
	<link href="indexStyle.css" rel="stylesheet" type="text/css" />

<title>Login - Emotional Trainer</title>



<!--[if lte IE 7]>
<style>
.content { margin-right: -1px; } /* this 1px negative margin can be placed on any of the columns in this layout with the same corrective effect. */
ul.nav a { zoom: 1; }  /* the zoom property gives IE the hasLayout trigger it needs to correct extra whiltespace between the links */
</style>
<![endif]-->

</head>

<body onload="tab();">

<div id="load" align="center"><img src="img/images/loading.gif" width="28" height="28" align="absmiddle"/> Loading...</div>

<div class="container">
  <div class="header">
  <?php include("../caregiver/include/header.php"); 
  $db=mysql_connect('localhost','cs4911_Team46','rmkU1KxJ') or die("Could not connect to Emotional Trainer Database: ". 						mysql_error());
	mysql_select_db('cs4911_Team46');
	 $string = "SELECT ChildID from Child WHERE CaregiverID = '{$_COOKIE['CaregiverID']}';";
	 $anotherQuery = mysql_query($string);
	 $row = mysql_fetch_object($anotherQuery);
	 $childID = $row -> ChildID;
  ?>
  	
  </div>
 
	<div class="content2">
                <!-- accordion -->
        <div id="accordionHor">
        
            <h2 class="current">Happiness</h2> 
            <div class="pane" style="display:block">
            
             <p align="center"> 
      			 <a href="#" class="myButton2">Edit Media</a>
                 <?php
      			 echo " <a href=\"addMedia.php?emotionID=1&child=$childID\" class=\"myButton2 iframe\">Add Media</a> ";
				 ?>
      		 </p>
                
             <?php
			 
			 	
				
                $string = "SELECT MediaID from ChildHasMedia WHERE ChildID = $childID;";
                $anotherQuery = mysql_query($string);
                
                if (!$anotherQuery) 
                {
                    echo 'Could not run Q query: ' . mysql_error();
                    exit;
                }
				
				$num=mysql_numrows($anotherQuery);
			 
			 	$i=0;
				$numTemp=0;

				while ($i < $num) {
					$medID = mysql_result($anotherQuery,$i,"MediaID");
					
					$string2 = "SELECT EmotionID from Media WHERE MediaID = $medID;";
					$query2 = mysql_query($string2);
					$emoID = (int) mysql_result($query2 ,$numTemp,"EmotionID");
					
					if ($emoID == 1){
						
						echo "
							<div class=\"box\">
							<a href=\"#\" id=\"$medID\"  class=\"delete\">x</a>				
							
							<a href=\"viewMedia.php?id=$medID\" class=\"highslide\" onclick=\"return hs.expand(this)\">
				
							<img src=\"viewMedia.php?id=$medID\"  width=120 height=120  alt=\"Highslide JS\"
				
							title=\"Click to enlarge\" />
				
							</a>			
							
							<div class=\"clear\"></div>
							</div>
						
						";				
					}
					$i++;
				}
			 
			 ?>
             <p> <br/> </p>
                
                
            </div>
            
            <h2>Sadness</h2>
            
            <div class="pane">
                <p align="center"> 
      			 <a  href="#" class="myButton2">Edit Media</a>
      			 <?php
      			 echo " <a href=\"addMedia.php?emotionID=2&child=$childID\" class=\"myButton2 iframe\">Add Media</a> ";
				 ?>
      		 	</p>
                
                <?php
			 
			 	
				
                $string = "SELECT MediaID from ChildHasMedia WHERE ChildID = $childID;";
                $anotherQuery = mysql_query($string);
                
                if (!$anotherQuery) 
                {
                    echo 'Could not run Q query: ' . mysql_error();
                    exit;
                }
				
				$num=mysql_numrows($anotherQuery);
			 
			 	$i=0;
				$numTemp=0;

				while ($i < $num) {
					$medID = mysql_result($anotherQuery,$i,"MediaID");
					
					$string2 = "SELECT EmotionID from Media WHERE MediaID = $medID;";
					$query2 = mysql_query($string2);
					$emoID = (int) mysql_result($query2 ,$numTemp,"EmotionID");
					
					if ($emoID == 2){
						
						echo "
							<div class=\"box\">
							<a href=\"#\" id=\"$medID\"  class=\"delete\">x</a>				
							
							<a href=\"viewMedia.php?id=$medID\" class=\"highslide\" onclick=\"return hs.expand(this)\">
				
							<img src=\"viewMedia.php?id=$medID\"  width=120 height=120  alt=\"Highslide JS\"
				
							title=\"Click to enlarge\" />
				
							</a>			
							
							<div class=\"clear\"></div>
							</div>
						
						";				
					}
					$i++;
				}
			 
			 ?>
                
            </div>
        
            <h2>Fear</h2>
            
            <div class="pane">
                <p align="center"> 
      			 <a href="#" class="myButton2">Edit Media</a>
      			 <?php
      			 echo " <a href=\"addMedia.php?emotionID=3&child=$childID\" class=\"myButton2 iframe\">Add Media</a> ";
				 ?>
      		 	</p>
                
                <?php
			 
			 	
				
                $string = "SELECT MediaID from ChildHasMedia WHERE ChildID = $childID;";
                $anotherQuery = mysql_query($string);
                
                if (!$anotherQuery) 
                {
                    echo 'Could not run Q query: ' . mysql_error();
                    exit;
                }
				
				$num=mysql_numrows($anotherQuery);
			 
			 	$i=0;
				$numTemp=0;

				while ($i < $num) {
					$medID = mysql_result($anotherQuery,$i,"MediaID");
					
					$string2 = "SELECT EmotionID from Media WHERE MediaID = $medID;";
					$query2 = mysql_query($string2);
					$emoID = (int) mysql_result($query2 ,$numTemp,"EmotionID");
					
					if ($emoID == 3){
						
						echo "
							<div class=\"box\">
							<a href=\"#\" id=\"$medID\"  class=\"delete\">x</a>				
							
							<a href=\"viewMedia.php?id=$medID\" class=\"highslide\" onclick=\"return hs.expand(this)\">
				
							<img src=\"viewMedia.php?id=$medID\"  width=120 height=120  alt=\"Highslide JS\"
				
							title=\"Click to enlarge\" />
				
							</a>			
							
							<div class=\"clear\"></div>
							</div>
						
						";				
					}
					$i++;
				}
			 
			 ?>
                
            </div>	
        	
            
            <h2>Anger</h2>
            
            <div class="pane">
                <p align="center"> 
      			 <a href="#" class="myButton2">Edit Media</a>
      			 <?php
      			 echo " <a href=\"addMedia.php?emotionID=4&child=$childID\" class=\"myButton2 iframe\">Add Media</a> ";
				 ?>
      		 	</p>
                
                <?php
			 
			 	
				
                $string = "SELECT MediaID from ChildHasMedia WHERE ChildID = $childID;";
                $anotherQuery = mysql_query($string);
                
                if (!$anotherQuery) 
                {
                    echo 'Could not run Q query: ' . mysql_error();
                    exit;
                }
				
				$num=mysql_numrows($anotherQuery);
			 
			 	$i=0;
				$numTemp=0;

				while ($i < $num) {
					$medID = mysql_result($anotherQuery,$i,"MediaID");
					
					$string2 = "SELECT EmotionID from Media WHERE MediaID = $medID;";
					$query2 = mysql_query($string2);
					$emoID = (int) mysql_result($query2 ,$numTemp,"EmotionID");
					
					if ($emoID == 4){
						
						echo "
							<div class=\"box\">
							<a href=\"#\" id=\"$medID\"  class=\"delete\">x</a>				
							
							<a href=\"viewMedia.php?id=$medID\" class=\"highslide\" onclick=\"return hs.expand(this)\">
				
							<img src=\"viewMedia.php?id=$medID\"  width=120 height=120  alt=\"Highslide JS\"
				
							title=\"Click to enlarge\" />
				
							</a>			
							
							<div class=\"clear\"></div>
							</div>
						
						";				
					}
					$i++;
				}
			 
			 ?>
                
            </div>	
            
        </div>
        
        <!-- activate tabs with JavaScript -->
        <script>
			$(function tab() { 
			
			$("#accordionHor").tabs("#accordionHor div.pane", {tabs: 'h2', effect: 'slide', initialIndex: null});
			});
			
        </script>
		
       <script>
			$(document).ready(function(){
				//Examples of how to assign the ColorBox event to elements
				$(".iframe").colorbox({iframe:true, width:"80%", height:"80%", 
					onClosed:function(){ location.reload(true); }});		
				
				
			});
		</script>
		

	</div>
  <div class="footer">
    <p></p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
</html>
