<?php
  require_once ('dataObject.class.inc');

  class Hilo extends DataObject {
    protected $datos = array(
      "id_hilo" => "",
      "titulo_hilo" => "",
      "fecha_creacion" => "",
      "n_visitas" => "",
      "usuarioCreador" =>""
    );

    public function __construct($datos) {
      parent::__construct($datos);
    }

    public static function obtenerHilo( $id_hilo ) {
      $conexion = parent::conectar();
      $sql = "SELECT * FROM " . TABLA_HILOS . " WHERE id_hilo = :id_hilo";
      try {
        $st = $conexion->prepare( $sql );
        $st->bindValue( ":id_hilo", $nick, PDO::PARAM_INT );
        $st->execute();
        $fila = $st->fetch();
        parent::desconectar( $conexion );
        if ( $fila ) return new Hilo( $fila );
      } catch ( PDOException $e ) {
        parent::desconectar( $conexion );
        die( "Consulta fallada: " . $e->getMessage() );
      }
    }

    public static function insertarHilo($id_hilo, $titulo_hilo, $fecha_creacion, $n_visitas, $usuario_creador){
      $conexion = parent::conectar();
      $sql = "INSERT INTO " . TABLA_HILOS . " VALUES (".$id_hilo.",'".$titulo_hilo."','".$fecha_creacion."',".$n_visitas.",'".$usuario_creador."');";

      try { $conexion->query( $sql ); }
      catch ( PDOException $e ) {
        parent::desconectar($conexion);
        die("Inserción fallida: " . $e->getMessage() );
      }
    }

    public static function borrarHilo($id_hilo){
      $conexion=parent::conectar();
      $sql= "DELETE FROM " . TABLA_HILOS . " WHERE (id_hilo=".$id_hilo.");"

      try{$conexion->query($sql);}
      catch(PDOException $e){
        parent::desconectar($conexion);
        die("Borrado fallido: ".$e->getMessage());
      }
    }


  }
?>

