<?php
    require_once('globals.php');
 
    try {
        if (!isset($_GET['id'])) {
            throw new Exception('ID not specified');
        }
 
        $id = (int) $_GET['id'];
 
        if ($id <= 0) {
            throw new Exception('Invalid ID specified');
        }
 
        $query  = sprintf('select * from images where image_id = %d', $id);
        $result = mysql_query($query, $db);
 
        if (mysql_num_rows($result) == 0) {
            throw new Exception('Image with specified ID not found');
        }
 
        $image = mysql_fetch_array($result);
    }
    catch (Exception $ex) {
        header('HTTP/1.0 404 Not Found');
        exit;
    }
 
    header('Content-type: ' . $image['mime_type']);
    header('Content-length: ' . $image['file_size']);
 
    echo $image['file_data'];
?>