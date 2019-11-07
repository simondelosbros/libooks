<?php
  require_once('./php_classes/usuarios.class.inc');

  $nick=$_POST['nick'];
  $contrasenia=$_POST['contrasenia'];

  $datos=array();
  $usuario=new Usuario($datos);

  $validacion=$usuario->validarUsuario($nick, $contrasenia);

  if($validacion===TRUE){
    session_start();
    $_SESSION['conectado']=TRUE;
    $_SESSION['nick']=$nick;
    $_SESSION['n_leidos']=$usuario->get_n_leidos($nick);

    header("Location: index.php");
  }else{
    header("Location: index.php?".$validacion);
  }

?>
