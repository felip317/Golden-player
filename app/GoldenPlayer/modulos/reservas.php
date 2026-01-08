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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reservas.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>


    <title>Admin Panel</title>
    <link rel="icon" type="image/png" href="../img/logotipo.png">
</head>

<body>
    <div class="side-menu">
        <div class="brand-name">
            <h1>Reservas</h1>
        </div>
        <ul>
            <a href="admin.php">
                <li><img src="../img/panel/inicio.png" alt=""><span>&nbsp; Inicio</span></li>
            </a>
            <a href="reservas.php">
                <li><img src="../img/panel/reserva.png" alt=""><span>&nbsp;Gestion de Reservas</span></li>
            </a>
            <a href="usuarios.php">
                <li><img src="../img/panel/usuario.png" alt=""><span>&nbsp;Gestion de Usuarios</span></li>
            </a>
            <a href="canchas.php">
                <li><img src="../img/panel/cancha.png" alt=""><span>&nbsp;Gestion de Canchas</span></li>
            </a>
            <a href="facturacion.php">
                <li><img src="../img/panel/factura.png" alt=""><span>&nbsp;Gestion de Facturacion</span></li>
            </a>
            <a href="campeonato.php">
                <li><img src="../img/panel/cancha.png" alt=""><span>&nbsp;Campeonato</span></li>
            </a>
        </ul>
    </div>
    <div class="container">
        <div class="header">
            <div class="nav">
                <div class="user">
                    <button class="btn" id="abrirModal">Hacer Nueva Reserva</button>
                    <div id="miModal" class="modal">
                        <div class="modal-content">
                            <span class="close" id="cerrarModal">&times;</span>
                            <div class="wrapper" id="reservaForm">
                                <form class="reserva-form" id="formReservaAdmin"
                                    action="../controlador/guardarReserva.php" method="POST">
                                    <center>
                                        <h2>Crear nueva reserva</h2>
                                    </center>
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
                                                    <option value="<?= $row['id'] ?>"><?= $row['nombre'] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="submit-button">Confirmar Reserva</button>
                                </form>
                            </div>
                            <div id="reservaConfirmada" style="display: none;">
                                <div class="confirmacion-container">
                                    <div class="confirmacion-icon">✓</div>
                                    <h3 class="confirmacion-title">¡Reserva Confirmada!</h3>
                                    <p class="confirmacion-text" id="detallesReserva"></p>
                                    <p class="confirmacion-email" id="emailConfirmacion"></p>
                                    <button class="reset-button" onclick="resetReservaAdmin()">Aceptar</button>
                                </div>
                            </div>
                            <script>
                                document.getElementById("formReserva").addEventListener("submit", function (e) {
                                    e.preventDefault(); // evita que se recargue la página

                                    const formData = new FormData(this);

                                    fetch("../controlador/guardarReserva.php", {
                                        method: "POST",
                                        body: formData
                                    })
                                        .then(res => res.text())
                                        .then(data => {
                                            if (data.trim() === "success") {
                                                document.getElementById("reservaConfirmada").style.display = "block";
                                                document.getElementById("detallesReserva").innerText =
                                                    "Tu reserva fue confirmada para la fecha " + formData.get("fecha") +
                                                    " a las " + formData.get("hora");
                                                document.getElementById("emailConfirmacion").innerText =
                                                    "Confirmación enviada a: " + formData.get("email");

                                                // Ocultar el formulario después de confirmar
                                                document.getElementById("formReserva").style.display = "none";
                                            } else {
                                                alert("Hubo un error: " + data);
                                            }
                                        })
                                        .catch(err => alert("Error en la solicitud: " + err));
                                });

                                function resetReservaAdmin() {
                                    window.location.href = "reservas.php"; // 👉 cambia "index.php" por la página a donde quieras enviar al usuario
                                }


                            </script>
                        </div>
                    </div>
                </div>
                <div class="search">
                    <input type="text" placeholder="Bienvenido <?php
                    echo $_SESSION["username"];
                    ?> !!" readonly>
                    <button type="submit"><img src="../img/user.png" alt=""></button>
                </div>
                <a href="../controlador/login/controladorCerrar.php" class="btn">Cerrar Sesion</a>
            </div>
        </div>
        <div class="content">
            <div class="cards">


                <div class="card">
                    <div class="box">
                        <h1>
                            <?php
                            $sql = "
    SELECT COUNT(*) AS total_reservas
    FROM reservas
    WHERE creado_en >= DATE_SUB(NOW(), INTERVAL 7 DAY)
";

                            $result = $conn->query($sql);
                            $data = $result->fetch_assoc();

                            $total_reservas_semana = $data['total_reservas'];

                            // Ejemplo de impresión
                            echo $total_reservas_semana;


                            ?>
                        </h1>
                        <h3>Reservas hechas esta ultima semana</h3>
                    </div>
                    <div class="icon-case">
                        <img src="../img/reserva.png" alt="">
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <h1>
                            <?php
                            $canceladas = $conn->query("SELECT COUNT(*) AS total FROM reservas WHERE estado ='cancelada'")->fetch_assoc()['total'];
                            print ($canceladas)
                                ?>
                        </h1>
                        <h3>Reservas Canceladas</h3>
                    </div>
                    <div class="icon-case">
                        <img src="../img/reserva.png" alt="">
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <h1>
                            <?php
                            $jugados = $conn->query("SELECT COUNT(*) AS total FROM reservas WHERE estado ='confirmada'")->fetch_assoc()['total'];
                            print ($jugados)
                                ?>
                        </h1>
                        <h3>Partidos jugados</h3>
                    </div>
                    <div class="icon-case">
                        <img src="../img/reserva.png" alt="">
                    </div>
                </div>
            </div>
            <div class="content-2">
                <div class="recent-payments">
                    <br>
                    <table id="miTabla" class="display">
                        <thead>
                            <tr>
                                <th>N° Reserva</th>
                                <th>Nombre Cancha</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Telefono</th>
                                <th>Cuando se realizo</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT 
    reservas.*, 
    canchas.nombre AS nombre_cancha
FROM reservas
INNER JOIN canchas ON reservas.cancha_id = canchas.id
WHERE reservas.estado = 'en_espera'";
                            $query = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td>
                                        <?= $row['id'] ?>
                                    </td>
                                    <td>
                                        <?= $row['nombre_cancha'] ?>
                                    </td>
                                    <td>
                                        <?= $row['fecha'] ?>
                                    </td>
                                    <td>
                                        <?= $row['hora'] ?>
                                    </td>
                                    <td>
                                        <?= $row['nombre'] ?>
                                    </td>
                                    <td>
                                        <?= $row['email'] ?>
                                    </td>
                                    <td>
                                        <?= $row['telefono'] ?>
                                    </td>
                                    <td>
                                        <?= $row['creado_en'] ?>
                                    </td>
                                    <td>
                                        <?= $row['estado'] ?>
                                    </td>
                                    <td class="funcion">
                                        <div class="actualizar">
                                            <a href="edit/editarReserva.php?id=<?= $row['id'] ?>"><img
                                                    src="../img/panel/actualizar.png" alt="" height="30px" width="30px"></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function () {
        $('#miTabla').DataTable({
            pageLength: 5,        // Cantidad de registros por página
            lengthMenu: [5, 10, 25, 50], // Opciones de paginación
            language: {           // Traducción al español
                url: 'https://cdn.datatables.net/plug-ins/2.0.8/i18n/es-ES.json'
            }
        });
    });
</script>
<script src="../js/reservas.js"></script>

</html>