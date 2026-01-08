<?php
include ('../../modelos/conexion.php');
$conn = conexion();

$id = $_GET['id'];
$sql = "DELETE FROM gastos WHERE id='$id'";
$query = mysqli_query($conn, $sql);

if ($query) {
    echo "<script>
            alert('✅ Gasto eliminado con exito');
            window.location.href='../../modulos/facturacion.php';
          </script>";
    exit();
}else {
     echo "<script>
            alert('❌ Error al eliminar gasto, intenta mas tarde');
            window.location.href='../../modulos/facturacion.php';
          </script>";
    exit();
}

?>