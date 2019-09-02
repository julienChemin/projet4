<?php

ob_start();

require('hero.php');

?>
<article id="articles" class="container">
	<section class="article">
		<?php
			if (!empty($article)) {
				?>
				<h2>Dernier article publié :<br><?=$article['title']?></h2>

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
				<?php
			} else {
				echo '<p class="infoComment">Il n\'y a aucun article a afficher pour l\'instant.</p>';
			}
		?>
	</section>

	<div class="info">
		Consulter <a href="Jean-Forteroche.php?action=listArticles">tout les articles</a>
	</div>
</article>
<?php

$content = ob_get_clean();

require('view/template.php');
