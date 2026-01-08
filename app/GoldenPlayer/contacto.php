<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Golden Player</title>
    <link rel="icon" type="image/png" href="img/logo.png">
    <link rel="stylesheet" href="css/contacto.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/fontawesome.min.css"
        integrity="sha384-NvKbDTEnL+A8F/AA5Tc5kmMLSJHUO868P+lDtTpJIeQdGYaUIuLr4lVGOEA1OcMy" crossorigin="anonymous">
</head>

<body>
    <header>
        <img src="img/logo.png" class="logo">
        <div class="menu-toggle" onclick="toggleMenu()">☰</div>
        <nav class="navegation">
            <a href="contacto.php">Contactanos</a>
            <button class="btnLogin-popup" onclick="window.location.href='login.php'">Iniciar Sesion</button>
        </nav>
    </header>
    <section class="contact">
        <div class="content">
            <br><br>
            <h2>Contactanos</h2>
            <p>Estamos aquí para escucharte. Si tienes preguntas, sugerencias o deseas más información sobre nuestros
                servicios, no dudes en ponerte en contacto con nosotros.</p>

        </div>
        <div class="container">
            <div class="contactInfo">
                <div class="box">
                    <div class="icon">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </div>
                    <div class="text">
                        <h3>Correo Electronico</h3>
                        <p>info@futbolreservas.com</p>
                    </div>
                </div>
                <div class="box">
                    <div class="icon">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                    </div>
                    <div class="text">
                        <h3>Telefono</h3>
                        <p>3156489567<br>3218596478</p>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="map-container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m12!1m8!1m3!1d31753.723143550833!2d-73.0414867!3d5.8252236!3m2!1i1024!2i768!4f13.1!2m1!1scanchas%20de%20futbol%20sinteticas%20duitama!5e0!3m2!1ses-419!2sco!4v1758068310102!5m2!1ses-419!2sco"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        
    </section>
    

    <script src="js/contacto.js"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>