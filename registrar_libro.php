<?php
  require_once("./php_classes/libros.class.inc");
  require_once("./php_classes/opiniones.class.inc");
  require_once("./php_classes/usuarios.class.inc");

  $datos=array();
  $libro= new Libro($datos);
  $opinion= new Opinion($datos);
  $usuario= new Usuario($datos);

  
  session_start();

  $libro->insertarLibro($_POST['titulo'], $_POST['autor'], $_POST['editorial'], $_POST['anio'], $_POST['numPaginas'], $_POST['descripcion'], $_SESSION['nick'], $_POST['imagen']);

  $isbn=$libro->getISBNlastInserted();

  $opinion->insertarOpinion($isbn, $_SESSION['nick'], $_POST['opinion'], $_POST['n_estrellas']);

  $usuario->nuevoLibroLeido($_SESSION['nick']);
  $_SESSION['n_leidos']=$usuario->get_n_leidos($_SESSION['nick']);

  header("Location: libroleido.php?v=".$isbn);
?>

