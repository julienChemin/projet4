<?php

$Comments = $CommentsManager -> getMostReportedComments();

ob_start();



$content = ob_get_clean();

$Comments -> closeCursor();

require('view/template.php');