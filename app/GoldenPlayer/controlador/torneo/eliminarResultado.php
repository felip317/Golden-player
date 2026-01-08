<?php
include ('../../modelos/conexion.php');
$conn = conexion();

$id = $_GET['id'];
$sql = "DELETE FROM partidos WHERE id_partido='$id'";
$query = mysqli_query($conn, $sql);

if ($query) {
    echo "<script>
            alert('✅ Resultado eliminado correctamente');
            window.location.href='../../modulos/campeonato.php';
          </script>";
    exit();
} else {
    echo "<script>
            alert('❌ Resultado no se puede eliminar, intenta mas tarde');
            window.location.href='../../modulos/campeonato.php';
          </script>";
    exit();
}
?>