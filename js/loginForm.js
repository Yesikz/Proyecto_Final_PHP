document.addEventListener('DOMContentLoaded', () => {
    const username = document.getElementById('username');
    const password = document.getElementById('password');
    const button = document.getElementById('button');

    button.addEventListener('click', (e) => {
        e.preventDefault();

        if (username.value.trim() === '' || password.value.trim() === '') {
            Swal.fire({
                icon: 'warning',
                text: 'Todos los campos son obligatorios!',
            });
        } else {
            const datos = {
                username: username.value,
                password: password.value,
            };
            console.log(datos);

            
            Swal.fire({
                icon: 'success',
                text: '¡Ha iniciado sesión correctamente!',
            }).then(() => {
                
                username.value = '';
                password.value = '';
            });
        }
    });
});