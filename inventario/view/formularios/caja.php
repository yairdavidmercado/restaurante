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
<link href="../../assets/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
<link href="../../assets/css/bootstrap-datepicker.css" rel="stylesheet" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

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
  <?php require("../menu.php"); ?>

<div class="container py-5">
  <div class="row">
      <div class="col-sm-3">
          <div class="form-group">
              <select ref="select" onchange="cuentas(this.value, $('input[name^=tipo_venta]:checked').val());limpiar_saldo_rago_fechas()" class="form-control form-control-sm id_bodegas" id="bodega" name="bodega">
                  <option value="">Seleccione el bodegas</option>
              </select>
          </div>
      </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Saldo general</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Saldo por rango de fecha</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
          <div style="margin-top:70px" class="card-deck mb-3 py-5 text-center">
            <div class="card mb-4 shadow-sm">
              <div class="card-header">
                <h4 class="my-0 font-weight-normal">Efectivo</h4>
              </div>
              <div class="card-body">
                <h2 class="card-title pricing-card-title">$ <span id="total_efectivo" class="text-muted total_efectivo"></span></h2>
                <ul class="list-unstyled mt-3 mb-4">
                </ul>
              </div>
            </div>
            <div class="card mb-4 shadow-sm">
              <div class="card-header">
                <h4 class="my-0 font-weight-normal">Banco</h4>
              </div>
              <div class="card-body">
                <h2 class="card-title pricing-card-title">$ <span id="total_tarjeta" class="text-muted total_tarjeta"></span></h2>
                <ul class="list-unstyled mt-3 mb-4">
                </ul>
              </div>
            </div>
            <div class="card mb-4 shadow-sm">
              <div class="card-header">
                <h4 class="my-0 font-weight-normal">Crédito</h4>
              </div>
              <div class="card-body">
                <h2 class="card-title pricing-card-title">$ <span id="total_credito" class="text-muted total_credito"></span></h2>
                <ul class="list-unstyled mt-3 mb-4">
                    <li>Total valor facturas:</li>
                    <li class="vl_facturas_credito"></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade show py-4 " id="profile" role="tabpanel" aria-labelledby="home-tab">
          <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Facturas generadas en el período establecido</h5>
            </div>
            <div class="card-body table-responsive-sm">
            <form name="consultar_saldo" class="form" role="form" id="consultar_saldo" role="form" onsubmit="event.preventDefault(); return consultar_saldos();" autocomplete="off">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-2">
                            <label for="">Fecha de inicio</label>
                            <div class="form-group">
                                <input maxlength="255" ref="fechaini" required class="form-control form-control-sm fecha" id="fechaini" name="parametro2" type="text" placeholder="Fecha inicio">
                            </div>
                        </div>
                        <div class="col-sm-2">
                          <label for="">Fecha final</label>
                            <div class="form-group">
                                <input maxlength="255" ref="fechafin" required class="form-control form-control-sm fecha" id="fechafin" name="parametro3" type="text" placeholder="fecha final">
                            </div>
                        </div>
                        <div class="col-sm-1">
                          <label for=""> .</label>
                            <div class="form-group">
                            <button class="btn btn-success btn-sm float-right" id="submit_guardar" type="submit">Consultar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div style="margin-top:10px" class="card-deck mb-3 py-5 text-center">
              <div class="card mb-4 shadow-sm">
                <div class="card-header">
                  <h4 class="my-0 font-weight-normal">Efectivo</h4>
                </div>
                <div class="card-body">
                  <h2 class="card-title pricing-card-title">$ <span id="total_efectivo" class="text-muted total_efectivo1"></span></h2>
                  <ul class="list-unstyled mt-3 mb-4">
                  </ul>
                </div>
              </div>
              <div class="card mb-4 shadow-sm">
                <div class="card-header">
                  <h4 class="my-0 font-weight-normal">Banco</h4>
                </div>
                <div class="card-body">
                  <h2 class="card-title pricing-card-title">$ <span id="total_tarjeta" class="text-muted total_tarjeta1"></span></h2>
                  <ul class="list-unstyled mt-3 mb-4">
                  </ul>
                </div>
              </div>
              <div class="card mb-4 shadow-sm">
                <div class="card-header">
                  <h4 class="my-0 font-weight-normal">Crédito</h4>
                </div>
                <div class="card-body">
                  <h2 class="card-title pricing-card-title">$ <span id="total_credito" class="text-muted total_credito1"></span></h2>
                  <ul class="list-unstyled mt-3 mb-4">
                    <li>Total valor facturas:</li>
                    <li class="vl_facturas_credito1"></li>
                  </ul>
                </div>
              </div>
            </div>
              <table class="table" id="example" style="width:100%;font-size:11px">
                  <thead class="thead-light">
                      <tr>
                          <th scope="col">Id</th>
                          <th scope="col">Nombre</th>
                          <th scope="col">Valor factura</th>
                          <th scope="col">Abonado</th>
                          <th scope="col">Saldo</th>
                          <th scope="col">Cuotas</th>
                          <th scope="col">Tipo de venta</th>
                          <th scope="col">Vendedor</th>
                          <th scope="col">Fecha venta</th>
                          <th style="width:10px">Fecha creación</th>
                      </tr>
                  </thead>
                  <tbody id="tbodytable">
                  </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="../../assets/js/jquery.slim.min.js" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/jquery.slim.min.js"><\/script>')</script>
    <script src="../../assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="/inventario/assets/js/bootstrap-notify.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="../../assets/js/bootstrap-datepicker.min.js"></script>
