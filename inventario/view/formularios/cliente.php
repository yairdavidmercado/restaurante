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
    <meta name="viewport" content="width=device-width, iidentificacionial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Inventario</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/offcanvas/">

    <!-- Bootstrap core CSS -->
<link href="../../assets/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
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

<main role="main" class="container py-5">
  <div class="py-5 bg-white rounded shadow-sm">
    <div class="container">
    <div class="row">
            <div class="col-sm-3">
                <!-- form user info -->
                <div id="ver_editar" style="display:none" class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Editar cliente</h5>
                    </div>
                    <div class="card-body">
                        <form class="form" id="form_actualizar" role="form" onsubmit="event.preventDefault(); return actualizar_cliente();" autocomplete="off">
                            <div class="container">
                            <div style="display:none" class="form-group">
                                    <input class="form-control form-control-sm" name="id1" type="text" placeholder="identificación">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-sm" required name="identificacion1" type="text" placeholder="identificación">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-sm" required name="nombre1" type="text" placeholder="Nombre">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-sm" required name="direccion1" type="text" placeholder="Dirección">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-sm" required name="telefono1" type="text" placeholder="Teléfono">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-sm" required name="email1" type="text" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <select class="form-control form-control-sm" name="state1" id="">
                                        <option value="">Estado</option>
                                        <option value="1">ACTIVO</option>
                                        <option value="0">INACTIVO</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success" type="submit">guardar</button>
                                    <button class="btn btn-primary" type="button" onclick="ver_guardar()">Nuevo</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="ver_guardar" class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Crear cliente</h5>
                    </div>
                    <div class="card-body">
                        <form class="form" id="form_guardar" role="form" methods="POST" onsubmit="event.preventDefault(); return guardar_cliente();" autocomplete="off">
                            <div class="container">
                                <div class="form-group">
                                    <input ref="identificacion" class="form-control form-control-sm" required name="identificacion" type="text" placeholder="identificación">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-sm" required name="nombre" type="text" placeholder="Nombre">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-sm" required name="direccion" type="text" placeholder="Dirección">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-sm" required name="telefono" type="text" placeholder="Teléfono">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-sm" required name="email" type="text" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Agregar</button>
                                    <button class="btn btn-danger" type="button" @click="limpiarcliente()">Limpiar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /form user info -->
            </div>
            <div class="col-sm-9">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">cliente</h5>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table" id="example" style="width:100%; font-size:11px">
                            <thead class="thead-light">
                                <tr>
                                    <th style="display:none" scope="col">identificacion</th>
                                    <th scope="col">Identificacion</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Dirección</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col">Email</th>
                                    <th style="display:none" scope="col">Estado</th>
                                    <th style="width:10px" scope="col"></th>
                                    <th style="width:10px" scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="tbodytable">
                                <!-- <tr>
                                    <td>{{item.identificacion}}</td>
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
<script>
$(function() {
        permisos("clientes")
        Showcliente()
        console.log( "index!" );
  });
  function guardar_cliente() {
      $.ajax({
        type : 'POST',
        data: $("#form_guardar").serialize(),
        url: '/inventario/php/cliente/guardar.php',
        success: function(respuesta) {
          let obj = JSON.parse(respuesta)
          if (obj.success) {
            notificacion("El cliente ha sido guardado exitosamente.", "success")
            limpiar_form()
            Showcliente()
            $("input[name*='identificacion']").focus()
          }else{
            alert('Datos invalidos para el acceso')
          }
        },
        error: function() {
          console.log("No se ha podido obtener la información");
        }
      });
      
    }

    function actualizar_cliente() {
      $.ajax({
        type : 'POST',
        data: $("#form_actualizar").serialize(),
        url: '/inventario/php/cliente/actualizar.php',
        success: function(respuesta) {
          let obj = JSON.parse(respuesta)
          if (obj.success) {
            notificacion("El cliente ha sido actualizado exitosamente.", "success")
            //limpiar_form()
            Showcliente()
            $("input[name*='identificacion1']").focus()
          }else{
            alert('Datos invalidos para el acceso')
          }
        },
        error: function() {
          console.log("No se ha podido obtener la información");
        }
      });
      
    }

    function Showcliente() {
        let values = { 
            cod: "1",
            state: 1,
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
        $("#example").dataTable().fnDestroy();
        let fila = ''
        $.each(obj.resultado, function( index, val ) {
            fila += '<tr>'+
                        '<td style="display:none">'+val.id+'</td>'+
                        '<td>'+val.identificacion+'</td>'+
                        '<td>'+val.nombre+'</td>'+
                        '<td>'+val.direccion+'</td>'+
                        '<td>'+val.telefono+'</td>'+
                        '<td>'+val.email+'</td>'+
                        '<td style="display:none">'+val.state+'</td>'+
                        '<td>'+val.fecha+'</td>'+
                        '<td class="editar"><button class="btn btn-warning btn-sm" onclick="ver_editar()" >Editar</button></td>'+
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
            $("input[name*='id1']").val(valores[0])
            $("input[name*='identificacion1']").val(valores[1])
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

    function limpiar_form() {
        $("input[name*='identificacion']").val("")
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
