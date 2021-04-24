/*
  SlidesJS 3.0.4 http://slidesjs.com
  (c) 2013 by Nathan Searles http://nathansearles.com
  Updated: June 26th, 2013
  Apache License: http://www.apache.org/licenses/LICENSE-2.0
*/
(function() {(function(e,t,n) {var r,i,s;s="slidesjs";i={width:910,height:463,start:1,navigation:{active:!0,effect:"slide"},pagination:{active:!0,effect:"slide"},play:{active:!1,effect:"slide",interval:5e3,auto:!1,swap:!0,pauseOnHover:!1,restartDelay:2500},effect:{slide:{speed:500},fade:{speed:300,crossfade:!0}},callback:{loaded:function(){},start:function(){},complete:function(){}}};r=function(){function t(t,n){this.element=t;this.options=e.extend(!0,{},i,n);this._defaults=i;this._name=s;this.init()}return t}();r.prototype.init=function(){var n,r,i,s,o,u,a=this;n=e(this.element);this.data=e.data(this);e.data(this,"animating",!1);e.data(this,"total",n.children().not(".slidesjs-navigation",n).length);e.data(this,"current",this.options.start-1);e.data(this,"vendorPrefix",this._getVendorPrefix());if(typeof TouchEvent!="undefined"){e.data(this,"touch",!0);this.options.effect.slide.speed=this.options.effect.slide.speed/2}n.css({overflow:"hidden"});n.slidesContainer=n.children().not(".slidesjs-navigation",n).wrapAll("<div class='slidesjs-container'>",n).parent().css({overflow:"hidden",position:"relative"});e(".slidesjs-container",n).wrapInner("<div class='slidesjs-control'>",n).children();e(".slidesjs-control",n).css({position:"relative",left:0});e(".slidesjs-control",n).children().addClass("slidesjs-slide").css({position:"absolute",top:0,left:0,width:"100%",zIndex:0,display:"none",webkitBackfaceVisibility:"hidden"});e.each(e(".slidesjs-control",n).children(),function(t){var n;n=e(this);return n.attr("slidesjs-index",t)});if(this.data.touch){e(".slidesjs-control",n).on("touchstart",function(e){return a._touchstart(e)});e(".slidesjs-control",n).on("touchmove",function(e){return a._touchmove(e)});e(".slidesjs-control",n).on("touchend",function(e){return a._touchend(e)})}n.fadeIn(0);this.update();this.data.touch&&this._setuptouch();e(".slidesjs-control",n).children(":eq("+this.data.current+")").eq(0).fadeIn(0,function(){return e(this).css({zIndex:10})});if(this.options.navigation.active){o=e("<a>",{"class":"slidesjs-previous slidesjs-navigation",href:"#",title:"Previous",text:"Previous"}).appendTo(n);r=e("<a>",{"class":"slidesjs-next slidesjs-navigation",href:"#",title:"Next",text:"Next"}).appendTo(n)}e(".slidesjs-next",n).click(function(e){e.preventDefault();a.stop(!0);return a.next(a.options.navigation.effect)});e(".slidesjs-previous",n).click(function(e){e.preventDefault();a.stop(!0);return a.previous(a.options.navigation.effect)});if(this.options.play.active){s=e("<a>",{"class":"slidesjs-play slidesjs-navigation",href:"#",title:"Play",text:"Play"}).appendTo(n);u=e("<a>",{"class":"slidesjs-stop slidesjs-navigation",href:"#",title:"Stop",text:"Stop"}).appendTo(n);s.click(function(e){e.preventDefault();return a.play(!0)});u.click(function(e){e.preventDefault();return a.stop(!0)});this.options.play.swap&&u.css({display:"none"})}if(this.options.pagination.active){i=e("<ul>",{"class":"slidesjs-pagination"}).appendTo(n);e.each(new Array(this.data.total),function(t){var n,r;n=e("<li>",{"class":"slidesjs-pagination-item"}).appendTo(i);r=e("<a>",{href:"#","data-slidesjs-item":t,html:t+1}).appendTo(n);return r.click(function(t){t.preventDefault();a.stop(!0);return a.goto(e(t.currentTarget).attr("data-slidesjs-item")*1+1)})})}e(t).bind("resize",function(){return a.update()});this._setActive();this.options.play.auto&&this.play();return this.options.callback.loaded(this.options.start)};r.prototype._setActive=function(t){var n,r;n=e(this.element);this.data=e.data(this);r=t>-1?t:this.data.current;e(".active",n).removeClass("active");return e(".slidesjs-pagination li:eq("+r+") a",n).addClass("active")};r.prototype.update=function(){var t,n,r;t=e(this.element);this.data=e.data(this);e(".slidesjs-control",t).children(":not(:eq("+this.data.current+"))").css({display:"none",left:0,zIndex:0});r=t.width();n=this.options.height/this.options.width*r;this.options.width=r;this.options.height=n;return e(".slidesjs-control, .slidesjs-container",t).css({width:r,height:n})};r.prototype.next=function(t){var n;n=e(this.element);this.data=e.data(this);e.data(this,"direction","next");t===void 0&&(t=this.options.navigation.effect);return t==="fade"?this._fade():this._slide()};r.prototype.previous=function(t){var n;n=e(this.element);this.data=e.data(this);e.data(this,"direction","previous");t===void 0&&(t=this.options.navigation.effect);return t==="fade"?this._fade():this._slide()};r.prototype.goto=function(t){var n,r;n=e(this.element);this.data=e.data(this);r===void 0&&(r=this.options.pagination.effect);t>this.data.total?t=this.data.total:t<1&&(t=1);if(typeof t=="number")return r==="fade"?this._fade(t):this._slide(t);if(typeof t=="string"){if(t==="first")return r==="fade"?this._fade(0):this._slide(0);if(t==="last")return r==="fade"?this._fade(this.data.total):this._slide(this.data.total)}};r.prototype._setuptouch=function(){var t,n,r,i;t=e(this.element);this.data=e.data(this);i=e(".slidesjs-control",t);n=this.data.current+1;r=this.data.current-1;r<0&&(r=this.data.total-1);n>this.data.total-1&&(n=0);i.children(":eq("+n+")").css({display:"block",left:this.options.width});return i.children(":eq("+r+")").css({display:"block",left:-this.options.width})};r.prototype._touchstart=function(t){var n,r;n=e(this.element);this.data=e.data(this);r=t.originalEvent.touches[0];this._setuptouch();e.data(this,"touchtimer",Number(new Date));e.data(this,"touchstartx",r.pageX);e.data(this,"touchstarty",r.pageY);return t.stopPropagation()};r.prototype._touchend=function(t){var n,r,i,s,o,u,a,f=this;n=e(this.element);this.data=e.data(this);u=t.originalEvent.touches[0];s=e(".slidesjs-control",n);if(s.position().left>this.options.width*.5||s.position().left>this.options.width*.1&&Number(new Date)-this.data.touchtimer<250){e.data(this,"direction","previous");this._slide()}else if(s.position().left<-(this.options.width*.5)||s.position().left<-(this.options.width*.1)&&Number(new Date)-this.data.touchtimer<250){e.data(this,"direction","next");this._slide()}else{i=this.data.vendorPrefix;a=i+"Transform";r=i+"TransitionDuration";o=i+"TransitionTimingFunction";s[0].style[a]="translateX(0px)";s[0].style[r]=this.options.effect.slide.speed*.85+"ms"}s.on("transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd",function(){i=f.data.vendorPrefix;a=i+"Transform";r=i+"TransitionDuration";o=i+"TransitionTimingFunction";s[0].style[a]="";s[0].style[r]="";return s[0].style[o]=""});return t.stopPropagation()};r.prototype._touchmove=function(t){var n,r,i,s,o;n=e(this.element);this.data=e.data(this);s=t.originalEvent.touches[0];r=this.data.vendorPrefix;i=e(".slidesjs-control",n);o=r+"Transform";e.data(this,"scrolling",Math.abs(s.pageX-this.data.touchstartx)<Math.abs(s.pageY-this.data.touchstarty));if(!this.data.animating&&!this.data.scrolling){t.preventDefault();this._setuptouch();i[0].style[o]="translateX("+(s.pageX-this.data.touchstartx)+"px)"}return t.stopPropagation()};r.prototype.play=function(t){var n,r,i,s=this;n=e(this.element);this.data=e.data(this);if(!this.data.playInterval){if(t){r=this.data.current;this.data.direction="next";this.options.play.effect==="fade"?this._fade():this._slide()}e.data(this,"playInterval",setInterval(function(){r=s.data.current;s.data.direction="next";return s.options.play.effect==="fade"?s._fade():s._slide()},this.options.play.interval));i=e(".slidesjs-container",n);if(this.options.play.pauseOnHover){i.unbind();i.bind("mouseenter",function(){return s.stop()});i.bind("mouseleave",function(){return s.options.play.restartDelay?e.data(s,"restartDelay",setTimeout(function(){return s.play(!0)},s.options.play.restartDelay)):s.play()})}e.data(this,"playing",!0);e(".slidesjs-play",n).addClass("slidesjs-playing");if(this.options.play.swap){e(".slidesjs-play",n).hide();return e(".slidesjs-stop",n).show()}}};r.prototype.stop=function(t){var n;n=e(this.element);this.data=e.data(this);clearInterval(this.data.playInterval);this.options.play.pauseOnHover&&t&&e(".slidesjs-container",n).unbind();e.data(this,"playInterval",null);e.data(this,"playing",!1);e(".slidesjs-play",n).removeClass("slidesjs-playing");if(this.options.play.swap){e(".slidesjs-stop",n).hide();return e(".slidesjs-play",n).show()}};r.prototype._slide=function(t){var n,r,i,s,o,u,a,f,l,c,h=this;n=e(this.element);this.data=e.data(this);if(!this.data.animating&&t!==this.data.current+1){e.data(this,"animating",!0);r=this.data.current;if(t>-1){t-=1;c=t>r?1:-1;i=t>r?-this.options.width:this.options.width;o=t}else{c=this.data.direction==="next"?1:-1;i=this.data.direction==="next"?-this.options.width:this.options.width;o=r+c}o===-1&&(o=this.data.total-1);o===this.data.total&&(o=0);this._setActive(o);a=e(".slidesjs-control",n);t>-1&&a.children(":not(:eq("+r+"))").css({display:"none",left:0,zIndex:0});a.children(":eq("+o+")").css({display:"block",left:c*this.options.width,zIndex:10});this.options.callback.start(r+1);if(this.data.vendorPrefix){u=this.data.vendorPrefix;l=u+"Transform";s=u+"TransitionDuration";f=u+"TransitionTimingFunction";a[0].style[l]="translateX("+i+"px)";a[0].style[s]=this.options.effect.slide.speed+"ms";return a.on("transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd",function(){a[0].style[l]="";a[0].style[s]="";a.children(":eq("+o+")").css({left:0});a.children(":eq("+r+")").css({display:"none",left:0,zIndex:0});e.data(h,"current",o);e.data(h,"animating",!1);a.unbind("transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd");a.children(":not(:eq("+o+"))").css({display:"none",left:0,zIndex:0});h.data.touch&&h._setuptouch();return h.options.callback.complete(o+1)})}return a.stop().animate({left:i},this.options.effect.slide.speed,function(){a.css({left:0});a.children(":eq("+o+")").css({left:0});return a.children(":eq("+r+")").css({display:"none",left:0,zIndex:0},e.data(h,"current",o),e.data(h,"animating",!1),h.options.callback.complete(o+1))})}};r.prototype._fade=function(t){var n,r,i,s,o,u=this;n=e(this.element);this.data=e.data(this);if(!this.data.animating&&t!==this.data.current+1){e.data(this,"animating",!0);r=this.data.current;if(t){t-=1;o=t>r?1:-1;i=t}else{o=this.data.direction==="next"?1:-1;i=r+o}i===-1&&(i=this.data.total-1);i===this.data.total&&(i=0);this._setActive(i);s=e(".slidesjs-control",n);s.children(":eq("+i+")").css({display:"none",left:0,zIndex:10});this.options.callback.start(r+1);if(this.options.effect.fade.crossfade){s.children(":eq("+this.data.current+")").stop().fadeOut(this.options.effect.fade.speed);return s.children(":eq("+i+")").stop().fadeIn(this.options.effect.fade.speed,function(){s.children(":eq("+i+")").css({zIndex:0});e.data(u,"animating",!1);e.data(u,"current",i);return u.options.callback.complete(i+1)})}return s.children(":eq("+r+")").stop().fadeOut(this.options.effect.fade.speed,function(){s.children(":eq("+i+")").stop().fadeIn(u.options.effect.fade.speed,function(){return s.children(":eq("+i+")").css({zIndex:10})});e.data(u,"animating",!1);e.data(u,"current",i);return u.options.callback.complete(i+1)})}};r.prototype._getVendorPrefix=function(){var e,t,r,i,s;e=n.body||n.documentElement;r=e.style;i="transition";s=["Moz","Webkit","Khtml","O","ms"];i=i.charAt(0).toUpperCase()+i.substr(1);t=0;while(t<s.length){if(typeof r[s[t]+i]=="string")return s[t];t++}return!1};return e.fn[s]=function(t){return this.each(function(){if(!e.data(this,"plugin_"+s))return e.data(this,"plugin_"+s,new r(this,t))})}})(jQuery,window,document)}).call(this);


