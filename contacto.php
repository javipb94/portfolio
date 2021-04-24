<article id="datos"><!--Esta página contiene algunos datos de contacto-->
   <div id="formcont">
      <form id="contactar" method="post" action="php/grabarcli.php" onsubmit="return validarcont()">
         <p>Nombre: </br><input type="text" name="nombre" id="nombre" placeholder="Escribe tu nombre" pattern="^[A-zÀ-ÿ\u00f1\u00d1]{2,20}(\s[A-zÀ-ÿ\u00f1\u00d1]{2,20})?$" title="El nombre debe estar compuesto por una o dos palabras con una longitud máxima de 20 caracteres cada una." required autofocus /></p>
         <p>Apellidos: </br><input type="text" name="apellidos" id="apellidos" placeholder="Escribe tus apellidos" pattern="^[A-zÀ-ÿ\u00f1\u00d1]{2,20}(\s[A-zÀ-ÿ\u00f1\u00d1]{2,20})?$" title="Los apellidos deben ser de una longitud máxima de 20 caracteres cada uno." required></p>
         <p>Correo electrónico: </br><input type="email" name="correo" id="correo" placeholder="Escribe tu correo" required /></p>
         <p>Teléfono: </br><input type="tel" name="telef" id="telef" placeholder="Escribe tu teléfono" pattern="^[0-9]{9}$" title="El teléfono se compondrá de 9 números sin espacios." required /></p>
         <p>Fecha: <br><input type="datetime-local" name="fecha" id="fecha" readonly></p>
         <p>Motivo del contacto: <br><textarea name="motivo" id="motivo" cols="40" rows="8" placeholder="Escribe el motivo de tu contacto" maxlength="300" required></textarea></p>
         <input type="submit" name="enviar" id="enviar" value="Enviar" />
      </form>
   </div>
   <div>
   	<dl>
      		<dt>E-mail:</dt>
      		<dd><a href="mailto:jp.javibarranquero@gmail.com">jp.javibarranquero@gmail.com</a></dd>
      		<dt>Teléfono:</dt>
      		<dd>+34 633 80 62 39</dd>
      		<dt>Dirección:</dt>
      		<dd>C/ Huerta Casilda<br/>29700 Vélez-Málaga</dd>
   	</dl>
   </div>
   <!--Aquí irán el mapa y el cálculo de ruta-->
   <p>Calcular ruta:</p>
   <p>Dirección de origen <input type="text" name="origen" id="origen"></p>
   <input type="button" value="Calcular ruta" onclick="calcularruta()"><br><br>
   <div id="mapa"></div>
   <div id="ruta"></div>
</article>