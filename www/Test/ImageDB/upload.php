<?php
    require_once('globals.php');
?>
<html>
    <head>
        <title>Upload an Image</title>
    </head>
    <body>
        <div>
            <h1>Upload an Image</h1>
 
            <p>
                <a href="./">View uploaded images</a>
            </p>
 
            <form method="post" action="process.php" enctype="multipart/form-data">
                <div>
                    <input type="file" name="image" />
                    <input type="submit" value="Upload Image" />
                </div>
            </form>
        </div>
    </body>
</html>