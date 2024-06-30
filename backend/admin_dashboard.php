<?php
session_start();
if (!isset($_SESSION['admin_email'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <!-- <link rel="stylesheet" href="#"> -->
    <title>Dashboard de Administrador</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            text-align: center;
        }
        .links {
            margin-top: 20px;
        }
        .links a {
            display: block;
            margin: 10px 0;
            text-decoration: none;
            color: #007BFF;
            font-size: 18px;
        }
        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Bienvenido, <?php echo $_SESSION['admin_nombre']; ?></h2>
        <p>Has iniciado sesión como: <?php echo $_SESSION['admin_nombre']; ?></p>
        <div class="links">
            <a href="abm_peliculas.php">Gestionar Películas</a>
            <a href="abm_generos.php">Gestionar Géneros</a>
            <a href="abm_directores.php">Gestionar Directores</a>
            <a href="abm_nacionalidades.php">Gestionar Nacionalidades</a>
        </div>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
