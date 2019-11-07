<!DOCTYPE HTML>
<html	lang="es">

<head>
	<title>Libooks</title>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="resources/css/libooks.css"/>
	<link rel="stylesheet" type="text/css" href="resources/css/index.css"/>
	<link rel="icon" type="image/png" href="resources/images/logo.png"/>
</head>

<body>
	<header class="cabecera2">
		<a href="index.php"><img id="logo" src="resources/images/logo.png" alt="logo_libooks"/></a>

		<a href="index.php"><h1 id="titulo">LIBOOKS</h1></a>

		<?php
			require_once("cajita.php");

			session_start();
                        session_regenerate_id();

			if(!isset($_SESSION['conectado']))
				cajita(0);
			else if(isset($_SESSION['conectado']) && $_SESSION['conectado'] === TRUE)
				cajita(1);

			if(isset($_GET["login_required"]))
				echo
	     			"<script type='text/javascript'>
					window.onload = function(){alert('Debes iniciar sesión para hacer eso.');}
				</script>";
		?>
	</header>

	<section class="principal">
		<section class="columna">
			<h2>¿Qué es Libooks?</h2>
			<img id="relacionada" src="resources/images/libros.jpg" alt="libros"/>
			<p id="descripcion">Libooks es un sitio web dedicado a la recomendación de libros. Aquí, los usuarios podrán 				valorar los libros que hayan leído para que el resto de lectores tengan una idea de la calidad de cada libro. 				Además, para cada libro habrá un foro en donde se expresen las opiniones de los lectores y se realicen 				discusiones.</p>

			<p id="descripcion">A partir de las valoraciones de los usuarios, el sistema podrá realizar recomendaciones de 				otros libros que los usuarios no hayan leído y que el sistema crea que puedan gustarles.</p>
		</section>

		<section class="columna">
			<h2>Libros mejor valorados</h2>
			<article class="libro">
				<img class="imagen_libro" src="resources/images/los_pilares.jpg" alt="los_pilares"/>
				<h3 class="titulo_libro">Los Pilares de la Tierra</h3><br>
				<p class="autor">Ken Follett</p>
				<p id="estrellas"> ★★★★★ </p>
				<p>2963 votos</p>
			</article>


			<article class="libro">
				<img class="imagen_libro" src="resources/images/la_viajera.jpg" alt="la_viajera"/>
				<h3 class="titulo_libro">La Viajera del Tiempo</h3><br>
				<p class="autor">Lorena Franco</p>
				<p id="estrellas"> ★★★★★ </p>
				<p>2278 votos</p>
			</article>


			<article class="libro">
				<img class="imagen_libro" src="resources/images/nombre_viento.jpg" alt="nombre_viento"/>
				<h3 class="titulo_libro">El Nombre del Viento</h3><br>
				<p class="autor">Patrick Rothfuss</p>
				<p id="estrellas"> ★★★★✩ </p>
				<p>1928 votos</p>
			</article>

		</section>
	</section>

	<footer class="pie_de_pagina">
		<p id="contacto"><b>Contacto:</b> <a href="mailto:simondelosbros@correo.ugr.es" target="_blank">simondelosbros@correo.ugr.es</a></p>


		<form id="suscripcion" action="" method="post" name="suscripcion">
			¡Suscríbete a nuestra Newsletter! <br>
			<input class="texto_form" type="email" onfocus="this.value=''" value="Tu correo electrónico" required/>
			<input class="boton_form" type="submit" value="Suscribirse"/>
		</form>

		<p id="comosehizo"><a href="p2.pdf" target="_blank"><i>¿Cómo se hizo?</i><sup>[PDF]</sup></a></p>
	</footer>


</body>
</html>

