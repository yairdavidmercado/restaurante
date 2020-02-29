<?php
session_start(); 
$cod = $_POST["cod"];
$parametro2 = $_POST["state"];
$response = array();
include '../conexion.php';
// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($cod == '1') {
    $sql = "SELECT *, CAST(reg_date AS DATE) as fecha FROM proveedors order by id desc;";
    $result = $conn->query($sql);
    // output data of each row
    $response["resultado"] = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $datos = array();
                                
                                $datos["id"] 				= $row["id"];
                                $datos["nit"] 				= $row["nit"];
                                $datos["nombre"] 			= $row["nombre"];
                                $datos["direccion"] 		= $row["direccion"];
                                $datos["telefono"] 			= $row["telefono"];
                                $datos["email"] 			= $row["email"];
                                $datos["state"] 			= $row["state"];
                                $datos["fecha"] 			= $row["fecha"];

                                // push single product into final response array
                                array_push($response["resultado"], $datos);

                                
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
    $sql = "SELECT * FROM proveedors WHERE state = $parametro2 order by id desc;";
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
}
//termina cod 2
$conn->close();
?>