//Esta función cambia el color de fondo del botón de la barra de navegación correspondiente a la página en la que te encuentras
$(document).ready( function() {
	$('span.selector').click( function() {
		$('span.selector').css('backgroundColor', 'rgb(138,206,229)');
		$(this).css('backgroundColor', '#666');
	});
	$('#donde').click( function() {
		$('span.selector').css('backgroundColor', 'rgb(138,206,229)');
	});
	$('#hidlog > span').click( function() {
		$('span.selector').css('backgroundColor', 'rgb(138,206,229)');
	});
});

//Esta función muestra un mensaje de bienvenida a los 5 segundos de entrar en la página
function bienvenida() {
	setTimeout(function() {alert('Bienvenido')}, 5000);
}

//Esta función muestra y oculta el formulario de inicio de sesión de la página
function mostrar() {
	var activo;
	if ( $('#hidlog').css('display') == 'none' ) {
		$('#hidlog').css('display', 'block');
		activo = false;
	}

	$(document).click( function(event) { 
		var $target = $(event.target);
		if( !$target.closest('#hidlog').length && activo == true ) {
			$('#hidlog').css('display', 'none');
			$(document).off();
		}
		activo = true;
	});
}

//Esta función hace que la barra de navegación esté siempre visible agregando una clase con la propiedad fixed en el documento css
window.onscroll = function() {
	var y = window.pageYOffset;

	if ( y >= 342 ) {
		$('nav').addClass('sticky');
		$('.scroll').css('top', '45px');
	} else {
		$('nav').removeClass('sticky');
		$('.scroll').css('top', '0px');
	}
}

