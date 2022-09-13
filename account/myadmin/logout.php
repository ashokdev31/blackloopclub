<?php
require_once "../../functions_basic.php";

if(isset($_SESSION['blackloop_slug'])){
	unset($_SESSION['blackloop_slug']);
	$_SESSION = [];
	session_destroy();
	header("Location: {$GLOBALS['path']}index");
	exit;
}else{
	header("Location: {$GLOBALS['path']}index");
	exit;
}