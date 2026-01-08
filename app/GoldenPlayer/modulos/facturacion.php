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
    <link rel="stylesheet" href="../css/facturacion.css">
    <title>Admin Panel</title>
    <link rel="icon" type="image/png" href="../img/logotipo.png">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>

    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.min.css">

    <!-- Librerías necesarias para Buttons -->
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>

    <!-- Archivos para Excel y PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>


</head>

<body>
    <div class="side-menu">
        <div class="brand-name">
            <h1>Facturacion</h1>
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
                    <a href="edit/crearGasto.php" class="btn">Registrar nuevo gasto</a>
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
                            $sql = "SELECT SUM(c.precio) AS total_ventas
                             FROM reservas r
                             JOIN canchas c ON r.cancha_id = c.id
                             WHERE r.estado = 'confirmada'";

                            $result = $conn->query($sql);
                            $ventas = $result->fetch_assoc()['total_ventas'];

                            // Si no hay ventas, poner 0
                            if ($ventas === null) {
                                $ventas = 0;
                            }
                            ?>
                            <?= number_format($ventas) ?>
                            <h3>Gastos Pendientes</h3>
                    </div>
                    <div class="icon-case">
                        <img src="../img/reserva.png" alt="">
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <h1>
                            <?php
                            $sql = "SELECT SUM(c.precio) AS total_ventas
                             FROM reservas r
                             JOIN canchas c ON r.cancha_id = c.id
                             WHERE r.estado = 'confirmada'";

                            $result = $conn->query($sql);
                            $ventas = $result->fetch_assoc()['total_ventas'];

                            // Si no hay ventas, poner 0
                            if ($ventas === null) {
                                $ventas = 0;
                            }
                            ?>
                            <?= number_format($ventas) ?>
                        </h1>
                        <h3>Ventas Anuales</h3>
                    </div>
                    <div class="icon-case">
                        <img src="../img/venta.png" alt="">
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <h1>
                            <?php
                            $sql = "SELECT SUM(c.precio) AS total_ventas
                             FROM reservas r
                             JOIN canchas c ON r.cancha_id = c.id
                             WHERE r.estado = 'confirmada'";

                            $result = $conn->query($sql);
                            $ventas = $result->fetch_assoc()['total_ventas'];

                            // Si no hay ventas, poner 0
                            if ($ventas === null) {
                                $ventas = 0;
                            }
                            ?>
                            <?= number_format($ventas) ?>
                        </h1>
                        <h3>Ventas semanales</h3>
                    </div>
                    <div class="icon-case">
                        <img src="../img/venta.png" alt="">
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <h1>
                            <?php
                            $sql = "SELECT SUM(c.precio) AS total_ventas
                             FROM reservas r
                             JOIN canchas c ON r.cancha_id = c.id
                             WHERE r.estado = 'confirmada'";

                            $result = $conn->query($sql);
                            $ventas = $result->fetch_assoc()['total_ventas'];

                            // Si no hay ventas, poner 0
                            if ($ventas === null) {
                                $ventas = 0;
                            }
                            ?>
                            <?= number_format($ventas) ?>
                        </h1>
                        <h3>Ventas mensuales</h3>
                    </div>
                    <div class="icon-case">
                        <img src="../img/venta.png" alt="">
                    </div>
                </div>
            </div>
            <div class="content-2">
                <div class="new-cancha">
                    <div class="title">
                        <h2>Canchas Alquiladas</h2>
                    </div>
                    <table id="miTabla" class="display">
                        <thead>
                            <tr>
                                <th>N° Reserva</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Usuario</th>
                                <th>Telefono</th>
                                <th>Estado</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM reservas WHERE estado = 'confirmada'";
                            $query = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td>
                                        <?= $row['id'] ?>
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
                                        <?= $row['telefono'] ?>
                                    </td>
                                    <td>
                                        Pago Realizado
                                    </td>

                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="new-cancha">
                    <div class="title">
                        <h2>Gastos</h2>
                    </div>
                    <table id="costos" class="display">
                        <thead>
                            <tr>
                                <th>Concepto</th>
                                <th>Valor</th>
                                <th>Fecha Limite</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM gastos";
                            $query = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td>
                                        <?= $row['concepto'] ?>
                                    </td>
                                    <td>
                                        <?= $row['valor'] ?>
                                    </td>
                                    <td>
                                        <?= $row['fecha_limite'] ?>
                                    </td>
                                    <td class="funcion">
                                        <div class="actualizar">
                                            <a href="edit/editarGasto.php?id=<?= $row['id'] ?>"><img
                                                    src="../img/panel/actualizar.png" alt="" height="30px" width="30px"></a>
                                        </div>
                                    </td>
                                    <td class="funcion">
                                        <div class="eliminar">
                                            <a href="../controlador/gastos/eliminarGasto.php?id=<?= $row['id'] ?>"><img
                                                    src="../img/panel/eliminar.png" alt="" height="30px" width="30px"></a>
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
    $('#miTabla').DataTable({
        pageLength: 5,
        lengthMenu: [5, 10, 25, 50],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/2.0.8/i18n/es-ES.json'
        },
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'pdfHtml5',
            'print'
        ]
    });

    $('#costos').DataTable({
        pageLength: 5,
        lengthMenu: [5, 10, 25, 50],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/2.0.8/i18n/es-ES.json'
        },
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'pdfHtml5',
            'print'
        ]
    });


</script>

</html>