
      document.addEventListener("DOMContentLoaded", function() {
            fetch('paises.json')
                .then(response => response.json())
                .then(data => {
                    let selects = document.querySelectorAll('.pais-select');
                    selects.forEach(select => {
                        let nacionalidadActual = select.getAttribute('data-nacionalidad');
                    data.forEach(pais => {
                        let option = document.createElement('option');
                        option.value = pais.codigo;
                        option.textContent = pais.nombre;
                            if (pais.codigo === nacionalidadActual) {
                                option.selected = true;
                            }
                        select.appendChild(option);
                        });
                    });
                })
                .catch(error => console.error('Error al cargar el archivo JSON:', error));
        });
   