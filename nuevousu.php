<?php
	session_start();
	include "php/sql.php";
?>
<article>
	<div id="form" onsubmit="return validarpass()">
		<h2>Nuevo usuario</h2>
		<!--Formulario de ingreso de nuevo usuario-->
		<form action="php/grabarusu.php" method="post">
			<p>Nombre: </br><input type="text" name="nombre" id="nombre" placeholder="Escribe tu nombre" pattern="^[A-zÀ-ÿ\u00f1\u00d1]{2,20}(\s[A-zÀ-ÿ\u00f1\u00d1]{2,20})?$" title="El nombre debe estar compuesto por una o dos palabras con una longitud máxima de 20 caracteres cada una." required autofocus /></p>
			<p>Apellidos: </br><input type="text" name="apellidos" id="apellidos" placeholder="Escribe tus apellidos" pattern="^[A-zÀ-ÿ\u00f1\u00d1]{2,20}(\s[A-zÀ-ÿ\u00f1\u00d1]{2,20})?$" title="Los apellidos deben ser de una longitud máxima de 20 caracteres cada uno." required></p>
			<p>Contraseña: <br><input type="password" name="pass" id="pass1" placeholder="Escribe tu contraseña" required></p>
			<p>Repetir contraseña: <br><input type="password" name="pass2" id="pass2" placeholder="Vuelve a escribir tu contraseña" required></p>
			<p>Correo electrónico: </br><input type="email" name="correo" id="correo" placeholder="Escribe tu correo" required /></p>
			<p>Teléfono: </br><input type="tel" name="telef" id="telef" placeholder="Escribe tu teléfono" pattern="^[0-9]{9}$" title="El teléfono se compondrá de 9 números sin espacios." required /></p>
			<!--En caso de que el usuario sea administrador, éste podrá crear otro usuario administrador-->
			<?php
				if ( isset($_SESSION["permiso"]) && $_SESSION["permiso"] == 0 ) {
			?>
					<p>Tipo: <br>
						<select id="permiso" name="permiso" required>
							<option value="">Seleccione un tipo de usuario</option>
							<option value="1">Cliente</option>
							<option value="0">Administrador</option>
						</select>
					</p>
			<?php
				}
			?>
			<input type="submit" name="enviar" value="Enviar">
		</form>
	</div>
</article>