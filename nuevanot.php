<?php
	session_start();
	include "php/sql.php";

	//Compruebo que el usuario sea administrador
	comprobar(0);
?>
<article>
	<div id="form">
		<h2>Nueva noticia</h2>
		<!--Formulario para crear una nueva noticia-->
		<form action="php/grabarnot.php" method="post">
			<p>Título: <br><input type="text" name="titulo" id="titulo" maxlength="20" placeholder="Escribe un título" required /></p>
			<p>descripción: <br><textarea name="desc" id="desc" maxlength="200" cols="30" rows="6" placeholder="Escribe una descripción (200 caracteres max.)" required></textarea></p>
			<p>Premio: <br><input type="text" name="premio" id="premio" maxlength="20" placeholder="Escribe un premio" required /></p>
			<p>Tecnología: <br><input type="text" name="tecno" id="tecno" maxlength="40" placeholder="Escribe las tecnologías empleadas" required /></p>
			<input type="submit" name="enviar" value="Enviar">
		</form>
	</div>
</article>