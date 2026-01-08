<?php
include ('../../modelos/conexion.php');
$conn = conexion();

$fecha = $_POST ['fecha'];
$valor = $_POST ['valor'];
$concepto = $_POST ['concepto'];

$sql = "INSERT INTO gastos (concepto, valor, fecha_limite) VALUES ('$concepto', '$valor', '$fecha')";
$query = mysqli_query($conn, $sql);

if ($query) {
    echo "<script>
            alert('✅ Nuevo gasto registrado');
            window.location.href='../../modulos/facturacion.php';
          </script>";
    exit();
}else {
     echo "<script>
            alert('❌ Error al registrar gasto, intenta mas tarde');
            window.location.href='../../modulos/facturacion.php';
          </script>";
    exit();
}
?>