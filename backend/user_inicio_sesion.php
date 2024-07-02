<?php
session_start();
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
    <link rel="stylesheet" href="../css/menu-hamburguesa.css">
    
    <title>Inicio Sesión Administrador</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body style="background-image: url('../img/fondo_pag_inicio_adm.jpg');">
    <div class="wrapper">
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
                        <li><a href="../pages/tendencias.html">(API)</a></li>
                        <li><a href="../pages/registro_usuario.html">Registrarse</a></li>
                        <li class="peli-adm"><a href="index.php">Administrar</a></li>
                        <li class="menu-1"><a href="../pages/inicio_sesion_user.html">Inicia Sesión</a></li>
                    </ul>
                </div>
            </nav>
        </header>

        <main class="main-container">
            <div class="form-insec">
                <h2>Iniciar Sesión Admin.</h2>
                <?php
                if (isset($_SESSION['error'])) {
                    echo '<p class="error">' . $_SESSION['error'] . '</p>';
                    unset($_SESSION['error']); // Clear the error message
                }
                ?>
                <form action="authenticate.php" method="post">
                    <input type="email" id="email" name="email" placeholder="Email" required>
                    <input type="password" id="password" name="password" placeholder="Contraseña" required>
                    <button id="button" type="submit">Iniciar Sesión</button>
                </form>
            </div>
        </main>

        <footer class="footer">
            <div class="texto-footer">
                <div>
                    <ul>
                        <li class="term-1">Términos y Condiciones</li>
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
    </div>

    <script src="../js/menu-hamburguesa.js"></script>

    <!-- JS para Inicio de Sesion--> 
    <script>
    document.getElementById('button').addEventListener('click', function() {
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'authenticate.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.status === 'success' && response.user_type === 'admin') {
                    // Redirigir al dashboard del administrador
                    window.location.href = 'admin_dashboard.php';
                } else {
                    // Mostrar mensaje de error específico para administrador
                    alert(response.message);
                }
            } else {
                // Manejar errores de conexión o del servidor
                alert('Error al intentar iniciar sesión. Inténtalo de nuevo más tarde.');
            }
        };
        var data = 'email=' + encodeURIComponent(email) + '&password=' + encodeURIComponent(password);
        xhr.send(data);
    });
    </script>

</body>
</html>
