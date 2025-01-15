<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json;");

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bbdd_joel";


    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("". $conn->connect_error);
    }

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellidos'];
    $dni = $_POST['dni'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $codigoPostal = $_POST['codigoPostal'];
    $email = $_POST['email'];
    $telFijo = $_POST['telFijo'];
    $telMovil = $_POST['telMovil'];
    $iban = $_POST['iban'];
    $tarjetaCredito = $_POST['tarjetaCredito'];
    $password = $_POST['password'];

    $sql = 'INSERT INTO usuarios (dni, nombre, apellidos, fechaNacimiento, codigoPostal, email, telFijo, telMovil, iban, tarjetaCredito, password) 
    VALUES (?,?,?,?,?,?,?,?,?,?,?)';

    $result = $conn->prepare($sql);
    
    $result->bind_param('ssssssssssss', $dni, $nombre, $apellido, $fechaNacimiento, $codigoPostal, $email, $telFijo, $telMovil, $iban, $tarjetaCredito, $password, $password);

    if ($result->execute()) {
        echo json_encode(["messages" => "Datos guardados"]);
    } else {
        echo json_encode(["error"=> "Error al guardar: ".$result -> error]);
    }
    
    $result -> close();
    $conn ->close();