<html>
    <head>
        <title>Error</title>
    </head>
    <body>
        <div>
            <p>
                The following errors occurred:
            </p>
            <?php
			$emotionID = (int) $_GET['mediaID'];
			$childID = (int) $_GET['child'];
			echo "<p> $emotionID,  $childID </p>";
			?>
            
      </div>
    </body>
</html>