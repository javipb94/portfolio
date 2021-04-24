<?php
	session_start();
	include "php/sql.php";
?>
<article>
	<h2>Modificar cita</h2>
	<?php
		$conexion = conectar();

		//Recopilo la fecha para ponerla en su campo correspondiente
		$query = "SELECT * FROM cita WHERE id_cita = ".$_POST['codigo'];
		$resul = mysqli_query($conexion,$query);
		$fila = mysqli_fetch_array($resul);
		$cliente = $fila['id_usuario'];

		//Compruebo que el usuario sea administrador a no ser que sea el propio usuario el que quiera cambiar su cita
		if ( $_SESSION["codigo"] != $cliente ) {
			comprobar(0);
		}
	?>
	<!--Formulario para editar la cita seleccionada-->
	<form id="form" name="form" method="post" action="php/modcit.php" onsubmit="return validarfechacita()">
		<input type="hidden" name="id_cita" id="id_cita" value="<?php echo $fila['id_cita'] ?>">
		<p>Fecha: <br><input type="datetime-local" name="fecha" id="fecha" min="<?php echo date('Y-m-d\TH:i', strtotime('+3 day')) ?>" value="<?php echo str_replace(' ', 'T', $fila['fecha']); ?>" required /></p>
		<!--En caso de que el usuario sea administrador, éste podrá cambiar el usuario que tenga la cita-->
		<?php
			if ( isset($_SESSION["permiso"]) && $_SESSION["permiso"] == 0 ) {
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
								echo "<option value='".$fila['id_usuario']."' ";
								if ( $fila['id_usuario'] == $cliente ) {
									echo 'selected';
								}
								echo ">".$fila['user']."</option>";
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
</article>