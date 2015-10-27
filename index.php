<?php 

require_once 'db/connectdb.php';

if ( isset($_GET['addtask']) ) {
	$tarea = htmlspecialchars($_POST['tarea'], ENT_QUOTES, 'UTF-8');
	$nivel = htmlspecialchars($_POST['nivel'], ENT_QUOTES, 'UTF-8');
	$errores = [];

	if ( $tarea == "" ) {
		$errores[] = 'Debes indicar un texto para cada tarea.';
	}

	if( $nivel < 1 || $nivel > 5) {
		$errores[] = 'Debes indicar un nivel con cada tarea.';
	}

	if ( empty($errores) ) {
		try{
			$sql = "INSERT INTO tareas (tarea, nivel) VALUES (:tarea, :nivel)";
			$ps = $pdo->prepare($sql);
			$ps->bindValue(':tarea', $tarea);
			$ps->bindValue(':nivel', $nivel);
			$ps->execute();
		}catch (PDOException $e){
			die("No se ha podido guardar la tarea en la base de datos:". $e->getMessage());
		}
		header("Location: .");
		exit();
	}
	
}

if ( isset($_GET['deletetask']) )
{
	$idtask = $_POST['idtask'];

	if ( is_numeric($idtask) ) {
		try {
			$sql = "DELETE FROM tareas WHERE id = :idtask";
			$ps = $pdo->prepare($sql);
			$ps->bindValue(':idtask', $idtask);
			$ps->execute();
		} catch (PDOException $e) {
			echo "Error";
			exit();
		}
	}
	
	header('Location: .');
	exit();
}

try{
	$sql = 'SELECT id,tarea,nivel FROM tareas ORDER BY nivel DESC, tarea ASC';
	$ps = $pdo->prepare($sql);
	$ps->execute();
}catch(PDOException $e){
	die("No se ha podido extraer información de la base de datos:". $e->getMessage());
}

if ( isset($_GET['tareaasc']) ) {
	try{
		$sql = 'SELECT id, tarea, nivel FROM tareas ORDER BY tarea ASC';
		$ps = $pdo->prepare($sql);
		$ps->execute();
	}catch(PDOException $e) {
		die("No se ha podido extraer información de la base de datos:". $e->getMessage());
	}
}

if ( isset($_GET['tareadesc']) ) {
	try{
		$sql = 'SELECT id, tarea, nivel FROM tareas ORDER BY tarea DESC';
		$ps = $pdo->prepare($sql);
		$ps->execute();
	}catch(PDOException $e) {
		die("No se ha podido extraer información de la base de datos:". $e->getMessage());
	}
}

if ( isset($_GET['nivelasc']) ) {
	try{
		$sql = 'SELECT id, tarea, nivel FROM tareas ORDER BY nivel ASC';
		$ps = $pdo->prepare($sql);
		$ps->execute();
	}catch(PDOException $e) {
		die("No se ha podido extraer información de la base de datos:". $e->getMessage());
	}
}

if ( isset($_GET['niveldesc']) ) {
	try{
		$sql = 'SELECT id, tarea, nivel FROM tareas ORDER BY nivel DESC';
		$ps = $pdo->prepare($sql);
		$ps->execute();
	}catch(PDOException $e) {
		die("No se ha podido extraer información de la base de datos:". $e->getMessage());
	}
}

while ($row = $ps->fetch(PDO::FETCH_ASSOC) ) {
	$datos[] = $row;
}

require_once 'view.html.php';