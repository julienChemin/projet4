<?php

ob_start();

if (isset($_SESSION['pseudo'])) {

	if (isset($_POST['confirmation']) && isset($_POST['id'])) {
		if ($_POST['confirmation'] === 'article') {
			//delete article
			$message = 'L\'article a bien été supprimé.';
			echo'<div class="infoComment">';
				echo '<p>' . $message . '</p>';
				echo '<a href="Jean-Forteroche_admin.php?action=edit">Retourner au menu d\'édition d\'article</a>';
			echo '</div>';
		} elseif ($_POST['confirmation'] === 'comment') {
			//delete comment
			$message = 'Le commentaire a bien été supprimé.';
			echo'<div class="infoComment">';
				echo '<p>' . $message . '</p>';
				echo '<a href="Jean-Forteroche_admin.php?action=moderate">Retourner au menu de modération des commentaires</a>';
			echo '</div>';
		}
	}

	if (isset($_GET['idArticle'])) {
		?>
		<!--form to confirm delete article-->
		<h3>Etes-vous sûr de vouloir supprimer cet article ?</h3>
		
		<section id="formConfirmation" class="container">
			<form method="POST" action="Jean-Forteroche_admin.php?action=delete">
					<input type="hidden" name="confirmation" value="article">

					<input type="hidden" name="id" value="<?=$_GET["idArticle"]?>">

					<input type="submit" name="submit" value="Supprimer">
			</form>
			<form method="POST" action="Jean-Forteroche_admin.php?action=edit">
				<input type="submit" name="submit" value="Annuler">
			</form>
		</section>
		<?php
	} elseif (isset($_GET['idComment'])) {
		?>
		<!--form to confirm delete comment-->
		<h3>Etes-vous sûr de vouloir supprimer ce commentaire ?</h3>
		
		<section id="formConfirmation" class="container">
			<form method="POST" action="Jean-Forteroche_admin.php?action=delete">
					<input type="hidden" name="confirmation" value="comment">

					<input type="hidden" name="id" value="<?=$_GET["idComment"]?>">

					<input type="submit" name="submit" value="Supprimer">
			</form>
			<form method="POST" action="Jean-Forteroche_admin.php?action=moderate">
				<input type="submit" name="submit" value="Annuler">
			</form>
		</section>
		<?php
	}
} else {
	header('Location: Jean-Forteroche_admin.php');
}

$content = ob_get_clean();

require('view/template.php');
