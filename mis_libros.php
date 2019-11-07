<!DOCTYPE HTML>
<html	lang="es">

<head>
	<title>Libooks / Mis Libros</title>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="resources/css/libooks.css"/>
	<link rel="stylesheet" type="text/css" href="resources/css/mis_libros.css"/>
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

			if(isset($_GET["error"]))
				echo
	     			"<script type='text/javascript'>
					window.onload = function(){alert('Libro no encontrado.');}
				</script>";

			if(isset($_GET["not_owner"]))
				echo
	     			"<script type='text/javascript'>
					window.onload = function(){alert('No puedes acceder aquí porque no eres el propietario de dicho libro.');}
				</script>";

			if(isset($_GET["borrado"]))
				echo
	     			"<script type='text/javascript'>
					window.onload = function(){alert('Libro borrado.');}
				</script>";
		?>
	</header>


	<main class="principal">
		<section class="columna_izda">
			<h2 class="sombra">Libros introducidos por <?php echo $_SESSION['nick'] ?>:</h2>
			<?php
			require_once("./php_classes/libros.class.inc");
			$datos=array();
			$librasos=new Libro($datos);

			$libros=$librasos->getLibrosFrom($_SESSION['nick']);
			if($libros[1]==0)
				echo
				'<a class="libro" href="altalibro.php">
				<article>
					<h3 class="titulo_libro">No hay libros para mostrar :(</h3><br>
					<p class="autor">¡Registra tu primer libro!</p>
				</article>
				</a>';
			else{
				foreach($libros[0] as $libro){
				echo
				'<a class="libro" href="libroleido.php?v='.$libro->devolverValor('ISBN').'">
				<article>
					<img class="imagen_libro" src="resources/images/books/'.$libro->devolverValor('imagen').'"/>
					<h3 class="titulo_libro">'.$libro->devolverValor('titulo').'</h3><br>
					<p class="autor">'.$libro->devolverValor('autor').'</p>
				</article>
				</a>';
				}
			}
			?>
		</section>

		<section class="columna_dcha">
			<h2 class="sombra">Últimos libros introducidos en Libooks:</h2>
			<hr>
			<a id="altalibro" href="altalibro.php"><b>Dar de alta nuevo libro.</b></a>
			<hr>
			<?php
			$libros=$librasos->getAllLibros('ISBN');

			if($libros[1]==0)
				echo
				'<a href="altalibro.php"><b>No hay ningún libro en Libooks :(</b>';
			else{
				foreach($libros[0] as $libro){
				echo
				'<a href="libro.php?v='.$libro->devolverValor('ISBN').'">
					<b>'.$libro->devolverValor('titulo').'</b>, '.$libro->devolverValor('autor').'.
				</a>';
				}
			}
			?>
			

			
		</section>
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

