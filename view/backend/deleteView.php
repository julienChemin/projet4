<?php

ob_start();

if(isset($_SESSION)){

	if(isset($_POST['confirmation'])){
		//delete article
		$ArticlesManager -> delete($_POST['confirmation']);

		$message = 'L\'élément a bien été supprimé.';
		echo'<div class="infoComment">';
			echo '<p>' . $message . '</p>';
			echo '<a href="Jean-Forteroche_admin.php?action=edit">Retourner au menu d\'édition d\'article</a>';
		echo '</div>';
	}

	if(isset($_GET['id_article'])){
		?>
		<!--form to confirm delete article-->
		<h3>Etes-vous sûr de vouloir supprimer cet élément ?</h3>
		
		<section id="form_confirmation" class="container">
			<form method="POST" action="Jean-Forteroche_admin.php?action=delete">
					<input type="hidden" name="confirmation" value="<?=$_GET["id_article"]?>">
					<input type="submit" name="submit" value="Supprimer">
			</form>
			<form method="POST" action="Jean-Forteroche_admin.php?action=edit">
				<input type="submit" name="submit" value="Annuler">
			</form>
		</section>
		<?php
	}
	
}
else{
	header('Location: Jean-Forteroche_admin.php');
}

$content = ob_get_clean();

require('view/template.php');