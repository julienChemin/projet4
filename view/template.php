<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Billet simple pour l'Alaska</title>

		<!--meta-->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Billet simple pour l'Alaska - Un blog de Jean-Forteroche">

		<meta name="twitter:title" content="Billet simple pour l'Alaska">
		<meta name="twitter:description" content="Billet simple pour l'Alaska - Un blog de Jean-Forteroche">
		<meta name="twitter:image" content="images/alaska.png">

		<meta property="og:title" content="Billet simple pour l'Alaska" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="julienchemin.fr/projet4/Jean-Forteroche.html" />
		<meta property="og:image" content="images/alaska.png" />
		<meta property="og:description" content="Billet simple pour l'Alaska - Un blog de Jean-Forteroche" /> 
		<meta property="og:site_name" content="Billet simple pour l'Alaska" />

		<!--css-->
		<link rel="stylesheet" type="text/css" href="public/css/style.css">

		<!--font awesome-->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		
	</head>
	<body>
		<?php 
		if (isset(Chemin\Blog\Model\Backend::$isConnected) && Chemin\Blog\Model\Backend::$isConnected) {
			require('backend/navbar.php');
		} else {
			require('frontend/navbar.php');
		}
		?>

		<main>
			<?=$content?>
		</main>

		<?php
		require('gitignore/key.php');
		?>
		<script src='https://cdn.tiny.cloud/1/<?=$tinyMCEapiKey?>/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
		<script src="public/js/tinyMCEinit.js"></script>
	</body>
</html>