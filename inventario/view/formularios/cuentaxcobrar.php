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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

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
  <div class="py-2 bg-white rounded shadow-sm">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <select ref="select" onchange="Showfactura_pendientes(this.value, $('input[name^=tipo_venta]:checked').val())" class="form-control form-control-sm id_bodegas" id="bodega" name="bodega">
                        <option value="">Seleccione el bodegas</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 mb-3">
                <label style="font-size:14px;" for="">Tipo de venta</label>
                <hr style="margin-top:-1px;">
                <div class="custom-control custom-radio custom-control-inline">
                    <input id="debit" value="efectivo" onclick="Showfactura_pendientes($('#bodega').val(), this.value)" name="tipo_venta" type="radio" class="custom-control-input" checked="" required="">
                    <label class="custom-control-label" for="debit">Efectivo</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input id="bank" value="tarjeta" onclick="Showfactura_pendientes($('#bodega').val(),this.value)" name="tipo_venta" type="radio" class="custom-control-input" required="">
                    <label class="custom-control-label" for="bank">Tarjeta</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input id="credit" value="credito" onclick="Showfactura_pendientes($('#bodega').val(),this.value)" name="tipo_venta" type="radio" class="custom-control-input" required="">
                    <label class="custom-control-label" for="credit">Crédito</label>
                </div>
            </div>
            <div class="mx-auto col-sm-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Facturas pendientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Facturas pagadas</a>
                </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Facturas pendientes</h5>
                            </div>
                            <div class="card-body table-responsive-sm">
                                <table class="table" id="example" style="width:100%;font-size:11px">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="width:10px" scope="col">Ver abono</th>
                                            <th scope="col">Id</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Valor factura</th>
                                            <th scope="col">Abonado</th>
                                            <th scope="col">Saldo</th>
                                            <th scope="col">Cuotas</th>
                                            <th scope="col">Tipo de venta</th>
                                            <th scope="col">Vendedor</th>
                                            <th scope="col">Fecha</th>
                                            <th style="width:10px"></th>
                                            <th style="width:10px"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodytable">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Facturas terminadas</h5>
                            </div>
                            <div class="card-body table-responsive-sm">
                                <table class="table" id="example1" style="width:100%;font-size:11px">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="width:10px" scope="col">Ver abono</th>
                                            <th scope="col">Id</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Valor factura</th>
                                            <th scope="col">Abonado</th>
                                            <th scope="col">Saldo</th>
                                            <th scope="col">Cuotas</th>
                                            <th scope="col">Tipo de venta</th>
                                            <th scope="col">Vendedor</th>
                                            <th scope="col">Fecha</th>
                                            <th style="width:10px"></th>
                                            <th style="width:10px"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodytable1">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            <div id="ver_credito" style="display:none" class="col-sm-12 py-4">
                <!-- form user info -->
                <div id="ver_editar" class="card">
                    <div class="card-header">
                    <button class="btn btn-success btn-sm float-right" onclick="btn_guardar()">Guardar</button>
                        <h5 class="mb-0">Abonar a factura</h5>
                    </div>
                    <div class="card-body">
                        <form name="editar_factura" class="form" role="form" id="form_actualizar" role="form" onsubmit="event.preventDefault(); return guardar_abono();" autocomplete="off">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input maxlength="255" ref="id" required disabled class="form-control form-control-sm" id="id1" name="id1" type="text" placeholder="id">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input maxlength="255" ref="nombre" required disabled class="form-control form-control-sm" name="nombre1" type="text" placeholder="Nombre">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input maxlength="20" class="form-control form-control-sm" required name="vl_abono1" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" type="text" placeholder="Valor del abono">
                                        </div>
                                    </div>
                                </div>
                                <div style="display:none" class="form-group">
                                <button class="btn btn-success btn-sm float-right" id="submit_guardar" type="submit">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /form user info -->
                <div id="ver_editar" class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Abonos realizados</h5>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table" style="width:100%;font-size:11px">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Valor abono</th>
                                    <th scope="col">Fecha</th>
                                    <th style="width:10px" scope="col">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyabono">
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
            <div class="col-sm-12">
                <!-- /form user info -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Detalles de facturas</h5>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table " id="example" style="width:100%; font-size:10px">
                            <thead class="thead-light">
                                <tr>
                                    <th style="display:none" scope="col">Id Producto</th>
                                    <th scope="col">Id Producto</th>
                                    <th scope="col">Nombre del producto</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Valor unitario</th>
                                    <th scope="col">IVA</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col">Total</th>
                                    <th style="width:10px" scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="tbodydetalle_factura">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <form id="form_existencias" class="form" role="form" role="form" onsubmit="event.preventDefault(); return guardar_existencias();" autocomplete="off">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Configurar existencias</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                <div class="container">
                                    <div class="row">
                                    <div style="display:none" class="col-sm-3">
                                            <div class="form-group">
                                            <input maxlength="20" class="form-control form-control-sm" required name="modal_id" type="text" placeholder="Cantidad existente">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                            <input maxlength="20" class="form-control form-control-sm" disabled name="modal_nombre" type="text" placeholder="Cantidad existente">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <input maxlength="20" class="form-control form-control-sm" required name="modal_cantidad" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" type="text" placeholder="Cantidad existente">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" alert() class="btn btn-primary">Guardar cambios</button>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
