<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta para verificar si es administrador
    $stmt_admin = $conn->prepare("SELECT id, nombre, password FROM administradores WHERE email = ?");
    $stmt_admin->bind_param("s", $email);
    $stmt_admin->execute();
    $result_admin = $stmt_admin->get_result();

    if ($result_admin->num_rows > 0) {
        // Es administrador
        $row_admin = $result_admin->fetch_assoc();
        if (password_verify($password, $row_admin['password'])) {
            // Contraseña correcta
            $_SESSION['admin_email'] = $email;
            $_SESSION['admin_nombre'] = $row_admin['nombre'];
            $_SESSION['admin_id'] = $row_admin['id'];
            $stmt_admin->close();
            $conn->close();
            echo json_encode(array("status" => "success", "user_type" => "admin"));
            exit();
        }
    }

    // Consulta para verificar si es usuario
    $stmt_user = $conn->prepare("SELECT id, nombre, password FROM usuarios WHERE email = ?");
    $stmt_user->bind_param("s", $email);
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();

    if ($result_user->num_rows > 0) {
        // Es usuario
        $row_user = $result_user->fetch_assoc();
        if (password_verify($password, $row_user['password'])) {
            // Contraseña correcta
            $_SESSION['user_email'] = $email;
            $_SESSION['user_nombre'] = $row_user['nombre'];
            $_SESSION['user_id'] = $row_user['id'];
            $stmt_user->close();
            $conn->close();
            echo json_encode(array("status" => "success", "user_type" => "user"));
            exit();
        }
    }

    // Ninguno coincide o contraseña incorrecta, mostrar mensaje de error
    echo json_encode(array("status" => "error", "message" => "E-mail o contraseña incorrectos."));
    exit();
} else {
    // Si no es una solicitud POST, redirigir a la página de login
    header("Location: login.php");
    exit();
}
?>
