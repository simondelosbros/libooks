<?php
  require_once('configuracion.inc');

  class DataObject {
    protected $datos = array();

    public function __construct( $data ) {
      //$this->datos= $data;
      foreach ( $data as $clave => $valor )
      	if ( array_key_exists( $clave, $this->datos ) ){
      	  $this->datos[$clave] = $valor;
      	  //echo $valor, '<br>';
      	}
    }

    public function devolverValor( $campo ) {
      if ( array_key_exists( $campo, $this->datos ) ) {
        return $this->datos[$campo];
      } else {
        die( "Campo no encontrado" );
      }
    }

    public function obtenerData( $filaInicio, $numeroFilas, $orden, $nombre_tabla){
      $conexion = self::conectar();
      $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . $nombre_tabla . " ORDER BY :orden LIMIT :filaInicio, :numeroFilas";
      try {
        $st = $conexion->prepare( $sql );
        $st->bindValue( ":filaInicio", $filaInicio, PDO::PARAM_INT );
        $st->bindValue( ":numeroFilas", $numeroFilas, PDO::PARAM_INT );
	$st->bindValue( ":orden", $orden, PDO::PARAM_STR);
        $st->execute();
        $data = array();
//	print_r($st->fetchAll());
        foreach ( $st->fetchAll() as $fila ) {
//	print_r($fila);
//	echo "<br><br>";
          $data[] = new DataObject( $fila );
//	print_r($data);
        }
        $st = $conexion->query( "SELECT found_rows() AS filasTotales" );
        $fila = $st->fetch();
        self::desconectar( $conexion );
        //return array( $fila["filasTotales"], $data );
	return $data;
      } catch ( PDOException $e ) {
        self::desconectar( $conexion );
        die( "Consulta fallida: " . $e->getMessage() );
      }
    }


    public function print_resultado(){
      foreach($this->datos as $result)
        echo $result, ', ';
    }

    protected static function conectar() {
      try {
        $conexion = new PDO( DB_DSN, DB_USUARIO, DB_CONTRASENIA );
        // Se permite a PHP que mantenga la conexión MySQL abierta para
        // que se emplee en otras partes de la aplicación.
        $conexion->setAttribute( PDO::ATTR_PERSISTENT, true );
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $conexion->exec("set names utf8");
        //$conexion->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
      } catch ( PDOException $e ) {
        die( "Conexión fallida: " . $e->getMessage() );
      }
      return $conexion;
    }

    protected static function desconectar( $conexion ) {
      $conexion = "";
    }

  }
?>

