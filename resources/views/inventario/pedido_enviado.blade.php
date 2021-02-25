@include('provincias')
<?php 
  if(!isset($_SESSION)){ session_start();}

  if (!isset($lista)) {$lista= [];}

  $Importe=0;
  $cantItem=0; 
  $i=1;
  $provincia=prueba();
  $provincia=json_decode($provincia,JSON_PRETTY_PRINT); 

?>
 
<style type="text/css">
  .drch { text-align: right; }
  .zqrd { text-align: left; }
  .dtos { color: gray; }
  .fnd { background: #EBEDEF;
         font-size: 0.8em;
         padding: 10px;}
  .ncbzd {background: white; width: 100px; text-align: center; margin: 0 auto;}       
</style>
        
 <div  class="card"> 
    <div class="card-header">
      <h4 class='modal-title'>Resumen de pedido enviado</h4>
    </div>

    <div class=" card-body row">
        <div class="col-lg-12 text-center" style="background: black; height: 28px;"><div class="ncbzd"><h4>PEDIDO</h4></div></div>
            
        <div class="col-6 text-center">Fecha: {{$lista['fecha'] ?? ''}}</div>
        <div class="col-6 text-center">Número: <span style="color: blue;">{{$lista['codigo'] ?? ''}}</span> </div>
            
        <div class="fnd col-6">
            <h6><strong>{{$_SESSION['empresa']['nombre_comercial']?? ''}}</strong></h6>
            <p>
              RUC: {{$_SESSION['empresa']['RUC']?? ''}} <br> 
              {{$_SESSION['empresa']['direccion']?? ''}}, 
              {{ $provincia[ $_SESSION['empresa']['provincia'] ]['provincia']  ?? ''}}: 
              {{ $provincia[$_SESSION['empresa']['provincia']]['cantones'][ $_SESSION['empresa']['canton'] ]['canton']  ?? ''}} <br>
                Tel. {{$_SESSION['empresa']['telefono'] ?? ''}}<br>
                {{$_SESSION['empresa']['correo'] ?? ''}}
            </p>
        </div>

        <div class="fnd col-6">
            <h6>Cliente</h6>
            <p>
              <strong>{{$cliente->nombre ?? ''}}</strong><br>
              {{$cliente->direccion ?? ''}}, 
               @if (isset($cliente->provincia))
                  {{ $provincia[$cliente->provincia]['provincia']  ?? ''}}: {{ $provincia[$cliente->provincia]['cantones'][$cliente->canton]['canton']  ?? ''}} <br>
               @endif
                Tel. {{$cliente->telefono ?? ''}}<br>
                {{$cliente->email ?? ''}}
            </p>
        </div>
     
      @include("ventas.listaCompra")


    <div class="col-12">
      <div class="col-6">Forma de pago: {{ $lista['forma_pago'] ??  '' }}</div>
      
    </div>
  </div>  
 </div>