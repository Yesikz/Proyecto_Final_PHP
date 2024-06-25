<?php
// config.php
/**
* @version      $Id: config.php  2024-06-12 14:00:00 
* @package      Adrian Stravitz
* @copyright    Copyright (C) 2024 - 2024 All rights reserved.
* 2024-06 coneccion al database
* 
* **/


$servername = "localhost";
$username = "id22335263_root";
$password = "root@Grupo007";
$dbname = "id22335263_prueba2";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
