<?php
// Incluir el archivo de configuración u otras dependencias necesarias
include 'config.php';

// Obtener y procesar el ID de la película u otro parámetro necesario
$id_pelicula = $_GET['id_pelicula'];

// Consulta SQL para obtener la imagen de la base de datos
$sql = "SELECT poster FROM peliculas WHERE id_pelicula = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_pelicula);
$stmt->execute();
$stmt->bind_result($imagen);
$stmt->fetch();
$stmt->close();

// Determinar el tipo MIME y configurar la cabecera
$mime = "image/jpeg"; // Ajusta el tipo MIME según sea necesario
header("Content-Type: $mime");

// Mostrar la imagen
echo $imagen;

// Cerrar la conexión u otros recursos necesarios
$mysqli->close();
?>
