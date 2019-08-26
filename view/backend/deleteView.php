<?php

ob_start();

if(isset($_SESSION['pseudo'])){

	if(isset($_POST['confirmation']) && isset($_POST['id'])){
		if($_POST['confirmation'] === 'article'){
			//delete article
			$ArticlesManager -> delete($_POST['id']);
			$Comments = $CommentsManager -> getComments($_POST['id']);
			if($comment = $Comments -> fetch()){
				do{
					$CommentsManager -> delete($comment['id']);
					$CommentsManager -> deleteReportsFromComment($comment['id']);
				}while($comment = $Comments -> fetch());
			}
			$Comments -> closeCursor();

			$message = 'L\'article a bien été supprimé.';
			echo'<div class="infoComment">';
				echo '<p>' . $message . '</p>';
				echo '<a href="Jean-Forteroche_admin.php?action=edit">Retourner au menu d\'édition d\'article</a>';
			echo '</div>';
		}
		else if($_POST['confirmation'] === 'comment'){
			//delete comment
			$CommentsManager -> delete($_POST['id']);
			$CommentsManager -> deleteReportsFromComment($_POST['id']);

			$message = 'Le commentaire a bien été supprimé.';
			echo'<div class="infoComment">';
				echo '<p>' . $message . '</p>';
				echo '<a href="Jean-Forteroche_admin.php?action=moderate">Retourner au menu de modération des commentaires</a>';
			echo '</div>';
		}
	}

	if(isset($_GET['id_article'])){
		?>
		<!--form to confirm delete article-->
		<h3>Etes-vous sûr de vouloir supprimer cet article ?</h3>
		
		<section id="form_confirmation" class="container">
			<form method="POST" action="Jean-Forteroche_admin.php?action=delete">
					<input type="hidden" name="confirmation" value="article">
					<input type="hidden" name="id" value="<?=$_GET["id_article"]?>">
					<input type="submit" name="submit" value="Supprimer">
			</form>
			<form method="POST" action="Jean-Forteroche_admin.php?action=edit">
				<input type="submit" name="submit" value="Annuler">
			</form>
		</section>
		<?php
	}
	else if(isset($_GET['id_comment'])){
		?>
		<!--form to confirm delete comment-->
		<h3>Etes-vous sûr de vouloir supprimer ce commentaire ?</h3>
		
		<section id="form_confirmation" class="container">
			<form method="POST" action="Jean-Forteroche_admin.php?action=delete">
					<input type="hidden" name="confirmation" value="comment">
					<input type="hidden" name="id" value="<?=$_GET["id_comment"]?>">
					<input type="submit" name="submit" value="Supprimer">
			</form>
			<form method="POST" action="Jean-Forteroche_admin.php?action=moderate">
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