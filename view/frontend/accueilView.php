<?php

require('hero.php');

?>
<article id="articles" class="container">
	<section class="article">
		<?php
			if (!empty($data['article'])) {
				?>
				<h2>Dernier article publié :<br><?=$data['article']->getTitle()?></h2>

				<div class="articleContent">
					<?php
					if (strlen($data['article']->getContent()) > 500) {
						for ($i =0; $i<500; $i++) {
							echo $data['article']->getContent()[$i];
						}
						echo " ...";
					} else {
						echo $data['article']->getContent();
					}
					?>	
				</div>

				<p class="articleAuthor">
					<?=$data['article']->getAuthor()?>
				</p>

				<p class="articleDatePublication">
					Le <?=$data['article']->getDatePublication()?>
				</p>

				<?php
				if (!empty($data['article']->getDateEdit())) {
					echo '<p class="articleDateEdit"> Edité le ' . $data['article']->getDateEdit() . '</p>';
				}
				?>

				<p class="linkComment">
					<a href="Jean-Forteroche.php?action=article&amp;idArticle=<?=$data['article']->getId()?>">Lire l'article</a>
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
