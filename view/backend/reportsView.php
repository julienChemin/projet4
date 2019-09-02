<?php

ob_start();

if (isset($_SESSION['pseudo'])) {
	if (isset($_GET['idComment'])) {

		echo '<h1>Voir les signalements</h1>';

		if (isset($_GET['idReport'])) {
			if ($_GET['idReport'] > 0) {
				//delete report
				$CommentsManager->deleteReport($_GET['idReport'], $_GET['idComment']);
			} else {
				throw new Exception('Le signalement spécifié est introuvable');
			}
		}
		
		//display list of report
		$Reports = $CommentsManager->getReportsFromComment($_GET['idComment']);

		?>
		<section class="container" id="moderateReport">
			<?php
			if ($report = $Reports->fetch()) {
				?>
				<table class="fullWidth">
					<caption><h2>Liste des signalements</h2></caption>
					<tr>
						<th>Signalement</th>
						<th>Supprimer</th>
					</tr>
					<?php
					do {
						?>
						<tr>
							<td>
								Auteur : <span><?=$report['author']?></span>
								<br>
								<br>
								Contenu : <span> <?=$report['content']?></span>
							</td>
							<td>
								<a href="Jean-Forteroche_admin.php?action=viewReports&amp;idComment=<?=$_GET['idComment']?>&amp;idReport=<?=$report['id']?>">
									<i class="fas fa-trash-alt"></i>
								</a>
							</td>
						</tr>
						<?php
					} while ($report = $Reports->fetch());
				echo '</table>';
			} else {
				echo '<p class="infoComment">Il n\'y a aucun signalement à afficher.</p>';
			}
			echo '</section>';

		$Reports->closeCursor();
	} else {
		throw new Exception('Le commentaire spécifié est introuvable');
	}
} else {
	header('Location: Jean-Forteroche_admin.php');
}

$content = ob_get_clean();

require('view/template.php');
