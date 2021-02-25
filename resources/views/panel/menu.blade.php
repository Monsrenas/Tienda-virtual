<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel Administrativo</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

  <link rel="stylesheet" href="{{ URL::asset('dataTables-1.10.21/DataTables-1.10.21/css/jquery.dataTables.min.css') }}">

  {{-- datatables--}}
  <script type="text/javascript" src="{{ asset('dataTables-1.10.21/DataTables-1.10.21/js/jquery.dataTables.min.js')}}"></script>

  <link rel="stylesheet" href="{{asset('css/style.css')}}">
 
</head>
<body style="background: #ECF0F1;">
<!-- partial:index.partial.html -->
<html>
 
<nav class="navbar navbar-expand-md navbar-light fixed-top" style="background-color: #FFFFFF;  -webkit-box-shadow: 0 8px 6px -6px #999;
   -moz-box-shadow: 0 8px 6px -6px #999;
   box-shadow: 0 8px 6px -6px #999;">

        <button class="navbar-toggler navbar-nav mr-auto" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span> 
        </button>

        <a class="navbar-brand mx-auto" href="/panel">{{ $_SESSION['empresa']['nombre_comercial'] ?? "Panel de control de tienda virtual" }}</a>
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Entrar</a>
            </li>
        @else
        <ul class="nav navbar-nav ml-md--auto"> 

                <li class="dropdown"> 

                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false"> 
                            {{ Auth::user()->nombre }} <b class="caret"></b>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('/Perfil') }}">Mi perfil</a>
                          
                                <div class="dropdown-divider"></div>
                               
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Cerrar Sección
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                        </div>

                </li> 
        </ul>
        @endguest


</nav>

<?php 
    $acceso=Auth::user()->acceso ?? [];
    $rol=Auth::user()->rol ?? "1";
?>

  <body>
   
    <?php 
   
    if ((Auth::user()->estado!="1")and($rol>1)) 
      { 
        echo "<div style='text-align: center; width: 100%; margin-top: 300px;'>
          <h1>Usuario Desactivado, consulte al administrador del sistema</h1>
        </div>";
        return;
      }
    ?> 
         
    <div class="area"></div>
    <nav class="main-menu" style="color: black; color: black; margin-top: 57px; position: fixed;">
            <ul>     
                @if (( count( array_intersect_key($acceso,['pp'=>0,'pu'=>0]) )>0 )or($rol=="1"))
                <li>
                    <span  class='caret'>
                        <a href="#" >
                            <i class="fa fa-users  fa-2x"></i>
                            <span class="fa">
                                Personas
                            </span>
                        </a>
                    </span>
                    <ul class='nested'>
                       @if ((isset($acceso['pp']))or($rol=="1"))
                        <li>
                           <a href="{{url('Listas/Persona/auth.personas.Lista_personas')}}" style="float: left;" >Personas </a>
                            <a href="javascript:Registros('auth.personas.registraPersona', 'Usuario', '_id')">
                                  <i class="fa fa-plus-square-o text-right" style=" font-size: 0.98em; vertical-align: middle; height: 21px; width: 121px; padding-right: 2px; color: white;"></i>
                            </a> 
                        </li>
                        @endif   

                       @if ((isset($acceso['pu']))or($rol=="1"))
                        <li>               
                           <a href="{{url('Listas/Usuario/auth.personas.Lista_usuarios')}}" style="float: left;" >Usuarios </a>
                            <a href="javascript:Registros('auth.personas.registraUsuario', 'Usuario', '_id')">
                                  <i class="fa fa-plus-square-o text-right" style=" font-size: 0.98em; vertical-align: middle; height: 21px; width: 121px; padding-right: 2px; color: white;"></i>
                            </a> 
                        </li>
                        @endif     

                    </ul>           
                </li>
                @endif

                @if ( count( array_intersect_key($acceso,['cp'=>0,'cf'=>0,'cm'=>0,'cc'=>0]) )>0 ) 
                <li>
                    <span class="caret">
                        <a href="#" >
                            <i class="fa fa-list fa-2x"></i>
                            <span class="fa" >
                                Catálogos
                            </span>
                        </a>
                    </span>
                    <ul class='nested'>

                       @if (isset($acceso['cp']))
                        <li> 
                           <a href="{{url('/Listas/Producto/panel.producto')}}" style="float: left;" >Productos </a>
                            <a href="{{url('/productos')}}">
                                  <i class="fa fa-plus-square-o text-right" style=" font-size: 0.98em; vertical-align: middle; height: 21px; width: 121px; padding-right: 2px; color: white;"></i>
                            </a> 
                        </li>
                        @endif

                        @if (isset($acceso['cf']))
                        <li><a href="{{url('/Listas/Fabricante/panel.lista_fabricante')}}">Fabricantes</a></li>
                        @endif

                        @if (isset($acceso['cm']))
                        <li><a href="{{url('EdicionMarcaModelo')}}">Marcas y Modelos</a></li>
                        @endif

                        @if (isset($acceso['cc']))
                        <li><a href="{{url('/editaCategoria')}}">Categorias</a></li>    
                        @endif

                    </ul>       
                </li>
                @endif

                @if ( count( array_intersect_key($acceso,['ii'=>0, 'im'=>0,'ie'=>0,'ia'=>0]) )>0 )
                <li>
                    <span  class='caret'>
                        <a href="#" >
                            <i class="fa fa-book fa-2x"></i>
                            <span class="fa">
                                Inventario
                            </span>
                        </a>
                    </span>
                    <ul class='nested'>
                      @if ( isset($acceso['ii']) )  
                        <li><a href="{{url('Pre_recepcion')}}">Ingreso</a></li>
                      @endif

                      @if ( isset($acceso['im'] ))      
                        <li><a href="{{url('ListadoRecepciones')}}">Movimientos</a></li> 
                      @endif

                      @if ( isset($acceso['ie'] )) 
                        <li><a href="{{url('ListadoInventario ')}}">Existencia</a></li> 
                      @endif                   
                      @if ( isset($acceso['ia'] ))
                          <li><a href="{{url('/Listas/Almacen/inventario.lista_almacen')}}">Almacenes</a></li>
                      @endif 
                    </ul>       
                </li>
                @endif

                @if ( count( array_intersect_key($acceso,['vf'=>0, 'vd'=>0,'vc'=>0,'vl'=>0,'vo'=>0]) )>0 )
                <li>
                    <span  class='caret'><a href="#"><i class="fa fa-shopping-cart fa-2x"></i>
                          <span class="fa" style="text-align: left;">
                              Ventas
                          </span>
                      </a>
                    </span>
                    <ul class='nested'>
                      {{--
                      @if ( isset(Auth::user()->acceso['or'] ))  
                        <li><a href="{{url('Pre_recepcion')}}">Venta</a></li>
                      @endif
                      --}}
                      @if ( isset(  $acceso['vf'] )) 
                        <li><a href="{{url('/Listas/Pedido/ventas.Lista_pedidos')}}">Facturar Pedido</a></li>      
                      @endif

                      @if ( isset($acceso['vd'] )) 
                        <li><a href="{{url('/Listas/Factura/ventas.Lista_facturas')}}">Despacho de Factura</a></li> 
                      @endif    

                      @if ( isset($acceso['vc'] )) 
                      <li><a href="{{url('/Listas/Factura/ventas.Lista_Cancelar')}}">Cancelación de venta</a></li>
                      @endif

                      @if ( isset($acceso['vl'] )) 
                       <li><a href="{{url('/Listas/Cancelacion/ventas.Lista_Cancelar')}}">Listado de Cancelaciones</a></li>
                      @endif

                      @if ( isset($acceso['vo'] ))   
                      <li><a href="{{url('/Listas/Descuento/panel.ofertas/_id,=,0')}}">Ofertas</a></li>
                      @endif
                    </ul>       
                </li>
                @endif

                @if ( count( array_intersect_key($acceso,['cd'=>0, 'ct'=>0,'cb'=>0]) )>0 )
                <li>
                    <span  class='caret'>
                        <a href="#"  >
                            <i class="fa fa-cogs" aria-hidden="true"></i>
                            <span class="fa">
                                Configuración
                            </span>
                        </a>
                    </span>
                    <ul class='nested'>

                        @if ( isset($acceso['cd'] ))
                         <li><a href="{{url('/editaEmpresa')}}">Datos de la empresa</a></li>
                        @endif

                        @if ( isset($acceso['ct'] ))
                         <li><a href="{{url('/configuracion')}}">Tienda Virtual</a></li>  
                        @endif
                        {{--  
                        @if ( isset($acceso['cb'] ))
                         <li><a href="{{url('/configuracion')}}">Banners</a></li>  
                        @endif
                        --}}               
                    </ul>       
                </li>
                @endif

        </nav>
