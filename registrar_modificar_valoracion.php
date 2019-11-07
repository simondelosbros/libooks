<?php
  require_once("./php_classes/opiniones.class.inc");
  require_once("./php_classes/usuarios.class.inc");

  $datos=array();
  $opinion= new Opinion($datos);
  $usuario= new Usuario($datos);

  session_start();

  $isbn=$_GET["v"];

  if($_GET["op"]==0){
    $opinion->insertarOpinion($isbn, $_SESSION['nick'], $_POST['opinion'], $_POST['n_estrellas']);
    $usuario->nuevoLibroLeido($_SESSION['nick']);
    $_SESSION['n_leidos']=$usuario->get_n_leidos($_SESSION['nick']);
  }else if ($_GET["op"]==1){
    $opinion->modificarOpinion($isbn, $_SESSION['nick'], $_POST['opinion'], $_POST['n_estrellas']);
  }

  header("Location: libro.php?v=".$isbn);
?>

