<!DOCTYPE HTML>
<html	lang="es">

<head>
	<title>Libooks / Los Pilares de la Tierra</title>
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
		<section class="valoracion_libro">
			<?php
        			require_once("./php_classes/libros.class.inc");
				require_once("./php_classes/opiniones.class.inc");

				if(isset($_GET["v"]))
					$isbn=$_GET["v"];
				else
					header("Location: mis_libros.php?error");

				$datos=array();
			  	$libro=new Libro($datos);

				$datos=$libro->obtenerLibro($isbn);

				
				if(!isset($datos))
					header("Location: mis_libros.php?error");

				$quienIntroduce=$datos->devolverValor('quienIntroduce');
				if($quienIntroduce!=$_SESSION['nick']){
					header("Location: mis_libros.php?not_owner");
				}

				$titulo=$datos->devolverValor('titulo');
				$autor=$datos->devolverValor('autor');
				$editorial=$datos->devolverValor('editorial');
				$anio=$datos->devolverValor('anio');
				$numPaginas=$datos->devolverValor('numPaginas');
				$descripcion=$datos->devolverValor('descripcion');
				$imagen=$datos->devolverValor('imagen');
				

				if($editorial==1) $editorial="Macmillan Publishers";
				if($editorial==2) $editorial="Debolsillo";
				if($editorial==3) $editorial="Planeta";
				if($editorial==4) $editorial="DAW Books";
				if($editorial==5) $editorial="Publicación Propia";

				$datos=array();
			  	$op=new Opinion($datos);

				$datos=$op->obtenerOpinion($isbn, $_SESSION['nick']);
				$opinion=$datos->devolverValor('opinion');
				$n_estrellas=$datos->devolverValor('n_estrellas');

				if($n_estrellas==0) $n_estrellas="✩✩✩✩✩";
				if($n_estrellas==1) $n_estrellas="★✩✩✩✩";
				if($n_estrellas==2) $n_estrellas="★★✩✩✩";
				if($n_estrellas==3) $n_estrellas="★★★✩✩";
				if($n_estrellas==4) $n_estrellas="★★★★✩";
				if($n_estrellas==5) $n_estrellas="★★★★★";
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

			<h2>Descripción: </h2>
			<section class="caja_texto">
				<p><?php echo $descripcion ?></p>
			</section>

			<h2>Opinión: </h2>
			<section class="caja_texto">
				<p><?php echo $opinion ?></p>
			</section>

			<h2>Mi valoración:</h2>
			<p id="estrellas"> <?php echo $n_estrellas ?> </p>

			<?php echo '<a id="modificar" href="valoracion_libro.php?v='.$isbn.'">Modificar opinion</a>'; ?>
			<!---<?php echo '<a id="modificar" href="valoracion_libro.php?v='.$isbn.'" onclick="return confirm();">Borrar libro</a>'; ?>-->
			<a id="modificar" href="borrar_libro.php?v=<?php echo $isbn ?>" onclick="return confirm('¿Estás seguro de que quieres borrar el libro?');">Borrar libro</a>			
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

