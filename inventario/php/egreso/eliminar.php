<?php
session_start(); 
$id = $_POST["id"];
$user_id = $_SESSION['idUser'];
$response = array();
include '../conexion.php';
// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "UPDATE egresos SET state = 0, delete_by = $user_id WHERE id = $id;";
    $result = $conn->query($sql);
    // output data of each row
    $response["resultado"] = array();

    if ($conn->affected_rows > 0) {
        
        $response["numero"] = 1;
        echo json_encode($response);
    } else {
        $response["success"] = false;
        $response["message"] = "No se encontraron registros".$conn->affected_rows;
        // echo no users JSON
        echo json_encode($response);
    }
    //
//termina cod 2
$conn->close();
?>