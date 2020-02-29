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
<link href="/inventario/assets/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
<link href="/inventario/assets/css/select2.min.css" rel="stylesheet" crossorigin="anonymous">
<link href="../../assets/css/bootstrap-datepicker.css" rel="stylesheet" crossorigin="anonymous">
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
  <div class="py-2 bg-white rounded shadow-sm">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <select ref="select" onchange="buscar_productos(this.vale)" class="form-control form-control-sm id_bodegas" id="bodega" name="bodega">
                        <option value="">Seleccione el bodegas</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-9">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Venta</h5>
                    </div>
                    <div class="card-body">
                        <div class="card mb-4">
                            <div class="card-body">
                                <form class="form" id="form_detalle_factura" role="form" onsubmit="event.preventDefault(); return guardar_detalle_factura();" autocomplete="off">
                                    <div class="container">
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label style="font-size:14px" for="">Producto</label>
                                                <br>
                                                <select onchange="productos_detalle(this.value, $('#bodega').val())" style="width:100%" required class="form-control select2-single id_producto" name="id_producto" id="id_producto">
                                                    <option value="">Seleccione el producto</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <label style="font-size:14px" for="">Valor de venta x unidad</label>
                                                <input class="form-control form-control-sm" required name="vl_venta" type="text" placeholder="Valor de venta x unidad">
                                            </div>
                                            <div class="form-group col-sm-2">
                                                <label style="font-size:14px" for="">Cantidad</label>
                                                <input class="form-control form-control-sm" required name="cantidad" id="cantidad" type="text" placeholder="Cantidad">
                                            </div>    
                                            <div class="form-group col-sm-1" style="margin-top:30px">
                                                <button class="btn btn-primary float-right btn-sm" type="submit"><i class="fa fa-floppy-o" style="font-size:18px"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="form-group col-sm-12 table-responsive">
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
                                        <tbody id="tbodytable">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <form class="form" id="form_factura" role="form" onsubmit="event.preventDefault(); return guardar_factura();" autocomplete="off">
                            <div class="row">
                                <div class="form-group col-sm-3">
                                    <label style="font-size:14px" for="">Fecha de venta</label>
                                    <input class="form-control form-control-sm fecha" required name="fecha_venta" type="text" placeholder="Fecha de venta">
                                </div>
                                <div class="col-sm-9">
                                    <label style="font-size:14px; margin-top:-1px;" for="">Tipo de venta</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input id="debit" value="efectivo" onclick="datos_clientes('0')" name="tipo_venta" type="radio" class="custom-control-input" checked="" required="">
                                        <label class="custom-control-label" for="debit">Efectivo</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input id="bank" value="tarjeta" onclick="datos_clientes('0')" name="tipo_venta" type="radio" class="custom-control-input" required="">
                                        <label class="custom-control-label" for="bank">Tarjeta</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input id="credit" value="credito" onclick="datos_clientes('1')" name="tipo_venta" type="radio" class="custom-control-input" required="">
                                        <label class="custom-control-label" for="credit">Crédito</label>
                                    </div>
                                </div>
                                <div id="content_cliente">
                                </div>
                                <div id="btn_guardar" class="col-sm-12">
                                    <button type="submit" class="btn btn-success float-right">Facturar</button>
                                </div>
                                <div style="display:none" id="btn_guardar_credito" class="col-sm-12">
                                    <button type="submit" class="btn btn-success float-right">Facturar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div id="ver_guardar" class="card">
                    <div class="card-body">
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div class="text-success">
                                    <h6 class="my-0" style="font-size:12px">Existencia actual del producto seleccionado</h6>
                                    <small id="vl_costo" class="text-muted"></small>
                                </div>
                                <span class="text-muted" id="existencias"></span>
                            </li>
                            <li style="background-color: #f7f7f7" class="list-group-item d-flex justify-content-between lh-condensed">
                                <form class="form" id="form_guardar" role="form" methods="POST" onsubmit="event.preventDefault(); return guardar_venta();" autocomplete="off">
                                    <div class="container">
                                        <div class="form-group">
                                            <label style="font-size:12px; margin-bottom:-30px" for="">Subtotal</label>
                                            <input disabled ref="nit" class="form-control form-control-sm" name="subtotal" type="text">
                                        </div>
                                        <div style="margin-top:-15px" class="form-group">
                                            <label style="font-size:12px; margin-bottom:-30px" for="">IVA</label>
                                            <input disabled class="form-control form-control-sm" name="iva" type="text">
                                        </div>
                                        <div style="margin-top:-15px" class="form-group">
                                            <label style="font-size:12px; margin-bottom:-30px" for="">Total</label>
                                            <input disabled class="form-control form-control-sm" name="total_pagar" type="text">
                                        </div>
                                    </div>
                                </form>
                            </li>
                            <li style="background-color: #f7f7f7" class="list-group-item d-flex justify-content-between lh-condensed">
                                <div class="container">
                                    <div class="form-group">
                                        <label style="font-size:12px; margin-bottom:-30px" for="">Efectivo</label>
                                        <input disabled class="form-control form-control-sm" name="efectivo" type="text">
                                    </div>
                                    <div style="margin-top:-15px" class="form-group">
                                        <label style="font-size:12px; margin-bottom:-30px" for="">Cambio</label>
                                        <input disabled class="form-control form-control-sm" name="cambio" type="text">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /form user info -->
            </div>
        </div>
    </div>
  </div>
