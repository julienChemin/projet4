<?php

$ListArticles = $ArticlesManager -> getArticles();

ob_start();

?>
<!--display article-->
<h1>Tout les articles</h1>
<section id="articles" class="container">

<?php
while($article = $ListArticles -> fetch()){
	?>
	<div class="article">
		<h2><?=$article['title']?></h2>
		<div class="article_content">
			<?php
			if(strlen($article['content']) > 150){
				for($i =0; $i<150; $i++){
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
	<?php
}
?>
</section>
<?php

$content = ob_get_clean();
$ListArticles -> closeCursor();

require('view/template.php');