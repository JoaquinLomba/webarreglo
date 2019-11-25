
<?php
session_start();
require 'database.php';

//para hacer un login reogemos la base de datos los datos que le pedimos por formulario,
//este if comprueba que no este vacio ni password ni email, si no esta vacio sigue con la ejecucion, si no da error
if (!empty($_POST['correo']) && !empty($_POST['password'])) {
//la variable records prepara la conexion a la base de datos
    $records = $conn->prepare('SELECT id_user, nombre, correo, password FROM data WHERE correo = :correo');
//la variable records da valores con el parametro bindparam, el segundo valor lo asigna al nombre que esta en el primer valor
    $records->bindParam(':correo', $_POST['correo']);
//ejecuta la conexion
    $records->execute();
//hacemos con la variable results un recogida de datos con el parametro que esta dentro del parentesis para transformarlo a string
    $results = $records->fetch(PDO::FETCH_ASSOC);
    $message = '';
//hacemos coon este if una comprobacion numerica contando si los resultados son mayores que cero y la contraseña encriptada es igual a la contraseña desencriptada, si es asi ejecutamos todo y vamos a la siguiente pagina que seria hello.php

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['id_user'] = $results['id_user'];
      $_SESSION['correo'] = $results['correo'];
      $_SESSION['nombre'] = $results['nombre'];
      header("Location: hello.php");
    } else {
      $message = 'Lo sentimos, el usuario no existe';
    }
  }


 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
   </head>
   <body>
     <form class="" action="signin.php" method="post">
       <input type="text" name="correo" value="">
       <input type="password" name="password" value="">
       <input type="submit" name="" value="Enviar">
     </form>
   </body>
 </html>
