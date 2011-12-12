<?php 
	include('config.php');
	// Clear temp directory
	if ($handle = opendir('photos/temp')) {
		while (false !== ($file = readdir($handle))) {
			@unlink('photos/temp/' . $file);
		}
		closedir($handle);
	}
	
	$link = mysql_connect($hostname, $username, $password);
	mysql_select_db($database, $link);
	
	$query = "SELECT * FROM images ORDER BY `order`";
	$rs = mysql_query($query);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Photo Manager</title>
    <script language="javascript" type="text/javascript" src="js/pm.js"></script>
	<link rel="stylesheet" type="text/css" href="css/manager.css" /> 
</head>
<body>
<div class="page">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td align="left" valign="top" id="contentMid">
            <form action="photo-manager-save.php" method="post">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="left" valign="top"><h1>Uploaded Photos</h1></td>
                    </tr>
                    <tr>
                        <td align="left" valign="top">
                            Photos are displayed on your Property Page in the order shown here.
                        </td>
                    </tr>
                    <tr>
                        <td align="left" valign="top">
                            <div id="main">
                                <div id="images_container">
                                    <?php					
                                        while ($images = mysql_fetch_assoc($rs)) {
                                            $imgid = $images['imgid'];
                                            $title = stripslashes($images['title']);
											$filename = 'photo-' . $imgid . '.jpg';
											$image_path = 'photos/' . $filename;
                                    ?>
                                    <div id="<?=$pimgid?>">
                                        <img class="pic" src="<?=$image_path?>" />
                                        <input name="title[]" size="12" maxlength="40" type="text" value="<?=$title?>" onFocus="labelOnFocus(this)" onBlur="labelOnBlur(this)" /><br /><a href="javascript:void(0);" onClick="deleteLinkOnClick(this, 'delFlag<?=$imgid?>')">Delete</a>
                                        <input name="delFlag[]" value="1" type="hidden" id="delFlag<?=$imgid?>" />
                                        <input name="imageName[]" value="<?=$filename?>,old" type="hidden" />
                                    </div>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr><td align="left" valign="top">&nbsp;</td></tr>
                    <tr><td align="left" valign="top"><h1>Add Photos</h1></td></tr>
                    <tr>
                        <td align="left" valign="top">
                            <div id="error" style="display:none"></div>	
                            <div id="iframe_container">
                                <iframe src="pm-upload.php" frameborder="0" style="height:75px;"></iframe>
                            </div>
                        </td>
                    </tr>
                    <tr><td><input type="submit" name="submit" value="Update"></td></tr>
                </table>
            </form>
        </td>
    </tr>
</table>
</div>
</body>
</html>