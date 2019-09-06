<?php

session_start();

if (!isset($_SESSION['pseudo']) && isset($_COOKIE['admin'])) {
	$_SESSION['pseudo'] = $_COOKIE['admin'];
}

function chargerClass($class)
{
	require 'model/' . $class . '.php';
}
spl_autoload_register('chargerClass');

require('controller/frontend.php');
require('controller/backend.php');

/*---------------------------------*/

try {
	if (isset($_SESSION['pseudo']) && isset($_GET['action'])) {
		switch ($_GET['action']) {
			case 'disconnect' :
				//disconnect
				disconnect();
				break;
			case 'add' :
				//add article
				add();
				break;
			case 'edit' :
				//edit articles
				edit();
				break;
			case 'delete' :
				//delete article
				delete();
				break;
			case 'moderate' :
				//moderate comments
				moderate();
				break;
			case 'viewReports' :
				//moderate reports
				viewReports();
				break;
			default :
				throw new Exception('L\'action renseignée est inexistante.');
		}
	} else {
		//"action" undefined -> home
		accueilAdmin();
	}
} catch (Exception $e) {
	error($e->getMessage());
}
