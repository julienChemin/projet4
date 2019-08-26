<?php

ob_start();

if(isset($_SESSION['pseudo'])){
	if(isset($_GET['id_comment'])){

		echo '<h1>Voir les signalements</h1>';

		if(isset($_GET['id_report'])){
			if($_GET['id_report'] > 0){
				//delete report
				$CommentsManager -> deleteReport($_GET['id_report'], $_GET['id_comment']);
			}
			else{
				throw new Exception('Le signalement spécifié est introuvable');
			}
		}
		
		//display list of report
		$Reports = $CommentsManager -> getReportsFromComment($_GET['id_comment']);

		?>
		<section class="container" id="moderate_report">
			<?php
			if($report = $Reports -> fetch()){
				?>
				<table class="full_width">
				<caption><h2>Liste des signalements</h2></caption>
				<tr>
					<th>Signalement</th>
					<th>Supprimer</th>
				</tr>
				<?php
				do{
					?>
					<tr>
						<td>
							Auteur : <span><?=$report['author']?></span> <br><br>
							Contenu : <span> <?=$report['content']?></span>
						</td>
						<td>
							<a href="Jean-Forteroche_admin.php?action=viewReports&amp;id_comment=<?=$_GET['id_comment']?>&amp;id_report=<?=$report['id']?>">
								<i class="fas fa-trash-alt"></i>
							</a>
						</td>
					</tr>
					<?php
				}while($report = $Reports -> fetch());

				echo '</table>';
			}
			else{
				echo '<p class="infoComment">Il n\'y a aucun signalement à afficher.</p>';
			}

			echo '</section>';

		$Reports -> closeCursor();
	}
	else{
		throw new Exception('Le commentaire spécifié est introuvable');
	}
}
else{
	header('Location: Jean-Forteroche_admin.php');
}

$content = ob_get_clean();

require('view/template.php');