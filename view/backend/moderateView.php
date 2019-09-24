<?php

echo '<h1>Modérer les commentaires</h1>';

//message
if (isset($data['message'])) {
	echo '<p class="infoComment">' . $data['message'] . '</p>';
}

if (isset($_GET['idComment'])) {
	if ($_GET['idComment'] > 0) {
		//display form to edit comment
		?>
		<section id="formAddEditArticle" class="container">
			<form method="POST" action="Jean-Forteroche_admin.php?action=moderate">
				<p>
					<label for="author">Auteur du commentaire</label>
					<input type="text" name="author" value="<?=$data['comment']->getAuthor()?>">
				</p>

				<p>
					<textarea id="tinyMCEtextarea" name="tinyMCEtextarea"></textarea>
				</p>

				<p>
					<input type="hidden" name="idComment" id="idComment" value="<?=$_GET['idComment']?>">
					<input type="submit" name="submit" value="Editer">
				</p>
			</form>

			<div id="content">
				<?=$data['comment']->getContent()?>
			</div>
		</section>
		<?php
	} else {
		throw new Exception('Le commentaire spécifié est introuvable');
	}
} else {
	//display list of most reported comments
	?>
	<section class="container" id="moderateComments">
		<?php
		if (!empty($data['listReportedComments'])) {
			?>
			<table class="fullWidth">
				<caption><h2>Liste des Commentaires signalés</h2></caption>
				<tr>
					<th>Commentaire</th>
					<th>Article concerné</th>
					<th>Editer</th>
					<th>Supprimer</th>
				</tr>
				<?php
				foreach ($data['listReportedComments'] as $comment) {
					//if comment's author is admin, display name in purple
					$style ="";
					if ($comment->getAuthorIsAdmin()) {
						$style = 'style="color:purple;"';
					}
					?>
					<tr>
						<td>
							Auteur : <span <?=$style?>> <?=$comment->getAuthor()?></span> <br><br>
							Contenu : <span> <?=$comment->getContent()?></span> <br><br>
							Nombre de signalement : <span> <?=$comment->getNbReport()?></span> - 
							<a href="Jean-Forteroche_admin.php?action=viewReports&amp;idComment=<?=$comment->getId()?>">Voir les signalement</a>
						</td>
						<td>
							<a href="Jean-Forteroche.php?action=article&amp;idArticle=<?=$comment->getIdArticle()?>&amp;idComment=<?=$comment->getId()?>">
								<i class="fas fa-eye"></i>
							</a>
						</td>
						<td>
							<a href="Jean-Forteroche_admin.php?action=moderate&amp;idComment=<?=$comment->getId()?>">
								<i class="fas fa-pencil-alt"></i>
							</a>
						</td>
						<td>
							<a href="Jean-Forteroche_admin.php?action=delete&amp;idComment=<?=$comment->getId()?>">
								<i class="fas fa-trash-alt"></i>
							</a>
						</td>
					</tr>
					<?php
				}
			echo '</table>';
		} else {
			echo '<p class="infoComment">Il n\'y a aucun commentaire à afficher.</p>';
		}
	echo '</section>';
}
