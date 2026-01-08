<?php
include('../../modelos/conexion.php');
$conn = conexion();
$id = $_GET['id'];
$sql = "SELECT * FROM gastos WHERE id='$id'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/gastos.css">
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
                        <form class="reserva-form" id="formReservaAdmin"
                            action="../../controlador/gastos/editarGasto.php" method="POST">
                            <center>
                                <h2>Registrar nuevo gasto</h2>
                            </center>
                            <div class="form-group">
                                <h3 class="reserva-cancha" id="nombreCanchaReserva"></h3>
                            </div>
                            <div class="form-row">
                                <input type="hidden" id="id" name="id" value="<?= $row ['id'] ?>">
                                <div class="form-group">
                                    <label class="form-label">Fecha Limite</label>
                                    <input type="date" id="fecha" name="fecha" class="form-input" value="<?= $row ['fecha_limite'] ?>" required />
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Valor</label>
                                    <input type="text" id="valor" name="valor" class="form-input"
                                        placeholder="precio sin puntos" value="<?= $row ['valor'] ?>" required />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Concepto</label>
                                <input type="text" id="concepto" name="concepto" class="form-input"
                                    placeholder="Descripcion" value="<?= $row ['concepto'] ?>" required />
                            </div>

                            <button type="submit" class="submit-button">Actualizar Gasto</button>
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