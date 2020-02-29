<?php
// start a session
session_start();
 if (!isset($_SESSION['idUser'])) {
    header ("Location:/inventario/index.php"); 
 }
// manipulate session variables
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Inventario</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/offcanvas/">

    <!-- Bootstrap core CSS -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

<meta name="theme-color" content="#563d7c">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
  </head>
  <body class="bg-light">
  <?php require("view/menu.php"); ?>

<main role="main" class="container py-5">
  <div class="py-5 bg-white rounded shadow-sm">
  <div class="container">
      <div class="row">
        <div class="col-md-2">
          <div class="card mb-4 shadow-sm">
            <img width="100%" src="assets/img/client.jpg" alt="">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a  href="view/formularios/cliente.php" class="btn btn-sm" style="background-color: #6c63ff; color:#fff">Registrar cliente</a>
                </div>
                <!-- <small class="text-muted">9 mins</small> -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="card mb-4 shadow-sm">
          <img width="100%" src="assets/img/buy.jpg" alt="">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a  href="view/formularios/venta.php" class="btn btn-sm" style="background-color: #6c63ff; color:#fff">Nueva venta</a>
                </div>
                <!-- <small class="text-muted">9 mins</small> -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="card mb-4 shadow-sm">
          <img width="100%" src="assets/img/search.jpg" alt="">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a  href="/form/existencia" class="btn btn-sm" style="background-color: #6c63ff; color:#fff">Consultar precios</a>
                </div>
                <!-- <small class="text-muted">9 mins</small> -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="card mb-4 shadow-sm">
          <img width="100%" src="assets/img/proveedores.jpg" alt="">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a  href="view/formularios/proveedor.php" class="btn btn-sm" style="background-color: #6c63ff; color:#fff">Registrar proveedores</a>
                </div>
                <!-- <small class="text-muted">9 mins</small> -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="card mb-4 shadow-sm">
          <img width="100%" src="assets/img/devoluciones.jpg" alt="">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm" style="background-color: #6c63ff; color:#fff">Devolución de cliente</button>
                </div>
                <!-- <small class="text-muted">9 mins</small> -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="card mb-4 shadow-sm">
          <img width="100%" src="assets/img/cxp.jpg" alt="">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm" style="background-color: #6c63ff; color:#fff">Buscar cuenta por pagar</button>
                </div>
                <!-- <small class="text-muted">9 mins</small> -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="card mb-4 shadow-sm">
          <img width="100%" src="assets/img/add-productos.jpg" alt="">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a  href="view/formularios/producto.php" class="btn btn-sm" style="background-color: #6c63ff; color:#fff">Registrar productos</a>
                </div>
                <!-- <small class="text-muted">9 mins</small> -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="card mb-4 shadow-sm">
          <img width="100%" src="assets/img/egreso.jpg" alt="">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                <a  href="view/formularios/egreso.php" class="btn btn-sm" style="background-color: #6c63ff; color:#fff">Registrar egresos</a>
                </div>
                <!-- <small class="text-muted">9 mins</small> -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="card mb-4 shadow-sm">
          <img width="100%" src="assets/img/buy-proveedores.jpg" alt="">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm" style="background-color: #6c63ff; color:#fff">Comprar a proveedores</button>
                </div>
                <!-- <small class="text-muted">9 mins</small> -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="card mb-4 shadow-sm">
          <img width="100%" src="assets/img/registrar-dinero.jpg" alt="">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm" style="background-color: #6c63ff; color:#fff">Registrar dinero</button>
                </div>
                <!-- <small class="text-muted">9 mins</small> -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="card mb-4 shadow-sm">
          <img width="100%" src="assets/img/revisar-compra-proveedor.jpg" alt="">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm" style="background-color: #6c63ff; color:#fff">Revisar compra proveedor</button>
                </div>
                <!-- <small class="text-muted">9 mins</small> -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="card mb-4 shadow-sm">
          <img width="100%" src="assets/img/buscar-cuenta-cobrar.jpg" alt="">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                <a  href="view/formularios/cuentaxcobrar.php" class="btn btn-sm" style="background-color: #6c63ff; color:#fff">Buscar cuentas por cobrar</a>
                </div>
                <!-- <small class="text-muted">9 mins</small> -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="card mb-4 shadow-sm">
          <img width="100%" src="assets/img/add-user.jpg" alt="">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                <a  href="view/formularios/usuario.php" class="btn btn-sm" style="background-color: #6c63ff; color:#fff">Añadir usuario</a>
                </div>
                <!-- <small class="text-muted">9 mins</small> -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="card mb-4 shadow-sm">
          <img width="100%" src="assets/img/reports.jpg" alt="">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm" style="background-color: #6c63ff; color:#fff">Reportes</button>
                </div>
                <!-- <small class="text-muted">9 mins</small> -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="card mb-4 shadow-sm">
          <img width="100%" src="assets/img/calendar.jpg" alt="">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm" style="background-color: #6c63ff; color:#fff">Registrar vencimientos</button>
                </div>
                <!-- <small class="text-muted">9 mins</small> -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="card mb-4 shadow-sm">
          <img width="100%" src="assets/img/devolucion-proveedores.jpg" alt="">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm" style="background-color: #6c63ff; color:#fff">Devoluciones a proveedores</button>
                </div>
                <!-- <small class="text-muted">9 mins</small> -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="card mb-4 shadow-sm">
          <img width="100%" src="assets/img/caja.jpg" alt="">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                <a  href="view/formularios/caja.php" class="btn btn-sm" style="background-color: #6c63ff; color:#fff">Caja general</a>
                </div>
                <!-- <small class="text-muted">9 mins</small> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script src="assets/js/jquery.slim.min.js" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="assets/js/jquery.slim.min.js"><\/script>')</script>
      <script src="assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(function() {
        console.log( "index!" );
  });
</script>
</body>
</html>
