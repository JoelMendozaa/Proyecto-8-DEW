<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bbdd_joel";

$conexion =new mysqli($servername, $username,$password, $dbname);

if ($conexion->connect_error) {
    die(json_encode(['succes' => false, 'message' => 'Conexion fallida'. $conexion ->connect_error]));
}
$a = $conexion->prepare("SELECT * FROM datos_usuario WHERE dni = ?");
$a -> bind_param("s", $_GET['dni']);
$a -> execute();
$resultado = $a -> get_result();

if ($resultado -> num_rows > 0){
    $row = $resultado -> fetch_assoc();
    echo json_encode($row);
} else{
    echo json_encode(['success' => false, 'message' => 'No se encontraron datos']);
}

$a -> close();
$conexion -> close();
?>