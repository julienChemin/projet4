<?php

ob_start();

$Comment = $CommentsManager -> getComment($_GET['id_comment']);

if($comment = $Comment -> fetch()){
	if(isset($_POST['post_report_pseudo']) && isset($_POST['post_report_content'])){
		//post report
		$CommentsManager -> report($_GET['id_comment'], htmlspecialchars($_POST['post_report_pseudo']), htmlspecialchars($_POST['post_report_content']), $comment['nb_report']);

		?>
		<section id="msg" class="container">
			<span>Le commentaire a été signalé.</span>
			<br>
			<a href="Jean-Forteroche.php?action=listArticles">Retourner sur la liste des articles</a>
		</section>
		<?php
	}
	else{
		//display form to post report
		?>
		<h1>Signaler un commentaire</h1>
		<form method="POST" action="Jean-Forteroche.php?action=report&amp;id_comment=<?=$_GET['id_comment']?>">
			<h2>Merci d'indiquer la raison pour laquelle vous signalez ce commentaire</h2>
			<p>
				<label for="post_report_pseudo">Pseudo</label>
				<input type="text" name="post_report_pseudo" id="post_report_pseudo" placeholder="Votre pseudo" required="">
			</p>
			<p>
				<textarea name="post_report_content" id="post_report_content" placeholder="Votre commentaire" required=""></textarea>
			</p>
			<p>
				<input type="submit" name="sumbit" id="submit" value="Signaler">
			</p>
		</form>
		<?php

		//display comment to report
		?>
		<section id="comments" class="container">
			<div class="comment full_width">
				<p class="comment_author"><?=$comment['author']?></p>
				<p class="comment_content"><?=$comment['content']?></p>
				<p class="comment_date_publication"><?=$comment['date_publication']?></p>
				<?php
				if(!empty($comment['date_edit']) && !empty($comment['author_edit'])){
					echo '<p class="comment_edit"> Edité le ' . $comment['date_edit'] . ' par ' . $comment['author_edit'] . '</p>';
				}
				?>
			</div>
		</section>
		<?php
	}
}
else{
	throw new Exception('Le commentaire recherché n\'existe pas.');
}

$content = ob_get_clean();

$Comment -> closeCursor();

require('template.php');