<script>
$(function() {
        console.log( "index!" );
        permisos("cajas")
        cuentas()
        buscar_bodegas()

        $('.fecha').datepicker({
          format: "yyyy-mm-dd",
          todayHighlight: true,
          language:"es"                       
        });
  });

  function consultar_saldos() {
          if ($("#bodega").val() == 0) {
              notificacion("Por favor seleccione la bodega.", "danger")
              $("#bodega").focus()
              return false
          }
          let values = { 
              cod: "2",
              parametro1: $('#bodega').val(),
              parametro2: $('#fechaini').val(),
              parametro3: $('#fechafin').val()
          }; 
        $.ajax({
        type : 'POST',
        data: values,
        url: '/inventario/php/caja/seleccionar.php',
        beforeSend: function() {
            //$(".loader").css("display", "inline-block")
        },
        success: function(respuesta) {
        //$(".loader").css("display", "none")
            let obj = JSON.parse(respuesta)
            $.each(obj.resultado, function( index, val ) {
              $('.total_efectivo1').text(val.vl_efectivo)
              $('.total_tarjeta1').text(val.vl_tarjeta)
              $('.total_credito1').text(val.vl_credito)
              $('.vl_facturas_credito1').text(val.vl_facturas_credito)
            });
            Showfactura()
        },
        error: function() {
            //$(".loader").css("display", "")
            console.log("No se ha podido obtener la información");
        }
    });
    
  }

  function Showfactura() {
        let values = { 
            cod: "3",
            parametro1: $('#bodega').val(),
            parametro2: $('#fechaini').val(),
            parametro3: $('#fechafin').val()
        }; 
        $.ajax({
        type : 'POST',
        data: values,
        url: '/inventario/php/caja/seleccionar.php',
        beforeSend: function() {
            //$(".loader").css("display", "inline-block")
        },
        success: function(respuesta) {
          //$(".loader").css("display", "none")
          let obj = JSON.parse(respuesta)
          $("#example").dataTable().fnDestroy();
          let fila = ''
          $.each(obj.resultado, function( index, val ) {
              fila += '<tr>'+
                          '<td>'+val.id+'</td>'+
                          '<td>'+val.nombre+'</td>'+
                          '<td>'+parseInt(val.valor_factu).toFixed(0)+'</td>'+
                          '<td>'+parseInt(val.abonado).toFixed(0)+'</td>'+
                          '<td>'+parseInt(val.saldo).toFixed(0)+'</td>'+
                          '<td>'+val.cuotas+'</td>'+
                          '<td><span class="text-uppercase">'+val.tipo_venta+'</span></td>'+
                          '<td>'+val.usuario_crea+'</td>'+
                          '<td>'+val.fecha_venta+'</td>'+
                          '<td>'+val.fecha+'</td>'+
                      '</tr>'
          });
          $("#tbodytable").html(fila)
          $('#example').DataTable({
              "ordering": false,
              "paging": false
          });
        
        },
        error: function() {
        //$(".loader").css("display", "")
        console.log("No se ha podido obtener la información");
        }
    });
  }  
  
  function limpiar_saldo_rago_fechas() {
    $('.total_efectivo1').text("")
    $('.total_tarjeta1').text("")
    $('.total_credito1').text("")
  }

    function limpiar_form() {
        $("input[name*='nit']").val("")
        $("input[name*='nombre']").val("")
        $("input[name*='direccion']").val("")
        $("input[name*='telefono']").val("")
        $("input[name*='email']").val("")
    }

    function ver_guardar() {
        $("#ver_guardar").css("display", "block")
        $("#ver_editar").css("display", "none")
    }

    function ver_editar() {
        $(".editar").click()
        $("#ver_editar").css("display", "block")
        $("#ver_guardar").css("display", "none")
    }
</script>
</body>
</html>
