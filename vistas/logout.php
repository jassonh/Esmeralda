<?php 

	require_once '../config/conn.php';

	session_destroy();

	header("Location:".Conectar::ruta()."vistas/index.php");
	exit();

?>