<?php
session_start(); 
$cod = $_POST["cod"];
//$parametro = $_POST["id"];
$parametro2 = $_POST["state"];
$response = array();
include '../conexion.php';
// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$conn -> set_charset("utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM categorias WHERE state = $parametro2 order by id desc;";
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
$conn->close();
?>