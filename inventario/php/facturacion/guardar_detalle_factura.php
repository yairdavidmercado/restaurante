<?php
session_start(); 
$id_producto = $_POST["id_producto"];
$vl_venta = $_POST["vl_venta"];
$cantidad = $_POST["cantidad"];
$id_factura = "0";
$bodega = $_POST["bodega"];
$user_id = $_SESSION["idUser"];
$state = "0";

$response = array();
include '../../php/conexion.php';
// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT guardar_detalle_factura('".$id_producto."', '".$vl_venta."', '".$cantidad."', '".$id_factura."', '".$bodega."', '".$user_id."', '".$state."');";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $row_cnt = $result->num_rows;
    if ($row_cnt > 0) {
        $response["success"] = true;
        $response["message"] = "Su producto ha sido agregado correctamente con el número: ".implode(",", $row);
        $response["numero"] = implode(",", $row);
        echo json_encode($response);
        
    } else {
        $response["success"] = false;
                $response["message"] = "No se guardó la información.";
                echo json_encode($response);
    }
}

$conn->close();
?>