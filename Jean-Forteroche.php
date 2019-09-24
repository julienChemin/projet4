<?php

session_start();

use \Chemin\Blog\Model\Frontend;
use \Chemin\Blog\Model\Backend;
use \Chemin\Blog\Model\ArticlesManager;
use \Chemin\Blog\Model\CommentsManager;
use \Chemin\Blog\Model\Article;
use \Chemin\Blog\Model\Comment;
use \Chemin\Blog\Model\RenderView;
use \Chemin\Blog\Model\UserManager;

spl_autoload_register(function($class)
{
	$arr = str_split($class, 18);
	$nameClass = $arr[1];
	
	if ($nameClass === 'Frontend' || $nameClass === 'Backend') {
		require 'controller/' . $nameClass . '.php';
	} else {
		require 'model/' . $nameClass . '.php';
	}
});

$frontend = new Frontend();

/*---------------------------------*/

try {
	if (isset($_GET['action'])) {
		switch ($_GET['action']) {
			case 'listArticles' :
				//list all articles
				$frontend->listArticles();
				break;
			case 'article' :
				//display one article
				if (isset($_GET['idArticle']) && $_GET['idArticle'] > 0) {
					$frontend->article();
				} else {
					throw new Exception('L\'article est introuvable.');
				}
				break;
			case 'postComment' :
				//post a comment
				if (isset($_POST['postCommentPseudo']) && isset($_POST['postCommentContent']) && isset($_POST["idArticle"])) {
					$frontend->postComment();
				} else {
					throw new Exception('Le formulaire doit etre remplit.');
				}
				break;
			case 'report' :
				//form for report
				if (isset($_GET['idComment']) && $_GET['idComment'] > 0) {
					$frontend->report();
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
		$frontend->accueil();
	}
} catch (Exception $e) {
	$frontend->error($e->getMessage());
}