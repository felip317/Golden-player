<?php
include('../../modelos/conexion.php');
$conn = conexion();
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
                        <form class="reserva-form" id="formReservaAdmin"
                            action="../../controlador/torneo/crearResultado.php" method="POST">
                            <center>
                                <h2>Registrar nuevo Resultado</h2>
                            </center>
                            <div class="form-group">
                                <h3 class="reserva-cancha" id="nombreCanchaReserva"></h3>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Equipo Local</label>
                                    <select id="local" name="local" class="form-input" required>
                                        <option value="">Selecciona el grupo</option>
                                        <?php
                                        $sql = "SELECT * FROM equipos";
                                        $query = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_array($query)) { ?>
                                            <option value="<?= $row['id_equipo'] ?>"><?= $row['nombre'] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Goles Equipo Local</label>
                                    <input type="text" id="gol" name="gol" class="form-input" required />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Equipo Visitante</label>
                                    <select id="visitante" name="visitante" class="form-input" required>
                                        <option value="">Selecciona el grupo</option>
                                        <?php
                                        $sql = "SELECT * FROM equipos";
                                        $query = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_array($query)) { ?>
                                            <option value="<?= $row['id_equipo'] ?>"><?= $row['nombre'] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Goles Equipo Visitante</label>
                                    <input type="text" id="golv" name="golv" class="form-input" required />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Fecha</label>
                                    <input type="date" id="fecha" name="fecha" class="form-input" required />
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Fase</label>
                                    <select id="fase" name="fase" class="form-input" required>
                                        <option value="">Selecciona el grupo</option>
                                        <option value="grupos">Fase de grupos</option>
                                        <option value="octavos">Octavos de Final</option>
                                        <option value="cuartos">Cuartos de Final</option>
                                        <option value="semifinal">Semifinal</option>
                                        <option value="final">final</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Torneo</label>
                                <?php
                                $sql = "SELECT * FROM torneos LIMIT 1";
                                $query = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($query)) { ?>

                                    <input type="text" id="" name="" class="form-input" placeholder="<?= $row['nombre'] ?>"
                                        required readonly />
                                    <input type="hidden" id="torneo" name="torneo" class="form-input"
                                        value="<?= $row['id_torneo'] ?>" required readonly />
                                    <?php
                                }
                                ?>
                            </div>

                            <button type="submit" class="submit-button">Actualizar Cancha</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../js/reservas.js"></script>

</html>