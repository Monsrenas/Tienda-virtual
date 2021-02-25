<!DOCTYPE html>
 
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" /> 
    
    <title>{{ $_SESSION['empresa']['nombre_comercial'] ?? "Tienda" }}</title>
    <link rel="icon" type="image/png" href="{{asset('/images/F1MotrizLogo.png')}}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="{{'css/Principal.css'}}">
</head>
@INCLUDE('autenticacion.Funciones_login')
 <?php 
    if(!isset($_SESSION)){ session_start();}      
 ?>



 @if (count($_SESSION['MyCarrito']?? [])<1) 

  <script type="text/javascript">
    location.href="/";  
  </script>
 @endif

<style type="text/css">
  tr { transition-duration: 0.8s; }      

  tr:hover {
       
      }    
</style>

<body > 
  
  <div class="container-fluid">
   @INCLUDE('barra')
 </div> 
  <div class="container-fluid">
    @INCLUDE('modal') 
    @INCLUDE('reloj')
    <div class="row" id="work" style="margin: 1px;">
      <div class="col-8"  id="DetallesProducto" style=" padding: 2px;">
          
      </div>
      <div class="col-4" style="margin-left: 0px; padding: 12px; padding-top: 2px;" id="VNTN_Derecha">
        <div class="card">
          <div class="card-header">
            <h5>Información de usuario</h5>
          </div>
          <div class="card-body" id="DetallesCliente">
             
          </div>
        </div>  
      </div>
    </div>  
  </div>


<div>
   @INCLUDE('pie_de_pagina')
</div>

</body>

<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Note</button>-->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal body -->
      <div class="modal-body" id="modal-body" style="max-height: 600px; overflow: auto;">
        Modal body..
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>     
    </div>
  </div>
</div>
   
</html>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script type="text/javascript">

      $('#center_wind').css("height", screen.height-312);
      $('#center_wind').css("max-height", screen.height-312); 
      $('.botonOp').click(function(){$('#qwerty').modal('show');});  


//MUESTRA Y PROCESAMIENTO DE PEDIDO
      $.get('preFactura', '', function(subpage)
      {        
          $('#DetallesProducto').empty().append(subpage);
          $('#DetallesProducto').show();
          $('.galeriaProductos').hide();
               
      }).fail(function() {
                            console.log('Error en carga de Datos');
                         }); 

      $('body').on('click', '#ProcesaPedido', function()
      {   
           $('#ProcesaPedido').hide(); 
           $.get('ComoPago', '', function(subpage)
            {
                $('#VNTN_Derecha').empty().append(subpage);
            }).fail(function() {
                                  console.log('Error en carga de Datos');
                                });  
      });

//NAVEGACIÓN         
      $('#busqueda').parent().empty();
      
      $('#operaUser').parent().parent().empty();

      $('body').on('click', '.navbar a', function()
      {   
          location.href="/";  
      }); 


//PAGAR Y CERRAR
      $('body').on('click', '#comoPagoSLCT', function(){   
            
           if ($('#comoPagoSLCT').val())
           {
              $('#SendPedido').attr('disabled', false);
           } else { $('#SendPedido').attr('disabled', true);} 

      });

      $('body').on('click', '#SendPedido', function(event)
      {
           event.preventDefault(); 
           $('#SendPedido').attr('disabled', true);
           $('#timer').modal('show');
           $.get('/registraPedido/'+$('#comoPagoSLCT').val(), '', function(subpage)
           {
                  $('#DetallesProducto').empty().append(subpage);
                  VacearCarrito();  
                  RegistraPago();  
                  $('#timer').modal('hide');         
          }).fail(function() {
                                 console.log('Error al procesar pedido');
                              });  
      });

      function VacearCarrito()
      {
          $data='{{ csrf_token() }}&url=Carrito';  
           $.get('CarritoVaciar', $data, function(subpage)
           {
               $('#right_wind').empty().append(subpage);
               $("#PedidoEnviado").off();
            }).fail(function() {
                                   console.log('Error en carga de Datos');
                                });
      }

      function RegistraPago()
      {
         var fp=$('#comoPagoSLCT').val();
         var tipos=["TC","TD"];
         if (tipos.indexOf(fp)>-1)
         {
            //Pago con tarjeta
         } else {
                    $.get('/registraPago', '', function(subpage)
                    {
                        $('#VNTN_Derecha').empty().append(subpage); 
                    });
                }
      }

//INFORMACIÓN DE CLIENTE Y AUTENTICACIÓN
    $.get('/EditaCliente', '', function(subpage)
      {
          $('#DetallesCliente').empty().append(subpage);
      }).fail(function() {
                              console.log('Error en carga de Datos');
                          }); 

    $('body').on('click', '#seRegistra', function()
    {   
          $.get('/Muestra/autenticacion.registro', '', function(subpage)
          {
              $('#DetallesCliente').empty().append(subpage); 
          }).fail(function() {
                                 console.log('Error en carga de Datos');
                              }); 
    });

</script>
{{--
<script src="{{'jquery/Principal.js'}}"></script>
--}}

  
  
 