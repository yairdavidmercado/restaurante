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
	CAST(reg_date AS DATE) as fecha, 
	((vl_costo*(CAST(iva AS DECIMAL(5,0))))/100) as total_iva,
	IF((select sum(cantidad) FROM existencias WHERE id_producto = productos.id AND bodega = $parametro2 ) IS NULL, 0 ,(select sum(cantidad) FROM existencias WHERE id_producto = productos.id AND bodega = $parametro2 )-(IF ((SELECT SUM(cantidad) FROM detalle_factura WHERE id_producto = productos.id AND detalle_factura.state = 1 AND bodega = $parametro2) IS NULL, 0, (SELECT SUM(cantidad) FROM detalle_factura WHERE id_producto = productos.id AND detalle_factura.state = 1 AND bodega = $parametro2)))) as cantidad,
	(vl_costo+((vl_costo*(CAST(iva AS DECIMAL(5,0))))/100)) as total_costo,
	(SELECT TRIM(nombre) FROM categorias WHERE categorias.id = productos.id_categoria) as categoria,
	(SELECT TRIM(nombre) FROM proveedors WHERE proveedors.id = productos.id_proveedor) as proveedor
	FROM productos WHERE productos.state = 1 order by id desc;";
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
	$sql = "SELECT id, nombre FROM productos WHERE productos.state = 1 order by id desc;";
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
	CAST(reg_date AS DATE) as fecha, 
	((vl_costo*(CAST(iva AS DECIMAL(5,0))))/100) as total_iva,
	IF((select sum(cantidad) FROM existencias WHERE id_producto = productos.id AND bodega = $parametro2 ) IS NULL, 0 ,(select sum(cantidad) FROM existencias WHERE id_producto = productos.id AND bodega = $parametro2 )-(IF ((SELECT SUM(cantidad) FROM detalle_factura WHERE id_producto = productos.id AND detalle_factura.state = 1 AND bodega = $parametro2) IS NULL, 0, (SELECT SUM(cantidad) FROM detalle_factura WHERE id_producto = productos.id AND detalle_factura.state = 1 AND bodega = $parametro2)))) as cantidad,
	(vl_costo+((vl_costo*(CAST(iva AS DECIMAL(5,0))))/100)) as total_costo,
	(SELECT TRIM(nombre) FROM categorias WHERE categorias.id = productos.id_categoria) as categoria,
	(SELECT TRIM(nombre) FROM proveedors WHERE proveedors.id = productos.id_proveedor) as proveedor 
	FROM productos WHERE productos.id = $parametro1 AND productos.state = 1 order by id desc;";
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