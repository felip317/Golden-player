<?php
include ('../modelos/conexion.php');
$conn = conexion();

$id = $_GET['id'];
$sql = "UPDATE reservas SET estado='cancelada' WHERE id='$id'  ";
$query = mysqli_query($conn,$sql);

if ($query) {
    echo "<script>
            alert('✅ Reserva actualizada correctamente como: $estado');
            window.location.href='../modulos/reservas.php';
          </script>";
    exit();
} else {
    echo "<script>
            alert('❌ Reserva no se puede actualizar, intenta mas tarde');
            window.location.href='../modulos/reservas.php';
          </script>";
    exit();
}

?>