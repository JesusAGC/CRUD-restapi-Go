<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/loginstyle.css">
  <title>Login</title>
</head>
<body>
  <div class="login-wrapper">
    <form action="" class="form">
      <h2>Login</h2>
      <div class="input-group">
        <input type="text" name="loginUser" id="loginUser" required>
        <label for="loginUser">Usuario</label>
      </div>
      <div class="input-group">
        <input type="password" name="loginPassword" id="loginPassword" required>
        <label for="loginPassword">Contraseña</label>
      </div>
      <input type="submit" value="Login" class="submit-btn">
      <a href="http://localhost/ProyectoP2/register.php" class="forgot-pw">Crear cuenta</a>
    </form>

   
  </div>
</body>
<?php

include "class/requests.php";
$req = new request();

$user = isset($_POST["loginUser"]) ? $user=strtoupper($_POST["loginUser"]) : $user=null;
$password = isset($_POST["loginPassword"]) ? $password=strtoupper($_POST["loginPassword"]) : $password=null;

$response = $req->login($user,$password);


?>
</html>