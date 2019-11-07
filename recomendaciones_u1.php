<!DOCTYPE HTML>
<html	lang="es">

<head>
	<title>Libooks / Recomendaciones</title>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="resources/css/libooks.css"/>
	<link rel="stylesheet" type="text/css" href="resources/css/recomendaciones.css"/>
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
				header('Location: index.php?login_required');
			else if(isset($_SESSION['conectado']) && $_SESSION['conectado'] === TRUE)
				cajita(1);
		?>
	</header>
	
	<main class="principal">
		<section class="recomendaciones">
			<h2 class="sombra">Libros recomendados:</h2>
			<h3 class="sombra">Recomendados por nuestros libreros:</h3>
			<hr>
			<section class="recomendados">
				<article class="libro">
					<img class="imagen_libro" src="resources/images/biblioteca_en_llamas.jpg"/>
					<span class="rodear">
						<p class="titulo">LA BIBLIOTECA EN LLAMAS</p>
						<p class="autor">Susan Orlean</p>
					</span>
				</article>
				<article class="libro">
					<img class="imagen_libro" src="resources/images/disputado_voto.jpg"/>
					<span class="rodear">
						<p class="titulo">EL DISPUTADO VOTO DEL SEÑOR CAYO</p>
						<p class="autor">Miguel Delibes</p>
					</span>
				</article>
				<article class="libro">
					<img class="imagen_libro" src="resources/images/lucidez.jpg"/>
					<span class="rodear">
						<p class="titulo">ENSAYO SOBRE LA LUCIDEZ</p>
						<p class="autor">José Saramago</p>
					</span>
				</article>
				<article class="libro">
					<img class="imagen_libro" src="resources/images/mauricio.jpg"/>
					<span class="rodear">
						<p class="titulo">MAURICIO O LAS ELECCIONES</p>
						<p class="autor">Eduardo Mendoza</p>
					</span>
				</article>
				<article class="libro">
					<img class="imagen_libro" src="resources/images/sumision.jpg"/>
					<span class="rodear">
						<p class="titulo">SUMISIÓN</p>
						<p class="autor">Michel Houellebecq</p>
					</span>
				</article>
			</section>
			
			
			<h3 class="sombra">Recomendados porque te gustó: La Sombra del Viento</h3>
			<hr>
			<section class="recomendados">
				<article class="libro libro2">
					<img class="imagen_libro" src="resources/images/temor.jpg"/>
					<span class="rodear">
						<p class="titulo">EL TEMOR DE UN HOMBRE SABIO</p>
						<p class="autor">Patrick Rothfuss</p>
					</span>
				</article>
				<article class="libro libro2">
					<img class="imagen_libro" src="resources/images/choque.jpg"/>
					<span class="rodear">
						<p class="titulo">CHOQUE DE REYES</p>
						<p class="autor">George R.R. Martin</p>
					</span>
				</article>
				<article class="libro libro2">
					<img class="imagen_libro" src="resources/images/anillos.jpg"/>
					<span class="rodear">
						<p class="titulo">LA COMUNIDAD DEL ANILLO</p>
						<p class="autor">J.R.R. Tolkien</p>
					</span>
				</article>
			</section>
			
			<hr>
			
			<section class="del_mes">
				<p class="nombre izda">Patrick Rothfuss, autor del mes</p>
				<img class="imagen dcha" src="resources/images/patrick.jpg"/>
			</section>
			
			<section class="del_mes">
				<img class="imagen izda" src="resources/images/moscu.jpg"/>
				<p class="nombre dcha">El Caballero de Moscú, libro del mes,<br> <span id="peque">de Amor Towles</span></p>
			</section>
		</section>
	</main>
	
	
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

