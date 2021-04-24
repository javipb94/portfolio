<?php
	session_start();
	include 'php/sql.php';
?>
<article><!--En esta página se encuentra el formularios de registro-->
	<div id="form">
		<h2>Cliente</h2>
		<form id="registro" method="post" action="php/grabarpro.php" onsubmit="return validarpre()" onchange="precio()" enctype="multipart/form-data">
			<p>
				<select name="codigo" id="codigo" required>
					<option value="">---</option>
					<?php
						$conexion = conectar();

						if ( $conexion == false ) {
							echo "No se ha podido realizar la conexión a la base de datos";
							exit();
						}

						$query = "SELECT id_usuario, user FROM usuario";

						$resul = mysqli_query($conexion, $query);

						while ( $fila = mysqli_fetch_assoc($resul) ) {
							echo "<option value='".$fila['id_usuario']."'>".$fila['user']."</option>";
						}

						mysqli_close($conexion);
					?>
				</select>
			</p>
			<h2>La web</h2>
			<p>Título: <br><input type="text" name="titulo" id="titulo" placeholder="Escribe un título identificativo" maxlength="20" required></p>
			<p>Descripción: <br><textarea name="desc" id="desc" cols="40" rows="8" placeholder="Escribe una descripción del proyecto (200 caracteres max.)" maxlength="200" required></textarea></p>
			<p>Lenguaje: <br><input type="text" name="leng" id="leng" placeholder="Lenguajes de programación empleados" maxlength="20" required></p>
			<p>Tipo de página web: </br>
				<select name="tipoweb" id="tipoweb" required="true">
					<option value="">---</option>
					<option value="Estática">Estática</option>
					<option value="Dinámica">Dinámica</option>
					<option value="BBDD">Con base de datos</option>
				</select>
			</p>
			<p>
				¿Añadir imagen?<br><input type="checkbox" name="subirimg" id="subirimg" onchange="activarimg(this)"><br><br><input type="file" name="imagen" id="imagen" disabled="true" onchange="cambimg(event)"></p>
				<img id="imgresul" src="" width="150"><br><br>
			</p>
			<p>Plazo en meses: </br><input type="number" name="plazo" id="plazo" min="1" max="12" required></p>
			Marque las secciones deseadas: 
				<table>
					<tr>
						<td><input type="checkbox" name="quien" id="quien">Quienes somos</td>
						<td><input type="checkbox" name="donde" id="donde">Donde estamos</td>
						<td><input type="checkbox" name="galeria" id="galeria">Galería de fotos</td>
						<td><input type="checkbox" name="ecomerce" id="ecomerce">eComerce</td>
					</tr>
					<tr>
						<td><input type="checkbox" name="gestion" id="gestion">Gestión interna</td>
						<td><input type="checkbox" name="noticias" id="noticias">Noticias</td>
						<td><input type="checkbox" name="facebook" id="facebook">Facebook</td>
						<td><input type="checkbox" name="twitter" id="twitter">Twitter</td>
					</tr>
				</table>
			<p class="interl">Presupuesto estimado: </br>
				<span class="pequenio">(recuerde que este presupesto es estimado, la cantidad final puede aumentar o disminuir)</span></br></br>
				<input type="text" name="presupuesto" id="presupuesto" readonly>
			</p>
			<p><input type="checkbox" name="polit" id="polit" required>Aceptar política de privacidad</p>
			<input type="submit" name="enviar" id="enviar" value="Enviar" />
		</form>
	</div>
</article>