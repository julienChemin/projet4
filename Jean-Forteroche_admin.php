<?php

session_start();

function chargerClass($class){
	require 'model/' . $class . '.php';
}
spl_autoload_register('chargerClass');

require('controller/frontend.php');
require('controller/backend.php');

/*---------------------------------*/

try{
	if(isset($_SESSION['pseudo']) && isset($_GET['action'])){
		//list all articles
		if($_GET['action'] === 'listArticles'){
			listArticles();
		}
		//one article
		else if($_GET['action'] === 'article' && isset($_GET['id_article'])){
			$_GET['id_article'] = (int) $_GET['id_article'];
			if($_GET['id_article'] > 0){
				article();
			}else{
				throw new Exception('L\'article est introuvable.');
			}
		}
		//post a comment
		else if($_GET['action'] === 'postComment'){
			if(isset($_POST['post_comment_pseudo']) && isset($_POST['post_comment_content'])){
				postComment();
			}else{
				throw new Exception('Le formulaire doit etre remplit.');
			}
		}
		//"action" value is unknow
		else{
			throw new Exception('L\'action renseignée est inexistante.');
		}
	}
	//"action" undefined -> home
	else{
		accueilAdmin();
	}
}
catch(Exception $e){
	error($e -> getMessage());
}