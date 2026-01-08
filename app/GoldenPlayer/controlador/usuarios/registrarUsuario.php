<?php
include('../../modelos/conexion.php');
$conn = conexion();

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$username = $_POST['username'];
$email = $_POST['email'];
$password_hash = $_POST['password_hash'];
$rol = "user";

$sql = "INSERT INTO usuarios (nombre, apellido, username, email, password_hash, rol) VALUES ('$nombre', '$apellido', '$username', '$email', '$password_hash','$rol')";
$query = mysqli_query($conn, $sql);
if ($query) {
    echo "<script>
            alert('✅ Perfil creado correctamente');
            window.location.href='../../login.php';
          </script>";
    exit();
} else {
    echo "<script>
            alert('❌ Perfil no se puede crear, intenta mas tarde');
            window.location.href='../../login.php';
          </script>";
    exit();
}

?>