//Generador de noticias rss
function rss(){
	var objHttp = null;
	if ( window.XMLHttpRequest ) {
		objHttp = new XMLHttpRequest();
	} else if( window.ActiveXObject ) {
		objHttp = new ActiveXObject('Microsoft.XMLHTTP');
	}
	objHttp.open('GET', 'bbc.xml', true);
	objHttp.onreadystatechange = function() {
		if ( objHttp.readyState == 4 ) {							
			var noticias = objHttp.responseXML; 
			var cadena = '';
			var entrada = noticias.getElementsByTagName('entry');
			for (i = 0;i < 5; i++) { 			
				cadena = cadena + '<b>Titular:</b> ' + entrada[i].getElementsByTagName('title')[0].childNodes[0].nodeValue + '<br/>';	
				cadena = cadena + '<b>Descripcion:</b> ' + entrada[i].getElementsByTagName('summary')[0].childNodes[0].nodeValue + '<br/>';
				cadena = cadena + '<b>Enlace:</b> <a href="' + entrada[i].getElementsByTagName('link')[0].getAttribute('href') + '" target="_blank">' +
					entrada[i].getElementsByTagName('link')[0].getAttribute('href') + '</a><br/><br/>';
			}
			document.getElementById('rss').innerHTML = cadena;
			} 
	}
	objHttp.send(null);
}

