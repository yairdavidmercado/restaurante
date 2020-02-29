<?php
session_start(); 
$nombre = $_POST["nombre"];
$email = $_POST["email"];
$telefono = $_POST["telefono"];
$password = $_POST["password"];
$perfil = $_POST["perfil"];
$state = "1";
$user_id = $_SESSION["idUser"];

$response = array();
include '../../php/conexion.php';
// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CALL guardar_users('".$nombre."', '".$email."', '".$telefono."', '".$password."', '".$perfil."','".$state."', '".$user_id."');";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $row_cnt = $result->num_rows;
    if ($row_cnt > 0) {
        $response["success"] = true;
        $response["message"] = "Su usuario ha sido actualizado con el numero: ".$row["LAST_INSERT_ID()"];
        $response["numero"] = $row["LAST_INSERT_ID()"];
        echo json_encode($response);
        
    } else {
        $response["success"] = false;
                $response["message"] = "No se guardó la información.";
                echo json_encode($response);
    }
}

$conn->close();
?>