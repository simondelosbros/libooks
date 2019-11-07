<?php
  require_once ('dataObject.class.inc');

  class Opinion extends DataObject {
    protected $datos = array(
      "ISBN" => "",
      "quienIntroduce" => "",
      "opinion" => "",
      "n_estrellas" => ""
    );

    public function __construct($datos) {
      parent::__construct($datos);
    }

    public static function getAllOpiniones( $isbn, $orden='n_estrellas') {
      $conexion = parent::conectar();
      $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . TABLA_OPINIONES . " where ISBN=".$isbn." ORDER BY " . $orden;
      try {
        $st = $conexion->prepare( $sql );
        $st->execute();
        $opiniones = array();
        foreach ( $st->fetchAll() as $fila ) {
          $opiniones[] = new Opinion( $fila );
        }
        $st = $conexion->query( "SELECT found_rows() AS filasTotales" );
        $fila = $st->fetch();
        parent::desconectar( $conexion );
        return array( $opiniones, $fila["filasTotales"] );
      } catch ( PDOException $e ) {
        parent::desconectar( $conexion );
        die( "Consulta fallida: " . $e->getMessage() );
      }
    }


    public static function obtenerOpinion( $isbn, $quienIntroduce ) {
      $conexion = parent::conectar();
      $sql = "SELECT * FROM " . TABLA_OPINIONES . " WHERE (isbn = :isbn and quienIntroduce= :quienIntroduce)";
      try {
        $st = $conexion->prepare( $sql );
        $st->bindValue( ":isbn", $isbn, PDO::PARAM_INT );
        $st->bindValue( ":quienIntroduce", $quienIntroduce, PDO::PARAM_STR );
        $st->execute();
        $fila = $st->fetch();
        parent::desconectar( $conexion );
        if ( $fila ) return new Opinion( $fila );
      } catch ( PDOException $e ) {
        parent::desconectar( $conexion );
        die( "Consulta fallada: " . $e->getMessage() );
      }
    }

    public static function insertarOpinion($isbn, $quienIntroduce, $opinion, $n_estrellas){
      $conexion = parent::conectar();
      $sql = "INSERT INTO " . TABLA_OPINIONES . " VALUES (".$isbn.",'".$quienIntroduce."','".$opinion."',".$n_estrellas.");";
      try { $conexion->query( $sql ); }
      catch ( PDOException $e ) {
        parent::desconectar($conexion);
        die("Inserción fallida: " . $e->getMessage() );
      }
    }

    public static function modificarOpinion($isbn, $quienIntroduce, $opinion, $n_estrellas){
      $conexion = parent::conectar();
      $sql = "UPDATE " . TABLA_OPINIONES . " SET opinion='".$opinion."', n_estrellas=".$n_estrellas." WHERE (isbn = ".$isbn." and quienIntroduce= '".$quienIntroduce."');";
      try { $conexion->query( $sql ); }
      catch ( PDOException $e ) {
        parent::desconectar($conexion);
        die("Modificación fallida: " . $e->getMessage() );
      }
    }

    public static function borrarOpiniones($isbn){
      $conexion = parent::conectar();
      $sql = "DELETE FROM " . TABLA_OPINIONES . " WHERE ISBN=".$isbn;

      try { $conexion->query( $sql ); }
      catch ( PDOException $e ) {
        parent::desconectar($conexion);
        die("Borrado fallido: " . $e->getMessage() );
      }
    }

  }
?>

