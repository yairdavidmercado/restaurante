<?php
// start a session
session_start();
 if (!isset($_SESSION['idUser'])) {
    header ("Location:/inventario/index.php"); 
 }
// manipulate session variables
?>
<!doctype html>
<html lang="es">
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
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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

<main role="main" class="container py-5">
    <div class="py-3 bg-white rounded shadow-sm">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <select ref="select" onchange="cuentas(this.value, $('input[name^=tipo_venta]:checked').val()); Showegreso(this.value)" class="form-control form-control-sm id_bodegas" id="bodega" name="bodega">
                            <option value="">Seleccione el bodegas</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="mx-auto col-sm-12">
                    <div class="alert alert-success float-right" style="width:100%">
                        <label for="" class="m-2"><b><h4><i class="fa fa-money"></i></h4>Efectivo: $ <span class="total_efectivo" id="total_efectivo" for=""></span></b></label>
                        <label for="" class="m-2"><b><h4><i class="fa fa-university"></i></h4> Banco: $ <span class="total_tarjeta" id="total_tarjeta" for=""></span></b></label> 
                        <label for="" class="m-2"><b><h4><i class="fa fa-credit-card"></i></h4> Crédito: $ <span class="total_credito" id="total_credito" for=""></span></b></label> 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="mx-auto col-sm-12">
                    <!-- form user info -->
                    <div id="ver_guardar" class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Crear egreso</h5>
                        </div>
                        <div class="card-body">
                            <form name="crear_egreso" class="form" role="form" id="form_guardar" role="form" onsubmit="event.preventDefault(); return guardar_egresos();" autocomplete="off">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <select ref="select" required class="form-control form-control-sm tipo_egreso" id="tipo_egreso" name="tipo_egreso">
                                                    <option value="">Seleccione el tipo de egreso</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input maxlength="20" class="form-control form-control-sm" required name="vl_egreso" id="vl_egreso" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" type="text" placeholder="Cantidad del egreso">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mb-3">
                                            <label style="font-size:14px;" for="">De donde hará el egreso</label>
                                            <hr style="margin-top:-1px;">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input id="debit" value="efectivo" name="ubicacion" type="radio" class="custom-control-input" checked="" required="">
                                                <label class="custom-control-label" for="debit">Efectivo</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input id="bank" value="tarjeta" name="ubicacion" type="radio" class="custom-control-input" required="">
                                                <label class="custom-control-label" for="bank">Tarjeta</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input id="credit" value="credito" name="ubicacion" type="radio" class="custom-control-input" required="">
                                                <label class="custom-control-label" for="credit">Crédito</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <textarea required class="form-control form-control-sm" name="descripcion" id="descripcion" placeholder="Descripción"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Guardar</button>
                                        <button class="btn btn-danger" type="button" onclick="ver_guardar()">Limpiar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /form user info -->
                </div>
                <div class="col-sm-12 py-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">egresos</h5>
                        </div>
                        <div class="card-body table-responsive-sm">
                            <table class="table" id="example" style="width:100%;font-size:11px">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Tipo de egreso</th>
                                        <th scope="col">Valor egreso</th>
                                        <th scope="col">Destino de egreso</th>
                                        <th scope="col">Descripción</th>
                                        <th scope="col">Realizado por</th>
                                        <th scope="col">Bodega</th>
                                        <th scope="col">Fecha</th>
                                        <th style="width:10px" scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody id="tbodytable">
                                    <!-- <tr>
                                        <td>{{item.nit}}</td>
                                        <td>{{item.nombre}}</td>
                                        <td>{{item.direccion}}</td>
                                        <td>{{item.telefono}}</td>
                                        <td>{{item.email}}</td>
                                        <td class="editar"><button class="btn btn-warning btn-sm" onclick="ver_editar()" >Editar</button></td>
                                        <td ><button class="btn btn-danger btn-sm">x</button></td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="../../assets/js/jquery.slim.min.js" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/jquery.slim.min.js"><\/script>')</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="/inventario/assets/js/bootstrap-notify.min.js"></script>
    <script src="/inventario/assets/js/boot4alert.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="/inventario/assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script>
