<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><!--Al usar el juego de caracteres utf-8 puedo escribir letras con tilde y ñ sin problema-->
	<meta http-equiv="Content-Type" content="text/javascript" />
	<title>Indice</title>
	<link rel="stylesheet" href="css/example.css">
	<link rel="stylesheet" type="text/css" href="estilo.css" /><!--Enlazo la hoja de estilos-->
</head>
<!--En caso de añadir un usuario se enviará una variable content por el método GET, que determinará que contenido cargará por ajax-->
<body onload="<?php
					if ( isset($_GET['content']) ) {
						if ( isset($_POST['codigo']) ) {
				?>
							contenido('<?php echo $_GET['content']; ?>', '<?php echo $_POST["codigo"]; ?>');
				<?php
						} else if ( isset($_GET['codigo']) ) {
				?>
							contenido('<?php echo $_GET['content']; ?>', '<?php echo $_GET["codigo"]; ?>');
				<?php
						} else {
				?>
							contenido('<?php echo $_GET['content']; ?>');
				<?php
						}
					} else {
				?>
						contenido('inicio'); $('#indice').css('background-color', '#666'); /*bienvenida();*/
				<?php
					}
				?>">
	<div id="wrapper"><!--En este div está todo el contenido de la página y su objetivo es centrarla-->
		<header><!--Encabezado con una imagen y un título, además del inicio de sesión-->
			<h1>Trabajo para Master.d</h1>
			<!--Formulario de inicio de sesión-->
			<div id="login">
				<!--Si no se ha iniciado sesion se mostrará el formulario de inicio de sesión-->
				<?php
					if ( !isset($_SESSION['permiso']) ) {
				?>
						<img src="imagenes/logicon.png" onclick="mostrar()">
						<!--Si se ha fallado el inicio de sesión se seguirá mostrando el formulario-->
						<?php
							if ( isset($_SESSION["errorlog"]) ) {
								echo "<div id='hidlog' style='display: block;'>";
							} else {
								echo "<div id='hidlog'>";
							}
						?>
							<form action="php/login.php" method="post">
								E-mail <input type="email" name="usuario" id="usuario" placeholder="ejemplo@gmail.com" required>
								Contraseña <input type="password" name="pass" id="pass" placeholder="contraseña" required>
								<?php
									if ( isset($_SESSION["errorlog"]) ) {
										echo "<b style='color: #a92d11; font-size: 0.9em;'>".$_SESSION["errorlog"]."</b>";
										unset($_SESSION["errorlog"]);
									}
								?>
								<span onclick="this.parentElement.parentElement.style.display = 'none'; $(document).off(); contenido('nuevousu');">Darse de alta como usuario</span>
								<br><br><input type="submit" value="Iniciar sesión">
							</form>
						</div>
				<?php
					} else {
				?>
						<img src="imagenes/logicon.png" onclick="mostrar()" style="right: 158px;"><div id="bienvenida" onclick="mostrar()">Bienvenid@<br><?php echo $_SESSION["nombre"]; ?></div>
						<div id="hidlog">
							<?php
								if ( $_SESSION["permiso"] == 0 ) {
							?>
									<span onclick="this.parentElement.style.display = 'none'; $(document).off(); contenido('presupuesto');">Nuevo proyecto</span><br>
									<span onclick="this.parentElement.style.display = 'none'; $(document).off(); contenido('proyectos');">Modificar proyecto</span><br>
									<span onclick="this.parentElement.style.display = 'none'; $(document).off(); contenido('nuevousu');">Añadir usuario</span><br>
									<span onclick="this.parentElement.style.display = 'none'; $(document).off(); contenido('usuarios');">Modificar usuario</span><br>
									<span onclick="this.parentElement.style.display = 'none'; $(document).off(); contenido('citas');">Consultar citas</span><br>
									<span onclick="this.parentElement.style.display = 'none'; $(document).off(); contenido('noticias');">Noticias</span><br>
									<span onclick="this.parentElement.style.display = 'none'; $(document).off(); contenido('mensajes');">Mensajes</span>
									<br><br>
							<?php
								} else {
							?>
									<a href="index.php?content=editusu&codigo=<?php echo $_SESSION['codigo'] ?>"><span onclick="this.parentElement.style.display = 'none'; $(document).off();">Editar perfil</span></a><br>
									<a href="index.php?content=citas&codigo=<?php echo $_SESSION['codigo'] ?>"><span onclick="this.parentElement.style.display = 'none'; $(document).off();">Consultar/pedir cita</span></a>
									<br><br>
							<?php
								}
							?>
							<a href="php/logout.php"><input type="button" name="enviar" value="Cerrar sesión"></a>
						</div>
				<?php
					}
				?>
			</div>
			<img src="imagenes/idea.jpg" id="idea" />
		</header>
		<nav><!--Barra de navegación para acceder a todos los apartados de mi página web-->
			<span id="indice" class="selector" onclick="contenido('inicio')">Indice</span>
			<span class="selector" onclick="contenido('portfolio'); carrusel()">Portfolio</span>
			<span class="selector" onclick="contenido('contacto')">Contacto</span>
		</nav>
		<section id="ajax" class="scroll"><!--Contenido principal de este apartado (se cargará con AJAX)-->
		</section>
		<!--Pie de la página con el nombre de la persona que ha realizado este trabajo-->
		<footer class="scroll">
			<span>Trabajo realizado por José Javier Pérez Barranquero - </span><span id="donde" onclick="contenido('donde')">Donde estamos</span>
		</footer>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script><!--Enlazo la librería jquery-->
	<script type="text/JavaScript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAw5McSMcrqjt_dvaKBC83NSBIMzhGVbrs&language=es"></script><!--Librería del mapa de google-->
	<script type="text/javascript" src="javascript.js" ></script><!--Enlazo el archivo de javascript-->
</body>
</html>