<?php

$accepted_origins = array("http://localhost", "https://julienchemin.fr");

$imageFolder = "../../public/images/";
/*
"../public/images" = l'image aparait dans tinymce mais le chemin dans le html lors de l'affichage est bugger 
(data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEASABIAAD/2wBDAAYEBQYFBAYGBQYHBwYIChAKCgkJChQODwwQFxQYGBcUFhYaHSUfGhsjHBYWICwgIyYnKSopGR8tMC0oMC ...	
		</div>
		<p class=)

"../../public/images" = l'image s'enregistre bien dans le dossier mais ne saffiche pas dans tinymce pendant l'ecriture de larticle et ne s'affiche pas non plus lors de laffichage des article (le lien a un "/" de trop ou un "../")
*/

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