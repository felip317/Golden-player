<?php
include ('../../modelos/conexion.php');
$conn = conexion();

$id = $_GET['id'];
$sql = "DELETE FROM usuarios WHERE id='$id'";
$query = mysqli_query($conn, $sql);

if ($query) {
    echo "<script>
            alert('✅ Perfil eliminado correctamente');
            window.location.href='../../modulos/usuarios.php';
          </script>";
    exit();
}else {
     echo "<script>
            alert('❌ Perfil no se puede eliminar, intenta mas tarde');
            window.location.href='../../modulos/usuarios.php';
          </script>";
    exit();
}

?>