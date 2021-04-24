<?php
	//Compruebo que el usuario sea administrador a no ser que sea un usuario que quiera cambiar sus propios datos
	session_start();
	include "php/sql.php";

	if ( $_SESSION["codigo"] != $_POST["codigo"] ) {
		comprobar(0);
	}
?>
<article>
	<h2>Modificar usuario</h2>
	<p>Datos del usuario</p>
	<?php
		$conexion = conectar();

		//Recopilo los datos para rellenar el posterior formulario
		$query = "SELECT * FROM usuario WHERE id_usuario = ".$_POST['codigo'];
		$resul = mysqli_query($conexion,$query);
		$fila = mysqli_fetch_array($resul);
	?>
	<!--Formulario para editar el usuario seleccionado-->
	<form id="form" name="form" method="post" action="php/modusu.php">
		<p>Código: </br><input type="text" name="codigo" id="codigo" readonly value="<?php echo $fila['id_usuario'] ?>"></p>
		<p>Nombre: </br><input type="text" name="nombre" id="nombre" placeholder="Escribe tu nombre" pattern="^[A-zÀ-ÿ\u00f1\u00d1]{2,20}(\s[A-zÀ-ÿ\u00f1\u00d1]{2,20})?$" title="El nombre debe estar compuesto por una o dos palabras con una longitud máxima de 20 caracteres cada una." required autofocus value="<?php echo $fila['nombre'] ?>" /></p>
		<p>Apellidos: </br><input type="text" name="apellidos" id="apellidos" placeholder="Escribe tus apellidos" pattern="^[A-zÀ-ÿ\u00f1\u00d1]{2,20}(\s[A-zÀ-ÿ\u00f1\u00d1]{2,20})?$" title="Los apellidos deben ser de una longitud máxima de 20 caracteres cada uno." required value="<?php echo $fila['apellidos'] ?>"></p>
		<p>Correo electrónico: </br><input type="email" name="correo" id="correo" placeholder="Escribe tu correo" required value="<?php echo $fila['user'] ?>" /></p>
		<p>Teléfono: </br><input type="tel" name="telef" id="telef" placeholder="Escribe tu teléfono" pattern="^[0-9]{9}$" title="El teléfono se compondrá de 9 números sin espacios." required value="<?php echo $fila['telefono'] ?>" /></p>
		<!--En caso de que el usuario sea administrador, éste podrá crear otro usuario administrador-->
		<?php
			if ( isset($_SESSION["permiso"]) && $_SESSION["permiso"] == 0 ) {
		?>
				<p>Tipo: <br>
					<select id="permiso" name="permiso" required>
						<option value="1" 
							<?php
							if ( $fila['permiso'] == 1 ) {
								echo 'selected';
							}
							?>
						>Cliente</option>
						<option value="0"
							<?php
							if ( $fila['permiso'] == 0 ) {
								echo 'selected';
							}
							?>
						>Administrador</option>
					</select>
				</p>
	<?php
			}
		?>
		<input type="submit" name="enviar" value="Enviar">
	</form>
</article>