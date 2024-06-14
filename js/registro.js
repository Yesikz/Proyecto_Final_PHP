// PAISES >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
fetch('../json/paises.json')
    .then(response => response.json())
    .then(data => {
        // Obtener el elemento select
        const selectPais = document.getElementById("pais");

        // Crear y agregar opciones al select
        data.forEach((pais) => {
            const opcion = document.createElement("option");
            opcion.value = pais.codigo;
            opcion.textContent = pais.nombre;
            selectPais.appendChild(opcion);
        });
    })
    .catch(error => console.error('Error al cargar el archivo JSON:', error));

// MODAL >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

var modal = document.getElementById("termsModal");

// Obtener el botón que abre el modal
var btn = document.getElementById("termsLink");

// Obtener el elemento <span> que cierra el modal
var span = document.getElementsByClassName("close")[0];

// Función para abrir el modal
function openModal() {
    modal.style.display = "block";
}

// Cuando el usuario haga clic en el botón, abre el modal
btn.onclick = function(event) {
    event.preventDefault(); // Evitar el comportamiento por defecto del enlace
    openModal();
}

// Cuando el usuario haga clic en el li del footer, abre el modal
document.getElementById("footerTerminos").onclick = function() {
    openModal();
}

// Cuando el usuario haga clic en <span> (x), cierra el modal
span.onclick = function() {
    modal.style.display = "none";
}

// Cuando el usuario haga clic en cualquier parte fuera del modal, lo cierra
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
