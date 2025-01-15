<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bbdd_joel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(["error" => "Connection failed: " . $conn->connect_error]);
    exit(); // Detener el script si la conexión falla
}

// Verificar si los datos se reciben correctamente
if (!isset($_POST['nombre'], $_POST['apellido'], $_POST['dni'], $_POST['fechaNacimiento'], $_POST['cp'], $_POST['email'], $_POST['fijo'], $_POST['movil'], $_POST['iban'], $_POST['tarjetaCredito'], $_POST['passwd'])) {
    echo json_encode(["error" => "Faltan algunos datos en la solicitud POST"]);
    exit(); // Detener el script si faltan datos
}

// Obtener datos del POST
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$dni = $_POST['dni'];
$fechaNacimiento = $_POST['fechaNacimiento'];
$codigoPostal = $_POST['codigoPostal'];
$email = $_POST['email'];
$telFijo = $_POST['telFijo'];
$telMovil = $_POST['telMovil'];
$iban = $_POST['iban'];
$tarjetaCredito = $_POST['tarjetaCredito'];
$contrasena = $_POST['passwd'];

// Consulta SQL para insertar datos
$sql = 'INSERT INTO usuarios (dni, nombre, apellidos, fechaNacimiento, codigoPostal, email, telFijo, telMovil, iban, tarjetaCredito, passwd) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    echo json_encode(["error" => "Error al preparar la consulta SQL: " . $conn->error]);
    exit();
}

$stmt->bind_param('sssssssssss', $dni, $nombre, $apellidos, $fechaNacimiento, $codigoPostal, $email, $telFijo, $telMovil, $iban, $tarjetaCredito, $contrasena);

if ($stmt->execute()) {
    echo json_encode(["message" => "Datos guardados correctamente"]);
} else {
    echo json_encode(["error" => "Error al ejecutar la consulta: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>