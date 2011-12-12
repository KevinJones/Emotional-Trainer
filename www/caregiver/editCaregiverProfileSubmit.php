<?php
/* 
Project Emotional Trainer
Created by Chameleon Designs
Moinak Bandyopadhyay, Jessica Blair, Kevin Jones, Mudit Manu Paliwal and Jacob Solomon.

Filename: editCaregiverProfileSubmit.php
Description: This page is used to submit the edits made to the caregiver profile to the database

*/
?>

<?php
echo 'blah'.$_COOKIE["CaregiverID"].'whoa START </html>';
$caregiverID1 = 0;

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
if(isset($_POST['email']))
{
	$name = $_POST['name'];
	$email = $_POST['email'];
	$nameSize = strlen($name);
	
	
	//		header("Location: register.php");
	
	
	/*TODO: Add necessary validation code */

	/*Connection to database cs4911_Team46 using your login name and password*/
	$db=mysql_connect('localhost','cs4911_Team46','rmkU1KxJ') or die("Could not connect to Emotional Trainer Database: ". mysql_error());
	mysql_select_db('cs4911_Team46');
	
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
			$query = mysql_query("UPDATE Caregiver SET Picure ='$data' where CaregiverID = '$caregiverID1';");
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
		$query = mysql_query("UPDATE Caregiver SET DOB ='$date' where CaregiverID = '$caregiverID1';");
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
	
	
	if(isset($_POST['name']))
	{
		
		if($caregiverID1 >0)
		{
		$query = mysql_query("UPDATE Caregiver SET Name ='$name' where CaregiverID = '$caregiverID1';");
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
		$query = mysql_query("UPDATE Caregiver SET Email = '{$_POST['email']}' where CaregiverID = '$caregiverID1';");
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
		$query = mysql_query("UPDATE Caregiver SET Password=SHA1('{$_POST['password']}') where CaregiverID = '$caregiverID1';");
		}
		if ( empty($_POST['password']))
		{
			echo 'Could not run insert query: PASSWORD' . mysql_error();
			//exit;
		}
	}
		
	/*
	if(mysql_affected_rows()>0)
	{
		//Blank fields remain unchanged. Others are updated.
		if($name != ""){
			$_SESSION['name'] = $name;
		}
		
		if($date != ""){
			$_SESSION['DOB'] = $date ;
		}
		
		$_SESSION['Picture'] = $data; //TODO: Add validation for this.
		
		if($email != "")
		{
			$_SESSION['Email'] = $email;
		}
		
		header("Location: caregiverHomepage.php");
	}
	else
	{
		$result = 'Sorry, try again ' ;
		echo $result;
	}
	*/
	header("Location: caregiverHomepage.php");
	mysql_close($db);

}

else
{
echo 'Not going into method';
header("Location: register.php");

}

?>