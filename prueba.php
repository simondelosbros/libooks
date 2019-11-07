<?php
  require_once('./php_classes/usuarios.class.inc');

  $datos=array();
  $usuario=new Usuario($datos);

  //$validacion=$usuario->validarUsuario("john_mayer", "contrasenia123");
  $validacion=$usuario->validarUsuario("john_mayer", "a");

  echo "<p>HOLAAAAAAAAAAAAAAAAAAAAAAA<br></p>";

  echo $validacion, "<br>";

  if($validacion===TRUE){
    echo "eeeee";
  }else{
    echo "ooooo";
    echo "<script type='text/javascript'>alert('$validacion');</script>";
  }
?>

