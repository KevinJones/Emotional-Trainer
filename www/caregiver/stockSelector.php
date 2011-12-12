
<?php
/*


Project Emotional Trainer
Created by Chameleon Designs
Moinak Bandyopadhyay, Jessica Blair, Kevin Jones, Mudit Manu Paliwal and Jacob Solomon.

Filename: stockSelector.php
Description: This file contains the code to associate stock images with a child.
*/

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>Stock Image Selector</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link type="text/css" rel="stylesheet" href="fcbklistselection.css" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="fcbklistselection.min.js"></script>
</head>
<body>


 
        <?php
          					$db=mysql_connect('localhost','cs4911_Team46','rmkU1KxJ') or die("Could not connect to Emotional Trainer Database: ". 						mysql_error());
                                mysql_select_db('cs4911_Team46');
								$emotionID = (int) $_GET['emotionID'];
								$childID = (int) $_GET['child'];
                                
                                 $string = "SELECT MediaID from Media WHERE EmotionID = $emotionID AND TypeID = 1;";
                                $anotherQuery = mysql_query($string);
                                
                                if (!$anotherQuery) 
                                {
                                    echo 'Could not run Q query: ' . mysql_error();
                                    exit;
                                }
                                
                   
				   
                   
                      echo " <form action=\"select.php?child=$childID\" method=\"post\"> ";
					  
				?>
    				   <ul id="fcbklist">
				   
				  <?php
				                $num=mysql_numrows($anotherQuery);
								
							
							$i=0;
                            while ($i < $num) {
                                $medID = mysql_result($anotherQuery,$i,"MediaID");
			
            
                                
                                echo "
                                    <li>
                                
                                 
                                        <p align=\"center\"> <img src=\"viewMedia.php?id=$medID\"  width=120 height=120  alt=\"Image\" align=\"middle\"> </p>
                                        <input type=\"hidden\" name=\"fcbklist_value[]\" value=\"$medID\" /> 
                                         
                                    </li>						
                                 ";
                                
                                $i++;	
                            }

                             ?>
                           
		
    </ul>
    <input type="submit" value="Submit" />
</form>
<script type="text/javascript" language="JavaScript">
    $(document).ready(function() {
      //id(ul id),width,height(element height),row(elements in row)        
      $.fcbkListSelection("#fcbklist","700","140","5");
    });    
</script>
</body>
</html>