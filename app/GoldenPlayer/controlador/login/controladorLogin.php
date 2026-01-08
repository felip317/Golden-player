<?php
ob_start();  
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'modelos/conexion.php';
$conn = conexion();

if (!empty($_POST["btningresar"])) {

    if (empty($_POST["email"]) || empty($_POST["password"])) {
        $_SESSION['error'] = "Campos vacíos";
        header("Location: login.php");
        exit;
    }

    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM usuarios WHERE email=? AND password_hash=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($datos = $result->fetch_object()) {

        $_SESSION["id"] = $datos->id;
        $_SESSION["username"] = $datos->username;
        $_SESSION["email"] = $datos->email;
        $_SESSION["rol"] = $datos->rol;

        if ($datos->rol === 'admin') {
            header("Location: modulos/admin.php");
        } else {
            header("Location: user/home.php");
        }
        exit;

    } else {
        $_SESSION['error'] = "Datos incorrectos";
        header("Location: login.php");
        exit;
    }
}
ob_end_flush();

