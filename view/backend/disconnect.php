<?php

if(isset($_SESSION)){
	session_destroy();
}

if(isset($_COOKIE['admin'])){
	setcookie('admin', '', time()-3600, null, null, false, true);
}

header('Location: Jean-Forteroche_admin.php');