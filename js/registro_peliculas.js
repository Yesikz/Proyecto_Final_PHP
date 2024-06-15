// JS para cargar categorías desde JSON

fetch('./json/generos.json')
    .then(response => response.json())
    .then(data => {
        const selectGenero = document.getElementById("genero");

        data.forEach(genero => {
            const opcion = document.createElement("option");
            opcion.value = genero.id;
            opcion.textContent = genero.nombre;
            selectGenero.appendChild(opcion);
        });
    })
    .catch(error => console.error('Error al cargar el archivo JSON:', error));