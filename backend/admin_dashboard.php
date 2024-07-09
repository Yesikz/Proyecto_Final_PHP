<?php
session_start();
if (!isset($_SESSION['admin_email'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard de Administrador</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1c1c22;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .header {
            margin-bottom: 20px;
            text-align: center;
        }

        .header h1 {
            color: white;
            font-size: 2em;
        }

        .card {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 300px;
        }

        .card h2 {
            margin-top: 0;
        }

        .buttons {
            margin-top: 20px;
        }

        .button {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            margin: 10px 0;
            text-decoration: none;
            color: #007BFF;
            font-size: 18px;
            border: 2px solid #007BFF;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
            background-color: transparent;
            cursor: pointer;
        }

        .button img {
            margin-right: 8px;
            width: 24px;
            height: 24px;
            vertical-align: middle;
        }

        .button:hover {
            background-color: #007BFF;
            color: #ffffff;
        }

        .button-red {
            color: #FF0000;
            border-color: #FF0000;
        }

        .button-red:hover {
            background-color: #FF0000;
            color: #ffffff;
        }

        .separator {
            border-top: 1px solid #ddd;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Panel de Administración</h1>
    </div>
    <div class="card">
        <h2>Hola <?php echo $_SESSION['admin_nombre']; ?>👋🏼</h2>
        <!-- <p>Has iniciado sesión como: <?php echo $_SESSION['admin_nombre']; ?></p> -->
        <div class="buttons">
             <a href="usuarios_registrados.php" class="button">Usuarios Registrados</a>
            <a href="abm_peliculas.php" class="button"><img src="./imagenes/claqueta.png" alt="Películas">Gestionar Películas</a>
            <a href="abm_generos.php" class="button"><img src="./imagenes/teatro.png" alt="Géneros">Gestionar Géneros</a>
            <a href="abm_directores.php" class="button"><img src="./imagenes/silla-de-director.png" alt="Directores">Gestionar Directores</a>
            <a href="abm_nacionalidades.php" class="button"><img src="./imagenes/ciudadania.png" alt="Nacionalidades">Gestionar Nacionalidades</a>
        </div>
        <div class="separator"></div>
        <a href="logout.php" class="button button-red">Logout</a>
    </div>
</body>
</html>
