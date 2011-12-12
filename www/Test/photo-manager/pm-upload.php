<?php
set_time_limit(60);
$err = false;

if (isset($_FILES['image'])) {
	$ftmp = $_FILES['image']['tmp_name'];
	$oname = $_FILES['image']['name'];
	$div_id = $_POST['div_id'];

	$type = @explode('/', $_FILES['image']['type']);
	$type = isset($type[1]) ? $type[1] : '';
	
	$type = ($type != 'pjpeg') ? $type : 'jpeg';
	
	$img_types = array('jpg', 'jpeg', 'gif', 'png');
	
	if (in_array($type, $img_types)) {
		$file_temp_name = substr(md5(time() . $div_id), 0, 14) . 'n' . '.' . $type;
		
		$fname = "photos/temp/" . $file_temp_name;
		$afname = "photos/temp/" . $file_temp_name;
		
		if (move_uploaded_file($ftmp, $fname)){
?>
<html>
	<head>
		<script language="javascript">
			window.parent.setUploadedImage('<?=$afname?>', '<?=$file_temp_name?>', '<?=$div_id?>');
		</script>
	</head>
</html>
<?php
			exit();
		}	
	}
	else {
		$err = true;
	}
}
?>
<html>
	<head>
    	<style type="text/css">
			body {
				margin: 0px;
				padding: 0px;
				background-color: #FFF;
				color:#000;
			}
		</style>
	</head>
	<body>
		<?php
			if ($err) {
		?>
			<script language="javascript">
				window.parent.uploadError('<?=$div_id?>', '<?=$oname?>');
			</script>
		<?php
			}
		?>
        <div>
		<form name="iform" action="" method="post" enctype="multipart/form-data">
			<input id="file" type="file" name="image" onChange="window.parent.upload(this);" /><br>
            <span style="font-size:11px; color:#666666;">only gif, png, jpg files.</span>
			<input type="hidden" value="" name="div_id" />
		</form>
        </div>
	</body>
</html>