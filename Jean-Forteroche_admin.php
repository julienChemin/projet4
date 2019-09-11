<?php

session_start();

function chargerClass($class)
{
	if ($class === 'Backend' || $class === 'Frontend') {
		require 'controller/' . $class . '.php';
	} else {
		require 'model/' . $class . '.php';
	}
}
spl_autoload_register('chargerClass');

$backend = new Backend();

/*---------------------------------*/

try {
	if (isset($_SESSION['pseudo']) && isset($_GET['action'])) {
		switch ($_GET['action']) {
			case 'disconnect' :
				//disconnect
				$backend->disconnect();
				break;
			case 'add' :
				//add article
				$backend->add();
				break;
			case 'edit' :
				//edit articles
				$backend->edit();
				break;
			case 'delete' :
				//delete article
				$backend->delete();
				break;
			case 'moderate' :
				//moderate comments
				$backend->moderate();
				break;
			case 'viewReports' :
				//moderate reports
				$backend->viewReports();
				break;
			default :
				throw new Exception('L\'action renseignée est inexistante.');
		}
	} else {
		//"action" undefined -> home
		$backend->accueilAdmin();
	}
} catch (Exception $e) {
	$backend->error($e->getMessage());
}
