<?php
session_start();
require 'database.php';
//var_dump($_SESSION['id_user']);
$message = '';
//Comprobamos que los campos de email y contraseña no esten vacios.
  if (!empty($_POST['correo']) && !empty($_POST['password']) && !empty($_POST['nombre'])) {
    $sql = "INSERT INTO data (nombre, password, correo) VALUES (:nombre, :password, :correo)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':correo', $_POST['correo']);
    $stmt->bindParam(':nombre', $_POST['nombre']);
    // $email = $_POST['email'];
    //La contraseña la encriptamos con un hash, para mayor seguridad y protección.
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);
    $pass1 = $_POST['password'];
    $pass2 = $_POST['passwordR'];
//Antes de mandar el registro, comprobamos que las contraseñas sean igules, si lo son, pasamos a la siguiente pantalla, si no se devuelve un mensaje de error y te manda a la misma pantalla
if ($pass1 == $pass2) {
  if ($stmt->execute()) {
    header("Location: hello.php");
    $last_id = $conn->lastInsertId();
    echo "New record created successfully. Last inserted ID is: " . $last_id;
  $_SESSION['id_user'] = $last_id;
  $_SESSION['nombre'] = $_POST['nombre'];
  $_SESSION['correo'] = $_POST['correo'];
    $message = 'Usuario creado correctamente';
  } else {
    $message = 'El correo introducido ya existe. Por favor, introduzca uno válido';
  }
}else {
  $message = "<p class='mensaje1'>Las contraseñas no son iguales</p>";
}
  }
 ?>

<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="style.css">

    <meta charset="utf-8">
    <title>IdiomaKids</title>
  </head>
  <body class="bodyBack" >

    <center>
      <h1 class="regis">REGISTRO</h1>


<br>
<br>
<form class="" action="index.php" method="post">
  <container class="containerFields">

    <section class="emailField">
        <h4 style="font-size:25px;display:table-row;">Email</h4>
        <input style="transition:0s" type="email" name="correo" id="correo" required>

    </section>
    <section class="passwordField">
      <h4 style="font-size:25px;display:table-row;">Contraseña</h4>
      <input style="transition:0s" type="password" name="password" minlength = 6 id="password" onmouseover="agrandar()"required>
    </section>
    <section class="passwordField">
      <h4 style="font-size:25px;display:table-row;">Nombre</h4>
      <input style="transition:0s"type="text" name="nombre" minlength = 6 id="nombre" required>
    </section>
    <section class="passwordField">
        <h4 style="font-size:25px;margin-bottom: 0%;">Repetir contraseña</h4>
        <input style="transition:0s" type="password" name="passwordR" minlength = 6 id="passwordR" onfocusout="passCheck()" onmouseout="passCheck()" required>
    </section>
<script type="text/javascript">
//Hacemos una comprabacion en vivo de las contraseñas antes de mandarlas a la base de datos, si alguien consigue burlar este paso, entra en juego el paso anterior de comprobacion de contraseñas
    var pass1 = document.getElementById('passwordR');
    var pass2 = document.getElementById('password');
  if (pass1.value != pass2.value) {
    window.alert("No voy a pasar a la siguiente pagina")
  }
</script>
  </container>
  <br>
  <br>
  <script type="text/javascript">
    function passCheck(){
      var x = document.getElementById('password').value;
      var y = document.getElementById('passwordR').value;
      if (x == y && x >1 && y>1) {
        document.getElementById('MessageCheck').style.display = 'none';
        document.getElementById('buttonRegister2').id = 'buttonRegisterCheck';
      }else{
        document.getElementById('MessageCheck').style.display = 'inline-block';
        document.getElementById('buttonRegisterCheck').id = 'buttonRegister2';
      }
    }
  </script>
  <?php if(!empty($message)): ?>
    <?= $message ?>
  <?php endif; ?>
  <p style="display:none;" id="MessageCheck" class="mensaje1">Las contraseñas no son iguales</p>
  <div class="buttonGroup">
    <a href="index.php" style="text-decoration:none;color:black;"><button type="button" name="buttonR" id="buttonRegister" style="margin-right:5%;">VOLVER</button></a>
    <input type="submit" name="buttonR" id="buttonRegister2" value="REGISTRAR"></input>
    <div class="">
      <input type="checkbox" name="button" required></input>
      <p style="display:inline-block;" class="mensaje1">He leido y acepto la <a href="dataProtection.html" target="_blank" class="mensaje2">política de protección de datos</a> de IdiomaKids</p>

    </div>
  </div>
</form>


<br>
<br>
    </center>
    <script type="text/javascript" src="script.js"></script>
  </body>

</html>
