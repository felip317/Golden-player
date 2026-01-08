<?php
session_start();
require "controlador/login/controladorLogin.php"; // procesa login

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Golden Player</title>
    <link rel="icon" type="image/png" href="img/logo.png">
    <link rel="stylesheet" href="css/crearCuenta.css">
</head>

<body>
    <header>
        <img src="img/logo.png" class="logo">
        <div class="menu-toggle" onclick="toggleMenu()">☰</div>
        <nav class="navegation">
            <button class="btnLogin-popup" onclick="window.location.href='login.php'">Volver</button>
        </nav>
    </header>
    <br><br>
    <div class="balon"></div>
    <div class="wrapper">
        <div class="form-box login">
            <h2>Crear nueva cuenta</h2>
            <form method="POST" action="controlador/usuarios/registrarUsuario.php">
                
                <div class="input-box">          
                    <input type="text" name="nombre" required>
                    <label>Nombre</label>
                </div>
                <div class="input-box">
                    <input type="text" name="apellido" required>
                    <label>Apellido</label>
                </div>
                <div class="input-box">
                    <input type="text" name="username" required>
                    <label>Nombre de usuario</label>
                </div>
                <div class="input-box">
                    <input type="email" name="email" required>
                    <label>Correo Electronico</label>
                </div>
                <div class="input-box">
                    <input type="password" name="password_hash" required>
                    <label>Contraseña</label>
                </div>
                <input type="submit" name="btningresar" class="btn" value="Login">
            </form>
        </div>
    </div>





    <script src="js/login.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>