<?php
	$existeus=0;
	if(isset($_POST['txtnameuser']) && $_POST['txtnameuser']!="" && isset($_POST['txtcontra']) && $_POST['txtcontra']!="")
	{
		//conectar a la base de datos
		 $conn =@mysql_connect("localhost","root","mysql")
		or die("no se pudo coonectar al servidor");
		mysql_select_db("agenciaautos")
		or die("no se pudo aceder a la base de datos");
		
		//verificar si ya existe el usuario
		$qry="select nombreus from usuarios";
		echo"<div id='seccionusuarios'>";
		$rs=mysql_query($qry,$conn)	or die("Error al recuperar datos del usuario".mysql_error());
		while($datos = mysql_fetch_object($rs))
		{
			if($datos->nombreus==$_POST['txtnameuser'])
				$existeus=1;
		}
		echo $existeus;
		if($existeus==0)//crear usuario
		{
			
			$n=$_POST['txtnameuser'];
			$c=$_POST['txtcontra'];
			$qry="insert into usuarios(nombreus,contrasena,tipousuario) values('".$n."','".$c."','General')";
			mysql_query($qry) or die("Error al crear usuario".mysql_error());
			header("location:driveme.php");
			
		}
		else
		{
			echo "error";
		}

	}
	else
	{
		echo "erro";
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
