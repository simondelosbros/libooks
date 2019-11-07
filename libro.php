<!DOCTYPE HTML>
<html	lang="es">

<head>
	<title>Libooks / Libros introducidos</title>
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

				require_once("./php_classes/usuarios.class.inc");

				$datos=array();
			  	$usuario=new Usuario($datos);

				$datos=$usuario->obtenerUsuario($quienIntroduce);
				$imagen_user=$datos->devolverValor('imagen');
				$n_leidos=$datos->devolverValor('n_leidos');

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

			<p id="introducido_por">Introducido por <?php echo $quienIntroduce ?>.</p>		
			
			<img class="tiny_user_img" src="resources/images/users/<?php echo $imagen_user ?>" onmouseover="MouseOver(this)" onmouseout="MouseOut(this)"/>
			<section id="small_libros_subidos">
				<p><b>Libros introducidos por <?php echo $quienIntroduce ?>:</b></p>
				<?php
					require_once("./php_classes/libros.class.inc");
					$datos=array();
					$librasos=new Libro($datos);

					$libros=$librasos->getLibrosFrom($quienIntroduce);
					if($libros[1]==0)
						echo '<p>(No ha introducido ningún libro)</p>';
					else{
						foreach($libros[0] as $libro){
							echo '<p>- '.$libro->devolverValor('titulo').', '.$libro->devolverValor('autor').'.</p>';
						}
					}
				?>
				<p><br><i>Libros leídos: <?php echo $n_leidos ?></i></p>
			</section>

			<script>
				function MouseOver(obj) {
					document.getElementById("small_libros_subidos").style.display = 'block';
				}

				function MouseOut(obj) {
					document.getElementById("small_libros_subidos").style.display = 'none';
				}
			</script>

			<h2>Descripción: </h2>
			<section class="caja_texto">
				<p><?php echo $descripcion ?></p>
			</section>

			<?php
				require_once("./php_classes/opiniones.class.inc");
				$opiniones=array();
				$op=new Opinion($datos);
				$opiniones=$op->getAllOpiniones($isbn);

				$suma=0;
				foreach($opiniones[0] as $opinion){
					$suma+=$opinion->devolverValor('n_estrellas');
				}
				$media=round($suma/$opiniones[1], 2);
				$n_estrellas=round($media);
				
				if($n_estrellas==0) $n_estrellas="✩✩✩✩✩";
				if($n_estrellas==1) $n_estrellas="★✩✩✩✩";
				if($n_estrellas==2) $n_estrellas="★★✩✩✩";
				if($n_estrellas==3) $n_estrellas="★★★✩✩";
				if($n_estrellas==4) $n_estrellas="★★★★✩";
				if($n_estrellas==5) $n_estrellas="★★★★★";
			?>
			
			<section class="valoracion">
				<h2>Valoración media:</h2>
				<p id="estrellas_media"> <?php echo $n_estrellas ?> <span style="font-size: 0.5em; text-shadow:none;">(<?php echo $media ?>)</span></p>
			</section>
			
			<hr>
				
			<h2>Opiniones: </h2>

			<?php
			foreach($opiniones[0] as $opinion){
				$color='#808080';
				if($opinion->devolverValor('quienIntroduce')==$_SESSION['nick'])
					$color='red';

				echo '<section class="caja_texto_peque"><span style="color:'.$color.'; font-weight: bold;">Opinión de '.$opinion->devolverValor('quienIntroduce').':</span><br>'.$opinion->devolverValor('opinion').'</section>';
			}
			?>
			
			<section class="navegar">
				<?php
					$next=$isbn;
					$previous=$isbn;
					$min_isbn=$libro->getISBNfirstinserted();
					$max_isbn=$libro->getISBNlastinserted();

					if($isbn==$max_isbn){
						$next=$min_isbn;
					}else{
						do{
							$next+=1;
						}while(empty($libro->obtenerLibro($next)));
					}

					if($isbn==$min_isbn){
						$previous=$max_isbn;
					}else{
						do{
							$previous-=1;
						}while(empty($libro->obtenerLibro($previous)));
					}
				?>

				<?php echo '<a id="anterior" href="libro.php?v='.$next.'">Anterior</a>'; ?>
				<?php echo '<a id="valorar" href="valoracion_libro.php?v='.$isbn.'">Valorar libro</a>'; ?>
				<?php echo '<a id="siguiente" href="libro.php?v='.$previous.'">Siguiente</a>'; ?>
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

