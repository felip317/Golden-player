<?php
include ('../../modelos/conexion.php');
$conn = conexion();

$id = $_POST ['id'];
$fecha = $_POST['fecha'];
$valor = $_POST['valor'];
$concepto = $_POST['concepto'];

$sql = "UPDATE gastos SET fecha_limite='$fecha', valor='$valor', concepto='$concepto' WHERE id='$id'";
$query = mysqli_query($conn, $sql);

if ($query) {
    echo "<script>
            alert('✅ Gasto actualizado con exito');
            window.location.href='../../modulos/facturacion.php';
          </script>";
    exit();
}else {
     echo "<script>
            alert('❌ Error al actualizar gasto, intenta mas tarde');
            window.location.href='../../modulos/facturacion.php';
          </script>";
    exit();
}
?>