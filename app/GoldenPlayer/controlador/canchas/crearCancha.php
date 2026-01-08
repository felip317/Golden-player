<?php
include ('../../modelos/conexion.php');
$conn = conexion();

$nombre = $_POST ['nombre'];
$descripcion = $_POST ['descripcion'];
$capacidad = $_POST ['capacidad'];
$precio = $_POST ['precio'];

$sql = "INSERT INTO canchas (nombre, descripcion, capacidad, precio) VALUES ('$nombre', '$descripcion', '$capacidad', '$precio')";
$query = mysqli_query($conn, $sql);

if ($query) {
    echo "<script>
            alert('✅ Nueva cancha registrada');
            window.location.href='../../modulos/canchas.php';
          </script>";
    exit();
}else {
     echo "<script>
            alert('❌ Error al registrar la cancha, intenta mas tarde');
            window.location.href='../../modulos/canchas.php';
          </script>";
    exit();
}
?>