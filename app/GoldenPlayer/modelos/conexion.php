<?php
function conexion() {
    $host = "db";          // nombre del servicio MySQL
    $user = "root";
    $pass = "root";
    $db   = "goal";

    $connect = mysqli_connect($host, $user, $pass, $db);

    if (!$connect) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    return $connect;
}
