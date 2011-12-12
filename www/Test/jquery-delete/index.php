<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Papermashup.com | jQuery Ajax Delete</title>

<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="highslide/highslide-with-gallery.js"></script>
<link rel="stylesheet" type="text/css" href="highslide/highslide.css" />

<script type="text/javascript">

hs.graphicsDir = 'highslide/graphics/';
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





<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
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
   url: "delete.php",
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
	width:120px;
	float: left;
	
}
.box:hover{background-color:#ccc;}

#load {
	position:absolute;
	left:225px;
	background-image:url(images/loading-bg.png);
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
</head>
<body>
<div id="container">
  <h3>Delete Comments</h3>

  <div id="load" align="center"><img src="images/loading.gif" width="28" height="28" align="absmiddle"/> Loading...</div>
    click the x to delete a comment<br/>
    <br/>
  
  
  <?php
 
     
    
	
		for ($i = 1; $i <= 4; $i++) {
			echo "
			
			<div class=\"box\">
     		<a href=\"#\" id=\"1\" class=\"delete\">x</a>				
			
			<a href=\"view.php?id=$i\" class=\"highslide\" onclick=\"return hs.expand(this)\">

			<img src=\"view.php?id=$i\"  width=120 height=120  alt=\"Highslide JS\"

			title=\"Click to enlarge\" />

			</a>			
			
			<div class=\"clear\"></div>
  			</div>
			
			";
		}
	?>
    
    
     
  
  

  
 
  
</div>


</body>
</html>
