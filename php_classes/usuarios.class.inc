<?php
  require_once ('dataObject.class.inc');

  class Usuario extends DataObject {
    protected $datos = array(
      "nick" => "",
      "email" => "",
      "contrasenia" => "",
      "nombre_apellidos" => "",
      "nacimiento" =>"",
      "pais" => "",
      "libro_fav"=>"",
      "n_leidos"=>"",
      "imagen"=>""
    );

    public function __construct($datos) {
      parent::__construct($datos);
    }

    public static function obtenerUsuario( $nick ) {
      $conexion = parent::conectar();
      $sql = "SELECT * FROM " . TABLA_USUARIOS . " WHERE nick = :nick";
      try {
        $st = $conexion->prepare( $sql );
        $st->bindValue( ":nick", $nick, PDO::PARAM_STR );
        $st->execute();
        $fila = $st->fetch();
        parent::desconectar( $conexion );
        if ( $fila ) return new Usuario( $fila );
      } catch ( PDOException $e ) {
        parent::desconectar( $conexion );
        die( "Consulta fallada: " . $e->getMessage() );
      }
    }

    public function validarUsuario($nick, $contrasenia){
      $user=self::obtenerUsuario($nick);
      if(isset($user)){
        if($user->devolverValor('contrasenia')==$contrasenia){
          return true;
        }else{
          return "fail=1";
          //return "Contraseña equivocada.<br>";
          //return false;
        }
      }else{
        return "fail=2";
        //return "Usuario no existente. <br>";
        //return false;
      }
    }

    public static function get_n_leidos( $nick ) {
      $user=self::obtenerUsuario($nick);
      if(isset($user))
        return $user->devolverValor('n_leidos');
      else
        return 'fail';
    }

    public static function insertarUsuario($nick, $email, $contrasenia, $nombre_apellidos="", $nacimiento="", $pais="", $libro_fav="", $imagen){
      $conexion = parent::conectar();
      $sql = "INSERT INTO " . TABLA_USUARIOS . " (nick, email, contrasenia";
      $valores = "VALUES ('".$nick."','".$email."','".$contrasenia."'";

      if($nombre_apellidos!=""){
        $sql=$sql.", nombre_apellidos";
        $valores=$valores.",'".$nombre_apellidos."'";
      }
      if($nacimiento!=""){
        $sql=$sql.", nacimiento";
        $valores=$valores.",'".$nacimiento."'";
      }
      if($pais!=""){
        $sql=$sql.", pais";
        $valores=$valores.",'".$pais."'";
      }
      if($libro_fav!=""){
        $sql=$sql.", libro_fav";
        $valores=$valores.",'".$libro_fav."'";
      }

      $sql=$sql.", n_leidos, imagen) ".$valores.", 0, '".$imagen."');";

      try { $conexion->query( $sql ); }
      catch ( PDOException $e ) {
        parent::desconectar($conexion);
        die("Inserción fallida: " . $e->getMessage() );
      }
    }

    public static function cambiarContrasenia($nick, $nuevacontrasenia){
      $conexion = parent::conectar();
      $sql= "UPDATE " . TABLA_USUARIOS . " SET contrasenia = '".$nuevacontrasenia."' WHERE (nick='".$nick."');";

      try { $conexion->query( $sql ); }
      catch ( PDOException $e ) {
        parent::desconectar($conexion);
        die("Modificación fallida: " . $e->getMessage() );
      }
    }

    public static function modificarDatos($nick, $email, $nombre_apellidos, $nacimiento, $pais, $libro_fav){
      $conexion=parent::conectar();
      $sql= "UPDATE ". TABLA_USUARIOS . " SET email='".$email."',
                                              nombre_apellidos='".$nombre_apellidos."',
                                              pais='".$pais."',
                                              libro_fav='".$libro_fav."'";


      if($nacimiento!="")  $sql=$sql.", nacimiento='".$nacimiento."'";

      $sql=$sql." WHERE (nick='".$nick."');";

      try{$conexion->query($sql);}
      catch(PDOException $e){
        parent::desconectar($conexion);
        die("Modificación fallida: ".$e->getMessage());
      }
    }

    public static function nuevoLibroLeido( $nick ){
      $conexion=parent::conectar();
      $sql= "UPDATE ". TABLA_USUARIOS . " SET n_leidos=n_leidos+1 WHERE (nick='".$nick."');";

      try{$conexion->query($sql);}
      catch(PDOException $e){
        parent::desconectar($conexion);
        die("Modificación fallida: ".$e->getMessage());
      }
    }


  }
?>

