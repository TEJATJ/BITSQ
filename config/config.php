<?php 
//DB params
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "123456");
define("DB_NAME", "bits_quora");
define("SITE_TITLE", "Welcome to BITS-QUORA");
//paths
define("BASE_URI","http://".$_SERVER['SERVER_NAME']."/bBITSQ/");
define("avatar",BASE_URI.'templates/avatars/');
/*if($_SERVER['SERVER_NAME']!="bitsq" )
	header("Location: http://bitsq/");
ini_set("error_reporting", E_ALL);
error_reporting(E_ALL);*/