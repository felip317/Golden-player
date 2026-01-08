<?php
include ('../../modelos/conexion.php');
$conn = conexion();

$id = $_POST ['id'];
$nombre = $_POST['nombre'];
$grupo = $_POST['grupo'];

$sql = "UPDATE equipos SET nombre='$nombre', grupo='$grupo' WHERE id_equipo='$id'";
$query = mysqli_query($conn, $sql);

if ($query) {
    echo "<script>
            alert('✅ Equipo actualizado correctamente');
            window.location.href='../../modulos/campeonato.php';
          </script>";
    exit();
} else {
    echo "<script>
            alert('❌ Equipo no se puede actualizar, intenta mas tarde');
            window.location.href='../../modulos/campeonato.php';
          </script>";
    exit();
}
?>