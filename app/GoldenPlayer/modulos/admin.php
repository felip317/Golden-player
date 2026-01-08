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
    <link rel="stylesheet" href="../css/admin.css">
    <title>Admin Panel</title>
    <link rel="icon" type="image/png" href="../img/logotipo.png">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
</head>


<body>
    <div class="side-menu">
        <div class="brand-name">
            <h1>Panel
            </h1>
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
                        <h1><?php
                        $reservas = $conn->query("SELECT COUNT(*) AS total FROM reservas WHERE estado='en_espera'")->fetch_assoc()['total'];
                        print ($reservas)
                            ?></h1>
                        <h3>Reservas</h3>
                    </div>
                    <div class="icon-case">
                        <img src="../img/reserva.png" alt="">
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <h1>
                            <?php
                            $usuarios = $conn->query("SELECT COUNT(*) AS total FROM usuarios")->fetch_assoc()['total'];
                            print ($usuarios)
                                ?>
                        </h1>
                        <h3>Usuarios Registrados</h3>
                    </div>
                    <div class="icon-case">
                        <img src="../img/usuario.png" alt="">
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <h1>
                            <?php
                            $canchas = $conn->query("SELECT COUNT(*) AS total FROM canchas")->fetch_assoc()['total'];
                            print ($canchas)
                                ?>
                        </h1>
                        <h3>Canchas Registradas</h3>
                    </div>
                    <div class="icon-case">
                        <img src="../img/cancha.png" alt="">
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
                        <h3>Ventas</h3>
                    </div>
                    <div class="icon-case">
                        <img src="../img/venta.png" alt="">
                    </div>
                </div>
            </div>
            <div class="content-2">
                <div class="recent-payments">
                    <div class="title">
                        <h2>Reservas Recientes</h2>
                        <a href="reservas.php" class="btn">Ver mas</a>
                    </div>
                    <table id="" class="display">
                        <thead>
                            <th>Nombre</th>
                            <th>Cancha</th>
                            <th>telefono</th>
                            <th>hora</th>
                            <th>Dia</th>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM reservas ORDER BY id DESC LIMIT 5";
                            $query = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td><?= $row['nombre'] ?></td>
                                    <td><?= $row['cancha_id'] ?></td>
                                    <td><?= $row['telefono'] ?></td>
                                    <td><?= $row['hora'] ?></td>
                                    <td><?= $row['fecha'] ?></td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="new-cancha">
                    <div class="title">
                        <h2>Usuarios nuevos</h2>
                        <a href="usuarios.php" class="btn">Ver mas</a>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Fecha de creacion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM usuarios LIMIT 5";
                            $query = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td><?= $row['username'] ?></td>
                                    <td><?= $row['created_at'] ?></td>
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

</html>