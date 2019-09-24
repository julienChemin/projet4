<?php

namespace Chemin\Blog\Model;

class Frontend
{
	public function accueil()
	{
		$ArticlesManager = new ArticlesManager();

		$article = $ArticlesManager->getLastArticle();

		RenderView::render('template.php', 'frontend/accueilView.php', ['article' => $article]);
	}

	public function error(string $error_msg)
	{
		RenderView::render('template.php', 'frontend/errorView.php', ['error_msg' => $error_msg]);
	}

	public function listArticles()
	{
		$ArticlesManager = new ArticlesManager();

		$listArticles = $ArticlesManager->getArticles();

		RenderView::render('template.php', 'frontend/articlesView.php', ['listArticles' => $listArticles]);
	}

	public function article()
	{
		$ArticlesManager = new ArticlesManager();
		$CommentsManager = new CommentsManager();

		if ($ArticlesManager->exists($_GET['idArticle'])) {
			$article = $ArticlesManager->getOneById($_GET['idArticle']);
			$comments = $CommentsManager->getComments($_GET['idArticle']);

			RenderView::render('template.php', 'frontend/articleView.php', ['article' => $article, 'comments' => $comments]);
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

		$comment = $CommentsManager->getOneById($_GET['idComment']);
		if (empty($comment)) {
			throw new Exception('Le commentaire recherché n\'existe pas.');
		}

		if (isset($_POST['postReportPseudo']) && isset($_POST['postReportContent'])) {
			//post report
			$CommentsManager->setReport(
				$_GET['idComment'],
				htmlspecialchars($_POST['postReportPseudo']),
				htmlspecialchars($_POST['postReportContent']),
				$comment->getNbReport());
		}
		RenderView::render('template.php', 'frontend/reportView.php', ['comment' => $comment]);
	}	
}
