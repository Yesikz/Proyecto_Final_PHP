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
                    <li class="peli-adm"><a href="../pages/inicio_sesion_adm.html">Administrar</a></li>
                    <li class="menu-1"><a href="../pages/inicio_sesion_user.html">Inicia Sesión</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <section class="login">
            <form class="form-container" id="registroForm" action="registro_user.php" method="post">
                <h1 class="titulo">Registro</h1><br>

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
                    ?>
                </select>

                <div class="terms-container">
                    <input type="checkbox" id="terminos" required>
                    <label for="terminos">Acepto los <a href="#" id="termsLink">términos y condiciones</a></label>
                </div>

                <div class="error-message" id="passwordError"><?php echo $error; ?></div> <!-- Mensaje de error -->

                <button type="submit" id="submitBtn" class="btn-registrarse">Registrarse</button>

                <div class="register-message">
                    <p>¿Ya tienes una cuenta?</p> <a href="./inicio.html">Inicia sesión</a>
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
            <!-- Aquí va el contenido del modal -->
        </div>
    </div>

    <!--Scrips-->
    <script src="../js/menu-hamburguesa.js"></script>
    <script>
        // JavaScript para confirmar terminos y condiciones
        document.getElementById('registroForm').addEventListener('submit', function(event) {
            const terminos = document.getElementById('terminos');
            if (!terminos.checked) {
                alert('Debe aceptar los términos y condiciones para registrarse.');
                event.preventDefault();
            }
        });

        // JavaScript para validar las contraseñas antes de enviar el formulario
        document.getElementById("registroForm").addEventListener("submit", function(event) {
            var password = document.getElementsByName("password")[0].value;
            var confirmarPassword = document.getElementsByName("confirmarPassword")[0].value;
            var errorDiv = document.getElementById("passwordError");

            if (password !== confirmarPassword) {
                errorDiv.textContent = "Las contraseñas no coinciden. Por favor, inténtalo de nuevo.";
                event.preventDefault(); // Evita que el formulario se envíe
            } else {
                errorDiv.textContent = ""; // Borra el mensaje de error si las contraseñas coinciden
            }
        });
    </script>

</body>

</html>
