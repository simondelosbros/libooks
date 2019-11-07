<?php
  require_once ('libros.class.inc');
  require_once ('usuarios.class.inc');

  $datos=array();

  //$usuario=new Usuario($datos);
  //$usuario->insertarUsuario('john_mayer', 'johnmayer@micorreo.es', 'contrasenia321', 'John Clayton Mayer', '1977-10-16', 'EEUU');
  //$usuario->cambiarContrasenia('Simon_LV', '12345sa');
  //$cosa=$usuario->obtenerUsuario('john_mayer');

  //print_r($cosa);

  //$usuario->validarUsuario('john_mayer', 'contrasenia321');
  //$usuario->validarUsuario('Simon_LV', '12345sa');
  
  $libro=new Libro($datos);
  
  /*
  $libro->insertarLibro(987654321, 'El Nombre del Viento', 'Patrick Rothfuss', 'DAW Books', 'Descripcion libro', 800, 2007, 'Simon_LV');
  $libro->insertarLibro(127839478, 'Don Quijote de la Mancha', 'Miguel de Cervantes', 'Altaya', 'Descripçao', 1200, 1500);
  $libro->insertarLibro(127839478, 'Don Quijote de la Mancha', 'Miguel de Cervantes', 'Altaya', 0, 1500);
  $libro->insertarLibro(127839478, 'Don Quijote de la Mancha', 'Miguel de Cervantes', 'Altaya', 0, 0, "john_mayer");

  $libro->insertarLibro(224839178, 'Harry Potter y nosequemas', 'J.K. Rowling', 'Altaya', 'Omg jarrui porer');

  $obtenido = $libro->obtenerLibro(224839178);

  $obtenido->print_resultado();
  */
  $obtenido=$libro->obtenerLibros( 0, 1000, 'ISBN');
  //$obtenido = $libro->obtenerLibro(224839178);
  //print_r($obtenido);  
  //echo "<br><br> SECOND <br>";
  $obtenido = $libro->obtenerLibro(224839178);
  print_r($obtenido);

  //echo $obtenido[0][0]->print_resultado(), "<br>";
  //echo $nose[0][1]->print_resultado(), "<br>";
  //echo $nose[0][2]->print_resultado(), "<br>";

  //echo $nose[1], "<br>";
  
?>

