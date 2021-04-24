<?php
	session_start();
	include "php/sql.php";

	//En el caso de que un usuario intente ver las citas de otro usuario se comprobará que sea administrador
	if ( $_SESSION["codigo"] != $_POST["codigo"] ) {
		comprobar(0);
	}
?>
<article>
	<!--Este formulario recarga este mismo apartado cuando se quiera buscar citas de un usuario en concreto (no será necesario si no es el admin quien hace la consulta)-->
	<?php
		if ( $_SESSION["permiso"] == 0 ) {
	?>
			<form action="index.php?content=citas" method="post">
				<p>Buscar por código de usuario
				<input type="search" name="codigo" id="codigo"><input type="submit" name="buscar" id="buscar" value="Buscar">
				</p>	
			</form>
	<?php
		}
	?>
	<button onclick="contenido('nuevacit')">Nueva cita</button><br><br>
	<!--$_SESSION['error'] se establecerá en su archivo php cuando se modifique, añade o elimine una cita y notificará se ha sido posible dicha acción-->
	<?php 
		if ( isset($_SESSION['error']) ) {
			echo $_SESSION['error'];
			unset($_SESSION["error"]);
		}
	?>
	<!--Tabla que contendrá los datos de las citas-->
	<table class="tabladatos">
		<tr>
			<th></th><th>Código usuario</th><th>Nombre</th><th>Apellidos</th><th>Usuario</th><th>Fecha</th><th></th>
		</tr>
		<?php
			$conexion = conectar();

			if ( $conexion == false ) {
				echo "No se ha podido realizar la conexión a la base de datos";
				exit();
			}

			//Si es un usuario cliente se recibirá un $_POST['codigo'], que usaremos para filtrar las citas de cicho usuario 
			if ( $_POST['codigo'] != 'undefined' ) {
				$codigo = $_POST['codigo'];

				$query = "SELECT * FROM usuario JOIN cita ON usuario.id_usuario = cita.id_usuario WHERE cita.id_usuario = ".$codigo." ORDER BY fecha DESC";
			} else {
				$query = "SELECT * FROM usuario JOIN cita ON usuario.id_usuario = cita.id_usuario ORDER BY fecha DESC, cita.id_usuario DESC LIMIT 30";
			}

			$resul = mysqli_query($conexion, $query);

			while ( $fila = mysqli_fetch_assoc($resul) ) {
				echo "<tr>
					<td><a onclick='return cambiarcita(".date('Ymdhi', strtotime($fila['fecha'])).",".$_SESSION['permiso'].")' href='index.php?content=editcit&codigo=".$fila["id_cita"]."'><img src='imagenes/editar.png' width='25' /></a></td><td>".$fila['id_usuario']."</td><td>".$fila['nombre']."</td><td>".$fila['apellidos']."</td><td>".$fila['user']."</td><td>".date('d/m/Y H:i', strtotime($fila['fecha']))."</td><td><a onclick='if ( confirmarborrado() == true ) {return cambiarcita(".date('Ymdhi', strtotime($fila['fecha'])).",".$_SESSION['permiso'].")} else {return false;}' href='php/borrcit.php?id_cita=".$fila["id_cita"]."'><img src='imagenes/borrar.png' width='25' /></a></td>";
				echo "</tr>";
			}
			mysqli_close($conexion);
		?>
	</table>
</article>
