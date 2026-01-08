<?php
include('../../modelos/conexion.php');
$conn = conexion();

$username = $_POST['username'];
$email = $_POST['email'];
$password_hash = $_POST['password_hash'];
$rol = "user";

$sql = "INSERT INTO usuarios (username, email, password_hash, rol) VALUES ('$username', '$email', '$password_hash','$rol')";
$query = mysqli_query($conn, $sql);

if ($query) {
    echo "<script>
            alert('✅ Perfil creado correctamente');
            window.location.href='../../modulos/usuarios.php';
          </script>";
    exit();
}else {
     echo "<script>
            alert('❌ Perfil no se puede crear, intenta mas tarde');
            window.location.href='../../modulos/usuarios.php';
          </script>";
    exit();
}
?>