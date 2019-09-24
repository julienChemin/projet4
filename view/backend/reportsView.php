<?php

if (isset($_GET['idComment'])) {

	echo '<h1>Voir les signalements</h1>';
		
	//display list of report
	?>
	<section class="container" id="moderateReport">
		<?php
		if (isset($data['message'])) {
			echo '<p class="infoComment">' . $data['message'] . '</p>';
		}
		if (!empty($data['listReports'])) {
			?>
			<table class="fullWidth">
				<caption><h2>Liste des signalements</h2></caption>
				<tr>
					<th>Signalement</th>
					<th>Supprimer</th>
				</tr>
				<?php
				foreach ($data['listReports'] as $report) {
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
				}
			echo '</table>';
		} else {
			echo '<p class="infoComment">Il n\'y a aucun signalement à afficher.</p>';
		}
	echo '</section>';
} else {
	throw new Exception('Le commentaire spécifié est introuvable');
}
