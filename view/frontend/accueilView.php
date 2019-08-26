<?php

$LastArticle = $ArticlesManager -> getLastArticle();
$article = $LastArticle -> fetch();

ob_start();

require('hero.php');

?>
<section id="articles" class="container">
	<div class="article">
		<h2>Dernier article publié :<br><?=$article['title']?></h2>
		<div class="article_content">
			<?php
			if(strlen($article['content']) > 500){
				for($i =0; $i<500; $i++){
					echo $article['content'][$i];
				}
				echo " ...";
			}
			else{
				echo $article['content'];
			}
			?>	
		</div>
		<p class="article_author"><?=$article['author']?></p>
		<p class="article_date_publication">Le <?=$article['date_publication']?></p>
		<?php
		if(!empty($article['date_edit'])){
			echo '<p class="article_date_edit"> Edité le ' . $article['date_edit'] . '</p>';
		}
		?>
		<p class="link_comment"><a href="Jean-Forteroche.php?action=article&amp;id_article=<?=$article['id']?>">Lire l'article</a></p>
	</div>

	<div class="info">
		Consulter <a href="Jean-Forteroche.php?action=listArticles">tout les articles</a>
	</div>
</section>
<?php

$content = ob_get_clean();
$LastArticle -> closeCursor();

require('view/template.php');