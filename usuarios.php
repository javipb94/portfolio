<?php
	//Compruebo que el usuario sea administrador
	session_start();
	include "php/sql.php";
	comprobar(0);
?>
<article>
	<!--Este formulario recarga este mismo apartado cuando se quiera buscar un usuario en concreto-->
	<form action="index.php?content=usuarios" method="post">
		<p>Buscar por código
		<input type="search" name="codigo" id="codigo"><input type="submit" name="buscar" id="buscar" value="Buscar">
		</p>	
	</form>
	<!--$_SESSION['error'] se establecerá en su archivo php cuando se modifique, añade o elimine un usuario y notificará se ha sido posible dicha acción-->
	<?php 
		if ( isset($_SESSION['error']) ) {
			echo $_SESSION['error'];
			unset($_SESSION["error"]);
		}
	?>
	<!--Tabla que contendrá los datos de los usuarios-->
	<table class="tabladatos">
		<tr>
			<th></th><th>Código</th><th>Nombre</th><th>Apellidos</th><th>Usuario</th><th>Teléfono</th><th>Privilegios</th><th></th>
		</tr>
		<?php
			$conexion = conectar();

			if ( $conexion == false ) {
				echo "No se ha podido realizar la conexión a la base de datos";
				exit();
			}

			//Si se ha usado el buscador de esta pagina obtendremos el código del usuario al que queremos buscar y lo usaremos en la consulta
			if ( $_POST['codigo'] != 'undefined' ) {
				$codigo = $_POST['codigo'];

				$query = "SELECT * FROM usuario WHERE id_usuario = ".$codigo;
			} else {
				$query = "SELECT * FROM usuario ORDER BY apellidos";
			}

			$resul = mysqli_query($conexion, $query);

			while ( $fila = mysqli_fetch_assoc($resul) ) {
				switch ($fila['permiso']) {
					case '1':
						$permiso = 'Cliente';
						break;
					case '0':
						$permiso = 'Admin';
						break;
				}
				echo "<tr>
					<td><a href='index.php?content=editusu&codigo=".$fila["id_usuario"]."'><img src='imagenes/editar.png' width='25' /></a></td><td>".$fila['id_usuario']."</td><td>".$fila['nombre']."</td><td>".$fila['apellidos']."</td><td>".$fila['user']."</td><td>".$fila['telefono']."</td><td>".$permiso."</td><td><a onclick='return confirmarborrado()' href='php/borrusu.php?id_usuario=".$fila["id_usuario"]."'><img src='imagenes/borrar.png' width='25' /></a></td>";
					
				echo "</tr>";
			}
			mysqli_close($conexion);
		?>
	</table>
</article>
