<?php
include ('../../modelos/conexion.php');
$conn = conexion();

$id = $_POST ['id'];
$local = $_POST ['local'];
$gol = $_POST ['gol'];
$visitante = $_POST ['visitante'];
$golv = $_POST ['golv'];
$fecha = $_POST ['fecha'];
$torneo = $_POST ['torneo'];

$sql = "UPDATE partidos SET id_equipo_local='$local', id_equipo_visitante='$visitante', goles_local='$gol', goles_visitante='$golv', fecha='$fecha', torneo_id='$torneo' WHERE id_partido='$id'";
$query = mysqli_query($conn, $sql);

if ($query) {
    echo "<script>
            alert('✅ Resultado actualizado correctamente');
            window.location.href='../../modulos/campeonato.php';
          </script>";
    exit();
} else {
    echo "<script>
            alert('❌ Resultado no se puede actualizar, intenta mas tarde');
            window.location.href='../../modulos/campeonato.php';
          </script>";
    exit();
}
?>