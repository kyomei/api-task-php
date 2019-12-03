<?php
require 'environment.php';

$config = array();

if (ENVIRONMENT == 'development') {
	define("BASE_URL", "http://localhost/cursos/php/poo/mvc/recriando_estrutura_mvc/");
	$config['dbname'] = 'task';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'rafael';
	$config['dbpass'] = '10152025';
} else {	
	define("BASE_URL", "");
	$config['dbname'] = '';
	$config['host'] = '';
	$config['dbuser'] = '';
	$config['dbpass'] = '';
}

try {
	global $db;
	$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
} catch(PDOException $e) {
	echo "Erro: ".$e->getMessage();
	exit;
}

