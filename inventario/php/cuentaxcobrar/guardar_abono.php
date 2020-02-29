<?php
session_start(); 
$id_factura = $_POST["id1"];
$vl_abono = $_POST["vl_abono1"];
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

$sql = "CALL guardar_abonos('".$id_factura."', '".$vl_abono."', '".$user_id."', '".$state."');";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $row_cnt = $result->num_rows;
    if ($row_cnt > 0) {
        $response["success"] = true;
        $response["message"] = "Su abono ha sido guardado con el número: ".$row["LAST_INSERT_ID()"];
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