//Función para que cuando se haga click en una de las 5 noticias de inicio, ésta se muestre más abajo
function mostrarnoticia(titulo, descripcion, premio, tecnologia) {
	var noticia = '<h2>' + titulo + '</h2>';
	noticia += '<p>' + descripcion + '</p>';

	if ( premio ) {
		noticia += '<p>Premio obtenido:</p>';
		noticia += '<p><b>' + premio + '</b></p>';
	}

	if ( tecnologia ) {
		noticia += '<p>Tecnologías empleadas:</p>';
		noticia += '<p><b>' + tecnologia + '</b></p>';
	}

	document.getElementById('noticia').innerHTML = noticia;
	$('#noticia').css('border-top', '1px solid black');
	$('#noticia').css('padding', '15px');
}

//Función que lanza el carrusel de imágenes
function carrusel() {
	$('#slides').slidesjs({
	width: 600,
    height: 400,
    play: 	{active: true,
    	    auto: true,
        	interval: 5000,
	        swap: true
    	    }
	});
}

//Función para el apartado portfolio, cuando se haga click en la galería, se harán visibles los datos del proyecto en el que se haya hecho click
function mostrarproy(id) {
	$('#ficha > img, #ficha > ul').css('display', 'none');
	$('.' + id).css('display', 'block');
}

