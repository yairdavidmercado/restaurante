<?php
session_start(); 
$cod = $_POST["cod"];
$parametro1 = $_POST["parametro1"];
$state = $_POST["state"];
$response = array();
include '../conexion.php';
// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$conn -> set_charset("utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($cod == '1') {
    $sql = "SELECT bodegas.* FROM bodegas 
    INNER JOIN permisos ON permisos.id_modulo = bodegas.id
    WHERE permisos.tipo = 'bodegas' AND permisos.perfil = $parametro1 AND bodegas.state = $state order by id desc;";
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
$conn->close();
?>