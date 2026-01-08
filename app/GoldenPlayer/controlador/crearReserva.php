<?php
require('../modelos/conexion.php');
$conn = conexion();

$cancha_id = $_POST['cancha_id'];
$fecha     = $_POST['fecha'];
$hora      = $_POST['hora'];
$nombre    = $_POST['nombre'];
$email     = $_POST['email'];
$telefono  = $_POST['telefono']; // Ej: 3001234567

$sql = "INSERT INTO reservas (cancha_id, fecha, hora, nombre, email, telefono)
        VALUES ('$cancha_id', '$fecha', '$hora', '$nombre', '$email', '$telefono')";

$query = mysqli_query($conn, $sql);

if ($query) {

    // 🔹 FORMATO TELÉFONO (COLOMBIA)
    $telefono_whatsapp = "57" . $telefono;

    // 🔹 MENSAJE WHATSAPP
    $mensaje  = "✅ *Reserva confirmada*\n\n";
    $mensaje .= "👤 Nombre: $nombre\n";
    $mensaje .= "⚽ Cancha: $cancha_id\n";
    $mensaje .= "📅 Fecha: $fecha\n";
    $mensaje .= "⏰ Hora: $hora\n";
    $mensaje .= "📞 Teléfono: $telefono\n\n";
    $mensaje .= "Gracias por reservar con nosotros 🙌";

    // 🔹 DATOS ULTRAMSG
    $instance = "TU_INSTANCE_ID";
    $token    = "TU_TOKEN";

    $url = "https://api.ultramsg.com/$instance/messages/chat";

    $data = [
        'token' => $token,
        'to'    => $telefono_whatsapp,
        'body'  => $mensaje
    ];

    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ]
    ];

    file_get_contents($url, false, stream_context_create($options));

    echo "
    <script>
        alert('✅ Reserva realizada, no olvides asistir 10 min antes');
        window.location.href = '../user/home.php';
    </script>
    ";

} else {
    echo "
    <script>
        alert('❌ Error al realizar la reserva');
        window.history.back();
    </script>
    ";
}
?>
