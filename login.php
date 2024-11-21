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

// Obtener datos del formulario
$Nombre = $_POST['Nombre'];
$Contraseña = $_POST['Contraseña'];  // Contraseña proporcionada por el usuario

// Consulta para verificar solo el nombre
$sql = "SELECT * FROM nitro WHERE Nombre = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $Nombre);  // Solo se pasa un parámetro: Nombre
$stmt->execute();
$result = $stmt->get_result();

// Verificar si el usuario existe con ese nombre
if ($result->num_rows == 0) {
    echo "No hay un usuario con ese nombre. <a href='index.html'>Volver</a>";
} else {
    // Obtener los datos del usuario de la base de datos
    $row = $result->fetch_assoc();
    
    // Comparar la contraseña ingresada con la almacenada en la base de datos
    if ($Contraseña === $row['Contraseña']) {
        // Si la contraseña es correcta, redirigir
        echo "Inicio de sesión exitoso. Redirigiendo...";
        header("Location: inicio.html"); // Cambia a la página deseada
        exit(); // Es importante salir después de redirigir
    } else {
        // Si la contraseña es incorrecta, mostrar error
        echo "La contraseña es incorrecta. <a href='index.html'>Volver</a>";
    }
}

$stmt->close();
$conn->close();
?>