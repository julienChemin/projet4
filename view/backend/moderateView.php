<?php

ob_start();

if (isset($_SESSION['pseudo'])) {

	echo '<h1>Modérer les commentaires</h1>';

	if (isset($_POST['idComment']) && isset($_POST['author']) && isset($_POST['tinyMCEtextarea'])) {
		//edit comment
		$CommentsManager->update(new Comment([
			'author' => $_POST['author'],
			'authorEdit' => 'Jean-Forteroche', 
			'content' => $_POST['tinyMCEtextarea'],
			'id' => $_POST['idComment']]));

		$CommentsManager->deleteReportsFromComment($_POST['idComment']);
		$CommentsManager->setNbReport($_POST['idComment'], 0);

		$message = 'Le commentaire a bien été édité.';
	}

	//message
	if (isset($message)) {
		echo '<p class="infoComment">' . $message . '</p>';
	}

	if (isset($_GET['idComment'])) {
		if ($_GET['idComment'] > 0) {
			//display form to edit comment
			$Comment = $CommentsManager->getComment($_GET['idComment']);
			$comment = $Comment->fetch();

			?>
			<section id="formAddEditArticle" class="container">
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
						<input type="hidden" name="idComment" id="idComment" value="<?=$_GET['idComment']?>">
						<input type="submit" name="submit" value="Editer">
					</p>
				</form>
			</section>
			<?php

			$Comment->closeCursor();
		} else {
			throw new Exception('Le commentaire spécifié est introuvable');
		}
	} else {
		//display list of most reported comments
		$Comments = $CommentsManager->getMostReportedComments();

		?>
		<section class="container" id="moderateComments">
			<?php
			if ($comment = $Comments->fetch()) {
				?>
				<table class="fullWidth">
					<caption><h2>Liste des Commentaires signalé</h2></caption>
					<tr>
						<th>Commentaire</th>
						<th>Article concerné</th>
						<th>Editer</th>
						<th>Supprimer</th>
					</tr>
					<?php
					do {
						//if comment's author is admin, display name in purple
						$style ="";
						if ($comment['authorIsAdmin']) {
							$style = 'style="color:purple;"';
						}
						?>
						<tr>
							<td>
								Auteur : <span <?=$style?>> <?=$comment['author']?></span> <br><br>
								Contenu : <span> <?=$comment['content']?></span> <br><br>
								Nombre de signalement : <span> <?=$comment['nbReport']?></span> - 
								<a href="Jean-Forteroche_admin.php?action=viewReports&amp;idComment=<?=$comment['id']?>">Voir les signalement</a>
							</td>
							<td>
								<a href="Jean-Forteroche.php?action=article&amp;idArticle=<?=$comment['idArticle']?>&amp;idComment=<?=$comment['id']?>">
									<i class="fas fa-eye"></i>
								</a>
							</td>
							<td>
								<a href="Jean-Forteroche_admin.php?action=moderate&amp;idComment=<?=$comment['id']?>">
									<i class="fas fa-pencil-alt"></i>
								</a>
							</td>
							<td>
								<a href="Jean-Forteroche_admin.php?action=delete&amp;idComment=<?=$comment['id']?>">
									<i class="fas fa-trash-alt"></i>
								</a>
							</td>
						</tr>
						<?php
					} while ($comment = $Comments->fetch());
				echo '</table>';
			} else {
				echo '<p class="infoComment">Il n\'y a aucun commentaire à afficher.</p>';
			}
			echo '</section>';

		$Comments->closeCursor();
	}
} else {
	header('Location: Jean-Forteroche_admin.php');
}

$content = ob_get_clean();

require('view/template.php');
