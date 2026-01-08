<?php
include ('../modelos/conexion.php');
$conn = conexion();

$id = $_POST ['id'];
$cancha_id = $_POST ['cancha_id'];
$fecha= $_POST ['fecha'];
$hora = $_POST ['hora'];
$nombre = $_POST ['nombre'];
$email = $_POST ['email'];
$telefono = $_POST ['telefono'];
$estado = $_POST ['estado'];
$motivo = $_POST ['motivo'];

$sql = "UPDATE reservas SET cancha_id='$cancha_id', fecha='$fecha', hora='$hora', nombre='$nombre', email='$email', telefono='$telefono', estado='$estado', motivo_cancelacion='$motivo' WHERE id='$id'  ";
$query = mysqli_query($conn, $sql);

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