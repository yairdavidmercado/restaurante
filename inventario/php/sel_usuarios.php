<?php
session_start(); 
$parametro = $_POST["id"];
$parametro2 = $_POST["pass"];
$response = array();
include 'conexion.php';
// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$conn -> set_charset("utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM users WHERE id = ".$parametro." AND password = MD5('$parametro2') ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	$response["resultado"] = array();
    while($row = $result->fetch_assoc()) {
		$datos = array();
							
							$datos["id"] 				= $row["id"];
							$datos["nombre"] 			= $row["nombre"];
							$datos["email"] 			= $row["email"];
							$_SESSION["idUser"]			= $row["id"];
							$_SESSION["nameUser"]		= $row["nombre"];
							$_SESSION["profile"]		= $row["perfil"];

							// push single product into final response array
							array_push($response["resultado"], $datos);

							$response["success"] = true;
							echo json_encode($response);
    }
} else {
    $response["success"] = false;
						$response["message"] = "No se encontraron registros";
						// echo no users JSON
						echo json_encode($response);
}
$conn->close();
?>