/*Al cambiar el contenido de la página también tengo que cambiar la altura de la barra lateral*/
function reescalar() {
	var altura = parseInt($('#ajax').css('height')) + 21;

	$('#rss').css('height', altura + 'px');
}

//Esta función es para cargar el mapa en las páginas de contacto y donde estamos
var mapa;
var mostrar_direcciones;
var servicios_rutas = new google.maps.DirectionsService();
var punto;
function cargarmapa() {
	mostrar_direcciones = new google.maps.DirectionsRenderer();
	punto = new google.maps.LatLng( 36.785954, -4.109426);
	var opciones = { zoom: 10, center: punto, mapTypeId: google.maps.MapTypeId.ROADMAP};
	mapa = new google.maps.Map(document.getElementById("mapa"), opciones);
	var marca = new google.maps.Marker({ position: punto, map: mapa, title: "Sucursal molona"});
	mostrar_direcciones.setMap(mapa);
	mostrar_direcciones.setPanel(document.getElementById("ruta"));
}

//Función para calcular la ruta en el mapa de contacto y la sección donde estamos
function calcularruta() {
	var origen = document.getElementById("origen").value;
	var opciones = { origin: origen,  destination: punto, travelMode: google.maps.DirectionsTravelMode.DRIVING};
	servicios_rutas.route(opciones, function(response, status) {
		if ( status == google.maps.DirectionsStatus.OK ) {
			mostrar_direcciones.setDirections(response);
			setTimeout(function() {reescalar()}, 1);
		} else {
			alert('Dirección no encontrada, prueba con una población');
		}
	});
}

