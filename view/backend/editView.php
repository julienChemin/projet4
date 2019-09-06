<?php

ob_start();

if (isset($_SESSION['pseudo'])) {

	echo '<h1>Editer un article</h1>';

	//message
	if (isset($message)) {
		echo '<p class="infoComment">' . $message . '</p>';
	}

	if (isset($_GET['idArticle'])) {
		if ($_GET['idArticle'] > 0) {
			//display form to edit article
			?>
			<section id="formAddEditArticle" class="container">
				<form method="POST" action="Jean-Forteroche_admin.php?action=edit">
					<p>
						<label for="editArticleTitle">Titre de l'article</label>
						<input type="text" name="editArticleTitle" id="editArticleTitle" value="<?=$article['title']?>" required="">
					</p>

					<p>
						<textarea id="tinyMCEtextarea" name="tinyMCEtextarea"></textarea>
					</p>

					<p>
						<input type="hidden" name="idArticle" id="idArticle" value="<?=$_GET['idArticle']?>">
						<input type="submit" name="submit" value="Editer">
					</p>
				</form>

				<div id="content">
					<?=$article['content']?>
				</div>
			</section>

			<?php
		} else {
			throw new Exception('L\'article spécifié est introuvable');
		}
	} else {
		//display list of articles
		?>
		<section class="container" id="editArticles">
			<table class="fullWidth">
				<caption><h2>Liste des articles</h2></caption>
				<tr>
					<th>Titre</th>
					<th>Voir</th>
					<th>Editer</th>
					<th>Supprimer</th>
				</tr>
			
				<?php
				foreach ($Articles as $article) {
					?>
					<tr>
						<td>
							<?=$article['title']?>
						</td>

						<td>
							<a href="Jean-Forteroche.php?action=article&amp;idArticle=<?=$article['id']?>">
								<i class="fas fa-eye"></i>
							</a>
						</td>

						<td>
							<a href="Jean-Forteroche_admin.php?action=edit&amp;idArticle=<?=$article['id']?>">
								<i class="fas fa-pencil-alt"></i>
							</a>
						</td>

						<td>
							<a href="Jean-Forteroche_admin.php?action=delete&amp;idArticle=<?=$article['id']?>">
								<i class="fas fa-trash-alt"></i>
							</a>
						</td>
					</tr>
					<?php
				}
				?>
			</table>
		</section>

		<?php
	}
} else {
	header('Location: Jean-Forteroche_admin.php');
}

$content = ob_get_clean();

require('view/template.php');
