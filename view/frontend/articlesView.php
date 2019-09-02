<?php

ob_start();

?>

<h1>Tout les articles</h1>

<article id="articles" class="container">
	<?php
	if (!empty($listArticles)) {
		foreach ($listArticles as $article) {
			//display articles
			?>
			<section class="article">
				<h2><?=$article['title']?></h2>

				<div class="articleContent">
					<?php
					if (strlen($article['content']) > 500) {
						for ($i =0; $i<500; $i++) {
							echo $article['content'][$i];
						}
						echo " ...";
					} else {
						echo $article['content'];
					}
					?>	
				</div>

				<p class="articleAuthor">
					<?=$article['author']?>
				</p>

				<p class="articleDatePublication">
					Le <?=$article['datePublication']?>
				</p>

				<?php
				if (!empty($article['dateEdit'])) {
					echo '<p class="articleDateEdit"> Edité le ' . $article['dateEdit'] . '</p>';
				}
				?>

				<p class="linkComment">
					<a href="Jean-Forteroche.php?action=article&amp;idArticle=<?=$article['id']?>">Lire l'article</a>
				</p>
			</section>
			<?php
		}
	} else {
		echo '<p class="infoComment">Il n\'y a aucun article a afficher pour l\'instant.</p>';
	}
echo '</article>';

$content = ob_get_clean();

require('view/template.php');
