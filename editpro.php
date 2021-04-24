<?php
	//Compruebo que el usuario sea administrador
	session_start();
	include "php/sql.php";
	comprobar(0);
?>
<article>
	<h2>Modificar proyecto</h2>
	<p>Datos del proyecto</p>
	<?php
		$conexion = conectar();

		//Recopilo los datos para rellenar el posterior formulario
		$query = "SELECT * FROM proyecto WHERE id_proyecto = ".$_POST['codigo'];
		$resul = mysqli_query($conexion,$query);
		$filapro = mysqli_fetch_array($resul);
	?>
	<!--Formulario para editar el proyecto seleccionado-->
	<form id="form" method="post" action="php/modpro.php" onsubmit="return validarpre()" onchange="precio()" enctype="multipart/form-data">
		<h2>Cliente</h2>
		<p>
			<select name="codigo" id="codigo" required>
				<?php
					$conexion = conectar();

					if ( $conexion == false ) {
						echo "No se ha podido realizar la conexión a la base de datos";
						exit();
					}

					$query = "SELECT id_usuario, user FROM usuario";

					$resul = mysqli_query($conexion, $query);

					//La condición if es para que me seleccione por defecto el cliente que haya encargado el proyecto
					while ( $filausu = mysqli_fetch_assoc($resul) ) {
						echo "<option value='".$filausu['id_usuario']."'";
						if ( $filausu["id_usuario"] == $filapro["id_usuario"] ) {
							echo "selected";
						}
						echo ">".$filausu['user']."</option>";
					}
				?>
			</select>
		</p>
		<h2>La web</h2>
		<input type="hidden" name="id_proyecto" id="id_proyecto" value="<?php echo $_POST['codigo'] ?>">
		<p>Título: <br><input type="text" name="titulo" id="titulo" placeholder="Escribe un título identificativo" maxlength="20" value="<?php echo $filapro['titulo'] ?>" required></p>
		<p>Descripción: <br><textarea name="desc" id="desc" cols="40" rows="8" placeholder="Escribe una descripción del proyecto (200 caracteres max.)" maxlength="200" required><?php echo $filapro['descripcion'] ?></textarea></p>
		<p>Lenguaje: <br><input type="text" name="leng" id="leng" placeholder="Lenguajes de programación empleados" maxlength="20" value="<?php echo $filapro['lenguaje'] ?>" required></p>
		<p>Tipo de página web: </br>
			<select name="tipoweb" id="tipoweb" required="true">
				<option value="Estática"
					<?php
						if ( $filapro["tipo"] == "Estática" ) {
						 	echo "selected";
						 } 
					?>
					>Estática</option>
				<option value="Dinámica"
					<?php
						if ( $filapro["tipo"] == "Dinámica" ) {
						 	echo "selected";
						 } 
					?>
					>Dinámica</option>
				<option value="BBDD"
					<?php
						if ( $filapro["tipo"] == "BBDD" ) {
						 	echo "selected";
						 } 
					?>
					>Con base de datos</option>
			</select>
		</p>
		<p>
			¿Añadir imagen?<br><input type="checkbox" name="subirimg" id="subirimg" onchange="activarimg(this)"><br><br><input type="file" name="imagen" id="imagen" disabled="true" onchange="cambimg(event)"></p>
			<img id="imgresul" src="<?php echo 'imagenes/'.$filapro['imagen'] ?>" width="150"><br><br>
		</p>
		<?php 
			$date1 = new DateTime($filapro['fecha_inicio']);
		 	$date2 = new DateTime($filapro['fecha_fin']);
		 	$interval = date_diff($date1, $date2);

		 	if ( date("Y-m-d") > $filapro["fecha_fin"] ) {
		 		echo "Proyecto terminado el ".date("Y/m/d", strtotime($filapro["fecha_fin"]));
		 	} else {
		 		echo "Proyecto para el ".date("Y/m/d", strtotime($filapro["fecha_fin"]));
		 	}
		?>
		<input type="hidden" name="fecha_inicio" id="fecha_inicio" value="<?php echo $filapro['fecha_inicio'] ?>">
		<p>Plazo en meses: </br><input type="number" name="plazo" id="plazo" min="1" max="12" value="<?php echo $interval->format('%m') ?>" required></p>
		Marque las secciones deseadas: 
			<table>
				<tr>
					<td><input type="checkbox" name="quien" id="quien" <?php if ( $filapro["quienes"] == "Si" ) echo "checked" ?> >Quienes somos</td>
					<td><input type="checkbox" name="donde" id="donde" <?php if ( $filapro["donde"] == "Si" ) echo "checked" ?> >Donde estamos</td>
					<td><input type="checkbox" name="galeria" id="galeria" <?php if ( $filapro["galeria"] == "Si" ) echo "checked" ?> >Galería de fotos</td>
					<td><input type="checkbox" name="ecomerce" id="ecomerce" <?php if ( $filapro["ecomerce"] == "Si" ) echo "checked" ?> >eComerce</td>
				</tr>
				<tr>
					<td><input type="checkbox" name="gestion" id="gestion" <?php if ( $filapro["gestion"] == "Si" ) echo "checked" ?> >Gestión interna</td>
					<td><input type="checkbox" name="noticias" id="noticias" <?php if ( $filapro["noticias"] == "Si" ) echo "checked" ?> >Noticias</td>
					<td><input type="checkbox" name="facebook" id="facebook" <?php if ( $filapro["facebook"] == "Si" ) echo "checked" ?> >Facebook</td>
					<td><input type="checkbox" name="twitter" id="twitter" <?php if ( $filapro["twitter"] == "Si" ) echo "checked" ?> >Twitter</td>
				</tr>
			</table>
		<p class="interl">Presupuesto estimado: </br>
			<span class="pequenio">(recuerde que este presupuesto es estimado, la cantidad final puede aumentar o disminuir)</span></br></br>
			<input type="text" name="presupuesto" id="presupuesto" value="<?php echo $filapro['presupuesto'] ?>" readonly>
		</p>
		<p><input type="checkbox" name="polit" id="polit" required>Aceptar política de privacidad</p>
		<input type="submit" name="enviar" id="enviar" value="Enviar" />
		<?php
			mysqli_close($conexion);
		?>
	</form>
</article>