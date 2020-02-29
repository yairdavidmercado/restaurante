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
    <title>Usuarios</title>

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
  <div class="py-5 bg-white rounded shadow-sm">
    <div class="container">
    <div class="row">
            <div class="col-sm-3">
                <!-- form user info -->
                <div id="ver_editar" style="display:none" class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Editar usuario</h5>
                    </div>
                    <div class="card-body">
                        <form class="form" id="form_actualizar" role="form" onsubmit="event.preventDefault(); return actualizar_usuario();" autocomplete="off">
                            <div class="container">
                                <div style="display:none" class="form-group">
                                    <input class="form-control form-control-sm" name="id1" type="text" placeholder="identificación">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-sm" required name="nombre1" type="text" placeholder="Nombre">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-sm" required name="email1" type="text" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-sm" required name="telefono1" type="text" placeholder="Teléfono">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-sm" required name="password1" type="password" placeholder="Contraseña">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-sm" required name="password_confirmar1" type="password" placeholder="Confirmar contraseña">
                                </div>
                                <div class="form-group">
                                    <select class="form-control form-control-sm" name="perfil1" id="perfil1">
                                        <option value="">Seleccionar perfil</option>
                                        <option value="1">Administrador</option>
                                        <option value="2">Vendedor</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control form-control-sm" name="state1" id="state1">
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
                        <h5 class="mb-0">Crear usuario</h5>
                    </div>
                    <div class="card-body">
                        <form class="form" id="form_guardar" role="form" methods="POST" onsubmit="event.preventDefault(); return guardar_usuario();" autocomplete="off">
                            <div class="container">
                                <div class="form-group">
                                    <input class="form-control form-control-sm" required name="nombre" type="text" placeholder="Nombre">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-sm" required name="email" type="text" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-sm" required name="telefono" type="text" placeholder="Teléfono">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-sm" required id="password" name="password" type="password" placeholder="Contraseña">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-sm" required id="password_confirmar" name="password_confirmar" type="password" placeholder="Confirmar contraseña">
                                </div>
                                <div class="form-group">
                                    <select class="form-control form-control-sm" required name="perfil" id="">
                                        <option value="">Seleccionar perfil</option>
                                        <option value="1">Administrador</option>
                                        <option value="2">Vendedor</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Agregar</button>
                                    <button class="btn btn-danger" type="button" @click="limpiarusuario()">Limpiar</button>
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
                    <a class="btn btn-danger float-right btn-sm" target="_blank" href="/inventario/reports/usuarios.php" type="submit"><i class="fa fa-file-pdf-o" style="font-size:18px" ></i></a>
                        <h5 class="mb-0">Usuarios</h5>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table" id="example" style="width:100%; font-size:11px">
                            <thead class="thead-light">
                                <tr>
                                    <th style="display:none" scope="col">identificacion</th>
                                    <th scope="col">id</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col">Perfil</th>
                                    <th style="display:none" scope="col">Estado</th>
                                    <th scope="col">Fecha</th>
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
        permisos("usuarios")
        Showusuario()
        console.log( "index!" );
  });
  function guardar_usuario() {
      if ($("#password").val() !== $("#password_confirmar").val() ) {
          notificacion("Las contraseñas no coinciden.", "red")
          $("input[name*='password']").val("")
          $("input[name*='password_confirmar']").val("")
          return false
      }
      $.ajax({
        type : 'POST',
        data: $("#form_guardar").serialize(),
        url: '/inventario/php/usuario/guardar.php',
        success: function(respuesta) {
          let obj = JSON.parse(respuesta)
          if (obj.success) {
            notificacion("El usuario ha sido guardado exitosamente.", "success")
            limpiar_form()
            Showusuario()
            $("input[name*='nombre']").focus()
            $("input[name*='password']").val("")
            $("input[name*='password_confirmar']").val("")
          }else{
            alert('Datos invalidos para el acceso')
          }
        },
        error: function() {
          console.log("No se ha podido obtener la información");
        }
      });
      
    }

    function actualizar_usuario() {
        if ($("input[name*='password1']").val() !== $("input[name*='password_confirmar1']").val() ) {
            notificacion("Las contraseñas no coinciden.", "red")
            $("input[name*='password1']").val("")
            $("input[name*='password_confirmar1']").val("")
            return false
        }
      $.ajax({
        type : 'POST',
        data: $("#form_actualizar").serialize(),
        url: '/inventario/php/usuario/actualizar.php',
        success: function(respuesta) {
          let obj = JSON.parse(respuesta)
          if (obj.success) {
            notificacion("El usuario ha sido actualizado exitosamente.", "success")
            //limpiar_form()
            Showusuario()
            $("input[name*='nombre1']").focus()
            $("input[name*='password1']").val("")
            $("input[name*='password_confirmar1']").val("")
          }else{
            alert('Datos invalidos para el acceso')
          }
        },
        error: function() {
          console.log("No se ha podido obtener la información");
        }
      });
      
    }

    function Showusuario() {
        let values = { 
            cod: "1",
            state: 1,
        }; 
        $.ajax({
        type : 'POST',
        data: values,
        url: '/inventario/php/usuario/seleccionar.php',
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
                        '<td>'+val.id+'</td>'+
                        '<td>'+val.nombre+'</td>'+
                        '<td>'+val.email+'</td>'+
                        '<td>'+val.telefono+'</td>'+
                        '<td>'+val.perfil+'</td>'+
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
            $("input[name*='nombre1']").val(valores[2])
            $("input[name*='email1']").val(valores[3])
            $("input[name*='telefono1']").val(valores[4])
            $("#perfil1").val(valores[5])
            $("#state1").val(valores[6])
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
        $("input[name*='nombre']").val("")
        $("input[name*='password']").val("")
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
