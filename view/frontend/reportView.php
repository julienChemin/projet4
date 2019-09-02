<?php

ob_start();

if (isset($_POST['postReportPseudo']) && isset($_POST['postReportContent'])) {
	//post report
	?>

	<section id="msg" class="container">
		<span>Le commentaire a été signalé.</span>
		<br>
		<a href="Jean-Forteroche.php?action=listArticles">Retourner sur la liste des articles</a>
	</section>

	<?php
} else {
	//display form to post report
	?>

	<h1>Signaler un commentaire</h1>

	<form method="POST" action="Jean-Forteroche.php?action=report&amp;idComment=<?=$_GET['idComment']?>">
		<h2>Merci d'indiquer la raison pour laquelle vous signalez ce commentaire</h2>

		<p>
			<label for="postReportPseudo">Pseudo</label>
			<input type="text" name="postReportPseudo" id="postReportPseudo" placeholder="Votre pseudo" required="">
		</p>

		<p>
			<textarea name="postReportContent" id="postReportContent" placeholder="Votre commentaire" required=""></textarea>
		</p>

		<p>
			<input type="submit" name="submit" id="submit" value="Signaler">
		</p>
	</form>

	<?php
	//display comment to report
	//if comment's author is admin, display name in purple
		$style ="";
		if ($comment['authorIsAdmin']) {
			$style = 'style="color:purple;"';
		}
	?>

	<section id="comments" class="container">
		<div class="comment">
			<p class="commentAuthor"<?=$style?>>
				<?=$comment['author']?>
			</p>

			<p class="commentContent">
				<?=$comment['content']?>
			</p>

			<p class="commentDatePublication">
				<?=$comment['datePublication']?>
			</p>

			<?php
			if (!empty($comment['dateEdit']) && !empty($comment['authorEdit'])) {
				echo '<p class="commentEdit"> Edité le ' . $comment['dateEdit'] . ' par ' . $comment['authorEdit'] . '</p>';
			}
			?>
		</div>
	</section>
	
	<?php
}

$content = ob_get_clean();

require('view/template.php');