//Esta función cargará el contenido de la página mediante ajax utilizando como contenedor el section principal
function contenido(pagina, dato){
	var objHttp = null;
	if ( window.XMLHttpRequest ) {
		objHttp = new XMLHttpRequest();
	} else if ( window.ActiveXObject ) {
		objHttp = new ActiveXObject('Microsoft.XMLHTTP');
	}
	objHttp.open('POST', pagina + '.php', true);
	objHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	objHttp.onreadystatechange = function() {
		if ( objHttp.readyState == 4 ) {							
			var documento = objHttp.responseText;

			//Cambiaré el title dependiendo de la página a la que acceda
			if ( pagina == 'donde' ) {
				pagina = 'donde estamos';
			}
			document.title = pagina[0].toUpperCase() + pagina.slice(1);

			document.getElementById('ajax').innerHTML = documento;

			//Si la página a la que se accede es portfolio, tengo que cargar el carrusel
			if ( pagina == 'portfolio' ) {
				carrusel();
				/*$('.galeria').click( function(){
					var caracteristicas = '<br><br>';

					switch (this.id) {
						case 'pag1':
							caracteristicas += '<ul>' +
													'<li>Tema: Coches</li>' +
													'<li>Descripción: Mi primera página web con varios archivos html</li>' +
													'<li>Lenguaje usado: HTML y CSS</li>' +
												'</ul>';
							break;
						case 'pag2':
							caracteristicas += '<ul>' +
													'<li>Tema: Dark Souls</li>' +
													'<li>Descripción: Mi segunda página web con varios archivos html</li>' +
													'<li>Lenguaje usado: HTML y CSS</li>' +
												'</ul>';
							break;
						case 'bordes':
							caracteristicas += '<ul>' +
													'<li>Tema: Tipos de bordes</li>' +
													'<li>Descripción: Ejercicio en el cual se practican los diferentes tipos de bordes</li>' +
													'<li>Lenguaje usado: HTML y CSS</li>' +
												'</ul>';
							break;
						case 'noticias':
							caracteristicas += '<ul>' +
													'<li>Tema: Overflow</li>' +
													'<li>Descripción: Ejercicio pensado para trabajar el recorte de párrafos e imágenes</li>' +
													'<li>Lenguaje usado: HTML y CSS</li>' +
												'</ul>';
							break;
						case 'lista':
							caracteristicas += '<ul>' +
													'<li>Tema: Listas</li>' +
													'<li>Descripción: Ejercicio en el que se ve la forma de enumerar distintos elementos</li>' +
													'<li>Lenguaje usado: HTML y CSS</li>' +
												'</ul>';
							break;
						case 'formulario':
							caracteristicas += '<ul>' +
													'<li>Tema: Formulario</li>' +
													'<li>Descripción: En este ejercicio se ha trabajado la forma de tratar diferentes tipos de campos en un formulario</li>' +
													'<li>Lenguaje usado: HTML</li>' +
												'</ul>';
							break;
						case 'madrid':
							caracteristicas += '<ul>' +
													'<li>Tema: Madrid</li>' +
													'<li>Descripción: Página con la implicación de títulos, párrafos, tablas, listas, imágenes y un campo de formulario</li>' +
													'<li>Lenguaje usado: HTML y CSS</li>' +
												'</ul>';
							break;
						case 'javascript':
							caracteristicas += '<ul>' +
													'<li>Tema: Javascript</li>' +
													'<li>Descripción: Ejercicio con interacción de javascript, en el original se podrá interactuar con las imágenes y las casillas de verificación</li>' +
													'<li>Lenguaje usado: HTML, CSS y JS</li>' +
												'</ul>';
							break;
					}

					document.getElementById('ficha').innerHTML = 
						'<br><br><a href="' + this.src.replace("v2", "") + '" target="_blanck" title="' + this.alt + '"><img src="' + this.src.replace("v2", "") + '" alt="' + this.alt + '" onload="reescalar()" /></a>' + caracteristicas;
				});*/
			//Si la página es contacto necesito la fecha actual para rellenar ese campo del formulario y cargar el mapa
			} else if ( pagina == 'contacto' ) {
				var fecha = new Date();
				anio = fecha.getFullYear();
				mes = fecha.getMonth() + 1;
				if ( mes < 10 ) {
					mes = '0' + mes;
				}
				dia = fecha.getDate();
				if ( dia < 10 ) {
					dia = '0' + dia;
				}
				hora = fecha.getHours();
				if ( hora < 10 ) {
					hora = '0' + hora;
				}
				minuto = fecha.getMinutes();
				if ( minuto < 10) {
					minuto = '0' + minuto;
				}

				document.getElementById('fecha').value = anio + '-' + mes + '-' + dia + 'T' + hora + ':' + minuto;

				cargarmapa();
			} else if ( pagina == 'donde estamos') {
				cargarmapa();
			}
		}
	}

	objHttp.send('codigo=' + dato);
}

