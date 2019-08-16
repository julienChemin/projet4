<!DOCTYPE html>
<html>
	<head>
		<title>Billet simple pour l'Alaska</title>
		<!--css-->
		<link rel="stylesheet" type="text/css" href="public/css/style.css">
		<!--font awesome-->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		
	</head>
	<body>

		<?php 
		if(isset($_SESSION['pseudo'])){
			require('backend/navbar.php');
		}else{
			require('frontend/navbar.php');
		}
		
		echo $content;

		require('gitignore/key.php');
		?>
		<script src='https://cdn.tiny.cloud/1/<?=$tinyMCEapiKey?>/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
		<script type="text/javascript" src="public/js/tinyMCEinit.js"></script>
	</body>
</html>