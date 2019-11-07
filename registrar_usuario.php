<?php
  require_once("./php_classes/usuarios.class.inc");

  $datos=array();

  $usuario = new Usuario($datos);

  $usuario->insertarUsuario($_POST['nick'], $_POST['email'], $_POST['contrasenia'],
                            $_POST['nombre_apellidos'], $_POST['nacimiento'], $_POST['pais'], $_POST['libro_fav'], $_POST['imagen']);

  header("Location: index.php");

?>

