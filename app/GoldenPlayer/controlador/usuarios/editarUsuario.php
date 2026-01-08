<?php
include ('../../modelos/conexion.php');
$conn = conexion();

$id = $_POST ['id'];
$username = $_POST['username'];
$email = $_POST['email'];

$sql = "UPDATE usuarios SET username='$username', email='$email' WHERE id='$id'";
$query = mysqli_query($conn, $sql);

if ($query) {
    echo "<script>
            alert('✅ Perfil actualizado correctamente');
            window.location.href='../../modulos/usuarios.php';
          </script>";
    exit();
}else {
     echo "<script>
            alert('❌ Perfil no se puede actualizar, intenta mas tarde');
            window.location.href='../../modulos/usuarios.php';
          </script>";
    exit();
}
?>