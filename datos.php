<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    
    echo "Datos recibidos:\nNombre: $nombre\nApellido: $apellido\nDNI: $dni\nFecha de Nacimiento: $fechaNacimiento
    \nCodigo Postal: $codigoPostal\nEmail: $email\nTelefono Fijo: $telFijo\nTelefono Movil: $telMovil\nIBAN: $iban
    \nTarjeta de Credito: $tarjetaCredito\nContraseña: $password";
}