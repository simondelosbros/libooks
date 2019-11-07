<!DOCTYPE HTML>
<html	lang="es">

<head>
	<title>Libooks / Foro</title>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="resources/css/libooks.css"/>
	<link rel="stylesheet" type="text/css" href="resources/css/foro.css"/>
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
		<section class="foro">
			<h2 class="sombra">Foro de Libooks:</h2>
			
			<a class="hilos" href="hilo1.html">
			<article>
				<section class="info1">
					<p class="titulo_hilo">XIV concurso de primavera (relatos tema libre)</p>
					<p class="descripcion_hilo">Creado por: frRJ96 » 10 de marzo de 2016</p>
				</section>
				<section class="info2">
					<p class="resp">Respuestas:<br><br>5</p>
					<p class="visit">Visitas:<br><br>107</p>
				</section>
			</article>
			</a>
			
			<a class="hilos" href="hilo2.html">
			<article>
				<section class="info1">
					<p class="titulo_hilo">La octava vida - Nino Haratischwili</p>
					<p class="descripcion_hilo">Creado por: Giada » 19 de junio 2018</p>
				</section>
				<section class="info2">
					<p class="resp">Respuestas:<br><br>21</p>
					<p class="visit">Visitas:<br><br>571</p>
				</section>
			</article>
			</a>
			
			<a class="hilos" href="hilo1.html">
			<article>
				<section class="info1">
					<p class="titulo_hilo">¡¡Cosas Importantes!! Y ficha para libros.	</p>
					<p class="descripcion_hilo">Creado por: Felicity » 1 de noviembre de 2019</p>
				</section>
				<section class="info2">
					<p class="resp">Respuestas:<br><br>8</p>
					<p class="visit">Visitas:<br><br>216</p>
				</section>
			
			</article>
			</a>
		</section>
		
		<form id="nuevo_hilo" action="foro.php" method="post" name="nuevo_hilo">
			<h2 class="sombra">Crear nuevo hilo:</h2>
			<label for="nombre_hilo">Nombre del hilo:<br>
			<input class="texto_form" style="width: 300px;" type="text" name="nombre_hilo" required/><br>
			</label>
			
			<label for="descrip_hilo">Descripcion del hilo:<br>
			<textarea class="texto_form_big" name="texto_form" required></textarea><br>
			</label>
						
			<label for="primer_post">Primer post en el hilo (opcional):<br>
			<textarea class="texto_form_big" name="primer_post"></textarea><br>
			</label>
			
			<input id="boton_hilo" type="submit" value="Crear hilo"/>
		</form>
	</main>
	
	
	<footer class="pie_de_pagina">
		<p id="contacto"><b>Contacto:</b> <a href="mailto:simondelosbros@correo.ugr.es" target="_blank">simondelosbros@correo.ugr.es</a></p>
		
		
		<form id="suscripcion" action="" method="post" name="suscripcion">
			¡Suscríbete a nuestra Newsletter! <br>
			<input class="texto_form" type="email" onfocus="this.value=''" value="Tu correo electrónico" required/>
			<input class="boton_form" type="submit" value="Suscribirse"/>		
		</form>
		
		<p id="comosehizo"><a href="docu.pdf" target="_blank"><i>¿Cómo se hizo?</i><sup>[PDF]</sup></a></p>
	</footer>
	
	
</body>	
</html>

