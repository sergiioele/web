<?php
	session_start();
	include("funciones.php");
 
 //contnectar bd
 $conn=conectarBD();
		
	
	//verificar si se inserta un nuevo auto
	if(isset($_REQUEST['inseA']))
	{
		if(isset($_POST['txtColor'])&& $_POST['txtColor']!="" && isset($_POST['txtMarca']) && $_POST['txtMarca']!=""
		&& isset($_POST['txtImporte'])&& $_POST['txtImporte']!="" && isset($_POST['txtPrecio']) && $_POST['txtPrecio']!=""
		&& isset($_POST['txtModelo'])&& $_POST['txtModelo']!=""
		/*&& $_POST['iauto']!=""*/)
		{
			$imagen = addslashes(file_get_contents($_FILES['iauto']['tmp_name']));
			insertaA($_POST['txtMarca'],$_POST['txtModelo'],$_POST['txtColor'],$_POST['txtPrecio'],$_POST['txtImporte'],$imagen);
		}

	}
	if(isset($_REQUEST['modA']))//modificar un auto
	{
		//validar que se haya seleccionado un auto
		if($_POST['selectidA']!="")
		{
			$cad=$_POST['selectidA'];
			$cad2="";
			//echo $cad2;
			for($i=0;$i<strlen($_POST['selectidA']);$i++)
			{
				if($cad[$i]==',')
					break;
				else
					$cad2+=$cad[$i];
			}
	
			actualizaA($_POST['txtMarca'],$_POST['txtModelo'],$_POST['txtColor'],$_POST['txtPrecio'],$_POST['txtImporte'],$cad2);
		}
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link rel="stylesheet" type="text/css" href="../estilos/estilosSesionG.css"/>
<link rel="stylesheet" type="text/css" href="../estilos/estilosAutos.css"/>
<script type="text/javascript">
var st=-1;
function act()
{
	alert(document.getElementById("idA").value);
	document.getElementById("idA").value=1;
	alert(document.getElementById("idA").value);
}
function insert()
{
	document.getElementById("idA").value=2;
}
</script>

<title>Untitled 1</title>
</head>

<body>
<div id="encSesion" class="encSesion">
	<div id="conlog" class="conlog"><img src="../imagenes/logo-769x245.png" alt="logoemp"/></div>
	<div id="continfo" class="continfo">
		<p>Usuario:   <?php echo $_SESSION['usr']?></p>
		<p>Tipo Usuario:       <?php echo $_SESSION['tipou'] ?></p>
		<a href="../driveme.php"> Cerrar Sesion</a>
	</div>
</div>
<?php
if($_SESSION['tipou']=="Administrador")
{
	//menu
	echo "<div id='ConMenu' class='ConMenu'>";
		echo"<p>MENU PRINCIPAL<p>";
		echo "<ul id='MenuSesion'>";
			echo "<li><a href='Ventas.php'>Ventas</a></li>";
			echo "<li><a href='Rentas'>Rentas</a></li>";
			echo "<li><a href='Autos.php'>Autos</a></li>";
			echo "<li><a href='Usuarios.php'>Usuarios</a></li>";
			echo "<li><a href='Comentarios.php'>Comentarios</a></li>";
		echo "</ul>";
	echo "</div>";
	//seccion de autos
	$qry="select * from autos";
			echo"<div id='seccionusuarios'>";
			$rs=mysql_query($qry,$conn)	or die("Error al recuperar datos del usuario".mysql_error());

	echo "<div id='seccionautos'>";	
			
			echo"<div id='tablaA'>";
				echo"<p>Autos</p>";
				echo "<table id='tablas' style border=1px>";
				echo ' <tr>
						<th>id Auto</th>
						<th>Marca</th>
						<th>Modelo</th>
						<th>Color</th>
						<th>Precio</th>
						<th>Importe</th>
						<th>Imagen</th>
						<th>Disponibilidad</th>
						<th>Acciones</th>
						</tr>';
				while($datos = mysql_fetch_object($rs))
				{
					echo "<tr>";
					echo "<td>".$datos->idAuto."</td>";
					echo "<td>".$datos->marca."</td>";
					echo "<td>".$datos->modelo."</td>";
					echo "<td>".$datos->color."</td>";
					echo "<td>".$datos->precio."</td>";
					echo "<td>".$datos->importe."</td>";
					echo "<td><img id='iiau' src='Imagen.php?idI=" . $datos->idAuto. "' alt='" . $datos->marca . "' class='imagenFicha' /></td>";
					if($datos->disponibilidad==0)
						$dis="Disponible";
					else
						$dis="No Disponible";
					echo "<td>".$dis."</td>";
					echo"<td><a href='eliminaA?idA=".$datos->idAuto."'>Eliminar</a></td>";
					echo"</tr>";
				}
				echo "</table>";
			echo "</div>";
			echo"<div id='Acc'>";
				echo"<form action='Autos.php' method='post' enctype='multipart/form-data'>";
					echo "<a>Insertar</a><br/><br/>";
					echo "<a>Id auto  </a>";
					$qry="select CONCAT(idAuto,', ',marca,' ',color,' ',modelo) as dat from autos";
					$rs=mysql_query($qry,$conn)	or die("Error al recuperar datos del usuario".mysql_error());
					echo "<select name='selectidA'>";
					while($datos = mysql_fetch_object($rs))
					{

						echo "<option>".$datos->dat."</option>";
					}
					echo "</select><a> * Obligatorio para modificar</a><<br/><br/>" ;	
					echo "<a>Marca  </a><input type='text'name='txtMarca'/><br/><br/>";
					echo "<a>Color  </a><input type='text'  name='txtColor'/><br/><br/>";
					echo "<a>Modelo  </a><input type='text' name='txtModelo'/><br/><br/>";
					echo "<a>Precio  </a><input type='text' name='txtPrecio'/><br/><br/>";
					echo "<a>Importe P/Renta </a><input type='text' name='txtImporte'/><br/><br/>";
					//echo "<a>Disponibilidad</a><input type='text'/><br/><br/>";
					echo "<a id='ima2'>Imagen</a>";
					echo "<input type='file' name='iauto'/>";
					echo "<input type='hidden'  id='idA'name='txtidA'/>";
					echo "<input type='submit' value='Insertar' name='inseA'/>";
					echo "<input type='submit' value='Modificar' name='modA'/>";
				echo"</form>";
			echo "</div>";
		echo "</div>";	
}	
else
{
	//menu
	echo "<div id='ConMenu' class='ConMenu'>";
		echo"<p>MENU PRINCIPAL<p>";
		echo "<ul id='MenuSesion'>";
			echo "<li><a href='Ventas.php'>Ventas</a></li>";
			echo "<li><a href='Rentas'>Rentas</a></li>";
			echo "<li><a href='Autos.php'>Autos</a></li>";
			echo "<li><a href='Comentarios.php'>Comentarios</a></li>";
		echo "</ul>";
	echo "</div>";
		//seccion de autos
	$qry="select * from autos";
			echo"<div id='seccionusuarios'>";
			$rs=mysql_query($qry,$conn)	or die("Error al recuperar datos del usuario".mysql_error());

	echo "<div id='seccionautos'>";	
			echo"<div id='tablaA'>";
				echo"<p>Autos</p>";
				echo "<table id='tablas' style border=1px>";
				echo ' <tr>
						<th>id Auto</th>
						<th>Marca</th>
						<th>Modelo</th>
						<th>Color</th>
						<th>Precio</th>
						<th>Importe</th>
						<th>Imagen</th>
						<th>Disponibilidad</th>
						</tr>';
				while($datos = mysql_fetch_object($rs))
				{
					echo "<tr>";
					echo "<td>".$datos->idAuto."</td>";
					echo "<td>".$datos->marca."</td>";
					echo "<td>".$datos->modelo."</td>";
					echo "<td>".$datos->color."</td>";
					echo "<td>".$datos->precio."</td>";
					echo "<td>".$datos->importe."</td>";
					echo "<td><img id='iiau' src='Imagen.php?idI=" . $datos->idAuto. "' alt='" . $datos->marca . "' class='imagenFicha' /></td>";
					if($datos->disponibilidad==0)
						$dis="Disponible";
					else
						$dis="No Disponible";
					echo "<td>".$dis."</td>";
					echo"</tr>";
				}
				echo "</table>";
			echo "</div>";
}
?>

</body>

</html>
