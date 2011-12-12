<?php
/*

Project Emotional Trainer
Created by Chameleon Designs
Moinak Bandyopadhyay, Jessica Blair, Kevin Jones, Mudit Manu Paliwal and Jacob Solomon.

Filename: editChildProfileSubmit.php
Description: This file contains the php code that runs after a caregiver makes changes to a child's profile and clicks submit.
It duplicates the changes in the database.

*/

echo 'blah'.$_COOKIE["CaregiverID"].'whoa START </html>';
$caregiverID1 = 0;
$childID1 =0;
if (isset($_COOKIE["CaregiverID"]))
{
	//echo 'blah'.$_COOKIE["CaregiverID"].'whoa isset Cookie </html>';
	$caregiverID1 = $_COOKIE["CaregiverID"];
}

else 
{
echo 'blah'.$_COOKIE["CaregiverID"].'whoa2 </html>';
}

/*simple checking of the data*/
if(isset($_POST['username']))
{
	$username = $_POST['username'];
	$name = "";
	if (isset($_POST['realName']))
	{
		$name = $_POST['realName'];
	}
	$nameSize = strlen($name);
	
	/*Connection to database cs4911_Team46 using your login name and password*/
	$db=mysql_connect('localhost','cs4911_Team46','rmkU1KxJ') or die("Could not connect to Emotional Trainer Database: ". mysql_error());
	mysql_select_db('cs4911_Team46');
	
	$q = mysql_query("Select ChildID from Child where CaregiverID = '$caregiverID1';");
	if(mysql_affected_rows()>0)
	{
		$row = mysql_fetch_object($q);
		$expire=time()+60*60*24*30;
		setcookie("ChildID", $row -> ChildID, $expire);
		$childID1 = $_COOKIE["ChildID"];
	}
	else
	{
		$result = 'Sorry, try again ' ;
		echo $result;
	}
	
	
	if (isset($_FILES['element_7']) && $_FILES['element_7']['size'] > 0) 
	{ 
      // Temporary file name stored on the server
      $tmpName  = $_FILES['element_7']['tmp_name'];  
      // Read the file 
      $fp      = fopen($tmpName, 'r');
      $data = fread($fp, filesize($tmpName));
      $data = addslashes($data);
      fclose($fp);
	  
	  if($caregiverID1 > 0 )
		{
			$q = mysql_query("Select ChildID from Child where CaregiverID = '$caregiverID1';");
			if(mysql_affected_rows()>0)
			{
				$row = mysql_fetch_object($q);
				$expire=time()+60*60*24*30;
				setcookie("ChildID", $row -> ChildID, $expire);
				$childID1 = $_COOKIE["ChildID"];
			}
			else
			{
				$result = 'Sorry, try again ' ;
				echo $result;
			}
			
			
			$query = mysql_query("UPDATE Child SET Picture ='$data' where ChildID = '$childID1';");
			
			if(mysql_affected_rows()>0)
				{
					$_SESSION['Picture'] = $data ;
				}
				else
				{
					$result = 'Sorry, try again ' ;
					echo $result;
				}
			}
			
			if (empty($day) && empty ($month) && empty($year)) 
			{
				echo 'Could not run insert query: DATE ' . mysql_error();
				//exit;
			}
	  
	}
		
	if(isset($_POST['element_6_1']) && isset($_POST['element_6_2']) && isset($_POST['element_6_3']))
	{
		$day = $_POST['element_6_1'];
		$month = $_POST['element_6_2'];
		$year = $_POST['element_6_3'];
		$date = $year.'-'.$month.'-'.$day;
		
		if($caregiverID1 > 0 && !empty($day) && !empty ($month) && !empty($year))
		{
		$query = mysql_query("UPDATE Child SET DOB ='$date' where ChildID = '$childID1';");
			if(mysql_affected_rows()>0)
			{
				$_SESSION['DOB'] = $date ;
			}
			else
			{
				$result = 'Sorry, try again ' ;
				echo $result;
			}
		}
		
		if (empty($day) && empty ($month) && empty($year)) 
		{
			echo 'Could not run insert query: DATE ' . mysql_error();
			//exit;
		}
		
	}
	
	
	if(isset($_POST['realName']))
	{
		
		if($caregiverID1 >0)
		{
		$query = mysql_query("UPDATE Child SET Name ='$name' where ChildID = '$childID1';");
			if(mysql_affected_rows()>0)
			{
				$_SESSION['name'] = $name;
			}
			else
			{
				$result = 'Sorry, try again ' ;
				echo $result;
			}
		}
		if (!$query) 
		{
			echo 'Could not run insert query: ' . mysql_error();
			exit;
		}
		
	}
	
	
	
	if(isset($_POST['email']))
	{
		if($caregiverID1 >0)
		{
		$query = mysql_query("UPDATE Child SET Email = '{$_POST['email']}' where ChildID = '$childID1';");
		}
		if (!$query) 
		{
			echo 'Could not run insert query: ' . mysql_error();
			exit;
		}
		if(mysql_affected_rows()>0)
		{
			$_SESSION['Email'] = $_POST['email'];
		}
		else
		{
			$result = 'Sorry, try again ' ;
			echo $result;
		}
	}
	
	
	if(isset($_POST['password']))
	{
		if($caregiverID1 > 0 && !empty($_POST['password']))
		{
		$query = mysql_query("UPDATE Child SET Password=SHA1('{$_POST['password']}') where ChildID = '$childID1';");
		}
		if ( empty($_POST['password']))
		{
			echo 'Could not run insert query: PASSWORD' . mysql_error();
			//exit;
		}
	}
		
	header("Location: caregiverHomepage.php");
	mysql_close($db);

}

else
{
echo 'Not going into method';
header("Location: register.php");

}

?>