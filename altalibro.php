<!DOCTYPE HTML>
<html	lang="es">

<head>
	<title>Libooks / Alta Libro</title>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="resources/css/libooks.css"/>
	<link rel="stylesheet" type="text/css" href="resources/css/libros.css"/>
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
		<script>
			function validateForm() {
				var titulo=document.forms["altalibro"]["titulo"].value;
				if(titulo==""){
					alert("Debes especificar un título.");
					return false;				
				}
				if(titulo.length >60){
					alert("El título no puede tener más de 60 caracteres.");
					return false;					
				}

				var autor=document.forms["altalibro"]["autor"].value;
				if(autor==""){
					alert("Debes especificar un autor.");
					return false;	
				}
				if(autor.length > 80){
					alert("El autor no puede tener más de 80 caracteres.");
					return false;	
				}

				var anio=document.forms["altalibro"]["anio"].value;
				anio_int=parseInt(anio);
				if(isNaN(anio_int) && anio!=""){
					alert("No has introducido un año válido.");
					return false;
				}

				var numPaginas=document.forms["altalibro"]["numPaginas"].value;
				numPaginas_int=parseInt(numPaginas);
				if(isNaN(numPaginas_int) && numPaginas!=""){
					alert("Número de páginas no válido.");
					return false;
				}

				var descripcion=document.forms["altalibro"]["descripcion"].value;
				if(descripcion==""){
					alert("Escriba una descripción del libro.");
					return false;
				}
				if(descripcion.length>500){
					alert("No te enrolles, escribe menos de 500 caracteres en la descripción.");
					return false;
				}

				var opinion=document.forms["altalibro"]["opinion"].value;
				if(opinion==""){
					alert("Escriba una opinion del libro.");
					return false;
				}
				if(opinion.length>500){
					alert("No te enrolles, escribe menos de 500 caracteres en la opinion.");
					return false;
				}

				return true;
			}
		</script>


		<form class="valoracion_libro" action="registrar_libro.php" method="post" onsubmit="return validateForm()" name="altalibro">
			<section class="detalles">
				<img id="add_image" src="resources/images/add_image.jpg" alt="add_image"/>
					<section class="detalles_texto">
						<p><b>Título:</b> <input class="texto_form" type="text" name="titulo"/></p>
						<p><b>Autor:</b> <input class="texto_form" type="text" name="autor"/></p>
						<p><b>Editorial:</b>
						<select class="texto_form" name="editorial">
							<option value="1" selected>Macmillan Publishers</option>
							<option value="2">Debolsillo</option>
							<option value="3">Planeta</option>
							<option value="4">DAW Books</option>
							<option value="5">Publicación Propia</option>
						</select></p>
						<p><b>Año:</b> <input class="texto_form" type="text" name="anio"/></p>
						<p><b>Nº de páginas:</b> <input class="texto_form" type="text" name="numPaginas"/></p>
					</section>
			</section>
			
			<h2>Mi descripción del Libro:</h2>
			<textarea class="caja_texto" name="descripcion"></textarea>
			
			<h2>Escriba su opinión:</h2>
			<textarea class="caja_texto" name="opinion"></textarea>
			
			<h2>Mi valoración:</h2>
			<p id="estrellas_voto">
			<input type="radio" name="n_estrellas" value="0" checked> ✩✩✩✩✩
			<input type="radio" name="n_estrellas" value="1"> ★✩✩✩✩
			<input type="radio" name="n_estrellas" value="2"> ★★✩✩✩
			<input type="radio" name="n_estrellas" value="3"> ★★★✩✩
			<input type="radio" name="n_estrellas" value="4"> ★★★★✩
			<input type="radio" name="n_estrellas" value="5"> ★★★★★
			</p>
			
			<h2>Escoge una portada:</h2>
			<p id="portadas">
			<input type="radio" name="imagen" value="book1.png" checked>
			<img class="book_img" src="resources/images/books/book1.png"/>
			<input type="radio" name="imagen" value="book2.png">
			<img class="book_img" src="resources/images/books/book2.png"/>
			<input type="radio" name="imagen" value="book3.png">
			<img class="book_img" src="resources/images/books/book3.png"/>
			<input type="radio" name="imagen" value="book4.png">
			<img class="book_img" src="resources/images/books/book4.png"/>
			<input type="radio" name="imagen" value="book5.png">
			<img class="book_img" src="resources/images/books/book5.png"/>
			<input type="radio" name="imagen" value="book6.png">
			<img class="book_img" src="resources/images/books/book6.png"/>
			</p>
			

			<input id="boton_gurdu" type="submit" value="Enviar"/>	
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

