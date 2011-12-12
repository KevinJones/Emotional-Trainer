<?php 
include('config.php');

if (isset($_POST['submit'])) {
	$link = mysql_connect($hostname, $username, $password);
	mysql_select_db($database, $link);
	
	$titles = isset($_POST['title']) ? $_POST['title'] : array();
	$delFlags = isset($_POST['delFlag']) ? $_POST['delFlag'] : array();
	$imageNames = isset($_POST['imageName']) ? $_POST['imageName'] : array();
	
	$order = 1;
	for ($i = 0; $i < count($titles); $i++) {
		// local variables
		$title = addslashes($titles[$i]);
		$delFlag = $delFlags[$i];
		$imageName = $imageNames[$i];
		$imageName = @explode(',', $imageName);
		$status = $imageName[1];
		$imageName = $imageName[0];
		$imgid = substr($imageName, 0, strlen($imageName) - 4);
		$imgid = substr($imgid, 6);

		// check the status and do accordingly
		if ($status == 'new' && $delFlag == '1') {
			$query = "INSERT INTO images(`order`, `title`) VALUES ($order, '$title')";
			mysql_query($query);
			
			// Retrieving new img id
			$imgid = mysql_insert_id();
			$new_image_name = 'photo-' . $imgid . '.jpg';
			
			copy('photos/temp/' . $imageName, 'photos/' . $new_image_name);
			unlink('photos/temp/' . $imageName);
	
			// increment the order variable
			$order++;
		}
		
		else if ($status == 'old' && $delFlag == '1') {
			$query = "UPDATE images SET `order` = '$order', `title` = '$title' WHERE `imgid` = '$imgid'";
			mysql_query($query);
			
			// increment the order variable
			$order++;					
		}
		
		else if ($status == 'old' && $delFlag == '0') {
			$query = "DELETE FROM images WHERE imgid = '$imgid'";
			mysql_query($query);
			
			$image_name = 'photo-' . $imgid . '.jpg';
			unlink('photos/' . $image_name); 
		}
	}
}
header('Location: photo-manager.php');
?>