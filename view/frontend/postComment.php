<?php

if (isset($_SESSION['pseudo'])) {
	$newComment = new Comment([
		'idArticle' => $_POST['idArticle'],
		'author' => htmlspecialchars($_POST['postCommentPseudo']),
		'content' => htmlspecialchars($_POST['postCommentContent']),
		'authorIsAdmin' => true]);
} else {
	$newComment = new Comment([
		'idArticle' => $_POST['idArticle'],
		'author' => htmlspecialchars($_POST['postCommentPseudo']),
		'content' => htmlspecialchars($_POST['postCommentContent'])]);
}
