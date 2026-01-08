<?php
include ('../../modelos/conexion.php');
$conn = conexion();

$id = $_POST ['id'];
$nombre = $_POST ['nombre'];
$descripcion = $_POST ['descripcion'];
$capacidad = $_POST ['capacidad'];
$precio = $_POST ['precio'];

$sql = "UPDATE canchas SET nombre='$nombre', descripcion='$descripcion', precio='$precio', capacidad='$capacidad' WHERE id='$id'";
$query = mysqli_query($conn, $sql);
if ($query) {
    echo "<script>
            alert('✅ Cancha actualizada con exito');
            window.location.href='../../modulos/canchas.php';
          </script>";
    exit();
}else {
     echo "<script>
            alert('❌ Error al actualizar la cancha, intenta mas tarde');
            window.location.href='../../modulos/canchas.php';
          </script>";
    exit();
}
?>