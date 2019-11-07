<?php
  function cajita($i){
    if($i==0){
      echo
      '<form id="acceso" action="acceder.php" method="post" name="acceso_cuenta">
        <fieldset><legend id="leyenda">Acceso / Registro</legend>
  	<label for="nombre"> Usuario: </label><br>
  	<input class="texto_form" type="text" name="nick" required/><br>
  	<label for="contrasenia"> Contraseña </label><br>
  	<input class="texto_form" type="password" name="contrasenia" required/><br><br>
  	<input class="boton_form" type="submit" value="Acceder"/>
  	<a id="registro" href="altausuario.php">Registro</a>
  	</fieldset>
      </form>';
      if(isset($_GET["fail"])){
         if($_GET["fail"] == 1)
           echo
           "<script type='text/javascript'>
              window.onload = function(){alert('Contraseña equivocada.');}
            </script>";
         if($_GET["fail"] == 2)
           echo 
           "<script type='text/javascript'>
              window.onload = function(){alert('Usuario no existente.');}
            </script>";
      }
    }

    if($i==1){
      echo
      '<form id="acceso" action="desconectar.php" method="post" name="desconectar">
        <fieldset><legend>Conectado</legend>
          <p id="user"><b>Usuario:</b> '.$_SESSION['nick'].'</p>
          <p id="leidos"><b>Libros leídos:</b> '.$_SESSION['n_leidos'].'</p>
          <input class="boton_form" type="submit" value="Desconectar"/><br><br>
          <a id="registro" href="datospersonales.php">Editar perfil</a>
        </fieldset>
      </form>

      <nav class="navegacion">
        <a href="mis_libros.php">Mis Libros</a>
        <a href="foro.php">Foro</a>
        <a href="recomendaciones_u1.php">Recomendaciones</a>
      </nav>';
    }
  }
?>

