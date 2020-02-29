<?php
session_start(); 
$cod = $_POST["cod"];
$parametro1 = $_POST["parametro1"];
$parametro2 = $_POST["parametro2"];
$response = array();
include '../conexion.php';
// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($cod == '1') {
    $sql = "SELECT *, (SELECT iva FROM productos WHERE productos.id = detalle_factura.id_producto) AS iva, (SELECT nombre FROM productos WHERE productos.id = detalle_factura.id_producto) AS nombre_producto, CAST(reg_date AS DATE) as fecha 
    FROM detalle_factura WHERE user_id = $parametro1 AND state = $parametro2 order by id desc;";
    $result = $conn->query($sql);
    // output data of each row
    $response["resultado"] = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $datos = array();

                                // push single product into final response array
                                array_push($response["resultado"], $row);

                                
        }
        $response["success"] = true;
        echo json_encode($response);
    } else {
        $response["success"] = false;
        $response["message"] = "No se encontraron registros";
        // echo no users JSON
        echo json_encode($response);
    }
    //termina cod 1
}elseif ($cod == '2') {
    $sql = "SELECT *, (SELECT iva FROM productos WHERE productos.id = detalle_factura.id_producto) AS iva, (SELECT nombre FROM productos WHERE productos.id = detalle_factura.id_producto) AS nombre_producto, CAST(reg_date AS DATE) as fecha 
    FROM detalle_factura WHERE id_factura = $parametro1 AND state = $parametro2 order by id desc;";
    $result = $conn->query($sql);
    // output data of each row
    $response["resultado"] = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $datos = array();

                                // push single product into final response array
                                array_push($response["resultado"], $row);

                                
        }
        $response["success"] = true;
        echo json_encode($response);
    } else {
        $response["success"] = false;
        $response["message"] = "No se encontraron registros";
        // echo no users JSON
        echo json_encode($response);
    }
    //termina cod 1
}
//termina cod 2
$conn->close();
?>