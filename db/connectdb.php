<?php 

require_once 'datadb.php';

try{
	$pdo = new PDO('mysql:host='.$host.';dbname='.$db, $user, $pass);

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->exec('SET NAMES utf8');
}catch(PDOException $e){
	die('Error de conexión a la base de datos: '. $e->getMessage());
}