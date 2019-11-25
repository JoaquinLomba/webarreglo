<?php
 session_start();

echo "hola";
$hola = $_SESSION['nombre'];
$id = $_SESSION['id_user'];
$correo = $_SESSION['correo'];
echo $correo;
echo $id;
echo $hola;




 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <title>tretretretretretre</title>
  </head>
  <body>
    <div class="maestro">


    <div class="correo1">
    <p>este es tu correo: </p>
      <?php echo $correo ;
      ?>
    </div>
    <div class="id2">
    <p>este es tu id: </p>
      <?php echo $id ;
      ?>
    </div>
    <div class="hola3">
    <p> este es tu nombre: </p>
      <?php echo $hola ;
      ?>
    </div>
  </div>

  </body>
</html>
