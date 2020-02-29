<?php
// start a session
session_start();
 if (!isset($_SESSION['idUser'])) {
    header ("Location:/restaurante/inventario/index.php"); 
 }
// manipulate session variables
?>
<nav style="font-size:12px" class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <div class="container">
        <a style="color:#fff" href="/restaurante/inventario/home.php"><img src="/inventario/assets/img/logo-invert.svg" width="40px" alt="" srcset=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/restaurante/inventario/home.php">Inicio</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Usuarios
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Registrar cliente</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Añadir usuario</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Ventas
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Nueva venta</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Registrar productos</a>
                    <a class="dropdown-item" href="#">Registrar proveedores</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Cuentas
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Buscar cuentas por cobrar</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Buscar cuentas por pagar</a>
                    <a class="dropdown-item" href="#">Registrar egresos</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Registrar ingresos</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" >Caja general</a>
            </li>
        </ul>
        <div class="form-inline my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $_SESSION['nameUser'];?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <!-- <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a> -->
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/restaurante/inventario/php/cerrar_sesion.php">Cerrar sesión</a>
                </div>
                </li>
            </ul>
        </div>
        </div>
    </div>
  </nav>
  <script src="/inventario/assets/js/jquery.slim.min.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script>
  let idUser = "<?php echo $_SESSION['idUser'];?>";
  let profile = "<?php echo $_SESSION['profile'];?>";
  $(function() {
        console.log( "ready!" );
  });
  function notificacion(message, type) {
    $.notify({
	    message: message,
        type: type,
    });
  }

  function permisos(modulo) {
          let values = { 
              cod: "1",
              parametro1: idUser,
              parametro2: profile,
              parametro3: modulo
          }; 
        $.ajax({
        type : 'POST',
        data: values,
        url: '/inventario/php/sel_menu.php',
        beforeSend: function() {
            //$(".loader").css("display", "inline-block")
        },
        success: function(respuesta) {
        //$(".loader").css("display", "none")
            let obj = JSON.parse(respuesta)
            if (obj.success) {
                $.each(obj.resultado, function( index, val ) {
                    if (val.restriccion !== "0") {
                        alert("Usted no posee permisos para esta acción")
                        window.location.href = '/restaurante/inventario/home.php';
                    }                
                });    
            }else{
                alert("Usted no posee permisos para esta acción")
                window.location.href = '/restaurante/inventario/home.php';
                console.log("No se ha podido obtener la información");
            }
            
        },
        error: function() {
            alert("Usted no posee permisos para esta acción")
            window.location.href = '/restaurante/inventario/home.php';
            console.log("No se ha podido obtener la información");
        }
    });
    
  }

  function cuentas(bodega) {
          let values = { 
              cod: "1",
              parametro1: bodega,
              parametro2: 2
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
              $('.total_efectivo').text(val.vl_efectivo)
              $('.total_tarjeta').text(val.vl_tarjeta)
              $('.total_credito').text(val.vl_credito)
              $('.vl_facturas_credito').text(val.vl_facturas_credito)
            });
        },
        error: function() {
            //$(".loader").css("display", "")
            console.log("No se ha podido obtener la información");
        }
    });
    
  }

  function buscar_bodegas() {
    let values = { 
            cod: "1",
            parametro1: profile,
            state: '1'
        }; 
        $.ajax({
        type : 'POST',
        data: values,
        url: '/inventario/php/bodega/seleccionar.php',
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
            $(".id_bodegas").html('<option value="0">Seleccione el bodegas</option>'+fila)
        },
        error: function() {
        //$(".loader").css("display", "")
        console.log("No se ha podido obtener la información");
        }
    });
    
  }

  function buscar_categorias(param) {
    let values = { 
            cod: "2",
            state: '1'
        }; 
        $.ajax({
        type : 'POST',
        data: values,
        url: '/inventario/php/categoria/seleccionar.php',
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
            $(".id_categoria").html('<option value="">Seleccione el categoría</option>'+fila)
        },
        error: function() {
        //$(".loader").css("display", "")
        console.log("No se ha podido obtener la información");
        }
    });
    
  }

  function buscar_proveedores(param) {
    let values = { 
            cod: "2",
            state: '1'
        }; 
        $.ajax({
        type : 'POST',
        data: values,
        url: '/inventario/php/proveedor/seleccionar.php',
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
            $(".id_proveedor").html('<option value="">Seleccione el proveedor</option>'+fila)
        },
        error: function() {
        //$(".loader").css("display", "")
        console.log("No se ha podido obtener la información");
        }
    });
    
  }

  </script>