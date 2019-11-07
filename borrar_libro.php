<?php
  require_once("./php_classes/libros.class.inc");
  require_once("./php_classes/opiniones.class.inc");
  require_once("./php_classes/usuarios.class.inc");

  $datos=array();
  $libro= new Libro($datos);
  $opinion= new Opinion($datos);
  
  $isbn=$_GET['v'];

  $opinion->borrarOpiniones($isbn);
  $libro->borrarLibro($isbn);

  header("Location: mis_libros.php?borrado");
?>

