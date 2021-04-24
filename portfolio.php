<!--Esta página contiene una lista de los diferentes ejercicios acompañados por sus imágenes-->
<?php
	session_start();
	include "php/sql.php";
?>
<article><!--Este article es el que contiene la galería-->
  <h2>Lista de trabajos</h2>
  <p>Haz click en cualquier imagen para ver una descripción del proyecto</p>
  <?php
			$conexion = conectar();

			if ( $conexion == false ) {
				echo "No se ha podido realizar la conexión a la base de datos";
				exit();
			}

			$query = "SELECT * FROM proyecto ORDER BY fecha_fin LIMIT 8";

			$resul = mysqli_query($conexion, $query);

			$i = 0;
			while ( $fila = mysqli_fetch_assoc($resul) ) {
				$i++;
				$proyecto[$i] = $fila;
			}
	?>
  <div id="container">
		<div id="slides">
			<?php
				for ( $i ; $i > 0 ; $i-- ) { 
					echo "<img src='imagenes/".$proyecto[$i]["imagen"]."' alt='".$proyecto[$i]["descripcion"]."' onclick='mostrarproy(".$proyecto[$i]["id_proyecto"].")' />";
				}
			?>
			<!--<img id="pag1" class="galeria" src="imagenes/pag1v2.jpg" alt="Mi primera página web" />
			<img id="pag2" class="galeria" src="imagenes/pag2v2.jpg" alt="Mi segunda página web" />
			<img id="bordes" class="galeria" src="imagenes/bordesv2.jpg" alt="Ejercicio de CSS centrado en bordes" />
			<img id="noticias" class="galeria" src="imagenes/noticiasv2.jpg" alt="Ejercicio de CSS centrado en cajas de texto y recorte de imágenes" />
			<img id="lista" class="galeria" src="imagenes/listav2.jpg" alt="Ejercicio html centrado en listas" />
			<img id="formulario" class="galeria" src="imagenes/formulariov2.jpg" alt="Ejercicio html centrado en formularios" />
			<img id="madrid" class="galeria" src="imagenes/madridv2.jpg" alt="Ejercicio html con tablas y listas" />
			<img id="javascript" class="galeria" src="imagenes/javascriptv2.jpg" alt="Ejercicio con eventos y javascript" />-->
		</div>
	</div>
</article>
<article id="ficha"><!--En este article se abrirá la ficha del trabajo sobre el que se haga click-->
	<?php
		foreach ( $proyecto as $val ) {
			if ( isset($val["imagen"])) {
				echo "<img class=".$val['id_proyecto']." style='display: none;' src='imagenes/".$val["imagen"]."' alt='".$val["descripcion"]."' onload='reescalar()' />";
			}
	?>
			<ul class="<?php echo $val['id_proyecto'] ?>" style="display: none;">
				<li>Tema: <?php echo $val["titulo"] ?></li>
				<li>Descripción: <?php echo $val["descripcion"] ?></li>
				<li>Lenguaje: <?php echo $val["lenguaje"] ?></li>
				<li>Tipo: <?php echo $val["tipo"] ?></li>
			</ul>
	<?php
		}
		mysqli_close($conexion);
	?>
</article>