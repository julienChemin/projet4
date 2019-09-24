<?php

namespace Chemin\Blog\Model;

class Backend
{
	public static $isConnected = false;

	public function __construct()
	{
		if (isset($_SESSION['pseudo'])) {
			static::$isConnected = true;
		} elseif (isset($_COOKIE['admin'])) {
			$_SESSION['pseudo'] = $_COOKIE['admin'];
			static::$isConnected = true;
		} else {
			if (isset($_GET['action'])) {
				header('Location: Jean-Forteroche_admin.php');
			}
		}
	}

	public function accueilAdmin()
	{
		//if user is not connected and try to connect
		if (isset($_POST['postConnectPseudo']) && isset($_POST['postConnectPassword'])) {
			$UserManager = new UserManager();

			$userExist = $UserManager->exists($_POST['postConnectPseudo']);
			$passwordIsOk = $UserManager->checkPassword($_POST['postConnectPseudo'], $_POST['postConnectPassword']);

			if ($userExist) {
				if ($passwordIsOk) {
					if (isset($_POST['stayConnect'])) {
						//if user want to stay connect
						setcookie('admin', $_POST['postConnectPseudo'], time()+(365*24*3600), null, null, false, true);
					}
					$_SESSION['pseudo'] = $_POST['postConnectPseudo'];
					header('Location: Jean-Forteroche_admin.php');
				} else {
					$message = 'Le mot de passe est incorrecte';
				}
			} else {
				$message = 'L\'identifiant est incorrecte';
			}
		}

		if (isset($message)) {
			RenderView::render('template.php', 'backend/accueilAdminView.php', ['message' => $message]);
		} else {
			RenderView::render('template.php', 'backend/accueilAdminView.php');
		}
	}

	public function error(string $error_msg)
	{
		RenderView::render('template.php', 'frontend/errorView.php', ['error_msg' => $error_msg]);
	}

	public function disconnect()
	{
		require('view/backend/disconnect.php');

		header('Location: Jean-Forteroche_admin.php');
	}

	public function add()
	{
		$ArticlesManager = new ArticlesManager();

		if (isset($_POST['newArticleTitle']) && isset($_POST['tinyMCEtextarea'])) {
			//add article
			$ArticlesManager->set(new Article([
				'author' => 'Jean-Forteroche',
				'title' => $_POST['newArticleTitle'],
				'content' => $_POST['tinyMCEtextarea']]));

			$message = 'L\'article a bien été publié.';
		}

		RenderView::render('template.php', 'backend/addView.php');
	}

	public function edit()
	{
		$ArticlesManager = new ArticlesManager();

		if (isset($_POST['idArticle']) && isset($_POST['editArticleTitle']) && isset($_POST['tinyMCEtextarea'])) {
			//edit article
			$ArticlesManager->update(new Article([
				'authorEdit' => 'Jean-Forteroche', 
				'title' => $_POST['editArticleTitle'], 
				'content' => $_POST['tinyMCEtextarea'],
				'id' => $_POST['idArticle']]));

				$message = 'L\'article a bien été édité.';
		}

		if (isset($_GET['idArticle']) && $_GET['idArticle'] > 0) {
			//display one article
			$article = $ArticlesManager->getOneById($_GET['idArticle']);

			RenderView::render('template.php', 'backend/editView.php', ['article' => $article]);
		} else {
			//display list of articles
			$listArticles = $ArticlesManager->getArticles();

			if (isset($message)) {
				RenderView::render('template.php', 'backend/editView.php', ['listArticles' => $listArticles, 'message' => $message]);
			} else {
				RenderView::render('template.php', 'backend/editView.php', ['listArticles' => $listArticles]);
			}
		}
	}

	public function delete()
	{
		if (isset($_POST['confirmation']) && isset($_POST['id'])) {
			if ($_POST['confirmation'] === 'article') {
				$ArticlesManager = new ArticlesManager();
				$CommentsManager = new CommentsManager();

				//delete article
				$ArticlesManager->delete($_POST['id']);
				$comments = $CommentsManager->getComments($_POST['id']);

				if (!empty($comments)) {
					foreach ($comments as $comment) {
						$CommentsManager->delete($comment->getId());
						$CommentsManager->deleteReportsFromComment($comment->getId());
					}
				}
			} elseif ($_POST['confirmation'] === 'comment') {
				$CommentsManager = new CommentsManager();

				//delete comment
				$CommentsManager->delete($_POST['id']);
				$CommentsManager->deleteReportsFromComment($_POST['id']);
			}
		}
		RenderView::render('template.php', 'backend/deleteView.php');
	}

	public function moderate()
	{
		$CommentsManager = new CommentsManager();

		if (isset($_POST['idComment']) && isset($_POST['author']) && isset($_POST['tinyMCEtextarea'])) {
			//edit comment
			$CommentsManager->update(new Comment([
				'author' => $_POST['author'],
				'authorEdit' => 'Jean-Forteroche', 
				'content' => $_POST['tinyMCEtextarea'],
				'id' => $_POST['idComment']]));

			//delete reports from edited comment
			$CommentsManager->deleteReportsFromComment($_POST['idComment']);
			$CommentsManager->setNbReport($_POST['idComment'], 0);

			$message = 'Le commentaire a bien été édité.';
		}

		if (isset($_GET['idComment']) && $_GET['idComment'] > 0) {
			//display comment to edit
			$comment = $CommentsManager->getOneById($_GET['idComment']);

			RenderView::render('template.php', 'backend/moderateView.php', ['comment' => $comment]);
		} else {
			//display list of reported comment
			$listReportedComments = $CommentsManager->getMostReportedComments();

			if (isset($message)) {
				RenderView::render('template.php', 'backend/moderateView.php', ['listReportedComments' => $listReportedComments, 'message' => $message]);
			} else {
				RenderView::render('template.php', 'backend/moderateView.php', ['listReportedComments' => $listReportedComments]);
			}
		}
	}

	public function viewReports()
	{
		$CommentsManager = new CommentsManager();

		if (isset($_GET['idComment'])) {
			if (isset($_GET['idReport'])) {
				if ($_GET['idReport'] > 0) {
					//delete report
					$CommentsManager->deleteReport($_GET['idReport'], $_GET['idComment']);
					$message = 'Le signalement a bien été supprimé';
				} else {
					throw new Exception('Le signalement spécifié est introuvable');
				}
			}

			$listReports = $CommentsManager->getReportsFromComment($_GET['idComment']);
		}

		if (isset($message)) {
			RenderView::render('template.php', 'backend/reportsView.php', ['listReports' => $listReports, 'message' => $message]);
		} else {
			RenderView::render('template.php', 'backend/reportsView.php', ['listReports' => $listReports]);
		}
	}
}
