<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos del formulario (por ejemplo, 'nombre', 'apellido', etc.)
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellidos'] ?? '';
    $dni = $_POST['dni'] ?? '';
    $fechaNacimiento = $_POST['fechaNacimiento'] ?? '';
    $codigoPostal = $_POST['codigoPostal'] ?? '';
    $email = $_POST['email'] ?? '';
    $telFijo = $_POST['telFijo'] ?? '';
    $telMovil = $_POST['telMovil'] ?? '';
    $iban = $_POST['iban'] ?? '';
    $tarjetaCredito = $_POST['tarjetaCredito'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmar = $_POST['password'] ??'';
    
    // Preparamos los datos para devolver como JSON
    $response = [
        'nombre' => $nombre,
        'apellido' => $apellido,
        'dni' => $dni,
        'fechaNacimiento' => $fechaNacimiento,
        'codigoPostal' => $codigoPostal,
        'email' => $email,
        'telFijo' => $telFijo,
        'telMovil' => $telMovil,
        'iban' => $iban,
        'tarjetaCredito' => $tarjetaCredito,
        'password' => $password,
        'confirmar' => $password
    ];

    // Establecer el encabezado para indicar que la respuesta será en formato JSON
    header('Content-Type: application/json');

    // Convertir el array PHP a JSON y devolverlo como respuesta
    echo json_encode($response);
}
