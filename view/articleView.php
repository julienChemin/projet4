<?php

$Article = $ArticlesManager -> getArticle($_GET['id_article']);
$article = $Article -> fetch();

$Comments = $CommentsManager -> getComments($_GET['id_article']);

ob_start();

?>
<!--display article-->
<section id="articles" class="container">
	<div class="article full_width">
		<h2><?=$article['title']?></h2>
		<p class="article_content"><?=$article['content']?></p>
		<p class="article_author"><?=$article['author']?></p>
		<p class="article_date_publication">Le <?=$article['date_publication']?></p>
		<?php
		if(!empty($article['date_edit'])){
			echo '<p class="article_date_edit"> Edité le ' . $article['date_edit'] . '</p>';
		}
		?>
		<div class="info">
			Consulter <a href="Jean-Forteroche.php?action=listArticles">tout les articles</a>
		</div>
	</div>
</section>

<section id="comments" class="container">
	<!--display form to post comment-->
	<form method="POST" action="Jean-Forteroche.php?action=postComment">
		<h3>Poster un commentaire</h3>
		<p>
			<label for="post_comment_pseudo">Pseudo</label>
			<input type="text" name="post_comment_pseudo" id="post_comment_pseudo" placeholder="Votre pseudo" required="">
		</p>
		<p>
			<textarea name="post_comment_content" id="post_comment_content" placeholder="Votre commentaire" required=""></textarea>
			<input type="hidden" name="id_article" value="<?=$article['id']?>">
		</p>
		<p>
			<input type="submit" name="sumbit" id="submit" value="Envoyer">
		</p>
	</form>
	<!--display comments-->
	<?php
	if($comment = $Comments -> fetch()){
		do{
			?>
			<div class="comment full_width">
				<div class="info">
					<a href="Jean-Forteroche.php?action=report&amp;id_comment=<?=$comment['id']?>">Signaler</a>
				</div>
				<p class="comment_author"><?=$comment['author']?></p>
				<p class="comment_content"><?=$comment['content']?></p>
				<p class="comment_date_publication"><?=$comment['date_publication']?></p>
				<?php
				if(!empty($comment['date_edit']) && !empty($comment['author_edit'])){
					echo '<p class="comment_edit"> Edité le ' . $comment['date_edit'] . ' par ' . $comment['author_edit'] . '</p>';
				}
				?>
			</div>
			<?php
		}while($comment = $Comments -> fetch());
	}
	else{
		echo '<p class="infoComment">Il n\'y a aucun commentaire.</p>';
	}
	?>
</section>
<?php

$content = ob_get_clean();

$Article -> closeCursor();
$Comments -> closeCursor();

require('template.php');