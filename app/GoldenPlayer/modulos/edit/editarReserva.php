<?php
include('../../modelos/conexion.php');
$conn = conexion();
$id = $_GET['id'];
$sql = "SELECT * FROM reservas WHERE id='$id'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/reservas.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>


    <title>Admin Panel</title>
</head>

<body>
    <div class="side-menu">
        <div class="brand-name">
            <h1>Reservas</h1>
        </div>
        <ul>
            <a href="../admin.php">
                <li><img src="../../img/panel/inicio.png" alt=""><span>&nbsp; Inicio</span></li>
            </a>
            <a href="../reservas.php">
                <li><img src="../../img/panel/reserva.png" alt=""><span>&nbsp;Gestion de Reservas</span></li>
            </a>
            <a href="../usuarios.php">
                <li><img src="../../img/panel/usuario.png" alt=""><span>&nbsp;Gestion de Usuarios</span></li>
            </a>
            <a href="../canchas.php">
                <li><img src="../../img/panel/cancha.png" alt=""><span>&nbsp;Gestion de Canchas</span></li>
            </a>
            <a href="../facturacion.php">
                <li><img src="../../img/panel/factura.png" alt=""><span>&nbsp;Gestion de Facturacion</span></li>
            </a>
            <a href="campeonato.php">
                <li><img src="../../img/panel/cancha.png" alt=""><span>&nbsp;Campeonato</span></li>
            </a>
        </ul>
    </div>
    <div class="container">
        <div class="header">
            <div class="nav">
                <div class="search">
                    <input type="text" placeholder="Buscar">
                    <button type="submit"><img src="../../img/buscar.png" alt=""></button>
                </div>
                <div class="user">
                    <div class="img-case">
                        <img src="../../img/user.png" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="content-2">
                <br>
                <div class="modal-content">
                    <div class="wrapper" id="reservaForm">
                        <form class="reserva-form" id="formReservaAdmin" action="../../controlador/editarReserva.php"
                            method="POST">
                            <center>
                                <h2>Actualizar Reserva</h2>
                            </center>
                            <input type="hidden" id="id" name="id" value="<?= $row['id'] ?>">
                            <input type="hidden" id="cancha_id" name="cancha_id" value="1">
                            <div class="form-group">
                                <h3 class="reserva-cancha" id="nombreCanchaReserva"></h3>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Fecha de reserva</label>
                                    <input type="date" id="fecha" name="fecha" class="form-input" required
                                        value="<?= $row['fecha'] ?>" />
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Hora de reserva</label>
                                    <select id="hora" name="hora" class="form-input" required>
                                        <option value="<?= $row['hora'] ?>"><?= $row['hora'] ?></option>
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
                                        placeholder="Tu nombre" value="<?= $row['nombre'] ?>" required />
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="email" id="email" name="email" class="form-input"
                                        placeholder="tu@email.com" value="<?= $row['email'] ?>" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Teléfono de contacto</label>
                                    <input type="tel" id="telefono" name="telefono" class="form-input"
                                        placeholder="+56 9 1234 5678" required value="<?= $row['telefono'] ?>" />
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
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Estado</label>
                                    <select id="estado" name="estado" class="form-input" required>
                                        <option value="en_espera">en_espera</option>
                                        <option value="confirmada">confirmada</option>
                                        <option value="cancelada">cancelada</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">En caso de cancelar escoja una razon</label>
                                    <select id="motivo" name="motivo" class="form-input" required>
                                        <option value="NULL"></option>
                                        <option value="No consiguió equipo completo">No consiguió equipo completo
                                        </option>
                                        <option value="Les fallaron varios jugadores a última hora">Les fallaron varios
                                            jugadores a última hora</option>
                                        <option value="El clima no está favorable">El clima no está favorable</option>
                                    </select>
                                </div>

                            </div>

                            <button type="submit" class="submit-button">Actualizar reserva</button>
                        </form>
                    </div>
                </div>
                <script>
                    document.getElementById("formReserva").addEventListener("submit", function (e) {
                        e.preventDefault(); // evita que se recargue la página

                        const formData = new FormData(this);

                        fetch("../../controlador/editarReserva.php", {
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
</body>
<script>
    $(document).ready(function () {
        $('#miTabla').DataTable({
            pageLength: 5,        // Cantidad de registros por página
            lengthMenu: [5, 10, 25, 50], // Opciones de paginación
            language: {           // Traducción al español
                url: '//cdn.datatables.net/plug-ins/2.0.8/i18n/es-ES.json'
            }
        });
    });
</script>
<script src="../js/reservas.js"></script>

</html>