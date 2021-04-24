	<!--$_SESSION['error'] se establecerá en su archivo php cuando se añada un cliente y notificará se ha sido posible dicha acción-->
	<?php 
		session_start();

		if ( isset($_SESSION['error']) ) {
			echo "<article style='color: #fff; border-bottom: 2px solid #000;'>".$_SESSION['error']."</article>";
			unset($_SESSION["error"]);
		}
	?>
<article id="intro"><!--Esta página contiene una introducción con un par de imágenes-->
	<h2>Introducción</h2>
	<p>Aquí podrás ver mi progresión como programador web, desde ejercicios simples hasta el completo desarrollo de mis propias páginas web.</p>
	<p>Trabajos destacados:</p>
	<div class="pag">
		<a href="imagenes/openquality.png" target="_blanck" title="Programa con gestión interna"><img src="imagenes/openquality.png" alt="Programa con gestión interna" /></a>
		<a href="imagenes/pag2.jpg" target="_blanck" title="Mi segunda página web"><img src="imagenes/pag2.jpg" alt="Mi segunda página web" /></a>
	</div>
</article>
<aside id="rss">
	<?php
		include "php/sql.php";

		//La conexión a la base de datos está en el archivo sql.php
		$conexion = conectar();

		if ( $conexion == false ) {
			echo "No se ha podido conectar";
			exit();
		}

		//Esta consulta devolverá los 5 últimos resultados de la tabla noticia
		$consulta = "SELECT * FROM noticia ORDER BY id_noticia DESC LIMIT 5";
		$resul = mysqli_query($conexion, $consulta);

		//Comprobación de que obtengo resultados, en caso positivo que me los imprima
		if ( mysqli_num_rows($resul) != 0 ) {
			while ( $linea = mysqli_fetch_assoc($resul) ) {
				$titulo = $linea['titulo'];
				$descripcion = $linea['descripcion'];
				$premio = $linea['premio'];
				$tecnologia = $linea['tecnologia'];
				echo "	<div id='".$linea['id_noticia']."' class='noticia' onclick='mostrarnoticia(`".$titulo."`, `".$descripcion."`, `".$premio."`, `".$tecnologia."`)'>
						<b>Titular</b>: ".$titulo."
						<p>Descripción: ".$descripcion."</p>
						<p>".$premio."</p>
						<p>".$tecnologia."</p>
						</div><hr>";
			}
			mysqli_free_result($resul);
			mysqli_close($conexion);
		} else {
			echo "No se ha podido acceder a los registros";
		}
	?>
</aside>
<article id="noticia">
	
</article>