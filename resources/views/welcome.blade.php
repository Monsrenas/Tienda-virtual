 
<!DOCTYPE html>

<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" /> 
    
    <title>MAZ Partes</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
@INCLUDE('autenticacion.Funciones_login')
<style>


.xNmodel { color: black; }
.xNmodel :hover { color: white;
                  background: black; 
                }

.left_wind 
  {
    background: #f3f3f3; 
    padding: 5px
  } 

.lista { font-size: 0.74em; }

.galeria_productos
  {
    -webkit-box-shadow: inset 0px 0px 6px 0px rgba(32,73,144,1);
    -moz-box-shadow: inset 0px 0px 6px 0px rgba(32,73,144,1);
    box-shadow: inset 0px 0px 6px 0px rgba(32,73,144,1);
    height: 100%; background: white; border: 1px solid #9BAB8A; float: left;
  }

.filtro {width: 29%; float: left;}

.oculto {visibility: hidden;
          display: none;
        }
</style>

<body style="background: #f3f3f3;">  
    @INCLUDE('barra')
    @INCLUDE('modal')
    <div class="row" id="work">
      
      <div class="col-md-3 left_wind" id="left_wind" style="padding: 2px;">
         <!--<div class="form-grup" style="margin-left: 15px;"  >
            <form>
              <input type="text" name="busqueda" placeholder='Buscar'>
            </form>
         </div>--> 
         @INCLUDE('filtros.filtros')
      </div>

      <div class="col-md-7 text-center" style="padding-right: 2px; padding-left: 1px;"> 
        @INCLUDE('filtros.selectores')
        @INCLUDE('carrousel')
        <div class="container galeria_productos" >
            @yield('lista_productos')
        </div>
      </div>

      <div class="col-md-2" id="right_wind">
          @INCLUDE('Carrito')
      </div>

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

<div class="modal" id="osmel">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal body -->
      <div class="modal-body" id="modal-body">
        Modal body..
      </div>
      
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
      
    </div>
  </div>
</div>