<?php
session_start(); 
$id = $_POST["id1"];
$identificacion = $_POST["identificacion1"];
$nombre = $_POST["nombre1"];
$direccion = $_POST["direccion1"];
$telefono = $_POST["telefono1"];
$email = $_POST["email1"];
$user_id = $_SESSION["idUser"];
$state = $_POST["state1"];

$response = array();
include '../../php/conexion.php';
// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CALL actualizar_clientes('".$id."','".$identificacion."', '".$nombre."', '".$direccion."', '".$telefono."', '".$email."', '".$user_id."','".$state."');";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $row_cnt = $result->num_rows;
    if ($row_cnt > 0) {
        $response["success"] = true;
        $response["message"] = "Su cliente ha sido registrado con el numero: ".$row["id1"];
        $response["numero"] = $row["id1"];
        echo json_encode($response);
        
    } else {
        $response["success"] = false;
                $response["message"] = "No se guardó la información.";
                echo json_encode($response);
    }
}

$conn->close();
?>