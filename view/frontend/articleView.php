<?php

ob_start();

?>

<article class="fullWidth">
	<section id="articles" class="container">
		<!--display article-->
		<div class="article">
			<h2><?=$article['title']?></h2>

			<div class="articleContent">
				<?=$article['content']?>
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
				<label for="postCommentPseudo">Pseudo</label>
				<input type="text" name="postCommentPseudo" id="postCommentPseudo" placeholder="Votre pseudo" required="">
			</p>

			<p>
				<textarea name="postCommentContent" id="postCommentContent" placeholder="Votre commentaire" required=""></textarea>
				<input type="hidden" name="idArticle" value="<?=$article['id']?>">
			</p>

			<p>
				<input type="submit" name="submit" id="submit" value="Envoyer">
			</p>
		</form>

		<!--display comments-->
		<?php
		if (!empty($comments)) {
			foreach ($comments as $comment) {
				//if comment's author is admin, display name in purple
				$nameStyle ="";
				if ($comment['authorIsAdmin']) {
					$nameStyle = 'style="color:purple;"';
				}

				//if looking for reported comment, display border in red
				$borderStyle = "";
				if (isset($_GET['idComment']) && $_GET['idComment'] === $comment['id']) {
					$borderStyle = 'style="border-color:red;"';
				}
				?>

				<div class="comment"<?=$borderStyle?>>
					<div class="info">
						<?php
						//display link "moderate" for admin or "report" for users
						if (isset($_SESSION['pseudo'])) {
							echo '<a href="Jean-Forteroche_admin.php?action=moderate&amp;idComment=' . $comment['id'] . '">Modérer</a>';
							echo ' / ';
							echo '<a href="Jean-Forteroche_admin.php?action=delete&amp;idComment=' . $comment['id'] . '">Supprimer</a>';
						} else {
							echo '<a href="Jean-Forteroche.php?action=report&amp;idComment=' . $comment['id'] . '">Signaler</a>';
						}
						?>
					</div>

					<p class="commentAuthor"<?=$nameStyle?>><?=$comment['author']?></p>

					<div class="commentContent"><?=$comment['content']?></div>

					<p class="commentDatePublication"><?=$comment['datePublication']?></p>

					<?php
					if (!empty($comment['dateEdit']) && !empty($comment['authorEdit'])) {
						echo '<p class="commentEdit"> Edité le ' . $comment['dateEdit'] . ' par ' . $comment['authorEdit'] . '</p>';
					}
				echo '</div>';
			}
		} else {
			echo '<p class="infoComment">Il n\'y a aucun commentaire.</p>';
		}
		?>
	</section>
</article>
<?php

$content = ob_get_clean();

require('view/template.php');
