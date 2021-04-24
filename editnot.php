<?php
	//Compruebo que el usuario sea administrador
	session_start();
	include "php/sql.php";
	comprobar(0);
?>
<article>
	<h2>Modificar noticia</h2>
	<?php
		$conexion = conectar();

		$query = "SELECT * FROM noticia WHERE id_noticia = ".$_POST['codigo'];
		$resul = mysqli_query($conexion,$query);
		$fila = mysqli_fetch_array($resul);

		mysqli_close($conexion);
	?>
	<!--Formulario para editar la noticia-->
	<form id="form" name="form" method="post" action="php/modnot.php">
		<input type="hidden" name="id_noticia" id="id_noticia" value="<?php echo $fila['id_noticia'] ?>">
		<p>Título: <br><input type="text" name="titulo" id="titulo" maxlength="20" value="<?php echo $fila['titulo'] ?>" placeholder="Escribe un título" required /></p>
		<p>descripción: <br><textarea name="desc" id="desc" maxlength="200" cols="30" rows="6" placeholder="Escribe una descripción (200 caracteres max.)" required><?php echo $fila['descripcion'] ?></textarea></p>
		<p>Premio: <br><input type="text" name="premio" id="premio" maxlength="20" value="<?php echo $fila['premio'] ?>" placeholder="Escribe un premio" required /></p>
		<p>Tecnología: <br><input type="text" name="tecno" id="tecno" maxlength="40" value="<?php echo $fila['tecnologia'] ?>" placeholder="Escribe las tecnologías empleadas" required /></p>
		<input type="submit" name="enviar" value="Enviar">
	</form>
</article>