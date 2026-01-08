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
    <link rel="stylesheet" href="../css/torneo.css">
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
            <section class="motivacion">
                <h2>¿Por qué participar?</h2>
                <p>Únete a emocionantes torneos de fútbol donde podrás competir con los mejores. Sigue los
                    resultados, anima a tu equipo y gana premios increíbles. ¡La pasión del fútbol te espera!</p>
                <p><strong>¡Regístrate ahora y forma parte de la liga!</strong></p>
                <br>
                <p><strong>Inscripciones al numero: 312 458 9864</strong></p>
                <table>
                    <thead>
                        <tr>
                            <th>Equipo</th>
                            <th>Inicio</th>
                            <th>Fin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM torneos";
                        $query = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($query)) { ?>
                            <tr>
                                <td><?= $row['nombre'] ?></td>
                                <td><?= $row['fecha_inicio'] ?></td>
                                <td><?= $row['fecha_fin'] ?></td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </section>

            <section class="seccion-resultados">
                <h2>Equipos Inscritos</h2>
                <p>Aquí puedes ver los equipos participantes de este torneo</p>

                <h3>Equipos</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Equipo</th>
                            <th>Grupo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM equipos";
                        $query = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($query)) { ?>
                            <tr>
                                <td><?= $row['nombre'] ?></td>
                                <td><?= $row['grupo'] ?></td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </section>
            <section class="seccion-resultados">
                <h2>Grupos Establecidos</h2>
                <div class="container">
                    <p>GRUPO A</p>
                    <table>
                        <thead>
                            <tr>
                                <th>Equipo</th>
                                <th>GC</th>
                                <th>GF</th>
                                <th>PJ</th>
                                <th>Pts</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT e.nombre AS equipo, SUM(CASE 
                        WHEN p.id_equipo_local = e.id_equipo THEN p.goles_visitante
                        WHEN p.id_equipo_visitante = e.id_equipo THEN p.goles_local
                        ELSE 0
                        END
                        ) AS GC,
                        SUM(
                        CASE 
                        WHEN p.id_equipo_local = e.id_equipo THEN p.goles_local
                        WHEN p.id_equipo_visitante = e.id_equipo THEN p.goles_visitante
                        ELSE 0
                        END
                        ) AS GF,
                        COUNT(p.id_partido) AS PJ,
                        SUM(
                        CASE
                        WHEN p.id_equipo_local = e.id_equipo AND p.goles_local > p.goles_visitante THEN 3
                        WHEN p.id_equipo_visitante = e.id_equipo AND p.goles_visitante > p.goles_local THEN 3
                        WHEN p.goles_local = p.goles_visitante THEN 1
                        ELSE 0
                        END
                        ) AS Pts
                        FROM equipos e
                        JOIN partidos p 
                        ON e.id_equipo IN (p.id_equipo_local, p.id_equipo_visitante)
                        WHERE e.grupo = 'A'
                        AND p.jugado = 1 AND fase = 'grupos' 
                        GROUP BY e.id_equipo
                        ORDER BY Pts DESC, GF DESC, GC ASC";

                            $query = mysqli_query($conn, $sql);

                            while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                <tr>
                                    <td><?= $row['equipo'] ?></td>
                                    <td><?= $row['GC'] ?></td>
                                    <td><?= $row['GF'] ?></td>
                                    <td><?= $row['PJ'] ?></td>
                                    <td><strong><?= $row['Pts'] ?></strong></td>
                                </tr>
                            <?php } ?>


                        </tbody>
                    </table>
                    <br>
                </div>
                <div class="container">
                    <p>GRUPO B</p>
                    <table>
                        <thead>
                            <tr>
                                <th>Equipo</th>
                                <th>GC</th>
                                <th>GF</th>
                                <th>PJ</th>
                                <th>Pts</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT e.nombre AS equipo, SUM(CASE 
                        WHEN p.id_equipo_local = e.id_equipo THEN p.goles_visitante
                        WHEN p.id_equipo_visitante = e.id_equipo THEN p.goles_local
                        ELSE 0
                        END
                        ) AS GC,
                        SUM(
                        CASE 
                        WHEN p.id_equipo_local = e.id_equipo THEN p.goles_local
                        WHEN p.id_equipo_visitante = e.id_equipo THEN p.goles_visitante
                        ELSE 0
                        END
                        ) AS GF,
                        COUNT(p.id_partido) AS PJ,
                        SUM(
                        CASE
                        WHEN p.id_equipo_local = e.id_equipo AND p.goles_local > p.goles_visitante THEN 3
                        WHEN p.id_equipo_visitante = e.id_equipo AND p.goles_visitante > p.goles_local THEN 3
                        WHEN p.goles_local = p.goles_visitante THEN 1
                        ELSE 0
                        END
                        ) AS Pts
                        FROM equipos e
                        JOIN partidos p 
                        ON e.id_equipo IN (p.id_equipo_local, p.id_equipo_visitante)
                        WHERE e.grupo = 'B'
                        AND p.jugado = 1 AND fase = 'grupos'
                        GROUP BY e.id_equipo
                        ORDER BY Pts DESC, GF DESC, GC ASC";

                            $query = mysqli_query($conn, $sql);

                            while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                <tr>
                                    <td><?= $row['equipo'] ?></td>
                                    <td><?= $row['GC'] ?></td>
                                    <td><?= $row['GF'] ?></td>
                                    <td><?= $row['PJ'] ?></td>
                                    <td><strong><?= $row['Pts'] ?></strong></td>
                                </tr>
                            <?php } ?>


                        </tbody>
                    </table>
                    <br>
                </div>
                <div class="container">
                    <p>GRUPO C</p>
                    <table>
                        <thead>
                            <tr>
                                <th>Equipo</th>
                                <th>GC</th>
                                <th>GF</th>
                                <th>PJ</th>
                                <th>Pts</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT e.nombre AS equipo, SUM(CASE 
                        WHEN p.id_equipo_local = e.id_equipo THEN p.goles_visitante
                        WHEN p.id_equipo_visitante = e.id_equipo THEN p.goles_local
                        ELSE 0
                        END
                        ) AS GC,
                        SUM(
                        CASE 
                        WHEN p.id_equipo_local = e.id_equipo THEN p.goles_local
                        WHEN p.id_equipo_visitante = e.id_equipo THEN p.goles_visitante
                        ELSE 0
                        END
                        ) AS GF,
                        COUNT(p.id_partido) AS PJ,
                        SUM(
                        CASE
                        WHEN p.id_equipo_local = e.id_equipo AND p.goles_local > p.goles_visitante THEN 3
                        WHEN p.id_equipo_visitante = e.id_equipo AND p.goles_visitante > p.goles_local THEN 3
                        WHEN p.goles_local = p.goles_visitante THEN 1
                        ELSE 0
                        END
                        ) AS Pts
                        FROM equipos e
                        JOIN partidos p 
                        ON e.id_equipo IN (p.id_equipo_local, p.id_equipo_visitante)
                        WHERE e.grupo = 'C'
                        AND p.jugado = 1 AND fase = 'grupos'
                        GROUP BY e.id_equipo
                        ORDER BY Pts DESC, GF DESC, GC ASC";

                            $query = mysqli_query($conn, $sql);

                            while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                <tr>
                                    <td><?= $row['equipo'] ?></td>
                                    <td><?= $row['GC'] ?></td>
                                    <td><?= $row['GF'] ?></td>
                                    <td><?= $row['PJ'] ?></td>
                                    <td><strong><?= $row['Pts'] ?></strong></td>
                                </tr>
                            <?php } ?>


                        </tbody>
                    </table>
                    <br>
                </div>
                <div class="container">
                    <p>GRUPO D</p>
                    <table>
                        <thead>
                            <tr>
                                <th>Equipo</th>
                                <th>GC</th>
                                <th>GF</th>
                                <th>PJ</th>
                                <th>Pts</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT e.nombre AS equipo, SUM(CASE 
                        WHEN p.id_equipo_local = e.id_equipo THEN p.goles_visitante
                        WHEN p.id_equipo_visitante = e.id_equipo THEN p.goles_local
                        ELSE 0
                        END
                        ) AS GC,
                        SUM(
                        CASE 
                        WHEN p.id_equipo_local = e.id_equipo THEN p.goles_local
                        WHEN p.id_equipo_visitante = e.id_equipo THEN p.goles_visitante
                        ELSE 0
                        END
                        ) AS GF,
                        COUNT(p.id_partido) AS PJ,
                        SUM(
                        CASE
                        WHEN p.id_equipo_local = e.id_equipo AND p.goles_local > p.goles_visitante THEN 3
                        WHEN p.id_equipo_visitante = e.id_equipo AND p.goles_visitante > p.goles_local THEN 3
                        WHEN p.goles_local = p.goles_visitante THEN 1
                        ELSE 0
                        END
                        ) AS Pts
                        FROM equipos e
                        JOIN partidos p 
                        ON e.id_equipo IN (p.id_equipo_local, p.id_equipo_visitante)
                        WHERE e.grupo = 'D'
                        AND p.jugado = 1 AND fase = 'grupos'
                        GROUP BY e.id_equipo
                        ORDER BY Pts DESC, GF DESC, GC ASC";

                            $query = mysqli_query($conn, $sql);

                            while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                <tr>
                                    <td><?= $row['equipo'] ?></td>
                                    <td><?= $row['GC'] ?></td>
                                    <td><?= $row['GF'] ?></td>
                                    <td><?= $row['PJ'] ?></td>
                                    <td><strong><?= $row['Pts'] ?></strong></td>
                                </tr>
                            <?php } ?>


                        </tbody>
                    </table>
                    <br>
                </div>
                <div class="container">
                    <p>GRUPO E</p>
                    <table>
                        <thead>
                            <tr>
                                <th>Equipo</th>
                                <th>GC</th>
                                <th>GF</th>
                                <th>PJ</th>
                                <th>Pts</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT e.nombre AS equipo, SUM(CASE 
                        WHEN p.id_equipo_local = e.id_equipo THEN p.goles_visitante
                        WHEN p.id_equipo_visitante = e.id_equipo THEN p.goles_local
                        ELSE 0
                        END
                        ) AS GC,
                        SUM(
                        CASE 
                        WHEN p.id_equipo_local = e.id_equipo THEN p.goles_local
                        WHEN p.id_equipo_visitante = e.id_equipo THEN p.goles_visitante
                        ELSE 0
                        END
                        ) AS GF,
                        COUNT(p.id_partido) AS PJ,
                        SUM(
                        CASE
                        WHEN p.id_equipo_local = e.id_equipo AND p.goles_local > p.goles_visitante THEN 3
                        WHEN p.id_equipo_visitante = e.id_equipo AND p.goles_visitante > p.goles_local THEN 3
                        WHEN p.goles_local = p.goles_visitante THEN 1
                        ELSE 0
                        END
                        ) AS Pts
                        FROM equipos e
                        JOIN partidos p 
                        ON e.id_equipo IN (p.id_equipo_local, p.id_equipo_visitante)
                        WHERE e.grupo = 'E'
                        AND p.jugado = 1 AND fase = 'grupos'
                        GROUP BY e.id_equipo
                        ORDER BY Pts DESC, GF DESC, GC ASC";

                            $query = mysqli_query($conn, $sql);

                            while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                <tr>
                                    <td><?= $row['equipo'] ?></td>
                                    <td><?= $row['GC'] ?></td>
                                    <td><?= $row['GF'] ?></td>
                                    <td><?= $row['PJ'] ?></td>
                                    <td><strong><?= $row['Pts'] ?></strong></td>
                                </tr>
                            <?php } ?>


                        </tbody>
                    </table>
                    <br>
                </div>
                <div class="container">
                    <p>GRUPO F</p>
                    <table>
                        <thead>
                            <tr>
                                <th>Equipo</th>
                                <th>GC</th>
                                <th>GF</th>
                                <th>PJ</th>
                                <th>Pts</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT e.nombre AS equipo, SUM(CASE 
                        WHEN p.id_equipo_local = e.id_equipo THEN p.goles_visitante
                        WHEN p.id_equipo_visitante = e.id_equipo THEN p.goles_local
                        ELSE 0
                        END
                        ) AS GC,
                        SUM(
                        CASE 
                        WHEN p.id_equipo_local = e.id_equipo THEN p.goles_local
                        WHEN p.id_equipo_visitante = e.id_equipo THEN p.goles_visitante
                        ELSE 0
                        END
                        ) AS GF,
                        COUNT(p.id_partido) AS PJ,
                        SUM(
                        CASE
                        WHEN p.id_equipo_local = e.id_equipo AND p.goles_local > p.goles_visitante THEN 3
                        WHEN p.id_equipo_visitante = e.id_equipo AND p.goles_visitante > p.goles_local THEN 3
                        WHEN p.goles_local = p.goles_visitante THEN 1
                        ELSE 0
                        END
                        ) AS Pts
                        FROM equipos e
                        JOIN partidos p 
                        ON e.id_equipo IN (p.id_equipo_local, p.id_equipo_visitante)
                        WHERE e.grupo = 'F'
                        AND p.jugado = 1 AND fase = 'grupos'
                        GROUP BY e.id_equipo
                        ORDER BY Pts DESC, GF DESC, GC ASC";

                            $query = mysqli_query($conn, $sql);

                            while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                <tr>
                                    <td><?= $row['equipo'] ?></td>
                                    <td><?= $row['GC'] ?></td>
                                    <td><?= $row['GF'] ?></td>
                                    <td><?= $row['PJ'] ?></td>
                                    <td><strong><?= $row['Pts'] ?></strong></td>
                                </tr>
                            <?php } ?>


                        </tbody>
                    </table>
                    <br>
                </div>
                <div class="container">
                    <p>GRUPO G</p>
                    <table>
                        <thead>
                            <tr>
                                <th>Equipo</th>
                                <th>GC</th>
                                <th>GF</th>
                                <th>PJ</th>
                                <th>Pts</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT e.nombre AS equipo, SUM(CASE 
                        WHEN p.id_equipo_local = e.id_equipo THEN p.goles_visitante
                        WHEN p.id_equipo_visitante = e.id_equipo THEN p.goles_local
                        ELSE 0
                        END
                        ) AS GC,
                        SUM(
                        CASE 
                        WHEN p.id_equipo_local = e.id_equipo THEN p.goles_local
                        WHEN p.id_equipo_visitante = e.id_equipo THEN p.goles_visitante
                        ELSE 0
                        END
                        ) AS GF,
                        COUNT(p.id_partido) AS PJ,
                        SUM(
                        CASE
                        WHEN p.id_equipo_local = e.id_equipo AND p.goles_local > p.goles_visitante THEN 3
                        WHEN p.id_equipo_visitante = e.id_equipo AND p.goles_visitante > p.goles_local THEN 3
                        WHEN p.goles_local = p.goles_visitante THEN 1
                        ELSE 0
                        END
                        ) AS Pts
                        FROM equipos e
                        JOIN partidos p 
                        ON e.id_equipo IN (p.id_equipo_local, p.id_equipo_visitante)
                        WHERE e.grupo = 'G'
                        AND p.jugado = 1 AND fase = 'grupos'
                        GROUP BY e.id_equipo
                        ORDER BY Pts DESC, GF DESC, GC ASC";

                            $query = mysqli_query($conn, $sql);

                            while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                <tr>
                                    <td><?= $row['equipo'] ?></td>
                                    <td><?= $row['GC'] ?></td>
                                    <td><?= $row['GF'] ?></td>
                                    <td><?= $row['PJ'] ?></td>
                                    <td><strong><?= $row['Pts'] ?></strong></td>
                                </tr>
                            <?php } ?>


                        </tbody>
                    </table>
                    <br>
                </div>
                <div class="container">
                    <p>GRUPO H</p>
                    <table>
                        <thead>
                            <tr>
                                <th>Equipo</th>
                                <th>GC</th>
                                <th>GF</th>
                                <th>PJ</th>
                                <th>Pts</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT e.nombre AS equipo, SUM(CASE 
                        WHEN p.id_equipo_local = e.id_equipo THEN p.goles_visitante
                        WHEN p.id_equipo_visitante = e.id_equipo THEN p.goles_local
                        ELSE 0
                        END
                        ) AS GC,
                        SUM(
                        CASE 
                        WHEN p.id_equipo_local = e.id_equipo THEN p.goles_local
                        WHEN p.id_equipo_visitante = e.id_equipo THEN p.goles_visitante
                        ELSE 0
                        END
                        ) AS GF,
                        COUNT(p.id_partido) AS PJ,
                        SUM(
                        CASE
                        WHEN p.id_equipo_local = e.id_equipo AND p.goles_local > p.goles_visitante THEN 3
                        WHEN p.id_equipo_visitante = e.id_equipo AND p.goles_visitante > p.goles_local THEN 3
                        WHEN p.goles_local = p.goles_visitante THEN 1
                        ELSE 0
                        END
                        ) AS Pts
                        FROM equipos e
                        JOIN partidos p 
                        ON e.id_equipo IN (p.id_equipo_local, p.id_equipo_visitante)
                        WHERE e.grupo = 'H'
                        AND p.jugado = 1 AND fase = 'grupos'
                        GROUP BY e.id_equipo
                        ORDER BY Pts DESC, GF DESC, GC ASC";

                            $query = mysqli_query($conn, $sql);

                            while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                <tr>
                                    <td><?= $row['equipo'] ?></td>
                                    <td><?= $row['GC'] ?></td>
                                    <td><?= $row['GF'] ?></td>
                                    <td><?= $row['PJ'] ?></td>
                                    <td><strong><?= $row['Pts'] ?></strong></td>
                                </tr>
                            <?php } ?>


                        </tbody>
                    </table>
                    <br>
                </div>

            </section>
            <section class="seccion-resultados">
                <h2>ELIMINICACION DIRECTA</h2>
                <p>Aquí puedes ver los resultados de los torneos que se han realizado, incluyendo estadísticas
                    clave.</p>
                <h1 class="titulo">Fase Final</h1>
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

            </section>
            <footer>
                <p>&copy; 2023 Torneos de Fútbol. ¡Sigue participando y vive la emoción!</p>
            </footer>
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