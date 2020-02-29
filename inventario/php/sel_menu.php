<?php
session_start(); 
$cod = $_POST["cod"];
$parametro1 = $_POST["parametro1"];
$parametro2 = $_POST["parametro2"];
$parametro3 = $_POST["parametro3"];

$response = array();
include 'conexion.php';
// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$conn -> set_charset("utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($cod == '1') {
	$sql = "SELECT permisos.id, 
	ifnull((SELECT id FROM restringir_permisos 
	WHERE id_permiso = permisos.id 
	AND id_usuario = $parametro1 LIMIT 1),0) as restriccion 
	FROM permisos 
	WHERE permisos.perfil = $parametro2 
	AND permisos.tipo = '$parametro3';";
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