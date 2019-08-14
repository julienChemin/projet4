<?php

ob_start();

if(isset($_SESSION)){
	if(isset($_POST['new_article_title']) && isset($_POST['tinyMCEtextarea'])){
		$ArticlesManager -> set(new Article([
			'author' => 'Jean-Forteroche', 'title' => $_POST['new_article_title'], 'content' => $_POST['tinyMCEtextarea']]));
			$message = 'L\'article a bien été publié.';
	}

	echo '<h1>Ajouter un article</h1>';

	if(isset($message)){
		echo '<p class="infoComment">' . $message . '</p>';
	}
	?>

	<section id="add_article" class="container">
		<form method="POST" action="Jean-Forteroche_admin.php?action=add">
			<p>
				<label for="new_article_title">Titre de l'article</label>
				<input type="text" name="new_article_title" id="new_article_title" required="">
			</p>
			<p>
				<textarea id="tinyMCEtextarea" name="tinyMCEtextarea" placeholder="Contenu de l'article"></textarea>
			</p>
			<p>
				<input type="submit" name="submit" value="Publier">
			</p>
		</form>
	</section>
	<?php
}
else{
	header('Location: Jean-Forteroche_admin.php');
}

$content = ob_get_clean();

require('view/template.php');