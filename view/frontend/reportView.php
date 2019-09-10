<?php

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
		if ($data['comment']->getAuthorIsAdmin()) {
			$style = 'style="color:purple;"';
		}
	?>

	<section id="comments" class="container">
		<div class="comment">
			<p class="commentAuthor"<?=$style?>>
				<?=$data['comment']->getAuthor()?>
			</p>

			<p class="commentContent">
				<?=$data['comment']->getContent()?>
			</p>

			<p class="commentDatePublication">
				<?=$data['comment']->getDatePublication()?>
			</p>

			<?php
			if (!empty($data['comment']->getDateEdit()) && !empty($data['comment']->getAuthorEdit())) {
				echo '<p class="commentEdit"> Edité le ' . $data['comment']->getDateEdit() . ' par ' . $data['comment']->getAuthorEdit() . '</p>';
			}
			?>
		</div>
	</section>
	
	<?php
}
