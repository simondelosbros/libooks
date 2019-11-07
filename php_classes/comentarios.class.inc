<?php
  require_once ('dataObject.class.inc');

  class Comentario extends DataObject {
    protected $datos = array(
      "id_comentario" => "",
      "id_hilo" => "",
      "usuario" => "",
      "fecha_hora" => "",
      "comentario" =>"",
      "responde_a" =>""
    );

    public function __construct($datos) {
      parent::__construct($datos);
    }

    public static function obtenerComentario( $id_comentario, $id_hilo ) {
      $conexion = parent::conectar();
      $sql = "SELECT * FROM " . TABLA_COMENTARIOS . " WHERE (id_hilo = :id_hilo AND id_comentario = :id_comentario)";
      try {
        $st = $conexion->prepare( $sql );
        $st->bindValue( ":id_hilo", $id_hilo, PDO::PARAM_INT );
        $st->bindValue( ":id_comentario", $id_comentario, PDO::PARAM_INT );
        $st->execute();
        $fila = $st->fetch();
        parent::desconectar( $conexion );
        if ( $fila ) return new Comentario( $fila );
      } catch ( PDOException $e ) {
        parent::desconectar( $conexion );
        die( "Consulta fallida: " . $e->getMessage() );
      }
    }

    public static function insertarComentario($id_comentario, $id_hilo, $usuario, $fecha_hora, $comentario, $responde_a=""){
      $conexion = parent::conectar();
      $sql = "INSERT INTO " . TABLA_COMENTARIOS . " (id_comentario, id_hilo, usuario, fecha_hora, comentario,";
      $valores = "VALUES (".$id_comentario.", ".$id_hilo.", '".$usuario."', '".$fecha_hora."', '".$comentario,"'";

      if($responde_a!=""){
        $sql=$sql.", responde_a";
        $valores=$valores.",'".$nombre_apellidos."'";
      }

      $sql=$sql.") ".$valores.");";

      try { $conexion->query( $sql ); }
      catch ( PDOException $e ) {
        parent::desconectar($conexion);
        die("Inserción fallida: " . $e->getMessage() );
      }
    }

    public static function borrarComentario($id_comentario, $id_hilo){
      $conexion=parent::conectar();
      $sql= "DELETE FROM " . TABLA_COMENTARIOS . " WHERE (id_comentario=".$id_comentario." and id_hilo=".$id_hilo.");"

      try{$conexion->query($sql);}
      catch(PDOException $e){
        parent::desconectar($conexion);
        die("Borrado fallido: ".$e->getMessage());
      }
    }


  }
?>

