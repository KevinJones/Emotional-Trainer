<?php
    require_once('globals.php');
 
    $query = sprintf('select image_id, filename from images');
    $result = mysql_query($query, $db);
 
    $images = array();
 
    while ($row = mysql_fetch_array($result)) {
        $id = $row['image_id'];
        $images[$id] = $row['filename'];
    }
?>
<html>
    <head>
        <title>Uploaded Images</title>
    </head>
    <body>
        <div>
            <h1>Uploaded Images</h1>
 
            <p>
                <a href="upload.php">Upload an image</a>
            </p>
 
            <ul>
                <?php if (count($images) == 0) { ?>
                    <li>No uploaded images found</li>
                <?php } else foreach ($images as $id => $filename) { ?>
                    <li>
                        <a href="view.php?id=<?php echo $id ?>">
                            <?php echo htmlSpecialChars($filename)  ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
    </body>
</html>