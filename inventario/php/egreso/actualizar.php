<?php
session_start(); 
$id = $_POST["id1"];
$nombre = $_POST["nombre1"];
$vl_costo = $_POST["vl_costo1"];
$vl_venta = $_POST["vl_venta1"];
$iva = $_POST["iva1"];
$id_categoria = $_POST["id_categoria1"];
$id_proveedor = $_POST["id_proveedor1"];
$user_id = $_SESSION["idUser"];
$state = $_POST["state1"];
$perfil = 1;

$response = array();
include '../../php/conexion.php';
// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CALL actualizar_agresos(".$id.",'".$nombre."', ".$vl_costo.", ".$vl_venta.", '".$iva."', ".$id_categoria.", ".$id_proveedor.", ".$user_id.", ".$perfil.",".$state.");";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $row_cnt = $result->num_rows;
    if ($row_cnt > 0) {
        $response["success"] = true;
        $response["message"] = "Su egreso ha sido registrado con el numero: ".$row["id1"];
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