</main>
<script src="/inventario/assets/js/jquery.slim.min.js" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="/inventario/assets/js/jquery.slim.min.js"><\/script>')</script>
    <script src="/inventario/assets/js/popper.min.js" crossorigin="anonymous"></script>
    <script src="/inventario/assets/js/ajaxJquery.min.js"></script>
    <script src="/inventario/assets/js/bootstrap-notify.min.js"></script>
    <script src="/inventario/assets/js/select2.full.js" crossorigin="anonymous"></script>
    <script src="/inventario/assets/js/boot4alert.min.js" crossorigin="anonymous"></script>
    <script src="/inventario/assets/js/jquery.dataTables.min.js"></script>
    <script src="/inventario/assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="/inventario/assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../../assets/js/bootstrap-datepicker.min.js"></script>

<script>
$(function() {
        permisos("ventas")
        buscar_bodegas()
        Showventa()
        buscar_productos()
        console.log( "index!" );

        $('.fecha').datepicker({
          format: "yyyy-mm-dd",
          todayHighlight: true,
          language:"es"                       
        });
  });
  function guardar_detalle_factura() {
        if ($("#bodega").val() == 0) {
            notificacion("Por favor seleccione la bodega.", "danger")
            $("#bodega").focus()
            return false
        }
        productos_detalle($("#id_producto").val(), $("#bodega").val())
        if(parseInt($("#existencias").text()) < parseInt($("#cantidad").val())){
            notificacion("la cantidad establecida no puede superar a la existencia actual del producto")
            return false
      }
      $.ajax({
        type : 'POST',
        data: $("#form_detalle_factura").serialize()+"&bodega="+$("#bodega").val(),
        url: '/inventario/php/facturacion/guardar_detalle_factura.php',
        success: function(respuesta) {
          let obj = JSON.parse(respuesta)
          if (obj.numero == 1) {
            notificacion("el producto se ha agregado exitosamente.", "success")
            //limpiar_form()
            Showventa()
            $("input[name*='id_producto']").focus()
          }else{
            notificacion("El producto ya se encuentra agregado.", "danger")
          }
        },
        error: function(e) {
        alert(e)
          //console.log("No se ha podido obtener la información");
        }
      });
      
    }

    function eliminar_detalle_factura(id) {
        let values = {
            id: id
        }
        $.ajax({
        type : 'POST',
        data: values,
        url: '/inventario/php/facturacion/eliminar.php',
        success: function(respuesta) {
          let obj = JSON.parse(respuesta)
          if (obj.numero == 1) {
            notificacion("el producto se ha eliminado exitosamente.", "success")
            //limpiar_form()
            Showventa()
            $("input[name*='id_producto']").focus()
          }else{
            notificacion("El producto no se encuentra en la base de datos, por favor actualice la página.", "danger")
          }
        },
        error: function() {
          console.log("No se ha podido obtener la información");
        }
      });
      
    }

    function Showventa() {
        let values = { 
            cod: "1",
            parametro1: idUser,
            parametro2: 0,
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
        $("#example").dataTable().fnDestroy();
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
        $("input[name*='subtotal']").val(parseFloat(sub_total).toFixed(2))
        $("input[name*='iva']").val(parseFloat(total_iva).toFixed(2))
        $("input[name*='total_pagar']").val(parseFloat(parseFloat(total_iva)+parseFloat(sub_total)).toFixed(2))
        $("#tbodytable").html(fila)
        $('#example').DataTable({
            "ordering": false
        });

        $(".editar").click(function() {
            var valores=[];
 
            // Obtenemos todos los valores contenidos en los <td> de la fila
            // seleccionada
            $(this).parents("tr").find("td").each(function(){
                valores.push($(this).html());
            });
            $("input[name*='id1']").val(valores[0])
            $("input[name*='nit1']").val(valores[1])
            $("input[name*='nombre1']").val(valores[2])
            $("input[name*='direccion1']").val(valores[3])
            $("input[name*='telefono1']").val(valores[4])
            $("input[name*='email1']").val(valores[5])
            $("select[name*='state1']").val(valores[6])
        })
            //$('#example').DataTable().ajax.reload();
        },
        error: function() {
        //$(".loader").css("display", "")
        console.log("No se ha podido obtener la información");
        }
    });
    
  }

  function guardar_factura() {
      if ($("#bodega").val() == 0) {
        notificacion("Por favor seleccione la bodega.", "danger")
        $("#bodega").focus()
        return false
      }
    let productos = []
    $(".id_productos").each(function(){
        productos.push($(this).text())
    });
    let values = ''
    if ($("input[name=tipo_venta]:checked").val() == 'credito') {
            values = $("#form_factura").serialize() + "&iva_factu="+$("input[name*='iva']").val()+"&subtotal_factu="+$("input[name*='subtotal']").val()+"&valor_factu="+$("input[name*='total_pagar']").val()+"&id_productos="+productos.toString()+"&bodega="+$("#bodega").val()
            console.log(values)
        }else{
            values = $("#form_factura").serialize() + "&iva_factu="+$("input[name*='iva']").val()+"&subtotal_factu="+$("input[name*='subtotal']").val()+"&valor_factu="+$("input[name*='total_pagar']").val()+"&tipo_venta="+$("input[name=tipo_venta]:checked").val()+"&cuotas=0&id_cliente=0&id_productos="+productos.toString()+"&bodega="+$("#bodega").val()
            console.log(values)
        }
    if (productos.length == 0) {
        notificacion("No existe producto agregado a la lista para generar la factura.", "success")
        return false
    }
      $.ajax({
        type : 'POST',
        data: values,
        url: '/inventario/php/facturacion/guardar_factura.php',
        success: function(respuesta) {
          let obj = JSON.parse(respuesta)
          if (obj.success) {
                window.open('/restaurante/inventario/reports/facturas.php?id='+obj.numero, '_blank');
            notificacion("La factura se ha agregado exitosamente.", "success")
            //limpiar_form()
            Showventa()
            $("input[name*='id_producto']").focus()
          }else{
            notificacion("La factura ya se encuentra agregado.", "danger")
          }
        },
        error: function(e) {
        alert(JSON.stringify(e))
          //console.log("No se ha podido obtener la información");
        }
      });
      
    }

  function buscar_productos(bodega = 0) {
    let values = { 
            cod: "2",
            parametro1: '1',
            parametro2: bodega
        }; 
        $.ajax({
        type : 'POST',
        data: values,
        url: '/inventario/php/producto/seleccionar.php',
        beforeSend: function() {
            //$(".loader").css("display", "inline-block")
        },
        success: function(respuesta) {
            $("input[name*='vl_venta']").val("")
            $("#vl_costo").text("")
            $("#existencias").text("")
            //$(".loader").css("display", "none")
            let obj = JSON.parse(respuesta)
            let fila = ''
            $.each(obj.resultado, function( index, val ) {
                fila += '<option value="'+val.id+'">'+val.id+' - '+val.nombre+'</option>';
            });
            $(".id_producto").html('<option value="">Seleccione el producto</option>'+fila)
            let placeholder = "Seleccione el producto";

            $(".id_producto").select2( {
                placeholder: placeholder,
                width: 'resolve'
            });
        },
        error: function() {
        //$(".loader").css("display", "")
        console.log("No se ha podido obtener la información");
        }
    });
    
  }

  function productos_detalle(id, bodega) {
    let values = { 
            cod: "3",
            parametro1: id,
            parametro2: bodega
        }; 
        $.ajax({
        type : 'POST',
        data: values,
        url: '/inventario/php/producto/seleccionar.php',
        beforeSend: function() {
            //$(".loader").css("display", "inline-block")
        },
        success: function(respuesta) {
            //$(".loader").css("display", "none")
            let obj = JSON.parse(respuesta)
            $.each(obj.resultado, function( index, val ) {
                $("input[name*='vl_venta']").val(parseInt(val.vl_venta))
                $("#vl_costo").text('$ '+parseInt(val.total_costo)+' C/U')
                $("#existencias").text(val.cantidad)
            });
           
            //$(".id_producto").html('<option value="">Seleccione el producto</option>'+fila)
        },
        error: function() {
        //$(".loader").css("display", "")
        console.log("No se ha podido obtener la información");
        }
    });
    
  }

  function buscar_clientes(param) {
    let values = { 
            cod: "2",
            state: '1'
        }; 
        $.ajax({
        type : 'POST',
        data: values,
        url: '/inventario/php/cliente/seleccionar.php',
        beforeSend: function() {
            //$(".loader").css("display", "inline-block")
        },
        success: function(respuesta) {
            //$(".loader").css("display", "none")
            let obj = JSON.parse(respuesta)
            let fila = ''
            $.each(obj.resultado, function( index, val ) {
                fila += '<option value="'+val.id+'">'+val.identificacion+' - '+val.nombre+'</option>';
            });
            $(".id_cliente").html('<option value="">Seleccione el cliente</option>'+fila)
            let placeholder = "Seleccione el cliente";

            $(".id_cliente").select2( {
                placeholder: placeholder,
                width: 'resolve'
            });
        },
        error: function() {
        //$(".loader").css("display", "")
        console.log("No se ha podido obtener la información");
        }
    });
    
  }


  function datos_clientes(id) {
      if (id == "1") {
            $("#content_cliente").html('<div class="form-group col-sm-12 py-3">'+
                                            '<div class="d-block">'+
                                                '<label style="font-size:14px;" for="">Datos del cliente</label>'+
                                                '<hr style="margin-top:-1px;">'+
                                                '<div class="row">'+
                                                    '<div class="col-sm-3">'+
                                                        '<input class="form-control form-control-sm" type="text" placeholder="Número de cuotas" required name="cuotas">'+
                                                    '</div>'+
                                                    '<div class="col-sm-6">'+
                                                        '<select required class="form-control form-control-sm select2-single id_cliente" name="id_cliente">'+
                                                            '<option value="">Seleccione el id_cliente</option>'+
                                                        '</select>'+
                                                    '</div>'+
                                                    '<div class="col-sm-3">'+
                                                        '<a style="font-size:14px;" href="/inventario/view/formularios/cliente.php" class="">Crear nuevo cliente</a>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>')
            buscar_clientes()
            $("#btn_guardar").css("display", "none")
            $("#btn_guardar_credito").css("display", "inline")                                        
      }else{
        $("#content_cliente").html('')
        $("#btn_guardar").css("display", "inline")
        $("#btn_guardar_credito").css("display", "none")
      }
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

    function confirmar_eliminacion(id) {

        boot4.confirm({
            title: "Advertencia",
            msg: "¿Estas seguro que deseas eliminar el regístro?",
            callback: function(result) {
            if(result){
                eliminar_detalle_factura(id)
                console.log("ok");
            }
            else{
                console.log("cancel");
            }
            }
        });
        
    }
</script>
</body>
</html>
