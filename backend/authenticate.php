<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta para verificar el e-mail y password
    $stmt = $conn->prepare("SELECT id, nombre FROM administradores WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Login exitoso
        $row = $result->fetch_assoc();
        $_SESSION['admin_email'] = $email;
        $_SESSION['admin_nombre'] = $row['nombre'];
        $_SESSION['admin_id'] = $row['id'];

        // Redirigir a la página de administrador o dashboard
        header("Location: admin_dashboard.php");
        exit(); // Asegúrate de que se detiene la ejecución del script
    } else {
        // Login fallido
        $_SESSION['error'] = "E-mail o Password incorrectos.";
    }

    $stmt->close();
    $conn->close();

    // Redirigir de nuevo al login si hubo un error
    if (isset($_SESSION['error'])) {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>
