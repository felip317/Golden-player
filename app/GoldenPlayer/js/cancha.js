// crear reserva
const modal = document.getElementById("miModalCancha");
const abrir = document.getElementById("abrirCancha");
const cerrar = document.getElementById("cerrarModal");

// Abrir
abrir.onclick = function () {
    modal.style.display = "block";
}

// Cerrar con la X
cerrar.onclick = function () {
    modal.style.display = "none";
}

// Cerrar al hacer clic fuera del contenido
window.onclick = function (e) {
    if (e.target == modal) {
        modal.style.display = "none";
    }
}


// Modal 2
const modal2 = document.getElementById("miModalEliminar");
const abrir2 = document.getElementById("abrirModalEliminar");
const cerrar2 = document.getElementById("cerrarModalEliminar");

abrir2.onclick = () => modal2.style.display = "block";
cerrar2.onclick = () => modal2.style.display = "none";



function seleccionarCancha(id) {
    canchaSeleccionada = id;
    
    // Update UI
    document.querySelectorAll('.cancha-card').forEach(card => {
        card.classList.remove('selected');
    });
    
    document.getElementById(`cancha${id}`).classList.add('selected');
    
    // Update buttons
    document.querySelectorAll('.cancha-button').forEach(button => {
        button.textContent = 'Seleccionar';
        button.classList.remove('selected');
    });
    
    const selectedButton = document.querySelector(`#cancha${id} .cancha-button`);
    selectedButton.textContent = 'Seleccionada';
    selectedButton.classList.add('selected');
    
    // Show reservation form
    document.getElementById('reservaSection').style.display = 'block';
    
    // Scroll to form
    document.getElementById('reservaSection').scrollIntoView({ behavior: 'smooth' });
    
    // Update cancha name in form
    const canchaNombre = document.querySelector(`#cancha${id} .cancha-name`).textContent;
    document.getElementById('nombreCanchaReserva').textContent = `Reservando: ${canchaNombre}`;

    // Reset precio mostrado
    document.getElementById('precioReserva')?.remove();

    // ✅ Guardar el id en el input hidden
    document.getElementById('canchaId').value = id;
}
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("reservaForm");

    // función para abrir modal y guardar cancha_id
    window.abrirModal = function (id) {
        document.getElementById("cancha_id").value = id;
    };

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        // aseguro que el hidden esté cargado
        const canchaId = document.getElementById("cancha_id").value;
        if (!canchaId) {
            alert("Error: no se seleccionó ninguna cancha");
            return;
        }

        const formData = new FormData(form);

        fetch("../controlador/guardarReserva.php", {
            method: "POST",
            body: formData,
        })
        .then(res => res.text())
        .then(data => {
            console.log(data);
            if (data.includes("success")) {
                alert("Reserva guardada con éxito");
                form.reset();
            } else {
                alert("Error: " + data);
            }
        })
        .catch(err => console.error("Error en fetch:", err));
    });
});
// Mostrar precio al cambiar la hora
function mostrarPrecio() {
    if (!canchaSeleccionada) return;

    const hora = document.getElementById('horaReserva').value;
    if (!hora) return;

    const horaNumero = parseInt(hora.split(':')[0]);
    const tarifa = horaNumero >= 18 ? "noche" : "dia";
    const precio = precios[canchaSeleccionada][tarifa];

    let precioElement = document.getElementById('precioReserva');
    if (!precioElement) {
        precioElement = document.createElement('p');
        precioElement.id = 'precioReserva';
        precioElement.style.fontWeight = 'bold';
        precioElement.style.marginTop = '10px';
        document.querySelector('.reserva-formu').appendChild(precioElement);
    }
    precioElement.textContent = `Valor de la reserva: $${precio.toLocaleString()}`;
}


// Captura el submit del formulario
document.getElementById('formReservaAdmin').addEventListener('submit', function (e) {
    e.preventDefault(); // Evita recargar la página

    const formData = new FormData(this);

    fetch('../controlador/guardarReserva.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.text())
        .then(data => {
            if (data.trim() === "success") {
                showConfirmation(formData);
            } else {
                alert("Error en la reserva: " + data);
            }
        })
        .catch(err => {
            alert("Error en la conexión: " + err);
        });
});


// Mostrar el mensaje de confirmación
function showConfirmation(formData) {
    document.getElementById('reservaForm').style.display = 'none';
    document.getElementById('reservaConfirmada').style.display = 'block';

    document.getElementById('detallesReserva').textContent =
        `Reserva para el día ${formData.get('fecha')} a las ${formData.get('hora')}`;
    document.getElementById('emailConfirmacion').textContent =
        `Confirmación enviada a: ${formData.get('email')}`;
}

// Permitir hacer otra reserva
function resetReservaAdmin() {
    document.getElementById('reservaForm').style.display = 'block';
    document.getElementById('reservaConfirmada').style.display = 'none';
    document.getElementById('formReservaAdmin').reset();
}
