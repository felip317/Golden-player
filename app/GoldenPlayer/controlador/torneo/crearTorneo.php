<?php
include ('../../modelos/conexion.php');
$conn = conexion();

$nombre = $_POST ['nombre'];
$grupo = $_POST ['grupo'];

$sql = "INSERT INTO equipos (nombre, grupo) VALUES ('$nombre', '$grupo')";
$query = mysqli_query($conn, $sql);

if ($query) {
    echo "<script>
            alert('✅ Nuevo equipo inscrito corectamente: $nombre en el grupo $grupo');
            window.location.href='../../modulos/campeonato.php';
          </script>";
    exit();
} else {
    echo "<script>
            alert('❌ Equipo no se puede inscrbir');
            window.location.href='../../modulos/campeonato.php';
          </script>";
    exit();
}
?>