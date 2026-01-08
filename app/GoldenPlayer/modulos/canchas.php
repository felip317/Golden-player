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
            <h1>Canchas</h1>
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
                    <button class="btn" id="abrirCancha">Registrar cancha nueva</button>
                    <div id="miModalCancha" class="modal">
                        <div class="modal-content">
                            <span class="close" id="cerrarModal">&times;</span>
                            <div class="wrapper" id="reservaForm">
                                <form class="reserva-form" id="formReservaAdmin"
                                    action="../controlador/canchas/crearCancha.php" method="POST">
                                    <center>
                                        <h2>Crear nueva cancha</h2>
                                    </center>
                                    <div class="form-group">
                                        <h3 class="reserva-cancha" id="nombreCanchaReserva"></h3>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="form-label">Nombre</label>
                                            <input type="text" id="nombre" name="nombre" class="form-input" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Precio</label>
                                            <input type="text" id="precio" name="precio" class="form-input"
                                                placeholder="80.000" required />
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="form-label">Descripcion</label>
                                            <input type="text" id="descripcion" name="descripcion" class="form-input"
                                                placeholder="Descripcion" required />
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Capacidad</label>
                                            <input type="text" id="capacidad" name="capacidad" class="form-input"
                                                placeholder="capacidad" />
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
            <br>
            <div class="content-2">
                <div class="recent-payments">
                    <br>
                    <table id="miTabla" class="display">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Capacidad</th>
                                <th>Precio</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM canchas";
                            $query = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($query)) {
                                ?>
                                <tr>
                                    <td><?= $row['nombre'] ?></td>
                                    <td><?= $row['descripcion'] ?></td>
                                    <td><?= $row['capacidad'] ?></td>
                                    <td><?= $row['precio'] ?></td>
                                    <td class="funcion">
                                        <div class="actualizar">
                                            <a href="edit/editarCancha.php?id=<?= $row['id'] ?>"><img
                                                    src="../img/panel/actualizar.png" alt="" height="30px" width="30px"></a>
                                        </div>
                                    </td>
                                    <td class="funcion">
                                        <div class="eliminar">
                                            <a href="../controlador/canchas/eliminarCancha.php?id=<?= $row['id'] ?>"><img
                                                    src="../img/panel/eliminar.png" alt="" height="30px" width="30px"></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
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
<script src="../js/cancha.js"></script>

</html>