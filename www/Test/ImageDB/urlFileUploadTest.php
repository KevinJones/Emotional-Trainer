<form method="post" action="process.php" enctype="multipart/form-data">
<input name="url" size="50" />
<input name="submit" type="submit" />
</form>
<?php

echo error_reporting();

// maximum execution time in seconds
set_time_limit (24 * 60 * 60);

if (!isset($_POST['submit'])){
	echo "Submit not yet set. <br>\n";
	exit();
}

// folder to save downloaded files to. must end with slash
$destination_folder = '/Saved/';

$url = $_POST['url'];
$newfname = $destination_folder . basename($url);
//Todo: add some sort of hash to the filename

echo $url;
echo "<br>\n";

echo $newfname;
echo "<br>\n";

$file = fopen ($url, "rb");
if ($file) {
	echo "\$file exists. <br>\n";
  $newf = fopen ($newfname, "wb");

  if(! $newf){
	echo "! \$newf is true <br>\n";
	echo mysql_error();
  }
  
  
  if ($newf){
	echo "\$newf exists. <br>\n";
	while(!feof($file)) {
		fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );
	}
  }
  
}

if ($file) {
  fclose($file);
}

if ($newf) {
  fclose($newf);
}

?>