<?php
  require_once("./php_classes/usuarios.class.inc");

  $datos=array();

  $usuario = new Usuario($datos);
  
  $pais="";
  if(isset($_POST['pais']))  $pais=$_POST['pais'];

  $usuario->cambiarContrasenia($_POST['nick'], $_POST['contrasenia']);

  $usuario->modificarDatos($_POST['nick'], $_POST['email'], $_POST['nombre_apellidos'], $_POST['nacimiento'], $pais, $_POST['libro_fav']);

  header("Location: datospersonales.php?modified");

?>