$(function() {
        permisos("egresos")
        buscar_tipo_egresos()
        buscar_bodegas()
        console.log( "index!" );
  });

    function buscar_tipo_egresos() {
        let values = { 
                cod: "2",
                parametro1: '1',
                parametro2: ''
            }; 
            $.ajax({
            type : 'POST',
            data: values,
            url: '/inventario/php/egreso/seleccionar.php',
            beforeSend: function() {
                //$(".loader").css("display", "inline-block")
            },
            success: function(respuesta) {
                //$(".loader").css("display", "none")
                let obj = JSON.parse(respuesta)
                let fila = ''
                $.each(obj.resultado, function( index, val ) {
                    fila += '<option value="'+val.id+'">'+val.nombre+'</option>';
                });
                $(".tipo_egreso").html('<option value="">Seleccione el tipo de egreso</option>'+fila)
            },
            error: function() {
            //$(".loader").css("display", "")
            console.log("No se ha podido obtener la información");
            }
        });
        
    }

    function guardar_egresos() {
        if ($("#bodega").val() == 0) {
            notificacion("Por favor seleccione la bodega.", "danger")
            $("#bodega").focus()
            return false
        }
        let efectivo = parseInt($("#total_efectivo").text()) 
        let tarjeta = parseInt($("#total_tarjeta").text())
        let credito = parseInt($("#total_credito").text())
        //alert($("#vl_egreso").val() +"  "+ efectivo+" -"+tarjeta+" -"+credito)
        if ($("input[name^=ubicacion]:checked").val() == "efectivo") {
            if (parseInt($("#vl_egreso").val()) > efectivo ) {
                notificacion("la cantidad no puede exceder el dinero recaudado en efectivo", 'info')
                return false
            }
        }
        if ($("input[name^=ubicacion]:checked").val() == "tarjeta") {
            if (parseInt($("#vl_egreso").val()) > tarjeta ) {
                notificacion("la cantidad no puede exceder el dinero recaudado en la tarjeta", 'info')
                return false
            }
        }
        if ($("input[name^=ubicacion]:checked").val() == "credito") {
            if (parseInt($("#vl_egreso").val()) > credito ) {
                notificacion("la cantidad no puede exceder el dinero recaudado en crédito", 'info')
                return false
            }
        }
      $.ajax({
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        type : 'POST',
        data: $("#form_guardar").serialize()+"&bodega="+$("#bodega").val(),
        url: '/inventario/php/egreso/guardar.php',
        success: function(respuesta) {
          let obj = JSON.parse(respuesta)
          if (obj.success) {
            notificacion("El egreso ha sido guardado exitosamente.", "success")
            limpiar_form()
            Showegreso($('#bodega').val())
            cuentas()
            $("input[name*='nombre']").focus()
          }else{
            alert('Datos invalidos para el acceso')
          }
        },
        error: function() {
          console.log("No se ha podido obtener la información");
        }
      });
      
    }

    function Showegreso(bodega) {
        let values = { 
            cod: "1",
            parametro1: "1",
            parametro2: bodega
        }; 
        $.ajax({
            type : 'POST',
            data: values,
            url: '/inventario/php/egreso/seleccionar.php',
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
                            '<td>'+val.tipo_egre+'</td>'+
                            '<td>'+val.vl_egreso+'</td>'+
                            '<td>'+val.ubicacion+'</td>'+
                            '<td>'+val.descripcion+'</td>'+
                            '<td>'+val.usuario+'</td>'+
                            '<td>'+val.bodega+'</td>'+
                            '<td>'+val.fecha+'</td>'+
                            '<td class="editar"><a style="cursor:pointer" onclick="confirmar_eliminacion('+val.id+')" ><i style="font-size:11px" class="fa fa-window-close"></i></a></td>'+
                        '</tr>'
            });
            $("#tbodytable").html(fila)
            $('#example').DataTable({
                "ordering": false
            });
            
            },
            error: function() {
            //$(".loader").css("display", "")
            console.log("No se ha podido obtener la información");
            }
        });
    
  }

    function limpiar_form() {
            $("#tipo_egreso").val("")
            $("input[name*='vl_egreso']").val("")
            $("#descripcion").val("")
    }

    function confirmar_eliminacion(id) {
    boot4.confirm({
        title: "Advertencia",
        msg: "¿Estas seguro que deseas eliminar el regístro?",
        callback: function(result) {
        if(result){
            eliminar_egreso(id)
            console.log("ok");
        }
        else{
            console.log("cancel");
        }
        }
    });

    }

    function eliminar_egreso(id) {
        let values = {
            id: id
        }
        $.ajax({
        type : 'POST',
        data: values,
        url: '/inventario/php/egreso/eliminar.php',
        success: function(respuesta) {
          let obj = JSON.parse(respuesta)
          if (obj.numero == 1) {
            notificacion("el egreso se ha eliminado exitosamente.", "success")
            limpiar_form()
            Showegreso($('#bodega').val())
            cuentas()
          }else{
            notificacion("El egreso no se encuentra en la base de datos, por favor actualice la página.", "danger")
          }
        },
        error: function() {
          console.log("No se ha podido obtener la información");
        }
      });
      
    }

</script>
</body>
</html>
