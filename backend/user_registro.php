<?php
require 'config.php';

// Variable para almacenar los mensajes de error
$error = ''; 

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmarPassword = $_POST['confirmarPassword'];
    $fecha_nacimiento = $_POST['fechaNacimiento'];
    $pais = $_POST['pais'];

    // Verificar si el correo electrónico ya está registrado
    $sql_check_email = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql_check_email);

    if ($result->num_rows > 0) {
        $error = "El correo electrónico ya está registrado. Por favor, utiliza otro correo.";
    } else {
        // Verificar que las contraseñas coincidan
        if ($password !== $confirmarPassword) {
            $error = "Las contraseñas no coinciden. Por favor, inténtalo de nuevo.";
        } else {
            $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuarios (nombre, apellido, email, password, fecha_nacimiento, pais) 
                    VALUES ('$nombre', '$apellido', '$email', '$passwordHashed', '$fecha_nacimiento', '$pais')";

            if ($conn->query($sql) === TRUE) {
                echo "Registro exitoso!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/logoY.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Biryani:wght@200;300;400;600;700;800;900&family=Carrois+Gothic&family=Noto+Sans+Khojki&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/registro.css">
    <link rel="stylesheet" href="../css/menu-hamburguesa.css">

    <title>Registro Usuario | Acisey</title>

    <style>
        .error-message {
            color: red;
            font-size: 14px;
        }
    </style>

    <!-- Sweet Alert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .swal2-title-custom {
            font-size: 15px;
            color: black;
        }
        .swal2-popup-custom {
            color: black;
            font-size: 11px; 
            width: 150px; 
            height: auto; 
        }
    </style>
</head>

<body style="background-image: url('../img/fondo_pag_inicio.jpg');">
    <header>
        <div class="logo-container">
            <h1><img id="logo" src="../img/cinemaacicey2.png" width="100 px" alt="logo"></h1>
        </div>
        <div class="mobile-menu-toggle">
            <button class="hamburger" onclick="toggleMenu()">
                <span class="hamburger-box">
                    <span class="hamburger-inner">&#9776;</span>
                </span>
            </button>
        </div>
        <nav id="navbar">
            <div class="menu">
                <ul>
                    <li><a href="../index.html">Inicio</a></li>
                    <!--<li class="peli-adm"><a href="../backend/index.php">Administrar</a></li>-->
                    <li class="menu-1"><a href="../backend/user_inicio_sesion.php">Inicia Sesión</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <section class="login">
            <form class="form-container" id="registroForm" action="user_registro.php" method="post">
                <h1 class="titulo">Registro de Usuario</h1><br>

                <input type="text" name="nombre" placeholder="Nombre" required>
                <input type="text" name="apellido" placeholder="Apellido" required>
                <input type="email" name="email" placeholder="Correo electrónico" required>
                
                <!-- Password y validacion-->
                <input type="password" name="password" placeholder="Contraseña" required>
                <input type="password" name="confirmarPassword" placeholder="Confirmar contraseña" required>
                
                <label for="fechaNacimiento">Fecha de nacimiento</label>
                <input type="date" name="fechaNacimiento" placeholder="Fecha de nacimiento" required>          
                              
                <select name="pais" required>
                    <option value="" disabled selected>Selecciona tu país</option>
                    <?php
                    require 'config.php';
                    // Consulta para obtener los países
                    $sql_paises = "SELECT nombre FROM nacionalidades";
                    $result_paises = $conn->query($sql_paises);

                    // Verificar si hay resultados y luego iterar sobre ellos
                    if ($result_paises->num_rows > 0) {
                        while ($row = $result_paises->fetch_assoc()) {
                            $nombre_pais = $row['nombre'];
                            echo "<option value='$nombre_pais'>$nombre_pais</option>";
                        }
                    } else {
                        echo "<option value=''>No hay países disponibles</option>";
                    }

                    $conn->close(); // Cerrar la conexión aquí también
                    ?>
                </select>

                <div class="terms-container">
                    <input type="checkbox" id="terminos" required>
                    <label for="terminos">Acepto los <a href="#" id="termsLink">términos y condiciones</a></label>
                </div>

                <div id="errorMessage" class="error-message"></div> <!-- Mensaje de error -->

                <button type="button" id="submitBtn" class="btn-registrarse">Registrarse</button>

                <div class="register-message">
                    <p>¿Ya tienes una cuenta?</p> <a href="../backend/user_inicio_sesion.php">Inicia sesión</a>
                </div>
            </form>
        </section>
        <br>
    </main>

    <footer class="footer">
        <div class="texto-footer">
            <div>
                <ul>
                    <li id="footerTerminos" class="term-1">Términos y Condiciones</li>
                    <li class="term-1">Preguntas Frecuentes</li>
                    <li class="term-1">Ayuda</li>
                </ul>
            </div>
        </div>
        <div class="redes-sociales">
            <a href="https://www.facebook.com/" target="_blank"><img src="../img/facebook.png" alt="Facebook"></a>
            <a href="https://www.instagram.com/" target="_blank"><img src="../img/instagram.png" alt="Instagram"></a>
            <a href="https://twitter.com/" target="_blank"><img src="../img/twitter.png" alt="Twitter"></a>
        </div>
    </footer>

    <!-- Modal de Términos y Condiciones -->
    <div id="termsModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Términos y Condiciones</h2>
            <ol>
                <li><strong>Aceptación de los Términos</strong><br>
                    Al registrarse en nuestra página de películas, el usuario acepta y se compromete a cumplir con los
                    siguientes términos y condiciones. Si no está de acuerdo con alguna parte de estos términos, no debe
                    utilizar nuestro servicio.</li>

                <li><strong>Elegibilidad</strong><br>
                    Para registrarse en nuestra página de películas, el usuario debe tener al menos 18 años de edad. Al
                    aceptar estos términos, el usuario declara y garantiza que tiene la edad legal para formar un
                    contrato vinculante.</li>

                <li><strong>Cuenta de Usuario</strong><br>
                    <ul>
                        <strong>Información de Registro:</strong> Al crear una cuenta, el usuario debe proporcionar
                        información precisa, actual y completa según se solicite en el formulario de registro. El
                        usuario es responsable de mantener la confidencialidad de su cuenta y contraseña, y de todas
                        las actividades que ocurran bajo su cuenta.
                        <strong>Uso Prohibido:</strong> El usuario se compromete a no utilizar la cuenta para ningún
                        propósito ilegal o no autorizado. No puede, en el uso del servicio, violar ninguna ley en su
                        jurisdicción.
                    </ul>
                </li>

                <li><strong>Privacidad</strong><br>
                    <ul>
                        <strong>Política de Privacidad:</strong> Nuestra política de privacidad describe cómo
                        manejamos y protegemos la información personal del usuario. Al registrarse, el usuario
                        acepta los términos establecidos en nuestra política de privacidad.
                        <strong>Cookies:</strong> Utilizamos cookies y tecnologías similares para mejorar la
                        experiencia del usuario en nuestra página. Al utilizar nuestro servicio, el usuario acepta
                        el uso de cookies de acuerdo con nuestra política de cookies.
                    </ul>
                </li>

                <li><strong>Propiedad Intelectual</strong><br>
                    <ul>
                        <strong>Contenido del Usuario:</strong> El usuario conserva todos los derechos sobre
                        cualquier contenido que publique en nuestra página. Sin embargo, al publicar contenido, el
                        usuario nos otorga una licencia mundial, no exclusiva, libre de regalías, y transferible
                        para usar, reproducir, distribuir, preparar trabajos derivados de, mostrar y ejecutar dicho
                        contenido en relación con la prestación del servicio.
                        <strong>Derechos de Autor:</strong> Todo el contenido y material en nuestra página,
                        incluyendo pero no limitado a textos, gráficos, logotipos, y software, es propiedad de
                        nuestra página o sus licenciantes y está protegido por leyes de derechos de autor.
                    </ul>
                </li>

                <li><strong>Terminación</strong><br>
                    Nos reservamos el derecho de suspender o terminar la cuenta del usuario en cualquier momento, sin
                    previo aviso, por cualquier violación de estos términos y condiciones o por cualquier otra razón que
                    consideremos apropiada.</li>

                <li><strong>Modificaciones a los Términos</strong><br>
                    Nos reservamos el derecho de modificar estos términos y condiciones en cualquier momento. Cualquier
                    cambio será efectivo inmediatamente después de su publicación en nuestra página. Es responsabilidad
                    del usuario revisar regularmente los términos y condiciones para estar al tanto de cualquier cambio.
                </li>

                <li><strong>Limitación de Responsabilidad</strong><br>
                    Nuestra página no será responsable por ningún daño directo, indirecto, incidental, especial, o
                    consecuente que resulte del uso o la imposibilidad de usar nuestro servicio, incluso si hemos sido
                    informados de la posibilidad de tales daños.</li>

                <li><strong>Ley Aplicable</strong><br>
                    Estos términos y condiciones se regirán e interpretarán de acuerdo con las leyes del país en el que
                    operamos, sin considerar sus disposiciones sobre conflicto de leyes.</li>

                <li><strong>Contacto</strong><br>
                    Si tiene alguna pregunta sobre estos términos y condiciones, por favor contáctenos a través de
                    nuestro formulario de contacto en la página.</li>
            </ol>
        </div>
    </div>

    <!--Scrips-->
    <script src="../js/menu-hamburguesa.js"></script>
    
    <script>
        document.getElementById("submitBtn").addEventListener("click", function() {
            var form = document.getElementById("registroForm");
            var formData = new FormData(form);

            // Validación de campos requeridos en el lado del cliente
            var nombre = formData.get("nombre");
            var apellido = formData.get("apellido");
            var email = formData.get("email");
            var password = formData.get("password");
            var confirmarPassword = formData.get("confirmarPassword");
            var fechaNacimiento = formData.get("fechaNacimiento");
            var pais = formData.get("pais");
            var terminos = document.getElementById("terminos");

            if (
                !nombre ||
                !apellido ||
                !email ||
                !password ||
                !confirmarPassword ||
                !fechaNacimiento ||
                !pais ||
                !terminos.checked
            ) {
                document.getElementById("errorMessage").textContent = "Todos los campos son obligatorios, por favor completalos.";
                return; // Evita enviar el formulario si hay campos vacíos
            }

            // Si todos los campos requeridos están completos, enviar el formulario
            fetch("user_procesar_registro.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "error") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message,
                        confirmButtonText: 'OK',
                        background: 'linear-gradient(135deg, #b37ef0, #476bce)',
                        customClass: {
                        title: 'swal2-title-custom',
                        popup: 'swal2-popup-custom'
                        }
                    });

                } else if (data.status === "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro exitoso!',
                        confirmButtonText: 'OK',
                        background: 'linear-gradient(135deg, #b37ef0, #476bce)',
                        customClass: {
                            title: 'swal2-title-custom',
                            popup: 'swal2-popup-custom'
                        }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '../backend/user_inicio_sesion.php';
                    }
                });
            }
        })
        .catch(error => console.error("Error:", error));
        });
    </script>

    <script>
        // JavaScript para confirmar terminos y condiciones
        document.getElementById('registroForm').addEventListener('submit', function(event) {
            const terminos = document.getElementById('terminos');
            if (!terminos.checked) {
                alert('Debe aceptar los términos y condiciones para registrarse.');
                event.preventDefault();
            }
        });

        // JavaScript para que aparezca el modal
        var modal = document.getElementById("termsModal");    
        var btn = document.getElementById("termsLink"); // Obtener el botón que abre el modal
        var span = document.getElementsByClassName("close")[0]; // Obtener el elemento <span> que cierra el modal   

        // Función para abrir el modal
        function openModal() {
            modal.style.display = "block";
        }

        // Cuando el usuario haga clic en el botón, abre el modal
        btn.onclick = function (event) {
            event.preventDefault(); // Evitar el comportamiento por defecto del enlace
            openModal();
        }

        // Cuando el usuario haga clic en el li del footer, abre el modal
        document.getElementById("footerTerminos").onclick = function () {
            openModal();
        }

        // Cuando el usuario haga clic en <span> (x), cierra el modal
        span.onclick = function () {
            modal.style.display = "none";
        }

    </script>

</body>

</html>
