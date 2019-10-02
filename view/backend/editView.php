<?php

echo '<h1>Editer un article</h1>';

//message
if (isset($data['message'])) {
	echo '<p class="infoComment">' . $data['message'] . '</p>';
}

if (isset($_GET['idArticle'])) {
	if ($_GET['idArticle'] > 0) {
		//display form to edit article
		?>
		<section id="formAddEditArticle" class="container">
			<form method="POST" action="Jean-Forteroche_admin.php?action=edit">
				<p>
					<label for="editArticleTitle">Titre de l'article</label>
					<input type="text" name="editArticleTitle" id="editArticleTitle" value="<?=$data['article']->getTitle()?>" required="">
				</p>

				<p>
					<textarea id="tinyMCEtextarea" name="tinyMCEtextarea"><?=$data['article']->getContent()?></textarea>
				</p>

				<p>
					<input type="hidden" name="idArticle" id="idArticle" value="<?=$_GET['idArticle']?>">
					<input type="submit" name="submit" value="Editer">
				</p>
			</form>
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
			foreach ($data['listArticles'] as $article) {
				?>
				<tr>
					<td>
						<?=$article->getTitle()?>
					</td>

					<td>
						<a href="Jean-Forteroche.php?action=article&amp;idArticle=<?=$article->getId()?>">
							<i class="fas fa-eye"></i>
						</a>
					</td>

					<td>
						<a href="Jean-Forteroche_admin.php?action=edit&amp;idArticle=<?=$article->getId()?>">
							<i class="fas fa-pencil-alt"></i>
						</a>
					</td>

					<td>
						<a href="Jean-Forteroche_admin.php?action=delete&amp;idArticle=<?=$article->getId()?>">
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
