<?php
session_start();
if (empty($_SESSION["id"])) {
    header("location: ../login.php");
}
include('../modelos/conexion.php');
$conn = conexion();

$id = $_SESSION["id"];
$sql = "SELECT * FROM usuarios WHERE id='$id'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Golden Player</title>
    <link rel="icon" type="image/png" href="../img/logo.png">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/fontawesome.min.css"
        integrity="sha384-NvKbDTEnL+A8F/AA5Tc5kmMLSJHUO868P+lDtTpJIeQdGYaUIuLr4lVGOEA1OcMy" crossorigin="anonymous">
</head>

<body>
    <header>
        <img src="../img/logo.png" class="logo">
        <div class="menu-toggle" onclick="toggleMenu()">☰</div>
        <nav class="navegation">
            <a href="home.php">Inicio</a>
            <a href="contacto.php">Contactanos</a>
            <a href="torneo.php">Torneo</a>
            <button class="btnLogin-popup" onclick="window.location.href='profile.php'"><?php
            echo $_SESSION["username"];
            ?></button>
            <a href="../controlador/login/controladorCerrar.php" class="btnc">Cerrar Sesion</a>
        </nav>
    </header>
    <br><br>
    <div class="container"></div>
    <section class="hero">
        <div class="container">
            
            <section class="motivacion">
                <h1>Editar Perfil de Fútbol</h1>
                <div class="profile-pic">⚽</div> <!-- Ícono de balón como placeholder para foto -->
                <form action="../controlador/usuarios/cambiarUsuario.php" method="post"> <!-- Cambia # por una URL real si tienes backend -->
                    <input type="hidden" id="id" name="id" placeholder="<?= $row['id'] ?>" value="<?= $row['id'] ?>" required>
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" placeholder="<?= $row['nombre'] ?>" value="<?= $row['nombre'] ?>" required>
                    <label for="apellido">Apellido:</label>
                    <input type="text" id="apellido" name="apellido" placeholder="<?= $row['apellido'] ?>" value="<?= $row['apellido'] ?>" required>
                    <label for="equipo">Usuario</label>
                    <input type="text" id="username" name="username" placeholder="<?= $row['username'] ?>" value="<?= $row['username'] ?>" required>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="<?= $row['email'] ?>" value="<?= $row['email'] ?>" required>
                    <label for="equipo">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="<?= $row['password_hash'] ?>" value="<?= $row['password_hash'] ?>" required>
                    <center>
                        <button type="submit">Guardar Cambios</button>
                    </center>
                </form>
                
            </section>
        </div>
    </section>


    <!-- Información de Contacto -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <h3 class="footer-title">FutbolReservas</h3>
                    <p>Reserva tu cancha de fútbol sintética de manera fácil y rápida.</p>
                </div>
                <div>
                    <h3 class="footer-title">Contacto</h3>
                    <p>Email: info@futbolreservas.cl</p>
                    <p>Teléfono: +56 2 2345 6789</p>
                </div>
                <div>
                    <h3 class="footer-title">Horario de Atención</h3>
                    <p>Lunes a Domingo</p>
                    <p>8:00 - 22:00 hrs</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2024 FutbolReservas. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <script src="../js/inicio.js"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>



</body>

</html>