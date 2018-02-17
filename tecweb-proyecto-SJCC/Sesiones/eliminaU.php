<?php

	$conn =@mysql_connect("localhost","root","mysql")
	or die("no se pudo coonectar al servidor");
	mysql_select_db("agenciaautos")
	or die("no se pudo aceder a la base de datos");

	
	if(isset($_GET['idU']) && $_GET['idU']!="")
	{
		$idu=$_GET['idU'];
		echo "entro";
		$qry="delete from usuarios where idUsuario=".$idu;
		mysql_query($qry) or die("No se pudo eliminar el usuario");
		header("Location:http://localhost/proyecto/sesiones/Usuarios.php");
	}
	else
	{
		echo "error";
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
</head>

<body>

</body>

</html>
