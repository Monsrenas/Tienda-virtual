 
<!DOCTYPE html>

<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" /> 
    <title>MAZ Partes</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<style>


.xNmodel { color: black; }
.xNmodel :hover { color: white;
                  background: black; 
                }

.carHeader 
{
    display: block;
    
    width: 100%;
    height: 24px;
    padding: 4px;
    background: #e6e6e6;
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

.filtro {width: 29%;}

.oculto {visibility: hidden;
          display: none;
        }
</style>

<body style="background: #f3f3f3;">  
 
    <div class="row" id="work" style="">
      
      <div class="col-md-2 left_wind" id="left_wind">
         <div class="form-grup" style="margin-left: 15px;"  >
            <form>
              <input type="text" name="busqueda" placeholder='Buscar'>
            </form>
         </div> 
         @INCLUDE('filtros')


      </div>

      <div class="col-md-7"  > 
        <div>
          <form class="form-inline" style="float: left; padding: 10px;">
             <select id="sMarca" class="filtro" onchange="AgregaSubOpciones('sModelo','dmrc'+this.value)">
                <option>MARCA</option>
              </select>

             <select id="sModelo" class="filtro">
                <option>MODELO</option>
              </select>

             <select id="sSistema" class="filtro">
                <option>SISTEMA</option>
                <option value="Iluminación">Volvo</option>
                <option value="Frenado">Saab</option>
                <option value="Arranque">Mercedes</option>
                <option value="Suspensión">Audi</option>
              </select>
            
          </form>
        </div>
        <div class="container galeria_productos" >
            @yield('lista_productos')
        </div>
      </div>

      <div class="col-md-3" id="right_wind" style="padding: 4px;">
        <div class="carHeader">
          <div class="fa fa-shopping-cart" id="Carrito" style="float: left;"> 10 </div>
          <div class="fa fa-usd"  style="float: right;"> 100</div>
        </div>

      </div>
    </div>
    
</body>

<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Note</button>-->

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
<script type="text/javascript">
  $('#center_wind').css("height", screen.height-312);
  $('#center_wind').css("max-height", screen.height-312); 
  $('.botonOp').click(function(){$('#qwerty').modal('show');});  


   function AgregaOpcion($id, $opcion, $valor)
   {
      var x = document.getElementById($id);
      var option = document.createElement("option");    
      option.text = $opcion ;
      option.value= $valor;
      x.add(option);
    }

    function AgregaSubOpciones($id, $cod) 
    {
        var x = document.getElementById($id);
        for (let i = x.options.length; i >= 1; i--) {
                                                          x.remove(i);
                                                    }

        var Elts = document.getElementsByClassName($cod);
        for (var i = 0; i < Elts.length; i++) {
                                                  var option = document.createElement("option");    
                                                  option.text = Elts[i].text;
                                                  option.value= Elts[i].id;
                                                  x.add(option);
                                              }
    }

 
  


</script>