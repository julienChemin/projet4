<?php

ob_start();

if(isset($_SESSION)){

	echo '<h1>Editer un article</h1>';

	if(isset($_POST['id_article']) && isset($_POST['edit_article_title']) && isset($_POST['tinyMCEtextarea'])){
		//edit article
		$ArticlesManager -> update(new Article([
			'author_edit' => 'Jean-Forteroche', 
			'title' => $_POST['edit_article_title'], 
			'content' => $_POST['tinyMCEtextarea'],
			'id' => $_POST['id_article']]));

			$message = 'L\'article a bien été édité.';
	}

	//message
	if(isset($message)){
		echo '<p class="infoComment">' . $message . '</p>';
	}

	if(isset($_GET['id_article'])){
		if($_GET['id_article'] > 0){
			//display form to edit article
			$Article = $ArticlesManager -> getArticle($_GET['id_article']);
			$article = $Article -> fetch();

			?>
			<section id="form_add_edit_article" class="container">
				<form method="POST" action="Jean-Forteroche_admin.php?action=edit">
					<p>
						<label for="edit_article_title">Titre de l'article</label>
						<input type="text" name="edit_article_title" id="edit_article_title" value="<?=$article['title']?>" required="">
					</p>
					<p>
						<textarea id="tinyMCEtextarea" name="tinyMCEtextarea"></textarea>
					</p>
					<p>
						<input type="hidden" name="content" id="content" value='<?=$article['content']?>'>
						<input type="hidden" name="id_article" id="id_article" value="<?=$_GET['id_article']?>">
						<input type="submit" name="submit" value="Editer">
					</p>
				</form>
			</section>
			<?php

			$Article -> closeCursor();
		}
		else{
			throw new Exception('L\'article spécifié est introuvable');
		}
	}
	else{
		//display list of articles
		$Articles = $ArticlesManager -> getArticles();

		?>
		<section class="container" id="edit_articles">
			<table class="full_width">
				<caption><h2>Liste des articles</h2></caption>
				<tr>
					<th>Titre</th>
					<th>Voir</th>
					<th>Editer</th>
					<th>Supprimer</th>
				</tr>
			
				<?php
				while($Article = $Articles -> fetch()){
					?>
					<tr>
						<td><?=$Article['title']?></td>
						<td><a href="Jean-Forteroche.php?action=article&amp;id_article=<?=$Article['id']?>"><i class="fas fa-eye"></i></a></td>
						<td><a href="Jean-Forteroche_admin.php?action=edit&amp;id_article=<?=$Article['id']?>"><i class="fas fa-pencil-alt"></i></a></td>
						<td><a href="Jean-Forteroche_admin.php?action=delete&amp;id_article=<?=$Article['id']?>"><i class="fas fa-trash-alt"></i></a></td>
					</tr>
					<?php
				}
				?>

			</table>
		</section>
		<?php

		$Articles -> closeCursor();
	}
}
else{
	header('Location: Jean-Forteroche_admin.php');
}

$content = ob_get_clean();

require('view/template.php');