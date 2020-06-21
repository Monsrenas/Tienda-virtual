@extends('menu')


@section('operaciones')

<style type="text/css">
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
    <div class="row" id="work">
      
      <div class="col-md-2 left_wind" id="left_wind">
         <!--<div class="form-grup" style="margin-left: 15px;"  >
            <form>
              <input type="text" name="busqueda" placeholder='Buscar'>
            </form>
         </div>--> 
         @INCLUDE('filtros.filtros')
      </div>
      
      <div class="col-md-10"  > 
        @INCLUDE('filtros.selectores')
         <div class=" galeria_productos container">
            @INCLUDE('administracion.listadoProducto')
        </div>
        
      </div>
    </div>    
</body>
</html>
@endsection