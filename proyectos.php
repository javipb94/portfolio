<?php
	//Compruebo que el usuario sea administrador
	session_start();
	include "php/sql.php";
	comprobar(0);
?>
<article>
	<!--$_SESSION['error'] se establecerá en su archivo php cuando se modifique, añade o elimine un proyecto y notificará se ha sido posible dicha acción-->
	<?php 
		if ( isset($_SESSION['error']) ) {
			echo $_SESSION['error'];
			unset($_SESSION["error"]);
		}
	?>
	<!--Tabla que contendrá los datos de los proyectos-->
	<table class="tabladatos">
		<tr>
			<th></th><th>Título</th><th class="longcell">Descripción</th><th>Lenguaje</th><th>Tipo</th><th>Fecha fin</th><th>Presupuesto</th><th></th>
		</tr>
		<?php
			$conexion = conectar();

			if ( $conexion == false ) {
				echo "No se ha podido realizar la conexión a la base de datos";
				exit();
			}

			$query = "SELECT * FROM proyecto";

			$resul = mysqli_query($conexion, $query);

			while ( $fila = mysqli_fetch_assoc($resul) ) {
				echo "<tr>
					<td><a href='index.php?content=editpro&codigo=".$fila["id_proyecto"]."'><img src='imagenes/editar.png' width='25' /></a></td><td>".$fila["titulo"]."</td><td>".$fila["descripcion"]."</td><td>".$fila["lenguaje"]."</td><td>".$fila["tipo"]."</td><td>".date("d/m/Y", strtotime($fila["fecha_fin"]))."</td><td>".$fila["presupuesto"]."€</td><td><a onclick='return confirmarborrado()' href='php/borrpro.php?id_proyecto=".$fila["id_proyecto"]."'><img src='imagenes/borrar.png' width='25' /></a></td>";
					
				echo "</tr>";
			}
			mysqli_close($conexion);
		?>
	</table>
</article>
