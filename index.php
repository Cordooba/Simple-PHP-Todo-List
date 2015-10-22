<?php 

require_once 'db/connectdb.php';

if ( $_POST ) {
	$tarea = htmlspecialchars($_POST['tarea'], ENT_QUOTES, 'UTF-8');
	$nivel = htmlspecialchars($_POST['nivel'], ENT_QUOTES, 'UTF-8');

	try{
		$sql = "INSERT INTO tareas (tarea, nivel) VALUES ('$tarea', '$nivel')";
		$pdo->exec($sql);
	}catch (PDOException $e){
		die("No se ha podido guardar la tarea en la base de datos:". $e->getMessage());
	}
}

try{
	$sql = 'SELECT tarea,nivel FROM tareas ORDER BY nivel DESC, tarea ASC';

	$result = $pdo->query($sql);
}catch(PDOException $e){
	die("No se ha podido extraer información de la base de datos:". $e->getMessage());
}

while ($row = $result->fetch(PDO::FETCH_ASSOC) ) {
	$datos[] = $row;
}

require_once 'view.html.php';