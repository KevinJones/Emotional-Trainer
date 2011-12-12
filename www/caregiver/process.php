<?php
/*

Project Emotional Trainer
Created by Chameleon Designs
Moinak Bandyopadhyay, Jessica Blair, Kevin Jones, Mudit Manu Paliwal and Jacob Solomon.

Filename: process.php
Description: This file is used for image processing. It contains code to validate that an image is uploaded correctly
and insert it into the database.

*/

    require_once('globals.php');
 
 	$emotionID = (int) $_GET['eID'];
	$childID = (int) $_GET['cID'];
			
    function assertValidUpload($code)
    {
        if ($code == UPLOAD_ERR_OK) {
            return;
        }
 
        switch ($code) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                $msg = 'Image is too large';
                break;
 
            case UPLOAD_ERR_PARTIAL:
                $msg = 'Image was only partially uploaded';
                break;
 
            case UPLOAD_ERR_NO_FILE:
                $msg = 'No image was uploaded';
                break;
 
            case UPLOAD_ERR_NO_TMP_DIR:
                $msg = 'Upload folder not found';
                break;
 
            case UPLOAD_ERR_CANT_WRITE:
                $msg = 'Unable to write uploaded file';
                break;
 
            case UPLOAD_ERR_EXTENSION:
                $msg = 'Upload failed due to extension';
                break;
 
            default:
                $msg = 'Unknown error';
        }
 
        throw new Exception($msg);
    }
 
    $errors = array();
 
    try {
        if (!array_key_exists('image', $_FILES)) {
            throw new Exception('Image not found in uploaded data');
        }
 
        $image = $_FILES['image'];
 
        // ensure the file was successfully uploaded
        assertValidUpload($image['error']);
 
        if (!is_uploaded_file($image['tmp_name'])) {
            throw new Exception('File is not an uploaded file');
        }
 
        $info = getImageSize($image['tmp_name']);
 
        if (!$info) {
            throw new Exception('File is not an image');
        }
    }
    catch (Exception $ex) {
        $errors[] = $ex->getMessage();
    }
 
    if (count($errors) == 0) {
        // no errors, so insert the image
 		$tID = 2;
        $query = sprintf(
            "insert into Media (Media, EmotionID, TypeID, FileType)
                values ('%s', '%d', %d, '%s')",
            mysql_real_escape_string(
                file_get_contents($image['tmp_name'])
            ), $emotionID, $tID,
			mysql_real_escape_string($info['mime'])			
        );
 
        mysql_query($query, $db);
 
        $id = (int) mysql_insert_id($db);
		
		
		$query2 = sprintf(
            "insert into ChildHasMedia (ChildID, MediaID)
                values ('%d', '%d')",
            $childID, $id			
        );
		
 		mysql_query($query2, $db);
        // finally, redirect the user to view the new image
        header('Location: redirect.html');
        exit;
    }
?>
<html>
    <head>
        <title>Error</title>
    </head>
    <body>
        <div>
            <p>
                The following errors occurred:
            </p>
 
            <ul>
                <?php foreach ($errors as $error) { ?>
                    <li>
                        <?php echo htmlSpecialChars($error) ?>
                    </li>
                <?php } ?>
            </ul>
            
            
            <?php
			echo "<p>  $id </p>";
			
			?>
 
            <p>
            	<?php
      			 echo " <a href=\"addMedia.php?emotionID=1&child=$childID\" class=\"myButton2 iframe\">Add Media</a> ";
				 ?>
            </p>
        </div>
    </body>
</html>