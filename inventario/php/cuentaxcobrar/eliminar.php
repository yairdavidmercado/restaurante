<?php
session_start(); 
$id_factura = $_POST["id_factura"];
$tipo_venta = $_POST["tipo_venta"];
$bodega = $_POST["bodega"];

$response = array();
include '../../php/conexion.php';
// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT eliminar_facturas(".$id_factura.",'".$tipo_venta."', ".$bodega.")";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $row_cnt = $result->num_rows;
    if ($row_cnt > 0) {
        $response["success"] = true;
        $response["message"] = "Se ha eliminado satisfactoriamente la factura número: ".implode($row);
        $response["numero"] = implode($row);
        echo json_encode($response);
        
    } else {
        $response["success"] = false;
                $response["message"] = "No se guardó la información.";
                echo json_encode($response);
    }
}

$conn->close();
?>