<?php
include ('../../modelos/conexion.php');
$conn = conexion();

$local = $_POST ['local'];
$gol = $_POST ['gol'];
$visitante = $_POST ['visitante'];
$golv = $_POST ['golv'];
$fecha = $_POST ['fecha'];
$torneo = $_POST ['torneo'];
$fase = $_POST ['fase'];
$jugado = 1;


$sql = "INSERT INTO partidos (id_equipo_local, id_equipo_visitante, goles_local, goles_visitante, fecha, jugado, torneo_id, fase) VALUES ('$local', '$visitante', '$gol', '$golv', '$fecha', '$jugado', '$torneo','$fase')";
$query = mysqli_query($conn, $sql);

if ($query) {
    echo "<script>
            alert('✅ Resutado registrado correctamente');
            window.location.href='../../modulos/campeonato.php';
          </script>";
    exit();
} else {
    echo "<script>
            alert('❌ Resultado no se puede registrar, intentalo mas tarde');
            window.location.href='../../modulos/campeonato.php';
          </script>";
    exit();
}
?>