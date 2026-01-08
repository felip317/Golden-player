<?php
include ('../../../modelos/conexion.php');
$conn = conexion();

$id = $_POST ['id'];
$nombre = $_POST ['nombre'];
$fecha_inicio = $_POST ['fecha_inicio'];
$fecha_fin = $_POST ['fecha_fin'];

$sql = "UPDATE torneos SET nombre='$nombre', fecha_inicio='$fecha_inicio', fecha_fin='$fecha_fin' WHERE id_torneo='$id'";
$query = mysqli_query($conn, $sql);

if ($query) {
    echo "<script>
            alert('✅ Torneo actualizado correctamente');
            window.location.href='../../../modulos/campeonato.php';
          </script>";
    exit();
} else {
    echo "<script>
            alert('❌ Torneo no se puede actualizar, intentalo mas tarde');
            window.location.href='../../../modulos/campeonato.php';
          </script>";
    exit();
}
?>