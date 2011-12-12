<?php
/*

Project Emotional Trainer
Created by Chameleon Designs
Moinak Bandyopadhyay, Jessica Blair, Kevin Jones, Mudit Manu Paliwal and Jacob Solomon.

Filename: uploadImage.php
Description: This file contains the code to upload images to the database.

*/
?>
<html>
<head>

	<title>Upload Image</title>

</head>

<body>

	
	<h2>Upload an Image</h2>
        <?php
			$emotionID = (int) $_GET['emotionID'];
			$childID = (int) $_GET['child'];
		
  		echo "<form method=\"post\" action=\"process.php?eID=$emotionID&cID=$childID\" enctype=\"multipart/form-data\">";
		?>
                    <input type="file" name="image" />
                    <input type="submit" value="Upload Image" />
                
        </form>
        
        
        

</body>

</html>
