<?php
/**
* @version		$Id: usuarios_registrados.php  
* @package		
* @copyright	
* 
* 
*/
session_start();
// Verificar si el usuario es un administrador logueado
if (!isset($_SESSION['admin_email'])) {
    header("Location: index.php");
    exit();
}
include 'config.php';

// Consulta para obtener los usuarios logueados
$stmt = $conn->prepare("SELECT id, nombre, apellido, email, fecha_nacimiento FROM usuarios ");
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Usuarios registrados</title>
    <style>
 body {
    font-family: Arial, sans-serif;
    background-color: #1c1c22;
}
.container {
    width: 80%;
    margin: 0 auto;
    text-align: center;
}

.titulo-h1 {
    display: grid;
    place-items: center;
    color: white;
}
.titulo-h3{
    color: white;
    margin-top: 20px;
}

.links {
    margin-top: 20px;
}
.links a {
    display: inline-block;
    margin: 10px;
    text-decoration: none;
    font-size: 18px;
    padding: 8px 16px;
    border: 2px solid #007BFF;
    border-radius: 4px;
}
.links a:hover {
    background-color: #007BFF;
    color: white;
    border-color: #007BFF;
}

table {
    width: 100%;
    border-collapse: collapse;
    background-color: #333;
    color: white;
    margin-top: 20px;
}

table th,
table td {
    padding: 10px;
    text-align: center;
}

table th {
    background-color: #007BFF;
}

table tr:nth-child(even) {
    background-color: #1c1c22;
}

table tr:hover {
    background-color: #555;
}

.button {
    padding: 5px 10px;
    border: none;
    color: #ffffff;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 5px;
}

.button-blue {
    color: #ffffff;
    border: 2px solid #007BFF;
    background-color: transparent;
}

.button-blue:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}

.button-red {
    background-color: transparent;
    color: #FF0000;
    border: 2px solid #FF0000;
}

.button-red:hover {
    background-color: #FF0000;
    color: #ffffff;
}

.button-green {
    background-color: transparent;
    color: #28a745;
    border: 2px solid #28a745;
}

.button-green:hover {
    background-color: #28a745;
    color: #ffffff;
}

form {
    background-color: #2c2c2c;
    padding: 20px;
    border-radius: 5px;
    margin-bottom: 20px;
}

form label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

form input[type="text"],
form input[type="number"],
form textarea,
form select {
    width: calc(100% - 22px);
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #555;
    border-radius: 4px;
    background-color: #1c1c22;
    color: white;
}

form input[type="text"]::placeholder,
form input[type="number"]::placeholder,
form textarea::placeholder {
    color: #aaa;
}

form select {
    cursor: pointer;
}

form input[type="submit"] {
    width: auto;
    margin-top: 10px;
}

form .button-blue {
    background-color: transparent;
    border: 2px solid #007BFF;
    color: #007BFF;
}

form .button-blue:hover {
    background-color: #007BFF;
    color: white;
    border-color: #007BFF;
}

form .button-green {
    background-color: transparent;
    border: 2px solid #28a745;
    color: #28a745;
}

form .button-green:hover {
    background-color: #28a745;
    color: white;
    border-color: #28a745;
}

form .button-red {
    background-color: transparent;
    border: 2px solid #FF0000;
    color: #FF0000;
}

form .button-red:hover {
    background-color: #FF0000;
    color: white;
    border-color: #FF0000;
}

    </style>
</head>
<body>
<div class="container">    
        <h1 class="titulo-h1">Usuarios registrados</h1>
        <div class="links">
            <a href="admin_dashboard.php" class= "button button-blue">Volver al dashboard</a>
        </div>
      </div>

<div class="container">
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre apellido</th>                
                <th>Email</th>
                <th>Fecha nacimiento</th>
            </tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['nombre']} {$row['apellido']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['fecha_nacimiento']}</td>
                </tr>";
            }
            ?>
            </table>
</div>

 <div class="container">
        <div class="links">
            <a href="abm_peliculas.php" class= "button button-blue">Gestionar Películas</a>
            <a href="abm_generos.php" class= "button button-blue">Gestionar Géneros</a>
            <a href="abm_directores.php" class= "button button-blue">Gestionar Directores</a>
            <a href="abm_nacionalidades.php" class= "button button-blue">Gestionar Nacionalidades</a>
        </div>
        <a href="logout.php" class="button button-red">Logout</a>
    </div>
</body>
</html>