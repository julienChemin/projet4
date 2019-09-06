<?php

ob_start();

if (empty($error_msg)) {
		$error_msg = 'Une erreur inconnu est survenue, merci de réessayer.'; 
	}
	$message = $error_msg;

?>

<section id="msg" class="container">
	<h1>Une erreur est survenue : </h1>

	<br>
	
	<span><?=$message?></span>	
</section>

<?php

$content = ob_get_clean();

require('view/template.php');
