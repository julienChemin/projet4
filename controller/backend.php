<?php

function accueilAdmin(){
	require('view/backend/accueilAdminView.php');
}

function disconnect(){
	require('view/backend/disconnect.php');
}

function add(){
	$ArticlesManager = new ArticlesManager();

	require('view/backend/add.php');
}

function edit(){
	$ArticlesManager = new ArticlesManager();

	require('view/backend/edit.php');
}

function delete(){
	$ArticlesManager = new ArticlesManager();

	require('view/backend/delete.php');
}

function moderate(){
	$CommentsManager = new CommentsManager();

	require('view/backend/moderate.php');
}