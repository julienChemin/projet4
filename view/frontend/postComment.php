<?php

if (isset($_SESSION['pseudo'])) {
	$newComment = new Chemin\Blog\Model\Comment([
		'idArticle' => $_POST['idArticle'],
		'author' => htmlspecialchars($_POST['postCommentPseudo']),
		'content' => htmlspecialchars($_POST['postCommentContent']),
		'authorIsAdmin' => true]);
} else {
	$newComment = new Chemin\Blog\Model\Comment([
		'idArticle' => $_POST['idArticle'],
		'author' => htmlspecialchars($_POST['postCommentPseudo']),
		'content' => htmlspecialchars($_POST['postCommentContent'])]);
}
