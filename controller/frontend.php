<?php

function accueil(){
	$ArticlesManager = new ArticlesManager();

	require('view/frontend/accueilView.php');
}

function error(string $error_msg){
	if(empty($error_msg)){
		$error_msg = 'Une erreur inconnu est survenue, merci de réessayer.'; 
	}
	$message = $error_msg;
	require('view/frontend/errorView.php');
}

function listArticles(){
	$ArticlesManager = new ArticlesManager();

	require('view/frontend/articlesView.php');
}

function article(){
	$ArticlesManager = new ArticlesManager();
	$CommentsManager = new CommentsManager();

	require('view/frontend/articleView.php');
}

function postComment(){
	$CommentsManager = new CommentsManager();
	
	require('view/frontend/postComment.php');
}

function report(){
	$CommentsManager = new CommentsManager();

	require('view/frontend/reportView.php');
}