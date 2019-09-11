<?php

if (isset($_SESSION['pseudo'])) {
	
	echo '<h1>Ajouter un article</h1>';

	//message
	if (isset($message)) {
		echo '<p class="infoComment">' . $message . '</p>';
	}
	?>

	<!--form to add article-->
	<section id="formAddEditArticle" class="container">
		<form method="POST" action="Jean-Forteroche_admin.php?action=add">
			<p>
				<label for="newArticleTitle">Titre de l'article</label>
				<input type="text" name="newArticleTitle" id="newArticleTitle" required="">
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
} else {
	header('Location: Jean-Forteroche_admin.php');
}
