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

$backend = new Backend();

/*---------------------------------*/

try {
	if (isset($_SESSION['pseudo']) && isset($_GET['action'])) {
		switch ($_GET['action']) {
			case 'disconnect' :
				//disconnect
				$backend->disconnect();
				break;
			case 'add' :
				//add article
				$backend->add();
				break;
			case 'edit' :
				//edit articles
				$backend->edit();
				break;
			case 'delete' :
				//delete article
				$backend->delete();
				break;
			case 'moderate' :
				//moderate comments
				$backend->moderate();
				break;
			case 'viewReports' :
				//moderate reports
				$backend->viewReports();
				break;
			default :
				throw new Exception('L\'action renseignée est inexistante.');
		}
	} else {
		//"action" undefined -> home
		$backend->accueilAdmin();
	}
} catch (Exception $e) {
	$backend->error($e->getMessage());
}
