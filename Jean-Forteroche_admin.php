<?php

session_start();

if (!isset($_SESSION['pseudo']) && isset($_COOKIE['admin'])) {
	$_SESSION['pseudo'] = $_COOKIE['admin'];
}

function chargerClass($class)
{
	require 'model/' . $class . '.php';
}
spl_autoload_register('chargerClass');

require('controller/frontend.php');
require('controller/backend.php');

/*---------------------------------*/

try {
	if (isset($_SESSION['pseudo']) && isset($_GET['action'])) {
		switch ($_GET['action']) {
			case 'listArticles' :
				//list all articles
				listArticles();
				break;
			case 'article' :
				//display one article
				//$_GET['id_article'] = (int) $_GET['id_article']; //////////////////
				if (isset($_GET['idArticle']) && $_GET['idArticle'] > 0) {
					article();
				} else {
					throw new Exception('L\'article est introuvable.');
				}
				break;
			case 'postComment' :
				//post a comment
				if (isset($_POST['postCommentPseudo']) && isset($_POST['postCommentContent'])) {
					postComment();
				} else {
					throw new Exception('Le formulaire doit etre remplit.');
				}
				break;
			case 'disconnect' :
				//disconnect
				disconnect();
				break;
			case 'add' :
				//add article
				add();
				break;
			case 'edit' :
				//edit articles
				edit();
				break;
			case 'delete' :
				//delete article
				delete();
				break;
			case 'moderate' :
				//moderate comments
				moderate();
				break;
			case 'viewReports' :
				//moderate reports
				viewReports();
				break;
			default :
				throw new Exception('L\'action renseignée est inexistante.');
		}
	} else {
		//"action" undefined -> home
		accueilAdmin();
	}
} catch (Exception $e) {
	error($e->getMessage());
}
