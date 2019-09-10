<article class="fullWidth">
	<section id="articles" class="container">
		<!--display article-->
		<div class="article">
			<h2><?=$data['article']->getTitle()?></h2>

			<div class="articleContent">
				<?=$data['article']->getContent()?>
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
				<input type="hidden" name="idArticle" value="<?=$data['article']->getId()?>">
			</p>

			<p>
				<input type="submit" name="submit" id="submit" value="Envoyer">
			</p>
		</form>

		<!--display comments-->
		<?php
		if (!empty($data['comments'])) {
			foreach ($data['comments'] as $comment) {
				//if comment's author is admin, display name in purple
				$nameStyle ="";
				if ($comment->getAuthorIsAdmin()) {
					$nameStyle = 'style="color:purple;"';
				}

				//if looking for reported comment, display border in red
				$borderStyle = "";
				if (isset($_GET['idComment']) && $_GET['idComment'] === $comment->getId()) {
					$borderStyle = 'style="border-color:red;"';
				}
				?>

				<div class="comment"<?=$borderStyle?>>
					<div class="info">
						<?php
						//display link "moderate" for admin or "report" for users
						if (isset($_SESSION['pseudo'])) {
							echo '<a href="Jean-Forteroche_admin.php?action=moderate&amp;idComment=' . $comment->getId() . '">Modérer</a>';
							echo ' / ';
							echo '<a href="Jean-Forteroche_admin.php?action=delete&amp;idComment=' . $comment->getId() . '">Supprimer</a>';
						} else {
							echo '<a href="Jean-Forteroche.php?action=report&amp;idComment=' . $comment->getId() . '">Signaler</a>';
						}
						?>
					</div>

					<p class="commentAuthor"<?=$nameStyle?>><?=$comment->getAuthor()?></p>

					<div class="commentContent"><?=$comment->getContent()?></div>

					<p class="commentDatePublication"><?=$comment->getDatePublication()?></p>

					<?php
					if (!empty($comment->getDateEdit()) && !empty($comment->getAuthorEdit())) {
						echo '<p class="commentEdit"> Edité le ' . $comment->getDateEdit() . ' par ' . $comment->getAuthorEdit() . '</p>';
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
