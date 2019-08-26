<?php

ob_start();

if(isset($_SESSION['pseudo'])){

	echo '<h1>Modérer les commentaires</h1>';

	if(isset($_POST['id_comment']) && isset($_POST['author']) && isset($_POST['tinyMCEtextarea'])){
		//edit comment
		$CommentsManager -> update(new Comment([
			'author' => $_POST['author'],
			'author_edit' => 'Jean-Forteroche', 
			'content' => $_POST['tinyMCEtextarea'],
			'id' => $_POST['id_comment']]));

		$CommentsManager -> deleteReportsFromComment($_POST['id_comment']);
		$CommentsManager -> setNbReport($_POST['id_comment'], 0);

			$message = 'Le commentaire a bien été édité.';
	}

	//message
	if(isset($message)){
		echo '<p class="infoComment">' . $message . '</p>';
	}

	if(isset($_GET['id_comment'])){
		if($_GET['id_comment'] > 0){
			//display form to edit comment
			$Comment = $CommentsManager -> getComment($_GET['id_comment']);
			$comment = $Comment -> fetch();

			?>
			<section id="form_add_edit_article" class="container">
				<form method="POST" action="Jean-Forteroche_admin.php?action=moderate">
					<p>
						<label for="author">Auteur du commentaire</label>
						<input type="text" name="author" value="<?=$comment['author']?>">
					</p>
					<p>
						<textarea id="tinyMCEtextarea" name="tinyMCEtextarea"></textarea>
					</p>
					<p>
						<input type="hidden" name="content" id="content" value="<?=$comment['content']?>">
						<input type="hidden" name="id_comment" id="id_comment" value="<?=$_GET['id_comment']?>">
						<input type="submit" name="submit" value="Editer">
					</p>
				</form>
			</section>
			<?php

			$Comment -> closeCursor();
		}
		else{
			throw new Exception('Le commentaire spécifié est introuvable');
		}
	}
	else{
		//display list of most reported comments
		$Comments = $CommentsManager -> getMostReportedComments();

		?>
		<section class="container" id="moderate_comments">
			<?php
			if($comment = $Comments -> fetch()){
				?>
				<table class="full_width">
				<caption><h2>Liste des Commentaires signalé</h2></caption>
				<tr>
					<th>Commentaire</th>
					<th>Article concerné</th>
					<th>Editer</th>
					<th>Supprimer</th>
				</tr>
				<?php
				do{
					//if comment's author is admin, display name in purple
					$style ="";
					if($comment['author_is_admin']){
						$style = 'style="color:purple;"';
					}
					?>
					<tr>
						<td>
							Auteur : <span <?=$style?>> <?=$comment['author']?></span> <br><br>
							Contenu : <span> <?=$comment['content']?></span> <br><br>
							Nombre de signalement : <span> <?=$comment['nb_report']?></span> - 
							<a href="Jean-Forteroche_admin.php?action=viewReports&amp;id_comment=<?=$comment['id']?>">Voir les signalement</a>
						</td>
						<td><a href="Jean-Forteroche.php?action=article&amp;id_article=<?=$comment['id_article']?>"><i class="fas fa-eye"></i></a></td>
						<td><a href="Jean-Forteroche_admin.php?action=moderate&amp;id_comment=<?=$comment['id']?>"><i class="fas fa-pencil-alt"></i></a></td>
						<td><a href="Jean-Forteroche_admin.php?action=delete&amp;id_comment=<?=$comment['id']?>"><i class="fas fa-trash-alt"></i></a></td>
					</tr>
					<?php
				}while($comment = $Comments -> fetch());

				echo '</table>';
			}
			else{
				echo '<p class="infoComment">Il n\'y a aucun commentaire à afficher.</p>';
			}

			echo '</section>';

		$Comments -> closeCursor();
	}
}
else{
	header('Location: Jean-Forteroche_admin.php');
}

$content = ob_get_clean();

require('view/template.php');