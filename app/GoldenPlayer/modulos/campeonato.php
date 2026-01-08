<?php
session_start();
if (empty($_SESSION["id"])) {
    header("location: ../login.php");
}
include("../modelos/conexion.php");
$conn = conexion();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="icon" type="image/png" href="../img/logotipo.png">
    <link rel="stylesheet" href="../css/campeonato.css">
    <href="https: //cdnjs.cloudflare.com/ajax/libs/jquery-bracket/0.11.1/jquery.bracket.min.css">
        <!-- CSS de la librería -->
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bracket/0.11.1/jquery.bracket.min.css">

        <title>Admin Panel</title>
</head>

<body>
    <div class="side-menu">
        <div class="brand-name">
            <h2>Campeonato</h2>
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
            <div class="equipos">
                <section class="motivacion">
                    <h1>Torneo</h1>
                    <p>Administra y organiza torneos de fútbol fácilmente. Crea equipos, define reglas y gestiona cada
                        partido desde un panel intuitivo y rápido.</p>

                    <br>
                    <a href="campeonato/crearTorneo.php" class="btn">Crear Torneo</a>
                    <center>
                        <br>
                        <div class="lista">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Nombre del torneo</th>
                                        <th>Inicio</th>
                                        <th>Fin</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $sql = "select * from torneos";
                                    $query = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_array($query)) { ?>
                                        <tr>
                                            <td>
                                                <?= $row['nombre'] ?>
                                            </td>
                                            <td>
                                                <?= $row['fecha_inicio'] ?>
                                            </td>
                                            <td>
                                                <?= $row['fecha_fin'] ?>
                                            </td>
                                            <td class="funcion">
                                                <div class="actualizar">
                                                    <a href="campeonato/editarTorneo.php?id=<?= $row['id_torneo'] ?>"><img
                                                            src="../img/panel/actualizar.png" alt="" height="30px"
                                                            width="30px"></a>
                                                </div>
                                            </td>
                                            <td class="funcion">
                                                <div class="eliminar">
                                                    <a
                                                        href="../controlador/torneo/torneo/eliminarTorneo.php?id=<?= $row['id_torneo'] ?>"><img
                                                            src="../img/panel/eliminar.png" alt="" height="30px"
                                                            width="30px"></a>
                                                </div>
                                            </td>
                                        </tr>

                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </center>
                </section>
            </div>
            <div class="equipos">
                <section class="motivacion">
                    <h1>Equipos participantes</h1>
                    <p>Inscribe a los equipos mas grandes de tu ciudad para hacer el torneo mas emocionante</p>
                    <p><strong>Registra los equipos participantes</strong></p>
                    <br>
                    <a href="campeonato/crearEquipo.php" class="btn">Inscribir equipo</a>
                    <center>
                        <br>
                        <div class="lista">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Grupo</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $sql = "select * from equipos ";
                                    $query = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_array($query)) { ?>
                                        <tr>
                                            <td>
                                                <?= $row['nombre'] ?>
                                            </td>
                                            <td>
                                                <?= $row['grupo'] ?>
                                            </td>
                                            <td class="funcion">
                                                <div class="actualizar">
                                                    <a href="campeonato/editarEquipo.php?id=<?= $row['id_equipo'] ?>"><img
                                                            src="../img/panel/actualizar.png" alt="" height="30px"
                                                            width="30px"></a>
                                                </div>
                                            </td>
                                            <td class="funcion">
                                                <div class="eliminar">
                                                    <a
                                                        href="../controlador/torneo/eliminarTorneo.php?id=<?= $row['id_equipo'] ?>"><img
                                                            src="../img/panel/eliminar.png" alt="" height="30px"
                                                            width="30px"></a>
                                                </div>
                                            </td>
                                        </tr>

                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </center>
                </section>
            </div>
            <div class="equipos">
                <section class="motivacion">
                    <h1>Resultados</h1>
                    <p>Registra los resultados entre los equipos que compitieron </p>
                    <br>
                    <a href="campeonato/crearResultado.php" class="btn">Registrar resultados</a>
                    <center>
                        <br>
                        <div class="encuentros">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Equipo Local</th>
                                        <th>Equipo Visitante</th>
                                        <th>Goles del local</th>
                                        <th>Goles del visitante</th>
                                        <th>Fecha</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $sql = "SELECT 
                                            p.id_partido,
                                            el.nombre AS equipo_local,
                                            ev.nombre AS equipo_visitante,
                                            p.goles_local,
                                            p.goles_visitante,
                                            p.fecha
                                            FROM partidos p
                                            JOIN equipos el ON p.id_equipo_local = el.id_equipo
                                            JOIN equipos ev ON p.id_equipo_visitante = ev.id_equipo;";
                                    $query = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_array($query)) { ?>
                                        <tr>
                                            <td>
                                                <?= $row['equipo_local'] ?>
                                            </td>
                                            <td>
                                                <?= $row['goles_local'] ?>
                                            </td>
                                            <td>
                                                <?= $row['goles_visitante'] ?>
                                            </td>
                                            <td>
                                                <?= $row['equipo_visitante'] ?>
                                            </td>
                                            <td>
                                                <?= $row['fecha'] ?>
                                            </td>
                                            <td class="funcion">
                                                <div class="actualizar">
                                                    <a href="campeonato/editarResultado.php?id=<?= $row['id_partido'] ?>"><img
                                                            src="../img/panel/actualizar.png" alt="" height="30px"
                                                            width="30px"></a>
                                                </div>
                                            </td>
                                            <td class="funcion">
                                                <div class="eliminar">
                                                    <a
                                                        href="../controlador/torneo/eliminarResultado.php?id=<?= $row['id_partido'] ?>"><img
                                                            src="../img/panel/eliminar.png" alt="" height="30px"
                                                            width="30px"></a>
                                                </div>
                                            </td>
                                        </tr>

                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </center>
                </section>
            </div>
            <div class="equipos">
                <section class="motivacion">
                    <div>
                        <center>
                            <h1>Fase Final</h1>
                            <p>Registra los resultados entre los equipos de la fase final, selecciona en que fase estan
                                jugando</p>
                            <br>
                            <a href="campeonato/crearResultado.php" class="btn">Registrar resultado</a>
                            <br>
                            <br>
                        </center>
                        <center>
                            <div class="campeonato-wrapper">
                                <div class="bracket-scroll">
                                    <div class="bracket">
                                <div class="round">
                                    <?php
                                    $sql = "SELECT 
                                            p.id_partido,
                                            el.nombre AS equipo_local,
                                            ev.nombre AS equipo_visitante,
                                            p.goles_local,
                                            p.goles_visitante,
                                            p.fecha
                                            FROM partidos p
                                            JOIN equipos el ON p.id_equipo_local = el.id_equipo
                                            JOIN equipos ev ON p.id_equipo_visitante = ev.id_equipo WHERE fase ='octavos'LIMIT 8;";
                                    $query = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_array($query)) { ?>
                                        <div class="match">
                                            <div class="team">
                                                <?= $row['equipo_local'] ?><span><?= $row['goles_local'] ?></span>
                                            </div>
                                            <div class="team">
                                                <?= $row['equipo_visitante'] ?><span><?= $row['goles_visitante'] ?></span>
                                            </div>
                                        </div>
                                    <?php }
                                    ?>
                                </div>
                                <!-- COLUMNA 1 -->
                                <div class="round">
                                    <?php
                                    $sql = "SELECT 
                                            p.id_partido,
                                            el.nombre AS equipo_local,
                                            ev.nombre AS equipo_visitante,
                                            p.goles_local,
                                            p.goles_visitante,
                                            p.fecha
                                            FROM partidos p
                                            JOIN equipos el ON p.id_equipo_local = el.id_equipo
                                            JOIN equipos ev ON p.id_equipo_visitante = ev.id_equipo WHERE fase ='cuartos'LIMIT 4;";
                                    $query = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_array($query)) { ?>
                                        <div class="match">
                                            <div class="team">
                                                <?= $row['equipo_local'] ?><span><?= $row['goles_local'] ?></span>
                                            </div>
                                            <div class="team">
                                                <?= $row['equipo_visitante'] ?><span><?= $row['goles_visitante'] ?></span>
                                            </div>
                                        </div>
                                    <?php }
                                    ?>
                                </div>

                                <!-- COLUMNA 2 -->
                                <div class="round">
                                    <?php
                                    $sql = "SELECT 
                                            p.id_partido,
                                            el.nombre AS equipo_local,
                                            ev.nombre AS equipo_visitante,
                                            p.goles_local,
                                            p.goles_visitante,
                                            p.fecha
                                            FROM partidos p
                                            JOIN equipos el ON p.id_equipo_local = el.id_equipo
                                            JOIN equipos ev ON p.id_equipo_visitante = ev.id_equipo WHERE fase ='semifinal'LIMIT 2;";
                                    $query = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_array($query)) { ?>
                                        <div class="match">
                                            <div class="team">
                                                <?= $row['equipo_local'] ?><span><?= $row['goles_local'] ?></span>
                                            </div>
                                            <div class="team">
                                                <?= $row['equipo_visitante'] ?><span><?= $row['goles_visitante'] ?></span>
                                            </div>
                                        </div>
                                    <?php }
                                    ?>
                                </div>

                                <!-- COLUMNA 3 -->
                                <div class="round">

                                    <?php
                                    $sql = "SELECT 
                                            p.id_partido,
                                            el.nombre AS equipo_local,
                                            ev.nombre AS equipo_visitante,
                                            p.goles_local,
                                            p.goles_visitante,
                                            p.fecha
                                            FROM partidos p
                                            JOIN equipos el ON p.id_equipo_local = el.id_equipo
                                            JOIN equipos ev ON p.id_equipo_visitante = ev.id_equipo WHERE fase ='final'LIMIT 1;";
                                    $query = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_array($query)) { ?>
                                        <div class="match">
                                            <div class="team">
                                                <?= $row['equipo_local'] ?><span><?= $row['goles_local'] ?></span>
                                            </div>
                                            <div class="team">
                                                <?= $row['equipo_visitante'] ?><span><?= $row['goles_visitante'] ?></span>
                                            </div>
                                        </div>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                                </div>
                            </div>

                        </center>

                        <br>
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>

</html>