<?php

function accueil()
{
	$ArticlesManager = new ArticlesManager();

	$lastArticle = $ArticlesManager->getLastArticle();
	$article = $lastArticle->fetch();

	require('view/frontend/accueilView.php');

	$lastArticle->closeCursor();
}

function error(string $error_msg)
{
	if (empty($error_msg)) {
		$error_msg = 'Une erreur inconnu est survenue, merci de réessayer.'; 
	}
	$message = $error_msg;
	require('view/frontend/errorView.php');
}

function listArticles()
{
	$ArticlesManager = new ArticlesManager();

	$listArticles = $ArticlesManager->getArticles();

	require('view/frontend/articlesView.php');

	$listArticles->closeCursor();
}

function article()
{
	$ArticlesManager = new ArticlesManager();
	$CommentsManager = new CommentsManager();

	$queryArticle = $ArticlesManager->getArticle($_GET['idArticle']);
	$article = $queryArticle->fetch();
	if (empty($article)) {
		throw new Exception('L\'article indiqué n\'existe pas.');
	}

	$comments = $CommentsManager->getComments($_GET['idArticle']);

	require('view/frontend/articleView.php');

	$queryArticle->closeCursor();
	$comments->closeCursor();
}

function postComment()
{
	$CommentsManager = new CommentsManager();
	
	require('view/frontend/postComment.php');

	$CommentsManager->set($newComment);

	header('Location: Jean-Forteroche.php?action=article&idArticle=' . $_POST["idArticle"]);
}

function report()
{
	$CommentsManager = new CommentsManager();

	$queryComment = $CommentsManager->getComment($_GET['idComment']);
	$comment = $queryComment->fetch();
	if (empty($comment)) {
		throw new Exception('Le commentaire recherché n\'existe pas.');
	}

	if (isset($_POST['postReportPseudo']) && isset($_POST['postReportContent'])) {
		//post report
		$CommentsManager->setReport($_GET['idComment'], htmlspecialchars($_POST['postReportPseudo']),
			htmlspecialchars($_POST['postReportContent']), $comment['nbReport']);
	}

	require('view/frontend/reportView.php');

	$queryComment->closeCursor();
}
