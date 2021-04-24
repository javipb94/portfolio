<?php
	session_start();
	include "php/sql.php";

	//Ningún usuario no registrado debería estar aquí
	if ( !isset($_SESSION["permiso"]) ) {
		comprobar(0);
	}
?>
<article>
	<div id="form">
		<h2>Nueva cita</h2>
		<!--Formulario para crear una nueva cita-->
		<form action="php/grabarcit.php" method="post" onsubmit="return validarfechacita()">
			<p>Fecha: <br><input type="datetime-local" name="fecha" id="fecha" min="<?php echo date('Y-m-d\TH:i', strtotime("+3 day")) ?>" required /></p>
			<!--En caso de que el usuario sea administrador se podrá seleccionar un usuario para la cita-->
			<?php
				if ( $_SESSION["permiso"] == 0 ) {
			?>
					<p>Cliente: <br>
						<select name="codigo" id="codigo" required>
							<option value="">---</option>
							<?php
								$conexion = conectar();

								if ( $conexion == false ) {
									echo "No se ha podido realizar la conexión a la base de datos";
									exit();
								}

								$query = "SELECT id_usuario, user FROM usuario WHERE permiso = 1";

								$resul = mysqli_query($conexion, $query);

								while ( $fila = mysqli_fetch_assoc($resul) ) {
									echo "<option value='".$fila['id_usuario']."'>".$fila['user']."</option>";
								}

								mysqli_close($conexion);
							?>
						</select>
					</p>
			<?php
				}
			?>
			<input type="submit" name="enviar" value="Enviar">
		</form>
	</div>
</article>