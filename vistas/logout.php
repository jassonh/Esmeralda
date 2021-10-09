<?php 

	require_once '../config/conn.php';

	session_destroy();

	header("Location:".Conexion::ruta()."vistas/index.php");
	exit();

?>