<?php

class Frontend
{
	public function accueil()
	{
		$ArticlesManager = new ArticlesManager();

		$lastArticle = $ArticlesManager->getLastArticle();
		$article = $lastArticle->fetchObject('Article');

		RenderView::render('template.php', 'frontend/accueilView.php', ['article' => $article]);

		$lastArticle->closeCursor();
	}

	public function error(string $error_msg)
	{
		RenderView::render('template.php', 'frontend/errorView.php', ['error_msg' => $error_msg]);
	}

	public function listArticles()
	{
		$ArticlesManager = new ArticlesManager();

		$queryArticles = $ArticlesManager->getArticles();
		$listArticles = $queryArticles->fetchAll(PDO::FETCH_CLASS, 'Article');

		RenderView::render('template.php', 'frontend/articlesView.php', ['listArticles' => $listArticles]);

		$queryArticles->closeCursor();
	}

	public function article()
	{
		$ArticlesManager = new ArticlesManager();
		$CommentsManager = new CommentsManager();

		if ($ArticlesManager->exists($_GET['idArticle'])) {
			$queryArticle = $ArticlesManager->getOneById($_GET['idArticle']);
			$article = $queryArticle->fetchObject('Article');

			$queryComments = $CommentsManager->getComments($_GET['idArticle']);
			$comments=$queryComments->fetchAll(PDO::FETCH_CLASS, 'Comment');

			RenderView::render('template.php', 'frontend/articleView.php', ['article' => $article, 'comments' => $comments]);

			$queryComments->closeCursor();
		} else {
			throw new Exception('L\'article indiqué n\'existe pas.');
		}
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
		$comment = $queryComment->fetchObject('Comment');
		if (empty($comment)) {
			throw new Exception('Le commentaire recherché n\'existe pas.');
		}

		if (isset($_POST['postReportPseudo']) && isset($_POST['postReportContent'])) {
			//post report
			$CommentsManager->setReport($_GET['idComment'], htmlspecialchars($_POST['postReportPseudo']),
				htmlspecialchars($_POST['postReportContent']), $comment->getNbReport());
		}

		RenderView::render('template.php', 'frontend/reportView.php', ['comment' => $comment]);

		$queryComment->closeCursor();
	}	
}
