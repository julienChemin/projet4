<h1>Tout les articles</h1>

<article id="articles" class="container">
	<?php
	if (!empty($data['listArticles'])) {
		foreach ($data['listArticles'] as $article) {
			//display articles
			?>
			<section class="article">
				<h2><?=$article->getTitle()?></h2>

				<div class="articleContent">
					<?php
					if (strlen($article->getContent()) > 500) {
						for ($i =0; $i<500; $i++) {
							echo $article->getContent()[$i];
						}
						echo " ...";
					} else {
						echo $article->getContent();
					}
					?>	
				</div>

				<p class="articleAuthor">
					<?=$article->getAuthor()?>
				</p>

				<p class="articleDatePublication">
					Le <?=$article->getDatePublication()?>
				</p>

				<?php
				if (!empty($article->getDateEdit())) {
					echo '<p class="articleDateEdit"> Edité le ' . $article->getDateEdit() . '</p>';
				}
				?>

				<p class="linkComment">
					<a href="Jean-Forteroche.php?action=article&amp;idArticle=<?=$article->getId()?>">Lire l'article</a>
				</p>
			</section>
			<?php
		}
	} else {
		echo '<p class="infoComment">Il n\'y a aucun article a afficher pour l\'instant.</p>';
	}
echo '</article>';