<div class="row">
    <div class="col-sm-1"></div>
    <div id="EspacioAccion" class="col-sm-11" style="margin: 62px; ">
            @yield('operaciones')
    </div>
</div>
<!-- partial -->


<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Note</button>-->
  <div class="modal" id="myModal">
    <div class="modal-dialog" style="width: 1200px; max-width: 1000px;">
      <div class="modal-content">
        <!-- Modal body -->
        <div class="modal-body" id="modal-body" style="max-height: 600px; overflow: auto;">
          Modal body..
        </div>
        <!-- Modal footer -->
        <div class="modal-footer" id="modalPie">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>     
      </div>
    </div>
  </div>



 <div class="modal" id="advierteModal">
    <div class="modal-dialog" style="background: red; color: white;">
      <div class="modal-content">
        <!-- Modal body -->
        <div class="modal-body" id="advierte-body" style="max-height: 600px; background: red; color: white; text-align: center; font-size: 1.3em;">
          
        </div>
        <!-- Modal footer -->
        <div class="modal-footer" id="modalPie">
          <button type="button" class="btn btn-danger" data-dismiss="modal" id="DVRTconfirma">Confirmar</button>
          <button type="button" class="btn btn-success" data-dismiss="modal" id="DVRTcancela">Cancelar acción</button>
        </div>     
      </div>
    </div>
  </div>

<!-- 
   <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>



<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/js/bootstrap.min.js'></script>
 -->
  <script src="{{URL::asset('popper/popper.min.js')}}"></script>
</body>
</html>
<script type="text/javascript" src="{{ asset('jquery/panel.js')}}"></script>   

<script type="text/javascript">
  function borraItem(controlador, clase, condicion)
  {
      $data="_token={{ csrf_token()}}&clase="+clase+"&condicion="+condicion;
      $('#advierte-body').empty().append("<strong>Está intentando eliminar un elemento de tipo: "+clase+"</strong>");
      $('#advierteModal').show();
      
      $('body').on('click', '#DVRTconfirma', function()
      {
           $("#advierteModal").hide();
           $.post('/'+controlador, $data, function(subpage){ 
              console.log("Elemento "+clase+" ha sido eliminado");
            }).fail(function() {
                 console.log('Error en carga de Datos');
            });
          
      });


      $('body').on('click', '#DVRTcancela', function()
      {
           $("#advierteModal").hide();
            console.log("Operación cancelada");
          
      });


     
  }
</script>