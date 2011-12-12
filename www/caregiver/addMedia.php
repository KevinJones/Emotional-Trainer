<?php

/* 
Project Emotional Trainer
Created by Chameleon Designs
Moinak Bandyopadhyay, Jessica Blair, Kevin Jones, Mudit Manu Paliwal and Jacob Solomon.

Filename: addMedia.php
Description: This page is used to upload user selected media to the database.

*/
?>
 
<html>
<head>
	<link rel="stylesheet"  href="screen950.css" media="all" />
<!--[if IE]>
	<link rel="stylesheet"  href="http://demo.webhole.net/styles/blueprint/ie.css" media="all" />
<![endif]-->
</head>
<body>
	<?php
	$emotionID = (int) $_GET['emotionID'];
	$childID = (int) $_GET['child'];
	?>
	<div class="container">
		<div>
			<ul class="css-tabs">
				<li><a href="#" id="selectStock" class="nav">Select Stock Image</a></li>
				<li><a href="#" id="uploadImage" class="nav">Upload Computer Image</a></li>
				<li><a href="#" id="internetImage" class="nav">Upload Internet Image</a></li>
			</ul>
		</div>
		<div class="span-19 last" id="response">
		
		</div>
	</div>
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>
	
    <script language="javascript" type="text/javascript">
		$(document).ready(function(){
		// load index page when the page loads
		$("#response").load("stockSelector.php");
		$("#selectStock").click(function(){
		// load home page on click
			<?php echo " $(\"#response\").load(\"stockSelector.php?emotionID=$emotionID&child=$childID\"); "; ?>
		});
		$("#uploadImage").click(function(){
		// load about page on click	
			<?php echo"	$(\"#response\").load(\"uploadImage.php?emotionID=$emotionID&child=$childID\");  "; ?>
		});
		$("#contact").click(function(){
		// load contact form onclick
			$("#response").load("#");
		});
		});
    </script>
</body>
</html>