/*Validación para los campos comunes en los formularios de presupuesto y contacto*/
function validarcomun() {
	var nombre = document.getElementById('nombre').value;
	var apellidos = document.getElementById('apellidos').value;
	var correo = document.getElementById('correo').value;
	var telef = document.getElementById('telef').value;

	if ( nombre.length == 0 ) {
		alert('El nombre es un campo obligatorio');
		document.getElementById('nombre').focus();
		return false;
	} else if ( !/^[A-zÀ-ÿ\u00f1\u00d1]{2,20}(\s[A-zÀ-ÿ\u00f1\u00d1]{2,20})?$/.test(nombre) ) {
		alert('No se admiten números ni símbolos en el nombre, solo se admiten nombres compuestos de 1 o 2 palabras de entre 2 a 20 caracteres');
		document.getElementById('nombre').focus();
		return false;
	}

	if ( apellidos.length == 0 ) {
		alert('El campo apellidos es obligatorio');
		document.getElementById('apellidos').focus();
		return false;
	} else if ( !/^[A-zÀ-ÿ\u00f1\u00d1]{2,20}(\s[A-zÀ-ÿ\u00f1\u00d1]{2,20})?$/.test(apellidos) ) {
		alert('No se admiten números ni símbolos en el campo apellidos, solo se admiten 1 o 2 apellidos de 2 a 20 caracteres');
		document.getElementById('apellidos').focus();
		return false;
	}

	if ( correo.length == 0 ) {
		alert('El campo correo es obligatorio');
		document.getElementById('correo').focus();
		return false;
	} else if ( !/^.+\@.+\..+$/.test(correo) ) {
		alert('El campo correo debe tener el siguiente formato: dirección@ejemplo.com');
		document.getElementById('correo').focus();
		return false;
	}

	if ( telef.length == 0 ) {
		alert('El campo teléfono es obligatorio');
		document.getElementById('telef').focus();
		return false;
	} else if ( !/^[0-9]{9}$/.test(telef) ) {
		alert('El teléfono se compondrá de 9 números sin espacios');
		document.getElementById('telef').focus();
		return false;
	}
}

//Función para rellenar los datos de la página presupuesto cuando se seleccione un cliente
function actualizar(cliente) {
	var ctel = document.getElementById('telef');
	var cnombre = document.getElementById('nombre');
	var capell = document.getElementById('apellidos');
	var ccorreo = document.getElementById('correo');

	var datalist = document.getElementsByClassName('opciones');

	for ( var i = 0 ; i < datalist.length ; i++) {
		if ( datalist[i].value == cliente ) {
			var cont = datalist[i].getAttribute('cont');
		}
	}

	ctel.value = tel[cont];
	cnombre.value = nombre[cont];
	capell.value = apell[cont];
	ccorreo.value = correo[cont];
}

//Validación para los campos restantes del formulario de presupuesto
function validarpre() {
	validarcomun();

	var tipoweb = document.getElementById('tipoweb').value;
	var plazo = document.getElementById('plazo').value;
	var polit = document.getElementById('polit').checked;


	if ( tipoweb == 0 ) {
		alert('Debe seleccionar un tipo de web');
		document.getElementById('tipoweb').focus();
		return false;
	}

	if ( plazo.length == 0 ) {
		alert('Debe seleccionar un plazo de tiempo en meses');
		document.getElementById('plazo').focus();
		return false;
	} else if ( plazo < 1 || plazo > 12 ) {
		alert('El plazo debe de ser de al menos 1 mes y no más de 12');
		document.getElementById('plazo').focus();
		return false;
	}

	if ( polit == false ) {
		alert('Debe aceptar nuestro acuerdo de política de privacidad');
		return false;
	}
	
	return true;
}

//Función activar y desactivar el input de archivo de la página de presupuesto
function activarimg(checkbox) {
	if ( checkbox.checked == true ) {
		document.getElementById('imagen').disabled = false;
	} else {
		document.getElementById('imagen').disabled = true;
		document.getElementById('imgresul').src = '';
		document.getElementById('imagen').value = '';
	}
}

