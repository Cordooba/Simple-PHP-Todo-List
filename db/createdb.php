<?php 

require_once 'connectdb.php';

try{
	$sql = "CREATE TABLE tareas (
		id 			INT AUTO_INCREMENT PRIMARY KEY,
		tarea 		VARCHAR(255) NOT NULL,
		nivel   	ENUM('1','2','3','4','5') NOT NULL DEFAULT '1',
		completada	BOOL DEFAULT 0,
		fechahora	TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	) DEFAULT CHARACTER SET UTF8 ENGINE=InnoDB";

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$pdo->exec($sql);

}catch(PDOException $e){
		die("No se ha podido crear la tabla 'tareas':". $e->getMessage());
}