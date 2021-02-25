 
<!DOCTYPE html>
 
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" /> 
    
    <title>{{ $_SESSION['empresa']['nombre_comercial'] ?? "Tienda" }}</title>
    <link rel="icon" type="image/png" href="{{asset('/images/Logo.jpg')}}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="{{'css/Principal.css'}}">
        <link rel="stylesheet" href="{{'css/personaliza.css'}}">

    <meta name="viewport" content="width=device-width, initial-scale=1">    
</head>
@INCLUDE('autenticacion.Funciones_login')
 <?php if(!isset($_SESSION)){ session_start();} 
    
      $nom1=(isset($_SESSION['config']['nom1'])) ? $_SESSION['config']['nom1']:"--";
      $nom2=(isset($_SESSION['config']['nom2'])) ? $_SESSION['config']['nom2']:"--";
            
 ?>

<style type="text/css">
  tr { transition-duration: 0.8s; }      

  tr:hover {
       
      }   

div.sticky {
  position: -webkit-sticky;
  position: sticky;
  top: 0;
  padding: 10px;
  font-size: 20px;
}      

.filtro_Bar {  
              max-height: 1400px;  
              margin-top: 2px; 
              padding: 8px; 
        
}       
</style>

<body > 
  
  <div class="container-fluid">

   @INCLUDE('barra')
 </div> 
  <div class="container-fluid">
    @INCLUDE('modal')
    @if (isset($_SESSION['config']['verbanner']))
      @INCLUDE('carrousel')
    @endif  
    <div class="row" id="work" style="margin: 1px;">
     
     <div class="col-sm-12 col-md-12 col-lg-2 pl-0 galeriaProductos filtro_Bar" style=" padding: 0px 10px 10px; padding-right: 5px; margin-left: 1px;">
                    <div class="filtro_Bar">
                      @INCLUDE('filtros.filtros')
                    </div> 
    </div>
                
      <div id="pruebame" class="col-sm-9 col-md-10 col-lg-8 col-xl-8 text-center galeriaProductos" style="padding: 0px; overflow: scroll;width: 1000px;"> 
        <div class="container-fluid" id="la_galeria"  >
             
        </div>
      </div>


      <div class="col-sm-8 col-md-12 col-lg-10 col-xl-10"  id="DetallesProducto" style="margin-left: 0px; margin-right: -5px; padding: 2px;">
     
      </div>
  
        <div class="col-2 right_wind" id="right_wind"> 
          @INCLUDE('Carrito')
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

<div id="qwerty" class="modal fade bd-example-modal-lg" tabindex="10" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="cabecera"></h4>
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
</script>

<script src="{{'jquery/Principal.js'}}"></script>
<script type="text/javascript">

  if (screen.height>700) {
      var posi = $('#pruebame').position();
      $('#pruebame').css("height", screen.height-posi.top-150);
      $('#pruebame').css("max-height", screen.height-posi.top-150);
  }
    MuestraProductos('');

  
</script>

  
  
 