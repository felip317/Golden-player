<?php
session_start();
if (empty($_SESSION["id"])) {
    header("location: ../login.php");
}
include('../modelos/conexion.php');
$conn = conexion();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Golden Player</title>
    <link rel="icon" type="image/png" href="../img/logo.png">
    <link rel="stylesheet" href="../css/home.css">
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
            <a href="../controlador/login/controladorCerrar.php" class="btn">Cerrar Sesion</a>
        </nav>
    </header>
    <br><br>
    <div class="container"></div>
    <section class="hero">
        <div class="container">
            <h2 class="hero-title">Encuentra y Reserva tu Cancha Ideal</h2>
            <p class="hero-subtitle">Disponibilidad en tiempo real y reserva instantánea</p>
            <center>
                <section class="motivacion">
                    <h2>Canchas existentes</h2>
                    <p>Selecciona solo canchas existentes y verifica bien el número antes de escogerla en el formulario.
                    </p>
                    <br>

                    <table>
                        <thead>
                            <tr>
                                <th>nombre</th>
                                <th>descripcion</th>
                                <th>capacidad</th>
                                <th>precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM canchas";
                            $query = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td>
                                        <?= $row['nombre'] ?>
                                    </td>
                                    <td>
                                        <?= $row['descripcion'] ?>
                                    </td>
                                    <td>
                                        <?= $row['capacidad'] ?>
                                    </td>
                                    <td>
                                        <?= $row['precio'] ?>
                                    </td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                </section>
            </center>
        </div>
        <br>
        <div class="container">
            <center>
                <div id="miModal" class="modal">
                    <div class="modal-content">
                        <div class="wrapper" id="reservaForm">
                            <form class="reserva-form" id="formReservaAdmin" action="../controlador/crearReserva.php"
                                method="POST">
                                <center>
                                    <h2>Realizar nueva reserva</h2>
                                </center>
                                <div class="hero-image-container">
                                    <img src="../img/inicio.jpg" alt="" class="hero-image" />
                                </div>
                                <input type="hidden" id="cancha_id" name="cancha_id" value="1">
                                <div class="form-group">
                                    <h3 class="reserva-cancha" id="nombreCanchaReserva"></h3>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label">Fecha de reserva</label>
                                        <input type="date" id="fecha" name="fecha" class="form-input" required />
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Hora de reserva</label>
                                        <select id="hora" name="hora" class="form-input" required>
                                            <option value="">Selecciona una hora</option>
                                            <option value="08:00">08:00</option>
                                            <option value="09:00">09:00</option>
                                            <option value="10:00">10:00</option>
                                            <option value="11:00">11:00</option>
                                            <option value="12:00">12:00</option>
                                            <option value="13:00">13:00</option>
                                            <option value="14:00">14:00</option>
                                            <option value="15:00">15:00</option>
                                            <option value="16:00">16:00</option>
                                            <option value="17:00">17:00</option>
                                            <option value="18:00">18:00</option>
                                            <option value="19:00">19:00</option>
                                            <option value="20:00">20:00</option>
                                            <option value="21:00">21:00</option>
                                            <option value="22:00">22:00</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label">Nombre completo</label>
                                        <input type="text" id="nombre" name="nombre" class="form-input"
                                            placeholder="Tu nombre" required />
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Email</label>
                                        <input type="email" id="email" name="email" class="form-input"
                                            placeholder="tu@email.com" />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label">Teléfono de contacto</label>
                                        <input type="tel" id="telefono" name="telefono" class="form-input"
                                            placeholder="+56 9 1234 5678" required />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Cancha</label>
                                        <select id="cancha_id" name="cancha_id" class="form-input" required>
                                            <option value=""></option>
                                            <?php
                                            $sql = "SELECT * FROM canchas";
                                            $query = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_array($query)) {
                                                ?>
                                                <option value="<?= $row['id'] ?>">
                                                    <?= $row['nombre'] ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="submit-button">Confirmar Reserva</button>
                            </form>
                        </div>
                    </div>
                </div>
            </center>
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
                    <p>Email: info@futbolreservas.com</p>
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
</body>
<script src="../js/inicio.js"></script>
<script src="https://unpkg.com/scrollreveal"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</html>