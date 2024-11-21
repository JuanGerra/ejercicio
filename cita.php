<?php
$servername = "localhost";
$username = "root"; // Cambia si tienes otra configuración
$password = "";
$dbname = "usuarios";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario y validar que no estén vacíos
$Nombres = isset($_POST['Nombres']) ? $_POST['Nombres'] : '';
$Correo = isset($_POST['Correo']) ? $_POST['Correo'] : '';
$Daño = isset($_POST['Daño']) ? $_POST['Daño'] : '';
$Numero = isset($_POST['Numero']) ? $_POST['Numero'] : '';

if ($result->num_rows > 0) {
    echo "El correo ya está registrado. <a href='index.html'>Volver</a>";
} else {
    // Insertar nuevo usuario
    $sql = "INSERT INTO nitro (Nombres, Correo, Daño, Numero) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $Nombres, $Correo, $Daño, $Numero,);
}

$stmt->close();
$conn->close();
?>