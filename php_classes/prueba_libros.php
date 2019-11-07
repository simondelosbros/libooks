<?php
	require_once("libros.class.inc");
	require_once("opiniones.class.inc");
	$datos=array();
	$librasos=new Libro($datos);

	//$libros=$librasos->getAllLibros('ISBN');
	//print_r($libros);
	//echo "<br><br>";
	$libros=$librasos->getISBNlastInserted();
	print_r($libros);
	echo "<br><br><br><br><br><br>";
	

?>