</main>
<script src="../../assets/js/jquery.slim.min.js" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/jquery.slim.min.js"><\/script>')</script>
    <script src="../../assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="/inventario/assets/js/bootstrap-notify.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script>
$(function() {
        permisos("cuentasxcobrar")
        buscar_bodegas()
        console.log( "index!" );
  });

    function guardar_abono() {
        if ($("input[name*='id1']").val().length == 0) {
            notificacion("Usted no ha seleccionado la factura a abonar.", "success")
            return false;
        }
        $.ajax({
            type : 'POST',
            data: $("#form_actualizar").serialize()+"&id1="+$("#id1").val(),
            url: '/inventario/php/cuentaxcobrar/guardar_abono.php',
            success: function(respuesta) {
            let obj = JSON.parse(respuesta)
            if (obj.success) {
                notificacion("El factura ha sido actualizado exitosamente.", "success")
                Showabono($("#id1").val())
                Showfactura_pendientes($('#bodega').val(), $("input[name^=tipo_venta]:checked").val())
                limpiar_form()
                $("input[name*='nit1']").focus()
            }else{
                alert('Datos invalidos para el acceso')
            }
            },
            error: function() {
            console.log("No se ha podido obtener la información");
            }
        });
      
    }

    function Showfactura_pendientes(bodega, tipo_venta) {
        Showfactura_terminadas(bodega, tipo_venta)
        ver_credito(tipo_venta)
        let values = { 
            cod: "1",
            parametro1: tipo_venta,
            parametro2: bodega 
        }; 
        $.ajax({
        type : 'POST',
        data: values,
        url: '/inventario/php/cuentaxcobrar/seleccionar.php',
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
                        '<td onclick="Showabono('+val.id+')" class="editar"><h6><span style="cursor:pointer" class="badge badge-info"><i class="fa fa-eye"></i></span></h6></td>'+
                        '<td>'+val.id+'</td>'+
                        '<td>'+val.nombre+'</td>'+
                        '<td>'+parseInt(val.valor_factu).toFixed(0)+'</td>'+
                        '<td>'+parseInt(val.abonado).toFixed(0)+'</td>'+
                        '<td>'+parseInt(val.saldo).toFixed(0)+'</td>'+
                        '<td>'+val.cuotas+'</td>'+
                        '<td><span class="text-uppercase">'+val.tipo_venta+'</span></td>'+
                        '<td>'+val.usuario_crea+'</td>'+
                        '<td>'+val.fecha+'</td>'+
                        '<td onclick="imprimir_factura('+val.id+')"><a style="cursor:pointer" ><i style="font-size:11px" class="fa fa-print"></i></a></td>'+
                        '<td onclick="eliminar_factura('+val.id+')"><a style="cursor:pointer" ><i style="font-size:11px" class="fa fa-window-close"></i></a></td>'+
                    '</tr>'
        });
        $("#tbodytable").html(fila)
        $('#example').DataTable({
            "ordering": false,
            "paging": false
        });

            $(".editar").click(function() {
                var valores=[];
    
                // Obtenemos todos los valores contenidos en los <td> de la fila
                // seleccionada
                $(this).parents("tr").find("td").each(function(){
                    valores.push($(this).html());
                });
                $("input[name*='vl_abono1']").focus()
                $("input[name*='id1']").val(valores[1])
                $("input[name*='nombre1']").val(valores[2])
            })
        
        },
        error: function() {
        //$(".loader").css("display", "")
        console.log("No se ha podido obtener la información");
        }
    });
    
  }

  function imprimir_factura(id) {
    window.open('/restaurante/inventario/reports/facturas.php?id='+id, '_blank');
  }

  function Showfactura_terminadas(bodega, tipo_venta) {
        let values = { 
            cod: "3",
            parametro1: tipo_venta,
            parametro2: bodega
        }; 
        $.ajax({
        type : 'POST',
        data: values,
        url: '/inventario/php/cuentaxcobrar/seleccionar.php',
        beforeSend: function() {
            //$(".loader").css("display", "inline-block")
        },
        success: function(respuesta) {
        //$(".loader").css("display", "none")
        let obj = JSON.parse(respuesta)
        $("#example1").dataTable().fnDestroy();
        let fila = ''
        $.each(obj.resultado, function( index, val ) {
            fila += '<tr>'+
                        '<td onclick="Showabono('+val.id+')" class="editar"><h6><span style="cursor:pointer" class="badge badge-info"><i class="fa fa-eye"></i></span></h6></td>'+
                        '<td>'+val.id+'</td>'+
                        '<td>'+val.nombre+'</td>'+
                        '<td>'+parseInt(val.valor_factu).toFixed(0)+'</td>'+
                        '<td>'+parseInt(val.abonado).toFixed(0)+'</td>'+
                        '<td>'+parseInt(val.saldo).toFixed(0)+'</td>'+
                        '<td>'+val.cuotas+'</td>'+
                        '<td><span class="text-uppercase">'+val.tipo_venta+'</span></td>'+
                        '<td>'+val.usuario_crea+'</td>'+
                        '<td>'+val.fecha+'</td>'+
                        '<td onclick="imprimir_factura('+val.id+')"><a style="cursor:pointer" ><i style="font-size:11px" class="fa fa-print"></i></a></td>'+
                        '<td onclick="eliminar_factura('+val.id+')"><a style="cursor:pointer" ><i style="font-size:11px" class="fa fa-window-close"></i></a></td>'+
                    '</tr>'
        });
        $("#tbodytable1").html(fila)
        $('#example1').DataTable({
            "ordering": false,
            "paging": false
        });

            $(".editar").click(function() {
                var valores=[];
    
                // Obtenemos todos los valores contenidos en los <td> de la fila
                // seleccionada
                $(this).parents("tr").find("td").each(function(){
                    valores.push($(this).html());
                });
                $("input[name*='vl_abono1']").focus()
                $("input[name*='id1']").val(valores[1])
                $("input[name*='nombre1']").val(valores[2])
            })
        
        },
        error: function() {
        //$(".loader").css("display", "")
        console.log("No se ha podido obtener la información");
        }
    });
    
  }

  function Showabono(factura) {
        Showdetalle_factura(factura)
        let values = { 
            cod: "2",
            parametro1: factura,
            parametro2: "1"
        }; 
        $.ajax({
        type : 'POST',
        data: values,
        url: '/inventario/php/cuentaxcobrar/seleccionar.php',
        beforeSend: function() {
            //$(".loader").css("display", "inline-block")
        },
        success: function(respuesta) {
            //$(".loader").css("display", "none")
            let obj = JSON.parse(respuesta)
            let fila = ''
            $.each(obj.resultado, function( index, val ) {
                fila += '<tr>'+
                            '<td>'+val.id+'</td>'+
                            '<td>'+val.vl_abono+'</td>'+
                            '<td>'+val.fecha+'</td>'+
                            '<td class="editar"><a style="cursor:pointer" ><i style="font-size:11px" class="fa fa-window-close"></i></a></td>'+
                        '</tr>'
            });
            $("#tbodyabono").html(fila)
        
        },
        error: function() {
        //$(".loader").css("display", "")
        console.log("No se ha podido obtener la información");
        }
    });
    
  }

  function Showdetalle_factura(factura) {
        let values = { 
            cod: "2",
            parametro1: factura,
            parametro2: 1,
        }; 
        $.ajax({
        type : 'POST',
        data: values,
        url: '/inventario/php/facturacion/seleccionar.php',
        beforeSend: function() {
            //$(".loader").css("display", "inline-block")
        },
        success: function(respuesta) {
        //$(".loader").css("display", "none")
        let obj = JSON.parse(respuesta)
        let fila = ''
        let total_iva = 0
        let sub_total = 0
        $.each(obj.resultado, function( index, val ) {
            total_iva += (parseInt(val.iva)*parseInt(val.cantidad)*(val.vl_venta))/100
            sub_total += parseInt(val.cantidad)*(val.vl_venta)-((parseInt(val.iva)*parseInt(val.cantidad)*(val.vl_venta))/100)
            fila += '<tr>'+
                        '<td class="id_productos" style="display:none" >'+val.id+'</td>'+
                        '<td>'+val.id_producto+'</td>'+
                        '<td>'+val.nombre_producto+'</td>'+
                        '<td>'+val.cantidad+'</td>'+
                        '<td>'+val.vl_venta+'</td>'+
                        '<td>'+parseFloat((parseInt(val.iva)*parseInt(val.cantidad)*(val.vl_venta))/100).toFixed(2)+'</td>'+
                        '<td>'+parseFloat(parseInt(val.cantidad)*(val.vl_venta)-((parseInt(val.iva)*parseInt(val.cantidad)*(val.vl_venta))/100)).toFixed(2)+'</td>'+
                        '<td>'+parseFloat(parseInt(val.cantidad)*(val.vl_venta)).toFixed(2)+'</td>'+
                        //'<td class="editar"><a style="cursor:pointer" onclick="ver_editar()" ><i style="font-size:11px" class="fa fa-pencil-square-o"></i></a></td>'+
                        '<td class="borrar"><a style="cursor:pointer" onclick="confirmar_eliminacion('+val.id+')" ><i style="font-size:11px" class="fa fa-window-close"></i></a></td>'+
                    '</tr>'
        });
        $("#tbodydetalle_factura").html(fila)
            //$('#example').DataTable().ajax.reload();
        },
        error: function() {
        //$(".loader").css("display", "")
        console.log("No se ha podido obtener la información");
        }
    });
    
  }

    function limpiar_form() {
            $("input[name*='id1']").val("")
            $("input[name*='nombre1']").val("")
            $("input[name*='vl_abono1']").val("")
    }

    function btn_guardar() {
        $("#submit_guardar").click()
    }

    function ver_credito(consec) {
        $("#tbodydetalle_factura").html("")
        if (consec == "credito") {
            $("#ver_credito").css("display", "block")
            limpiar_form()
            $("#tbodyabono").html("")
        }else{
            $("#ver_credito").css("display", "none")
        }
    }

    function ver_editar() {
        $(".editar").click()
        $("#ver_editar").css("display", "block")
        $("#ver_guardar").css("display", "none")
    }

    function eliminar_factura(id) {
        $.confirm({
            title: 'Atención!',
            content: '¿ Estas seguro de que quieres eliminar la factura número '+id+' ?',
            buttons: {
                confirm: function () {
                    if ($("#bodega").val() == 0) {
                        notificacion("Por favor seleccione la bodega.", "danger")
                        $("#bodega").focus()
                        return false
                    }
                    let values = {
                        id_factura: id,
                        tipo_venta: $("input[name^=tipo_venta]:checked").val(),
                        bodega: $("#bodega").val()
                    }
                    $.ajax({
                        type : 'POST',
                        data: values,
                        url: '/inventario/php/cuentaxcobrar/eliminar.php',
                        success: function(respuesta) {
                        let obj = JSON.parse(respuesta)
                        if (obj.numero == 1) {
                            //$.alert('Confirmed!');
                            notificacion("el producto se ha eliminado exitosamente.", "success")
                            //limpiar_form()
                            Showfactura_pendientes($("input[name^=tipo_venta]:checked").val())
                        }else{
                            notificacion("El producto no se encuentra en la base de datos, por favor actualice la página.", "danger")
                        }
                        },
                        error: function() {
                        console.log("No se ha podido obtener la información");
                        }
                    });
                },
                cancel: function () {
                    //$.alert('Canceled!');
                }
            }
        });
    }

</script>
</body>
</html>
