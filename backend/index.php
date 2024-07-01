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
    <title>Acisey Movies - Login Administrador</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body style="background-image: url('../img/fondo_pag_inicio_adm.jpg');">
    <div class="wrapper">
        <header>
            <div class="logo-container">
                <h1><img id="logo" src="../img/cinemaacicey2.png" width="100 px" alt="logo"></h1>
    <title>Log in de Administrador</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 300px;
            margin: 0px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Log in de Administrador</h2>
        <?php
        if (isset($_SESSION['error'])) {
            echo '<p class="error">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']); // Clear the error message
        }
        ?>
        <form action="authenticate.php" method="post">
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <nav id="navbar">
                <div class="menu">
                    <ul>
                        <li><a href="../index.html">Inicio</a></li>
                        <li><a href="../pages/tendencias.html">(API)</a></li>
                        <li><a href="../pages/registro_usuario.html">Registrarse</a></li>
                        <li class="peli-adm"><a href="inicio_sesion_adm.php">Administrar</a></li>
                        <li class="menu-1"><a href="../pages/inicio_sesion_user.html">Inicia Sesión</a></li>
                    </ul>
                </div>
            </nav>
        </header>


        <main class="main-container">
            <div class="form-insec">
                <h2>Iniciar Sesión</h2>
                <?php
                if (isset($_SESSION['error'])) {
                    echo '<p class="error">' . $_SESSION['error'] . '</p>';
                    unset($_SESSION['error']); // Clear the error message
                }
                ?>
                <form action="authenticate.php" method="post">
                    <input type="email" id="email" name="email" placeholder="Usuario" required>
                    <input type="password" id="password" name="password" placeholder="Contraseña" required>
                    <input id="button" type="submit" value="Iniciar Sesión">
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

    <script src="../js/loginForm.js"></script>
</body>
</html>

            <!--<div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <button type="submit">Login</button>
            </div>
        </form>
    </div>
</body>
</html>-->
