<?php

ob_start();

if(isset($_SESSION['pseudo'])){
	//user is connected
	?>
	<h1>Bienvenue, <?=$_SESSION['pseudo']?></h1>
	<h2>Que souhaitez vous faire ?</h2>
	<section id="accueil_admin" class="container">
		<a href="Jean-Forteroche_admin.php?action=add">
			<div>
				<h3>Ajouter un article</h3>
				<i class="fas fa-plus"></i>
			</div>
		</a>
		<a href="Jean-Forteroche_admin.php?action=edit">
			<div>
				<h3>Editer un article</h3>
				<i class="fas fa-pencil-alt"></i>
			</div>
		</a>
		<a href="Jean-Forteroche_admin.php?action=moderate">
			<div>
				<h3>Modérer les commentaires</h3>
				<i class="fas fa-comments"></i>
			</div>
		</a>
	</section>
	<p class="info"><a href="Jean-Forteroche.php?action=listArticles">Voir tout les articles</a></p>
	<?php
}
else{
	//user is not connected
	if(isset($_POST['post_connect_pseudo']) && isset($_POST['post_connect_password'])){
		//if user try to connect
		if(isset($_POST['stayConnect'])){
			setcookie('admin', $_POST['post_connect_pseudo'], time()+(365*24*3600), null, null, false, true);
		}

		$UserManager = new UserManager();

		if($UserManager -> exists($_POST['post_connect_pseudo'])){
			//pseudo exists
			if($UserManager -> checkPassword($_POST['post_connect_pseudo'], $_POST['post_connect_password'])){
				//password is ok
				$_SESSION['pseudo'] = htmlspecialchars($_POST['post_connect_pseudo']);
				header('Location: Jean-Forteroche_admin.php');
			}
			else{
				$message = 'Le mot de passe est incorrecte';
			}
		}
		else{
			$message = 'L\'identifiant est incorrecte';
		}
	}
	//display form to connect
	?>
	<h1>Bienvenue dans l'espace d'administration</h1>
	<form method="POST" action="Jean-Forteroche_admin.php">
		<h2>Entrez vos identifiants de connection</h2>
		<p>
			<label for="post_connect_pseudo">Identifiant</label>
			<input type="text" name="post_connect_pseudo" required="">
		</p>
		<p>
			<label for="post_connect_password">Mot de passe</label>
			<input type="password" name="post_connect_password">
		</p>
		<p>
			<label for="stayConnect">Rester connecté</label>
			<input type="checkbox" name="stayConnect" id="stayConnect">
		</p>
		<p>
			<input type="submit" name="submit" value="connection" required="">
		</p>
	</form>
	<?php
	if(isset($message)){
		echo '<p class="infoError">' . $message . '</p>';
	}
}

$content = ob_get_clean();

require('view/template.php');