//Función para mostrar una vista previa de la imagen enviada en la página de presupuesto
function cambimg(img) {
	document.getElementById("imgresul").src = URL.createObjectURL(img.target.files[0]);
}

//Cálculo del precio de la página de presupuesto
function precio() {
	var precio = 0;
	var tipoweb = document.getElementById('tipoweb').value;
	var plazo = document.getElementById('plazo').value;
	var quien = document.getElementById('quien').checked;
	var donde = document.getElementById('donde').checked;
	var galeria = document.getElementById('galeria').checked;
	var ecomerce = document.getElementById('ecomerce').checked;
	var gestion = document.getElementById('gestion').checked;
	var noticias = document.getElementById('noticias').checked;
	var facebook = document.getElementById('facebook').checked;
	var twitter = document.getElementById('twitter').checked;
	var extra = [quien, donde, galeria, ecomerce, gestion, noticias, facebook, twitter];

	switch (tipoweb) {
		case 'Estática':
			precio = 600;
			break;
		case 'Dinámica':
			precio = 800;
			break;
		case 'BBDD':
			precio = 1000;
			break;
	}

	if ( plazo <= 4 && plazo >= 1 ) {
		precio = precio * (100 - plazo * 5) / 100;
	} else if ( plazo > 4 ) {
		precio = precio * (100 - 20) / 100;
	}

	for( i in extra ) {
		if ( extra[i] ) {
			precio = precio + 400;
		}
	}

	document.getElementById('presupuesto').value = precio + '€';
}

//Validación para los campos restantes del formulario de contacto
function validarcont() {
	validarcomun();

	var motivo = document.getElementById('motivo').value

	if ( motivo.length == 0 ) {
		alert('Debe especificar el motivo de su contacto');
		document.getElementById('motivo').focus();
		return false;
	} else if ( motivo.length > 300 ) {
		alert('El motivo de su contacto debe ser explicado en menos de 300 caracteres');
		document.getElementById('motivo').focus();
		return false;
	}

	return true;
}

//función para el formulario de registro de usuario, hay 2 campos de contraseña y sus valores deben ser iguaales
function validarpass() {
	var pass1 = document.getElementById("pass1").value;
	var pass2 = document.getElementById("pass2").value;

	if ( pass1 != pass2 ) {
		alert("Las contraseñas no son iguales");
		return false;
	} else {
		return true;
	}
}

//Esta función evitará que se pidan citas fuera de horario
function validarfechacita() {
	var fecha = new Date(document.getElementById('fecha').value);
	var dia = fecha.getDay();
	var hora = fecha.getHours();
	var minuto = fecha.getMinutes();

	if ( dia == 0 ) {
		alert("No se pueden pedir citas los domingos");
		return false;
	} else if ( hora < 9 || hora > 13 && hora < 16 || hora > 19 ) {
		alert("Horario disponible: 9:00-13:30 y 16:00-19:30");
		return false;
	} else if ( hora == 13 && minuto > 30 || hora == 19 && minuto > 30 ) {
		alert("Horario disponible: 9:00-13:30 y 16:00-19:30");
		return false;
	} else {
		return true;
	}
}

//Función para que no deje cambiar citas sin un margen de 72 horas, el admin podrá cambiarla a voluntad
function cambiarcita(fechacita, admin) {
	if ( admin == 0 ) {
		return true;
	}

	fechacita = fechacita.toString();
	var fecha = new Date(fechacita.slice(0, 4) + "," + fechacita.slice(4, 6) + "," + fechacita.slice(6, 8) + " " + fechacita.slice(8,10) + ":" + fechacita.slice(10));

	fecha.setDate(fecha.getDate() - 3);

	if ( fecha < Date.now() ) {
		alert("Solo se puede cambiar la fecha con 3 días de antelación");
		return false;
	} else {
		return true;
	}
}

//función para no borrar en casi de click accidental
function confirmarborrado() {
	if (!confirm("¿Eliminar?")) {
		return false;
	} else {
		return true;
	}
}