<!DOCTYPE HTML>
<html	lang="es">

<head>
	<title>Libooks / Alta Usuario</title>
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
				cajita(0);
			else if(isset($_SESSION['conectado']) && $_SESSION['conectado'] === TRUE)
				header("Location: datospersonales.php");
		?>
	</header>

	<main class="principal">
		<script>

			function validateEmail(email) {
				var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{1,}))$/;
				return re.test(email);
			}

			function validateForm() {
				var nick=document.forms["altausuario"]["nick"].value;
				if(nick==""){
					alert("Debes especificar un nick de usuario.");
					return false;				
				}
				if(nick.length >20){
					alert("El nick no puede tener más de 20 caracteres.");
					return false;					
				}

				/*<?php //Era pa comprobar que el nombre de usuario no estaba usado pero no se
					//como poner una variable de javascript en php
					require_once("./php_classes/usuarios.class.inc");
					$datos=array();
					$usuario=new Usuario($datos);
					$datos=$usuario->obtenerUsuario($_POST['nick']);
				?>*/

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
			<h2 class="sombra">Registro en Libooks:</h2>
			<form id="altausuario" action="registrar_usuario.php" onsubmit="return validateForm()" method="post" name="altausuario">
				<label id="nick" for="nick">Introduzca un nick: <span style="color:red;">*</span> <br>
				<input class="texto_form" name="nick" type="text"/>
				</label>

				<label for="email">Correo electrónico: <span style="color:red;">*</span><br>
				<input class="texto_form" name="email"/>
				</label>

				<label for="contrasenia">Contraseña: <span style="color:red;">*</span><br>
				<input class="texto_form" name="contrasenia" type="password"/>
				</label>

				<label for="contrasenia_repetida">Repita la contraseña: <span style="color:red;">*</span><br>
				<input class="texto_form" name="contrasenia_repetida" type="password"/>
				</label>

				<label for="nombre_apellidos">Nombre y apellidos:<br>
				<input class="texto_form" name="nombre_apellidos" type="text"/>
				</label>

				<label for="nacimiento">Fecha de nacimiento:<br>
				<input class="texto_form" name="nacimiento" type="date"/>
				</label>

				<label for="pais">País de origen:<br>
				<select class="texto_form" name="pais">
					<option value="" selected disabled hidden>Escoja su país</option>
					<option value="DEU">Alemania</option>
					<option value="ESP">España</option>
					<option value="FRA">Francia</option>
					<option value="GBR">Reino Unido</option>
					<option value="GRC">Grecia</option>
					<option value="TUR">Turquía</option>
					<option value="USA">Estados Unidos</option>
				</select>
				</label>

				<label for="libro_fav">Libro favorito:<br>
				<input class="texto_form" name="libro_fav" type="text"/>
				</label>

				<label id="fotos" for="imagen" style="width:100%;">Escoja una imagen de usuario:<br>
				<input type="radio" name="imagen" id="user1.png" value="user1.png" checked>
				<img class="user_img" src="resources/images/users/user1.png"/>
				<input type="radio" name="imagen" id="user2.png" value="user2.png">
				<img class="user_img" src="resources/images/users/user2.png"/>
				<input type="radio" name="imagen" id="user3.png" value="user3.png">
				<img class="user_img" src="resources/images/users/user3.png"/>
				<input type="radio" name="imagen" id="user4.png" value="user4.png">
				<img class="user_img" src="resources/images/users/user4.png"/>
				<input type="radio" name="imagen" id="user5.png" value="user5.png">
				<img class="user_img" src="resources/images/users/user5.png"/>
				<input type="radio" name="imagen" id="user6.png" value="user6.png">
				<img class="user_img" src="resources/images/users/user6.png"/>
				</label>

				<input id="boton_gurdu" type="submit" value="Registrar"/>
			</form>


			<p id="nota"><b>Nota:</b> los campos con <span style="color:red;">*</span> son obligatorios.</p>
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

