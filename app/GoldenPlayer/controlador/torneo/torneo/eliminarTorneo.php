<?php
include ('../../../modelos/conexion.php');
$conn = conexion();

$id = $_GET['id'];
$sql = "DELETE FROM torneos WHERE id_torneo='$id'";
$query = mysqli_query($conn, $sql);

if ($query){
 header('location: ../../../modulos/campeonato.php');
}
if ($query) {
    echo "<script>
            alert('✅ Torneo eliminado correctamente');
            window.location.href='../../../modulos/campeonato.php';
          </script>";
    exit();
} else {
    echo "<script>
            alert('❌ Torneo no se puede eliminar, intentalo mas tarde');
            window.location.href='../../../modulos/campeonato.php';
          </script>";
    exit();
}

?>