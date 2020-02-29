<?php
session_start(); 
$id_productos = $_POST["id_productos"];
$id_cliente = $_POST["id_cliente"];
$iva_factu = $_POST["iva_factu"];
$subtotal_factu = $_POST["subtotal_factu"];
$valor_factu = $_POST["valor_factu"];
$bodega = $_POST["bodega"];
$cuotas = $_POST["cuotas"];
$tipo_venta = $_POST["tipo_venta"];
$fecha_venta = $_POST["fecha_venta"];
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

$sql = "CALL guardar_facturas('".$id_productos."','".$id_cliente."', '".$iva_factu."', '".$subtotal_factu."', '".$valor_factu."', '".$bodega."', '".$cuotas."', '".$tipo_venta."', '".$fecha_venta."', '".$user_id."','".$state."');";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $row_cnt = $result->num_rows;
    if ($row_cnt > 0) {
        $response["success"] = true;
        $response["message"] = "Su factura ha sido actualizado con el numero: ".$row["LAST_INSERT_ID()"];
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