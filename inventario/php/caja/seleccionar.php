<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start(); 
$cod = $_POST["cod"];
$parametro1 = $_POST["parametro1"];
$parametro2 = $_POST["parametro2"];
$parametro3 = $_POST["parametro3"];
$response = array();
include '../conexion.php';
// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($cod == '1') {
    $sql = "SELECT 
            (IFNULL( (SELECT SUM(valor_factu) FROM facturas WHERE state = 1 AND tipo_venta = 'efectivo' AND bodega = $parametro1), 0))
            -
            (IFNULL( (SELECT SUM(vl_egreso) FROM egresos WHERE state = 1 AND ubicacion = 'efectivo'AND bodega = $parametro1), 0)) 
            as vl_efectivo,
            (IFNULL( (SELECT SUM(valor_factu) FROM facturas WHERE state = 1 AND tipo_venta = 'tarjeta' AND bodega = $parametro1), 0))
            -
            (IFNULL( (SELECT SUM(vl_egreso) FROM egresos WHERE state = 1 AND ubicacion = 'tarjeta' AND bodega = $parametro1), 0)) 
            as vl_tarjeta,
            (IFNULL((SELECT SUM(vl_abono) FROM abonos INNER JOIN facturas ON facturas.id = abonos.id_factura WHERE facturas.state = 1 AND facturas.bodega = $parametro1 ), 0))
            -
            (IFNULL( (SELECT SUM(vl_egreso) FROM egresos WHERE state = 1 AND ubicacion = 'credito' AND bodega = $parametro1 ), 0)) 
            as vl_credito,
            (IFNULL( (SELECT SUM(valor_factu) FROM facturas WHERE state = 1 AND tipo_venta = 'credito' AND bodega = $parametro1), 0))
            as vl_facturas_credito
            FROM facturas WHERE state = 1 LIMIT 1;";
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
}else if ($cod == '2') {
    $sql = "SELECT 
            (IFNULL( (SELECT SUM(valor_factu) FROM facturas WHERE state = 1 
            AND tipo_venta = 'efectivo' 
            AND bodega = $parametro1 
            AND date(fecha_venta) BETWEEN '$parametro2' AND '$parametro3'), 0)) as vl_efectivo,
            (IFNULL( (SELECT SUM(valor_factu) FROM facturas WHERE state = 1 AND tipo_venta = 'tarjeta' 
            AND bodega = $parametro1
            AND date(fecha_venta) BETWEEN '$parametro2' AND '$parametro3'), 0))as vl_tarjeta,
            (IFNULL((SELECT SUM(vl_abono) FROM abonos INNER JOIN facturas ON facturas.id = abonos.id_factura WHERE facturas.state = 1 
            AND facturas.bodega = $parametro1
            AND date(fecha_venta) BETWEEN '$parametro2' AND '$parametro3'), 0)) as vl_credito,
            (IFNULL( (SELECT SUM(valor_factu) FROM facturas WHERE state = 1 AND tipo_venta = 'credito' 
            AND bodega = $parametro1
            AND date(fecha_venta) BETWEEN '$parametro2' AND '$parametro3'), 0))as vl_facturas_credito,
            (IFNULL( (SELECT SUM(vl_egreso) FROM egresos WHERE state = 1 AND ubicacion = 'credito' AND bodega = $parametro1 ), 0)) as total_egreso
            FROM facturas WHERE state = 1 LIMIT 1;";
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
}else if ($cod == '3') {
	$sql = "SELECT *,
	CASE WHEN (SELECT sum(vl_abono) FROM abonos WHERE id_factura = facturas.id AND abonos.state = 1 ) IS NULL THEN 0 ELSE (SELECT sum(vl_abono) FROM abonos WHERE id_factura = facturas.id AND abonos.state = 1 ) END AS abonado,
    (valor_factu-(CASE WHEN (SELECT sum(vl_abono) FROM abonos WHERE id_factura = facturas.id AND abonos.state = 1 ) IS NULL THEN 0 ELSE ((SELECT sum(vl_abono) FROM abonos WHERE id_factura = facturas.id AND abonos.state = 1 )) END)) as saldo,
	(SELECT nombre FROM users WHERE id = facturas.user_id) AS usuario_crea,
	CASE WHEN (SELECT nombre FROM clientes WHERE clientes.id = id_cliente LIMIT 1) IS NULL THEN 'NINGUNO' ELSE (SELECT nombre FROM clientes WHERE clientes.id = id_cliente LIMIT 1) END AS nombre, 
	CAST(reg_date AS DATE) as fecha
	FROM facturas WHERE facturas.state = 1 AND bodega = '".$parametro1."' 
    AND date(fecha_venta) BETWEEN '$parametro2' AND '$parametro3'
	order by id desc;";
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