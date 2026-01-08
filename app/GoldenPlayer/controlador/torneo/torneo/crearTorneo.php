<?php
include ('../../../modelos/conexion.php');
$conn = conexion();

$nombre = $_POST ['nombre'];
$fecha_inicio = $_POST ['fecha_inicio'];
$fecha_fin = $_POST ['fecha_fin'];

$sql = "INSERT INTO torneos (id_torneo, nombre, fecha_inicio, fecha_fin) VALUES ('1', '$nombre', '$fecha_inicio','$fecha_fin')";
$query = mysqli_query($conn, $sql);

if ($query) {
    echo "<script>
            alert('✅ Nuevo torneo creado correctamente: $nombre');
            window.location.href='../../../modulos/campeonato.php';
          </script>";
    exit();
} else {
    echo "<script>
            alert('❌ Torneo no se puede crear, intentalo mas tarde');
            window.location.href='../../../modulos/campeonato.php';
          </script>";
    exit();
}
?>