<?php
	session_start();
	include "php/sql.php";

	//Compruebo que el usuario sea administrador
	comprobar(0);
?>
<article>
	<!--Tabla que contendrá los datos de lo recibido en la sección de contacto-->
	<table class="tabladatos">
		<tr>
			<th>Nombre</th><th>Apellidos</th><th>E-mail</th><th>Fecha</th><th>Telefono</th><th>Motivo</th>
		</tr>
		<?php
			$conexion = conectar();

			if ( $conexion == false ) {
				echo "No se ha podido realizar la conexión a la base de datos";
				exit();
			}

			$query = "SELECT * FROM cliente ORDER BY fecha_ingreso DESC LIMIT 30";

			$resul = mysqli_query($conexion, $query);

			while ( $fila = mysqli_fetch_assoc($resul) ) {
				echo "<tr>
					<td>".$fila['nombre']."</td><td>".$fila['apellidos']."</td><td>".$fila['email']."</td><td>".date('d/m/Y H:i', strtotime($fila['fecha_ingreso']))."</td><td>".$fila['telefono']."</td><td>".$fila['motivo']."</td>";
				echo "</tr>";
			}
			mysqli_close($conexion);
		?>
	</table>
</article>
