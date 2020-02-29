<?php
session_start(); 
$tipo_egreso = $_POST["tipo_egreso"];
$vl_egreso = $_POST["vl_egreso"];
$ubicacion = $_POST["ubicacion"];
$bodega = $_POST["bodega"];
$descripcion = utf8_decode($_POST["descripcion"]);
$user_id = $_SESSION["idUser"];
$state = "1";

$response = array();
include '../../php/conexion.php';
// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CALL guardar_egresos('".$tipo_egreso."', '".$vl_egreso."', '".$ubicacion."', '".$bodega."', '".$descripcion."','".$user_id."','".$state."');";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $row_cnt = $result->num_rows;
    if ($row_cnt > 0) {
        $response["success"] = true;
        $response["message"] = "Su egreso ha sido guardado con el número: ".$row["LAST_INSERT_ID()"];
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