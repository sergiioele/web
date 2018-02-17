<?php

	$conn =@mysql_connect("localhost","root","mysql")
	or die("no se pudo coonectar al servidor");
	mysql_select_db("agenciaautos")
	or die("no se pudo aceder a la base de datos");

	
	if(isset($_GET['idV']) && $_GET['idV']!="")
	{
		$idv=$_GET['idV'];
		echo "entro";
		$qry="delete from ventas where idVenta=".$idv;
		mysql_query($qry) or die("No se pudo eliminar el registro");
		
		$ida=$_GET['idA'];
		$im=0;
		echo $ida;
		$qry2="update autos set disponibilidad=".$im." where idAuto=".$ida;
		mysql_query($qry2,$conn) or die("No se pudo actualizar");
		header("Location:http://localhost/proyecto/sesiones/Ventas.php");

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
