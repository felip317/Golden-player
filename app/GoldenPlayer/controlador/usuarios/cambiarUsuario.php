<?php
include ('../../modelos/conexion.php');
$conn = conexion();

$id = $_POST['id'];
$username = $_POST['username'];
$email = $_POST['email'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$password = $_POST['password'];

$sql = "UPDATE usuarios 
        SET username='$username', email='$email', nombre='$nombre', apellido='$apellido', password_hash='$password' 
        WHERE id='$id'";

$query = mysqli_query($conn, $sql);

if ($query) {
    echo "<script>
            alert('✅ Perfil actualizado correctamente');
            window.location.href='../../user/home.php';
          </script>";
    exit();
}else {
     echo "<script>
            alert('❌ Perfil no se puede actualizar');
            window.location.href='../../user/home.php';
          </script>";
    exit();
}
?>

