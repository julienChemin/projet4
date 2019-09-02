<?php

session_start();

function chargerClass($class)
{
	require 'model/' . $class . '.php';
}
spl_autoload_register('chargerClass');

require('controller/frontend.php');

/*---------------------------------*/

try {
	if (isset($_GET['action'])) {
		switch ($_GET['action']) {
			case 'listArticles' :
				//list all articles
				listArticles();
				break;
			case 'article' :
				//display one article
				if (isset($_GET['idArticle']) && $_GET['idArticle'] > 0) {
					article();
				} else {
					throw new Exception('L\'article est introuvable.');
				}
				break;
			case 'postComment' :
				//post a comment
				if (isset($_POST['postCommentPseudo']) && isset($_POST['postCommentContent']) && isset($_POST["idArticle"])) {
					postComment();
				} else {
					throw new Exception('Le formulaire doit etre remplit.');
				}
				break;
			case 'report' :
				//form for report
				if (isset($_GET['idComment']) && $_GET['idComment'] > 0) {
					report();
				} else {
					throw new Exception('Le commentaire est introuvable');
				}
				break;
			default :
				//"action" value is unknow
				throw new Exception('L\'action renseignée est inexistante.');
		}
	} else {
		//"action" undefined -> home
		accueil();
	}
} catch (Exception $e) {
	error($e->getMessage());
}