<?php
session_start();
require "controlador/login/controladorLogin.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Golden Player</title>
    <link rel="icon" type="image/png" href="img/logo.png">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <header>
        <img src="img/logo.png" class="logo">
        <div class="menu-toggle" onclick="toggleMenu()">☰</div>
        <nav class="navegation">
            <a href="contacto.php">Contactanos</a>
            <button class="btnLogin-popup" onclick="window.location.href='login.php'">Iniciar Sesion</button>
        </nav>
    </header>
    <br><br>
    <div class="balon"></div>
    <div class="wrapper">
        <div class="form-box login">
            <h2>Iniciar sesion</h2>
            <form method="POST" action="">
                 <?php
    // Mostrar errores si existen
    if (isset($_SESSION['error'])) {
        echo "<center style='color:red'>" . $_SESSION['error'] . "</center>";
        unset($_SESSION['error']);
    }
    ?>
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                    <input type="email"  name="email" required>
                    <label>Correo Electronico</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                    <input type="password"  name="password" required>
                    <label>Contraseña</label>
                </div>
                
                <input type="submit" name="btningresar" class="btn" value="Login">
                <div class="login-register">
                    <p>¿No tienes una cuenta?<a href="crearCuenta.php" class="register-link">  Crear cuenta</a></p>
                </div>
            </form>
        </div>
    </div>
    
    



    <script src="js/login.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>