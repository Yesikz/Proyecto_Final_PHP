<?php
require 'config.php';

// Verificar campos requeridos
$requiredFields = ['nombre', 'apellido', 'email', 'password', 'confirmarPassword', 'fechaNacimiento', 'pais'];
foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
        die(json_encode(array("status" => "error", "message" => "Por favor completa todos los campos obligatorios.")));
    }
}

// Verificar si el correo electrónico ya está registrado
$email = $_POST['email'];
$sql_check_email = "SELECT * FROM usuarios WHERE email = '$email'";
$result = $conn->query($sql_check_email);

if ($result->num_rows > 0) {
    die(json_encode(array("status" => "error", "message" => "El correo electrónico ya está registrado. Por favor, utiliza otro correo.")));
}

// Verificar que las contraseñas coincidan
$password = $_POST['password'];
$confirmarPassword = $_POST['confirmarPassword'];
if ($password !== $confirmarPassword) {
    die(json_encode(array("status" => "error", "message" => "Las contraseñas no coinciden. Por favor, inténtalo de nuevo.")));
}

// Hash de la contraseña
$passwordHashed = password_hash($password, PASSWORD_DEFAULT);

// Insertar usuario en la base de datos
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$fecha_nacimiento = $_POST['fechaNacimiento'];
$pais = $_POST['pais'];

$sql = "INSERT INTO usuarios (nombre, apellido, email, password, fecha_nacimiento, pais) 
        VALUES ('$nombre', '$apellido', '$email', '$passwordHashed', '$fecha_nacimiento', '$pais')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("status" => "success", "message" => "Registro exitoso!"));
} else {
    echo json_encode(array("status" => "error", "message" => "Error: " . $conn->error));
}

$conn->close();
?>
