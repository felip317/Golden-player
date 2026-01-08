# Golden Player 

Golden Player es una aplicación web desarrollada en PHP y MySQL orientada a la gestión de usuarios y funcionalidades relacionadas con una plataforma deportiva.  
El proyecto está completamente dockerizado, lo que facilita su despliegue, pruebas, mantenimiento y la realización de auditorías de seguridad.

Este repositorio hace parte de un proyecto académico y de portafolio personal.

---

## Tecnologías utilizadas

- PHP 8.2
- MySQL
- Apache
- Docker
- Docker Compose
- HTML
- CSS
- JavaScript

---

## Arquitectura del proyecto

La aplicación está compuesta por los siguientes servicios:

- **Apache + PHP**: Servidor web que ejecuta la lógica de la aplicación.
- **MySQL**: Base de datos relacional para la gestión de usuarios y datos del sistema.
- **Docker Compose**: Orquestación de los contenedores para facilitar el despliegue local.

Toda la comunicación entre servicios se realiza dentro de una red Docker interna.

---

## Requisitos previos

Antes de ejecutar el proyecto, asegúrate de tener instalado:

- Docker
- Docker Compose
- Git

---

## Instalación y ejecución

1. git clone https://github.com/tu-usuario/golden-player.git
2. cd golden-player
3. docker compose up -d
4. Acceder a http://localhost:8080

---

## Funcionalidades
- Inicio de sesión
- Manejo de sesiones
- Control de roles
- Auditoría de seguridad

---

## Autor
Carlos Felipe Valbuena Corredor
