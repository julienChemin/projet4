<?php

$accepted_origins = array("http://localhost", "https://julienchemin.fr");

$imageFolder = "images/";

reset($_FILES);
$temp = current($_FILES);

if(is_uploaded_file($temp['tmp_name'])){
    if(isset($_SERVER['HTTP_ORIGIN'])){
        if(in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)){
            header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
        }else{
            header("HTTP/1.1 403 Origin Denied");
            return;
        }
    }
  
    // Sanitize input
    if(preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])){
        header("HTTP/1.1 400 Invalid file name.");
        return;
    }
  
    // Verify extension
    if(!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))){
        header("HTTP/1.1 400 Invalid extension.");
        return;
    }

    $filetowrite = $imageFolder . $temp['name'];
    move_uploaded_file($temp['tmp_name'], $filetowrite);
  
    echo json_encode(array('location' => $filetowrite));
} else {
    header("HTTP/1.1 500 Server Error");
}