<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link rel="stylesheet" href="estilos/font-awesome/css/font-awesome.min.css"/>
<link rel="stylesheet" href="font-awesome\css\font-awesome.min.css"/>
<link  rel="stylesheet"  href ="estilos/animate.css" />
<link rel="stylesheet" type="text/css" href="estilos/estilosdriveme.css"/>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
<script type="text/javascript">
var inter;
var contador=0;
var numimagen=2;
function mueveslider()
{
	//alert("1");
	inter=setInterval(muevesl,100);
	//alert("3");
}
function muevesl()
{
	//alert(1);
	if(contador>=10)
	{
		//document.getElementById("sliderim").style.backgroundImage="url(negro.jpg)";
		document.getElementById("sliderim").className="gola";
		if(contador>=13)
		{
			//alert(numimagen);
			switch(numimagen)
			{
				case 1:
				document.getElementById("sliderim").className="animated bounceInRight";
				document.getElementById("sliderim").style.backgroundImage="url(imagenes/renta-de-autos-en-cancun-aeropuerto.jpg)";
				numimagen+=1;
				//document.getElementById("sliderim").className="";
				break;
				case 2:
				document.getElementById("sliderim").className="animated bounceInRight";
				document.getElementById("sliderim").style.backgroundImage="url(imagenes/toyota-rav4.jpg)";
				numimagen+=1;
				//document.getElementById("sliderim").className="";
				break;
				case 3:
				document.getElementById("sliderim").className="animated bounceInRight";
				document.getElementById("sliderim").style.backgroundImage="url(imagenes/GAZ_5524bad7bd9f4a0dab64ea1751e50b8a.jpg)";
				numimagen+=1;
				//document.getElementById("sliderim").className="";
				break;
				case 4:
				document.getElementById("sliderim").className="animated bounceInRight";
				document.getElementById("sliderim").style.backgroundImage="url(imagenes/VA_7c398119909c4a3486f1199b6fa89fdc.jpg)";
				//numimagen+=1;
				//document.getElementById("sliderim").className="";
				numimagen=1;
				break;
			}
			contador=0;
		}
	}
	//alert(contador)
	contador+=0.2;
}
</script>
</head>

<body onload="mueveslider()">
<div id="congeneral">
	<div id="slider">
	<div id="menunaveg">
		<div id="logoe"><img src="imagenes/logo-769x245.png" alt="logoem"/></div>
		<div id="menup">
		<ul id="menupagi">
			<li><a href="driveme.php">Inicio</a></li>
			<li><a href="Galeria.php">Galeria</a></li>
			<li><a href="Nosotros.php">Nosotros</a></li>
			<li><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
			<li><a href="https://www.google.com.mx/"><i class="fa fa-google"></i></a></li>
		</ul>
		</div>
	</div>
		<div id="sliderim"></div>
	</div>
	<div id="registro">
	<div id="contenedorreg">
		<form action="Sesiones/iniciosesion.php" method="get" id="freg">
			<p>Usuario</p><br/>
			<input type="text" name="txtusuario"/><br/>
			<p>Contraseña</p><br/>
			<input type="password" name="Pass"/><br/><br/><br/>
			<input type="submit" value="Iniciar Sesion"/><br/><br/>
			<a href="Registrar.php" id="btnreg">Registrarse</a>
		</form>
	</div>
	</div>
	<div id="mapa">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4251.149715532386!2d-101.01783586764519!3d22.145005850751918!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x842a98d2378b0fdf%3A0xd719b6541c1fe08e!2sAv.+Dr.+Manuel+Nava%2C+Bellas+Lomas%2C+78210+San+Luis%2C+S.L.P.!5e0!3m2!1ses-419!2smx!4v1511682345861" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
	</div>
	<div id="pie"><p>Drive-me, San Luis Potosi, SLP, Mexico</p></div>
</div>
</body>
</html>

