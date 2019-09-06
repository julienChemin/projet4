<?php

class Frontend
{
	public function accueil()
	{
		$ArticlesManager = new ArticlesManager();

		$lastArticle = $ArticlesManager->getLastArticle();
		$article = $lastArticle->fetch();

		RenderView::render('template.php', 'frontend/accueilView.php', ['article' => $article]);
		//require('view/frontend/accueilView.php');

		$lastArticle->closeCursor();
	}

	public function error(string $error_msg)
	{
		require('view/frontend/errorView.php');
	}

	public function listArticles()
	{
		$ArticlesManager = new ArticlesManager();

		$listArticles = $ArticlesManager->getArticles();

		require('view/frontend/articlesView.php');

		$listArticles->closeCursor();
	}

	public function article()
	{
		$ArticlesManager = new ArticlesManager();
		$CommentsManager = new CommentsManager();

		$queryArticle = $ArticlesManager->getOneById($_GET['idArticle']);
		$article = $queryArticle->fetch();
		if (empty($article)) {
			throw new Exception('L\'article indiqué n\'existe pas.');
		}

		$comments = $CommentsManager->getComments($_GET['idArticle']);

		require('view/frontend/articleView.php');

		$comments->closeCursor();
	}

	public function postComment()
	{
		$CommentsManager = new CommentsManager();
		
		require('view/frontend/postComment.php');

		$CommentsManager->set($newComment);

		header('Location: Jean-Forteroche.php?action=article&idArticle=' . $_POST["idArticle"]);
	}

	public function report()
	{
		$CommentsManager = new CommentsManager();

		$queryComment = $CommentsManager->getOneById($_GET['idComment']);
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
}
