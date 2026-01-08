<?php
include ('../../modelos/conexion.php');
$conn = conexion();

$id = $_GET['id'];
$sql = "DELETE FROM equipos WHERE id_equipo='$id'";
$query = mysqli_query($conn, $sql);


if ($query) {
    echo "<script>
            alert('✅ Equipo eliminado correctamente');
            window.location.href='../../modulos/campeonato.php';
          </script>";
    exit();
} else {
    echo "<script>
            alert('❌ Equipo no se puede eliminar, intenta mas tarde');
            window.location.href='../../modulos/campeonato.php';
          </script>";
    exit();
}
?>