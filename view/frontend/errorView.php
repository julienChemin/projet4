<?php

ob_start();

?>

<section id="msg" class="container">
	<h1>Une erreur est survenue : </h1>
	<br>
	<span><?=$message?></span>	
</section>

<?php

$content = ob_get_clean();

require('view/template.php');
