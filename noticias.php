<?php
	//Compruebo que el usuario sea administrador
	session_start();
	include "php/sql.php";
	comprobar(0);
?>
<article>
	<button onclick="contenido('nuevanot')">Nueva noticia</button><br><br>
	<!--$_SESSION['error'] se establecerá en su archivo php cuando se modifique, añade o elimine una noticia y notificará si ha sido posible dicha acción-->
	<?php 
		if ( isset($_SESSION['error']) ) {
			echo $_SESSION['error'];
			unset($_SESSION["error"]);
		}
	?>
	<!--Tabla que contendrá los datos de los usuarios-->
	<table class="tabladatos">
		<tr>
			<th></th><th>Título</th><th class="longcell">Descripción</th><th>Premio</th><th>Tecnología</th><th></th>
		</tr>
		<?php
			$conexion = conectar();

			if ( $conexion == false ) {
				echo "No se ha podido realizar la conexión a la base de datos";
				exit();
			}

			$query = "SELECT * FROM noticia ORDER BY id_noticia DESC LIMIT 30";

			$resul = mysqli_query($conexion, $query);

			while ( $fila = mysqli_fetch_assoc($resul) ) {
				echo "<tr>
					<td><a href='index.php?content=editnot&codigo=".$fila["id_noticia"]."'><img src='imagenes/editar.png' width='25' /></a></td><td>".$fila['titulo']."</td><td>".$fila['descripcion']."</td><td>".$fila['premio']."</td><td>".$fila['tecnologia']."</td><td><a onclick='return confirmarborrado()' href='php/borrnot.php?id_noticia=".$fila["id_noticia"]."'><img src='imagenes/borrar.png' width='25' /></a></td>";
					
				echo "</tr>";
			}
			mysqli_close($conexion);
		?>
	</table>
</article>
