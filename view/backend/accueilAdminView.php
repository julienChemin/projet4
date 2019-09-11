<?php

if (isset($_SESSION['pseudo'])) {
	//user is connected
	?>
	<h1>Bienvenue, <?=$_SESSION['pseudo']?></h1>

	<h2>Que souhaitez vous faire ?</h2>

	<section id="accueilAdmin" class="container">
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

	<p class="info"><a href="Jean-Forteroche.php?">Accéder au site</a></p>

	<?php
} else {
	//if user is not connected and try to connect
	if (isset($_POST['postConnectPseudo']) && isset($_POST['postConnectPassword'])) {
		if (isset($_POST['stayConnect'])) {
			//if user want to stay connect
			setcookie('admin', $_POST['postConnectPseudo'], time()+(365*24*3600), null, null, false, true);
		}

		if ($userExist) {
			if ($passwordIsOk) {
				$_SESSION['pseudo'] = $_POST['postConnectPseudo'];
			} else {
				$message = 'Le mot de passe est incorrecte';
			}
		} else {
			$message = 'L\'identifiant est incorrecte';
		}
	}
	//display form to connect
	?>
	<h1>Bienvenue dans l'espace d'administration</h1>

	<form method="POST" action="Jean-Forteroche_admin.php">
		<h2>Entrez vos identifiants de connection</h2>

		<p>
			<label for="postConnectPseudo">Identifiant</label>
			<input type="text" name="postConnectPseudo" required="">
		</p>

		<p>
			<label for="postConnectPassword">Mot de passe</label>
			<input type="password" name="postConnectPassword" required="">
		</p>

		<p>
			<label for="stayConnect">Rester connecté</label>
			<input type="checkbox" name="stayConnect" id="stayConnect">
		</p>

		<p>
			<input type="submit" name="submit" value="connection">
		</p>
	</form>
	
	<?php
	if (isset($message)) {
		echo '<p class="infoError">' . $message . '</p>';
	}
}
