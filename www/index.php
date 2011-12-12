<!--Root directory index. Redirects to the caregiver index by default. -->
<?php
session_start();
if(isset($_SESSION['name'])) //If there's already a session, redirect the user to the caregiver homepage.
	{
		$host	= $_SERVER['HTTP_HOST'];
		$uri	= rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra	= './caregiver/caregiverHomepage.php';
		header("Location: http://$host$uri/$extra");
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<SCRIPT language="JavaScript" SRC="caregiver.js"></SCRIPT>

<title>Welcome to Emotional Trainer</title>
</head>

<body>
<meta http-equiv="Refresh" content="0;url=caregiver/index.php" />
</body>
</html>
