<?php
session_start(); 
$nombre = $_POST["nombre"];
$vl_costo = $_POST["vl_costo"];
$vl_venta = $_POST["vl_venta"];
$iva = $_POST["iva"];
$id_categoria = $_POST["id_categoria"];
$id_proveedor = $_POST["id_proveedor"];
$user_id = $_SESSION["idUser"];
$perfil = "2";
$state = "1";

$response = array();
include '../../php/conexion.php';
// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CALL guardar_productos('".$nombre."', '".$vl_costo."', '".$vl_venta."', '".$iva."', '".$id_categoria."','".$id_proveedor."','".$user_id."','".$perfil."','".$state."');";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $row_cnt = $result->num_rows;
    if ($row_cnt > 0) {
        $response["success"] = true;
        $response["message"] = "Su producto ha sido guardado con el número: ".$row["LAST_INSERT_ID()"];
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