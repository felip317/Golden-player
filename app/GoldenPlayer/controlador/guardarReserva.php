<?php
require ('../modelos/conexion.php');
$conn = conexion();

$cancha_id = $_POST ['cancha_id'];
$fecha= $_POST ['fecha'];
$hora = $_POST ['hora'];
$nombre = $_POST ['nombre'];
$email = $_POST ['email'];
$telefono = $_POST ['telefono'];

$sql = "INSERT INTO reservas (cancha_id, fecha, hora, nombre, email, telefono) VALUES ('$cancha_id', '$fecha', '$hora', '$nombre', '$email', '$telefono')";
$query = mysqli_query($conn, $sql);

if ($query) {
    echo "<script>
            alert('✅ Reserva guardada correctamente');
            window.location.href='../modulos/reservas.php';
          </script>";
    exit();
} else {
    echo "<script>
            alert('❌ Reserva no se puede guardar, intenta mas tarde');
            window.location.href='../modulos/reservas.php';
          </script>";
    exit();
}
?>
