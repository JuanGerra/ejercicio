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
$Nombre = isset($_POST['Nombre']) ? $_POST['Nombre'] : '';
$Apellido = isset($_POST['Apellido']) ? $_POST['Apellido'] : '';
$Telefono = isset($_POST['Telefono']) ? $_POST['Telefono'] : '';
$Correo = isset($_POST['Correo']) ? $_POST['Correo'] : '';
$Contraseña = isset($_POST['Contraseña']) ? $_POST['Contraseña'] : '';

// Verificar si algún campo está vacío
if (empty($Nombre) || empty($Apellido) || empty($Telefono) || empty($Correo) || empty($Contraseña)) {
    echo "Todos los campos son obligatorios. <a href='index.html'>Volver</a>";
    exit; // Detener la ejecución si hay campos vacíos
}

// Verificar si el correo ya existe
$sql = "SELECT * FROM nitro WHERE Correo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $Correo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "El correo ya está registrado. <a href='index.html'>Volver</a>";
} else {
    // Insertar nuevo usuario
    $sql = "INSERT INTO nitro (Nombre, Apellido, Telefono, Correo, Contraseña) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $Nombre, $Apellido, $Telefono, $Correo, $Contraseña);

    if ($stmt->execute()) {
        echo "Registro exitoso. <a href='index.html'>Iniciar sesión</a>";
    } else {
        echo "Error al registrarse. <a href='index.html'>Volver</a>";
    }
}

$stmt->close();
$conn->close();
?>