<!DOCTYPE HTML>
<html	lang="es">

<head>
	<title>Libooks / Datos Personales</title>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="resources/css/libooks.css"/>
	<link rel="stylesheet" type="text/css" href="resources/css/usuario.css"/>
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

			if(isset($_GET["modified"]))
				echo
        			"<script type='text/javascript'>
					window.onload = function(){alert('Datos modificados.');}
        			</script>";
		?>
	</header>

	<main class="principal">
		<script>
			function validateEmail(email) {
				var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{1,}))$/;
				return re.test(email);
			}

			function validateForm() {
				var email=document.forms["altausuario"]["email"].value;
				if(email==""){
					alert("Debes especificar un email.");
					return false;
				}
				if(!validateEmail(email)){
					alert("Introduzca un email válido.");
					return false;
				}
				if(email.length >50){
					alert("El email no puede tener más de 50 caracteres.");
					return false;
				}

				var contrasenia=document.forms["altausuario"]["contrasenia"].value;
				var contrasenia_repetida=document.forms["altausuario"]["contrasenia_repetida"].value;
				if(contrasenia==""){
					alert("Debes introducir una contraseña.");
					return false;
				}
				if(contrasenia.length >20){
					alert("La contrasenia debe tener menos de 20 caracteres.");
					return false;
				}
				if(contrasenia_repetida==""){
					alert("Debes repetir la contraseña.");
					return false;
				}
				if(contrasenia != contrasenia_repetida){
					alert("No has repetido la misma contraseña.");
					return false;
				}

				var nombre_apellidos=document.forms["altausuario"]["nombre_apellidos"].value;
				if(nombre_apellidos.length>80){
					alert("No usar más de 80 caracteres en ``Nombre y Apellidos''");
					return false;
				}

				var libro_fav=document.forms["altausuario"]["libro_fav"].value;
				if(libro_fav.length>60){
					alert("No usar más de 60 caracteres en su libro favorito.");
					return false;
				}

				return true;
			}
		</script>
		<section class="usuario">
			<?php
				require_once("./php_classes/usuarios.class.inc");

			  $datos=array();

			  $usuario = new Usuario($datos);

			  $datos = $usuario->obtenerUsuario($_SESSION['nick']);

				$nick=$datos->devolverValor('nick');
				$email=$datos->devolverValor('email');
				$contrasenia=$datos->devolverValor('contrasenia');
				$nombre_apellidos=$datos->devolverValor('nombre_apellidos');
				$nacimiento=$datos->devolverValor('nacimiento');
				$pais=$datos->devolverValor('pais');
				$libro_fav=$datos->devolverValor('libro_fav');
				$imagen=$datos->devolverValor('imagen');
			?>

			<img class="small_user_img" src="resources/images/users/<?php echo $imagen ?>" onmouseover="MouseOver(this)" onmouseout="MouseOut(this)"/>
			<section id="libros_subidos">
				<p><b>Libros introducidos por <?php echo $_SESSION['nick'] ?>:</b></p>
				<?php
					require_once("./php_classes/libros.class.inc");
					$datos=array();
					$librasos=new Libro($datos);

					$libros=$librasos->getLibrosFrom($_SESSION['nick']);
					if($libros[1]==0)
						echo '<p>(No ha introducido ningún libro)</p>';
					else{
						foreach($libros[0] as $libro){
							echo '<p>- '.$libro->devolverValor('titulo').', '.$libro->devolverValor('autor').'.</p>';
						}
					}

				?>
			</section>

			<script>
				function MouseOver(obj) {
					document.getElementById("libros_subidos").style.display = 'block';
				}

				function MouseOut(obj) {
					document.getElementById("libros_subidos").style.display = 'none';
				}
			</script>

			<h2 class="sombra">Datos personales de <?php echo $nick ?>:</h2>

			<form id="altausuario" action="modificar_usuario.php" method="post" onsubmit="return validateForm()" name="altausuario">
				<label id="nick" for="nick">Nick de usuario:<br>
				<input class="texto_form" name="nick" type="text" value="<?php echo $nick?>" style="color:#808080; font-weight: bold;" readonly/>
				</label>

				<label for="email">Correo electrónico:<br>
				<input class="texto_form" name="email" value="<?php echo $email?>" required/>
				</label>

				<label for="contrasenia">Nueva contraseña:<br>
				<input class="texto_form" name="contrasenia" type="password" value="<?php echo $contrasenia?>" required/>
				</label>

				<label for="contrasenia_repetida">Repita la nueva contraseña:<br>
				<input class="texto_form" name="contrasenia_repetida" type="password" value="<?php echo $contrasenia?>" required/>
				</label>

				<label for="nombre_apellidos">Nombre y apellidos:<br>
				<input class="texto_form" name="nombre_apellidos" type="text" value="<?php echo $nombre_apellidos?>"/>
				</label>

				<label for="nacimiento">Fecha de nacimiento:<br>
				<input class="texto_form" name="nacimiento" type="date" value="<?php echo $nacimiento?>"/>
				</label>

				<label for="pais">País de origen:<br>
				<select id="pais" class="texto_form" name="pais" value="<?php echo $pais?>">
					<option value="" selected hidden disabled>Escoja su país</option>
					<option id="DEU" value="DEU">Alemania</option>
					<option id="ESP" value="ESP">España</option>
					<option id="FRA" value="FRA">Francia</option>
					<option id="GBR" value="GBR">Reino Unido</option>
					<option id="GRC" value="GRC">Grecia</option>
					<option id="TUR" value="TUR">Turquía</option>
					<option id="USA" value="USA">Estados Unidos</option>
				</select>
				</label>

				<script>
					<?php
						echo "var valor = '{$pais}';";
					?>
					var indice=document.getElementById(valor).index;
					document.getElementById("pais").selectedIndex = indice;
				</script>

				<label for="libro_fav">Libro favorito:<br>
				<input class="texto_form" name="libro_fav" type="text" value="<?php echo $libro_fav?>"/>
				</label>

				<input id="boton_gurdu" type="submit" value="Modificar"/>
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

