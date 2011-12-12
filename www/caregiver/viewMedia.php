<?php

/*

Project Emotional Trainer
Created by Chameleon Designs
Moinak Bandyopadhyay, Jessica Blair, Kevin Jones, Mudit Manu Paliwal and Jacob Solomon.

Filename: viewMedia.php
Description: this file contains the code to view the media associated with a child.

*/

    require_once('globals.php');
 
    try {
        if (!isset($_GET['id'])) {
            throw new Exception('ID not specified');
        }
 
        $id = (int) $_GET['id'];
 
        if ($id <= 0) {
            throw new Exception('Invalid ID specified');
        }
 
        $query  = sprintf('select * from Media where MediaID = %d', $id);
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
 
    header('Content-type: ' . $image['FileType']);
 
    echo $image['Media'];
?>