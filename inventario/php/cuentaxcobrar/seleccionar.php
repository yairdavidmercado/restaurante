<?php
session_start(); 
$cod = $_POST["cod"];
$parametro1 = $_POST["parametro1"];
$parametro2 = $_POST["parametro2"];
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
	$sql = "SELECT *,
	CASE WHEN (SELECT sum(vl_abono) FROM abonos WHERE id_factura = facturas.id AND abonos.state = 1 ) IS NULL THEN 0 ELSE (SELECT sum(vl_abono) FROM abonos WHERE id_factura = facturas.id AND abonos.state = 1 ) END AS abonado,
    (valor_factu-(CASE WHEN (SELECT sum(vl_abono) FROM abonos WHERE id_factura = facturas.id AND abonos.state = 1 ) IS NULL THEN 0 ELSE ((SELECT sum(vl_abono) FROM abonos WHERE id_factura = facturas.id AND abonos.state = 1 )) END)) as saldo,
	(SELECT nombre FROM users WHERE id = facturas.user_id) AS usuario_crea,
	CASE WHEN (SELECT nombre FROM clientes WHERE clientes.id = id_cliente LIMIT 1) IS NULL THEN 'NINGUNO' ELSE (SELECT nombre FROM clientes WHERE clientes.id = id_cliente LIMIT 1) END AS nombre, 
	CAST(reg_date AS DATE) as fecha
	FROM facturas WHERE facturas.state = 1 AND tipo_venta = '".$parametro1."' AND bodega = '".$parametro2."'
	AND (valor_factu-(CASE WHEN (SELECT sum(vl_abono) FROM abonos WHERE id_factura = facturas.id AND abonos.state = 1 ) IS NULL THEN 0 ELSE ((SELECT sum(vl_abono) FROM abonos WHERE id_factura = facturas.id AND abonos.state = 1 )) END)) > 0 order by id desc;";
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
}elseif ($cod == '2') {
	$sql = "SELECT *,
	CAST(reg_date AS DATE) as fecha 
	FROM abonos WHERE abonos.id_factura = $parametro1 order by id desc;";
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
}elseif ($cod == '3') {
	$sql = "SELECT *,
	CASE WHEN (SELECT sum(vl_abono) FROM abonos WHERE id_factura = facturas.id AND abonos.state = 1 ) IS NULL THEN 0 ELSE (SELECT sum(vl_abono) FROM abonos WHERE id_factura = facturas.id AND abonos.state = 1 ) END AS abonado,
    (valor_factu-(CASE WHEN (SELECT sum(vl_abono) FROM abonos WHERE id_factura = facturas.id AND abonos.state = 1 ) IS NULL THEN 0 ELSE ((SELECT sum(vl_abono) FROM abonos WHERE id_factura = facturas.id AND abonos.state = 1 )) END)) as saldo,
	(SELECT nombre FROM users WHERE id = facturas.user_id) AS usuario_crea,
	CASE WHEN (SELECT nombre FROM clientes WHERE clientes.id = id_cliente LIMIT 1) IS NULL THEN 'NINGUNO' ELSE (SELECT nombre FROM clientes WHERE clientes.id = id_cliente LIMIT 1) END AS nombre, 
	CAST(reg_date AS DATE) as fecha
	FROM facturas WHERE facturas.state = 1 AND tipo_venta = '".$parametro1."' AND bodega = '".$parametro2."'
	AND (valor_factu-(CASE WHEN (SELECT sum(vl_abono) FROM abonos WHERE id_factura = facturas.id AND abonos.state = 1 ) IS NULL THEN 0 ELSE ((SELECT sum(vl_abono) FROM abonos WHERE id_factura = facturas.id AND abonos.state = 1 )) END)) <= 0 order by id desc;";
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