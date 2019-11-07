<!DOCTYPE HTML>
<html	lang="es">

<head>
	<title>Libooks / Valorar Libro</title>
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
				var opinion=document.forms["modificar_libro"]["opinion"].value;
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
		<section class="valoracion_libro">
			<?php
        			require_once("./php_classes/libros.class.inc");

				if(isset($_GET["v"]))
					$isbn=$_GET["v"];
				else
					header("Location: mis_libros.php?error");

				$datos=array();
			  	$libro=new Libro($datos);

				$datos=$libro->obtenerLibro($isbn);

				if(!isset($datos))
					header("Location: mis_libros.php?error");

				$titulo=$datos->devolverValor('titulo');
				$autor=$datos->devolverValor('autor');
				$editorial=$datos->devolverValor('editorial');
				$anio=$datos->devolverValor('anio');
				$numPaginas=$datos->devolverValor('numPaginas');
				$descripcion=$datos->devolverValor('descripcion');
				$quienIntroduce=$datos->devolverValor('quienIntroduce');
				$imagen=$datos->devolverValor('imagen');

				if($editorial==1) $editorial="Macmillan Publishers";
				if($editorial==2) $editorial="Debolsillo";
				if($editorial==3) $editorial="Planeta";
				if($editorial==4) $editorial="DAW Books";
				if($editorial==5) $editorial="Publicación Propia";
			?>
			<section class="detalles">
				<img class="detalles_imagen" src="resources/images/books/<?php echo $imagen ?>"/>
				<section class="detalles_texto">
					<p><b>Título:</b> <?php echo $titulo ?>.<br></p>
					<p><b>Autor:</b> <?php echo $autor ?>.<br></p>
					<p><b>Editorial:</b> <?php echo $editorial ?>.<br></p>
					<p><b>Año:</b> <?php echo $anio ?><br></p>
					<p><b>Nº de páginas:</b> <?php echo $numPaginas ?><br></p>
				</section>
			</section>

			<!--<p id="introducido_por">Introducido por <?php echo $quienIntroduce ?>.</p>-->

			<h2>Descripción: </h2>
			<section class="caja_texto">
				<i><?php echo $descripcion ?></i>
			</section>

			<?php
				require_once("./php_classes/opiniones.class.inc");
				$datos=array();
			  	$op=new Opinion($datos);
				$datos=$op->obtenerOpinion($isbn, $_SESSION['nick']);

				$opinado=0;
				$opinion="";
				$n_estrellas=0;

				if(isset($datos)){
					$opinado=1;

					$opinion=$datos->devolverValor('opinion');
					$n_estrellas=$datos->devolverValor('n_estrellas');
				}
			?>

			<form action="registrar_modificar_valoracion.php?v=<?php echo $isbn ?>&op=<?php echo $opinado ?>" method="post" onsubmit="return validateForm()" name="modificar_libro">
				<h2>Escriba su opinión:</h2>
				<textarea class="caja_texto" name="opinion"><?php echo $opinion?></textarea>

				<h2>Mi valoración:</h2>
				<p id="estrellas_voto">
				<input type="radio" name="n_estrellas" id="0" value="0" checked> ✩✩✩✩✩
				<input type="radio" name="n_estrellas" id="1" value="1"> ★✩✩✩✩
				<input type="radio" name="n_estrellas" id="2" value="2"> ★★✩✩✩
				<input type="radio" name="n_estrellas" id="3" value="3"> ★★★✩✩
				<input type="radio" name="n_estrellas" id="4" value="4"> ★★★★✩
				<input type="radio" name="n_estrellas" id="5" value="5"> ★★★★★
				</p>

				<script>
					<?php
						echo "var id = '{$n_estrellas}';";
					?>
					document.getElementById(id).checked=true;
				</script>


				<input id="boton_gurdu" type="submit" value="Enviar"/>
			</form>

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
