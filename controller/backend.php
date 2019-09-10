<?php

class Backend
{
	function accueilAdmin()
	{
		//if user is not connected and try to connect
		if (isset($_POST['postConnectPseudo']) && isset($_POST['postConnectPassword'])) {
			$UserManager = new UserManager();

			$userExist = $UserManager->exists($_POST['postConnectPseudo']);
			$passwordIsOk = $UserManager->checkPassword($_POST['postConnectPseudo'], $_POST['postConnectPassword']);
		}

		require('view/backend/accueilAdminView.php');

		//login and password is ok, redirect to admin_home
		if (isset($_POST['postConnectPseudo']) && isset($_POST['postConnectPassword'])) {
			if ($userExist && $passwordIsOk) {
				header('Location: Jean-Forteroche_admin.php');
			}
		}
	}

	public function error(string $error_msg)
	{
		RenderView::render('template.php', 'frontend/errorView.php', ['error_msg' => $error_msg]);
	}

	function disconnect()
	{
		require('view/backend/disconnect.php');

		header('Location: Jean-Forteroche_admin.php');
	}

	function add()
	{
		$ArticlesManager = new ArticlesManager();

		if (isset($_POST['newArticleTitle']) && isset($_POST['tinyMCEtextarea'])) {
			//add article
			$ArticlesManager->set(new Article([
				'author' => 'Jean-Forteroche', 'title' => $_POST['newArticleTitle'], 'content' => $_POST['tinyMCEtextarea']]));
				$message = 'L\'article a bien été publié.';
		}

		require('view/backend/addView.php');
	}

	function edit()
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
			$Article = $ArticlesManager->getOneById($_GET['idArticle']);
			$article = $Article->fetch();
			$Article->closeCursor();
		} else {
			//display list of articles
			$Articles = $ArticlesManager->getArticles();
		}

		require('view/backend/editView.php');

		if (!empty($Articles)) {
			$Articles->closeCursor();
		}
	}

	function delete()
	{
		if (isset($_POST['confirmation']) && isset($_POST['id'])) {
			if ($_POST['confirmation'] === 'article') {
				$ArticlesManager = new ArticlesManager();
				$CommentsManager = new CommentsManager();

				//delete article
				$ArticlesManager->delete($_POST['id']);
				$Comments = $CommentsManager->getComments($_POST['id']);

				if ($comment = $Comments->fetch()) {
					do {
						$CommentsManager->delete($comment['id']);
						$CommentsManager->deleteReportsFromComment($comment['id']);
					} while ($comment = $Comments->fetch());
				}
				$Comments->closeCursor();
			} elseif ($_POST['confirmation'] === 'comment') {
				$CommentsManager = new CommentsManager();

				//delete comment
				$CommentsManager->delete($_POST['id']);
				$CommentsManager->deleteReportsFromComment($_POST['id']);
			}
		}

		require('view/backend/deleteView.php');
	}

	function moderate()
	{
		$CommentsManager = new CommentsManager();

		if (isset($_POST['idComment']) && isset($_POST['author']) && isset($_POST['tinyMCEtextarea'])) {
			//edit comment
			$CommentsManager->update(new Comment([
				'author' => $_POST['author'],
				'authorEdit' => 'Jean-Forteroche', 
				'content' => $_POST['tinyMCEtextarea'],
				'id' => $_POST['idComment']]));

			$CommentsManager->deleteReportsFromComment($_POST['idComment']);
			$CommentsManager->setNbReport($_POST['idComment'], 0);

			$message = 'Le commentaire a bien été édité.';
		}

		if (isset($_GET['idComment'])) {
			if ($_GET['idComment'] > 0) {
				$Comment = $CommentsManager->getOneById($_GET['idComment']);
				$comment = $Comment->fetch();
			}
		} else {
			$Comments = $CommentsManager->getMostReportedComments();
		}

		require('view/backend/moderateView.php');

		if (!empty($Comment)) {
			$Comment->closeCursor();
		}
		if (!empty($Comments)) {
			$Comments->closeCursor();
		}
	}

	function viewReports()
	{
		$CommentsManager = new CommentsManager();

		if (isset($_GET['idComment'])) {
			if (isset($_GET['idReport'])) {
				if ($_GET['idReport'] > 0) {
					//delete report
					$CommentsManager->deleteReport($_GET['idReport'], $_GET['idComment']);
				} else {
					throw new Exception('Le signalement spécifié est introuvable');
				}
			}

			$Reports = $CommentsManager->getReportsFromComment($_GET['idComment']);
		}

		require('view/backend/reportsView.php');

		if (!empty($Reports)) {
			$Reports->closeCursor();
		}
	}
}