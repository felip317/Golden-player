<?php
include ('../../modelos/conexion.php');
$conn = conexion();

$id = $_GET['id'];
$sql = "DELETE FROM canchas WHERE id='$id'";
$query = mysqli_query($conn, $sql);


if ($query) {
    echo "<script>
            alert('✅ Cancha eliminada con exito');
            window.location.href='../../modulos/canchas.php';
          </script>";
    exit();
}else {
     echo "<script>
            alert('❌ Error al eliminar la cancha, intenta mas tarde');
            window.location.href='../../modulos/canchas.php';
          </script>";
    exit();
}

?>