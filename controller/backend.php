<?php

function accueilAdmin(){
	require('view/backend/accueilAdminView.php');
}

function disconnect(){
	require('view/backend/disconnect.php');
}

function add(){
	$ArticlesManager = new ArticlesManager();

	require('view/backend/addView.php');
}

function edit(){
	$ArticlesManager = new ArticlesManager();

	require('view/backend/editView.php');
}

function delete(){
	$ArticlesManager = new ArticlesManager();
	$CommentsManager = new CommentsManager();

	require('view/backend/deleteView.php');
}

function moderate(){
	$CommentsManager = new CommentsManager();

	require('view/backend/moderateView.php');
}

function viewReports(){
	$CommentsManager = new CommentsManager();

	require('view/backend/reportsView.php');
}