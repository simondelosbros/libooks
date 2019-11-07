<?php
  require_once ('dataObject.class.inc');

  class Libro extends DataObject {
    protected $datos = array(
      "ISBN" => "",
      "titulo" => "",
      "autor" => "",
      "editorial" => "",
      "descripcion" =>"",
      "numPaginas" => "",
      "anio"=>"",
      "quienIntroduce" => "",
      "imagen"=>""
    );

    /*public function __construct($datos) {
      parent::__construct($datos);
    }
    public static function obtenerLibros( $filaInicio, $numeroFilas, $orden){
      return parent::obtenerData($filaInicio, $numeroFilas, $orden, TABLA_LIBROS);
    }*/


                                      /* $filaInicio, $numeroFilas, $orden */
    public static function getAllLibros( $orden='ISBN' ) {
      $conexion = parent::conectar();
      $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . TABLA_LIBROS . " ORDER BY " . $orden . " DESC;";
      try {
        $st = $conexion->prepare( $sql );
        $st->execute();
        $libros = array();
        foreach ( $st->fetchAll() as $fila ) {
          $libros[] = new Libro( $fila );
        }
        $st = $conexion->query( "SELECT found_rows() AS filasTotales" );
        $fila = $st->fetch();
        parent::desconectar( $conexion );
        return array( $libros, $fila["filasTotales"] );
      } catch ( PDOException $e ) {
        parent::desconectar( $conexion );
        die( "Consulta fallida: " . $e->getMessage() );
      }
    }

    public static function getLibrosFrom( $nick, $orden='ISBN' ) {
      $conexion = parent::conectar();
      $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . TABLA_LIBROS . " where quienIntroduce='".$nick."' ORDER BY " . $orden . " DESC;";
      try {
        $st = $conexion->prepare( $sql );
        //$st->bindValue( ":filaInicio", $filaInicio, PDO::PARAM_INT );
        //$st->bindValue( ":numeroFilas", $numeroFilas, PDO::PARAM_INT );
        $st->execute();
        $libros = array();
        foreach ( $st->fetchAll() as $fila ) {
          $libros[] = new Libro( $fila );
        }
        $st = $conexion->query( "SELECT found_rows() AS filasTotales" );
        $fila = $st->fetch();
        parent::desconectar( $conexion );
        return array( $libros, $fila["filasTotales"] );
      } catch ( PDOException $e ) {
        parent::desconectar( $conexion );
        die( "Consulta fallida: " . $e->getMessage() );
      }
    }


    public static function obtenerLibro( $isbn ) {
      $conexion = parent::conectar();
      $sql = "SELECT * FROM " . TABLA_LIBROS . " WHERE ISBN = :isbn";
      try {
        $st = $conexion->prepare( $sql );
        $st->bindValue( ":isbn", $isbn, PDO::PARAM_INT );
        $st->execute();
        $fila = $st->fetch();
	//print_r($fila);
        parent::desconectar( $conexion );
        if ( $fila ) return new Libro( $fila );
      } catch ( PDOException $e ) {
        parent::desconectar( $conexion );
        die( "Consulta fallada: " . $e->getMessage() );
      }
    }

    public static function insertarLibro($titulo, $autor, $editorial, $anio="", $numPaginas="", $descripcion, $quienintroduce="", $imagen){
      $conexion = parent::conectar();
      $sql = "INSERT INTO " . TABLA_LIBROS . " (titulo, autor, editorial, descripcion";
      $valores = "VALUES ('".$titulo."','".$autor."','".$editorial."','".$descripcion."'";

      if($numPaginas!=""){
        $sql=$sql.", numPaginas";
        $valores=$valores.",".$numPaginas;
      }
      if($anio!=""){
        $sql=$sql.", anio";
        $valores=$valores.",".$anio;
      }
      if($quienintroduce!=""){
        $sql=$sql.", quienIntroduce";
        $valores=$valores.",'".$quienintroduce."'";
      }

      $sql=$sql.", imagen) ".$valores.", '".$imagen."');";

      try { $conexion->query( $sql ); }
      catch ( PDOException $e ) {
        parent::desconectar($conexion);
        die("Inserción fallida: " . $e->getMessage() );
      }
    }

    public static function borrarLibro($isbn){
      $conexion = parent::conectar();
      $sql = "DELETE FROM " . TABLA_LIBROS . " WHERE ISBN=".$isbn;

      try { $conexion->query( $sql ); }
      catch ( PDOException $e ) {
        parent::desconectar($conexion);
        die("Borrado fallido: " . $e->getMessage() );
      }
    }

    public static function getISBNfirstinserted(){
      $conexion = parent::conectar();
      $sql = "SELECT MIN(ISBN) FROM " . TABLA_LIBROS;
      try {
        $st = $conexion->prepare( $sql );
        $st->execute();
        $fila = $st->fetch();
        parent::desconectar( $conexion );
        if ( $fila ) return $fila[0];
      } catch ( PDOException $e ) {
        parent::desconectar( $conexion );
        die( "Consulta fallada: " . $e->getMessage() );
      }
    }

    public static function getISBNlastinserted(){
      $conexion = parent::conectar();
      $sql = "SELECT MAX(ISBN) FROM " . TABLA_LIBROS;
      try {
        $st = $conexion->prepare( $sql );
        $st->execute();
        $fila = $st->fetch();
        parent::desconectar( $conexion );
        if ( $fila ) return $fila[0];
      } catch ( PDOException $e ) {
        parent::desconectar( $conexion );
        die( "Consulta fallada: " . $e->getMessage() );
      }
    }

  }
?>
