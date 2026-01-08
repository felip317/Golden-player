<?php
session_start();
session_destroy();
echo "<script>
            alert('Sesion cerrada');
            window.location.href='../../user/home.php';
          </script>";
header("location: ../../login.php");
?>