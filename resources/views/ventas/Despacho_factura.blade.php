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
  .ncbzd {background: white; width: 120px; text-align: center; margin: 0 auto;}       
</style>
 
<link rel="stylesheet" href="{{asset('css/Principal.css')}}">       
 <div  style="width: 1000px;"> 

    <div class="row">
        <div class="col-lg-12 text-center" style="background: black; height: 28px;">
          <div class="ncbzd"><h4>FACTURA</h4></div></div>
            
        <div class="col-6 text-center">Fecha: {{$lista->Fecha ?? ''}}</div>
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
              <strong>{{$lista->Cliente->nombre ?? ''}}</strong><br>
              {{$lista->Cliente->direccion ?? ''}}, 
               @if (isset($lista->Cliente->provincia))
                  {{ $provincia[$lista->Cliente->provincia]['provincia']  ?? ''}}: {{ $provincia[$lista->Cliente->provincia]['cantones'][$lista->Cliente->canton]['canton']  ?? ''}} 
               @endif
                <br>
                Teléfono: {{$lista->Cliente->telefono ?? ''}}<br>
                {{$lista->Cliente->email ?? ''}}
            </p>
        </div>
  <div class="col-lg-12">      
  <form id="Despacho">       
  <input type="text" name="factura" value="{{$lista->codigo}}" hidden>   
	<table class="col-lg-12 table-striped">
		<thead>
			<tr style="border: 1px solid black; padding: 10px;">
				<th>No.</th>
				<th></th>
				<th>Descripción</th>
        <th>Entregado</th>
        <th style="text-align: right;">Despachar</th>
				<th style="text-align: right;">Existencia</th>
        <th style="text-align: right;">En almacén</th>
        <th></th>
			</tr>
		</thead>
  <tbody>  
	@foreach ($lista['productos'] as $key=>$item)
		<?php  
 
		$cantid=(isset($item['cantidad']) ? (double) $item['cantidad'] : 0);
    $entregado=(isset($item['entregado']) ? (double) $item['entregado'] : 0);
    $despachar=$cantid;
    if (isset($item['entregado'])) {$despachar=$cantid-$entregado;}
	  ?>	
		
			<tr>
				<td>{{$i}}</td>
				<td><img class='carFoto' style="border: none;" src="{{asset($lista['detalles'][$key]['foto'] ??  'images/noimagen.jpg') }}" /></td>
			
				<td style="text-align: left; line-height: 0.8em; ">
          {{$lista['detalles'][$key]['nombre'] ?? ''}}<br> 
          <span style="font-size: .7em; color: gray;">Código: {{$lista['detalles'][$key]['codigo']}}</span>
        </td>
        <td>{{$item['entregado']?? ""}}</td>
        <td style="text-align: right;" >
          @if (($cantid-$entregado)>0)
           <input style="width: 60px;" type="number" min="0" max="{{$despachar}}" id="ctd{{$i}}" class="proCntd" name="productos[{{$key}}][entregado]" value="{{$despachar}}">
          
          @endif 
        </td>

				<td style="text-align: right;">{{$lista['detalles'][$key]['stock'] ?? ""}}</td>
        <td style="text-align: right;">{{$lista['detalles'][$key]['fisico'] ?? ""}}</td>			 
			</tr>
			
		<?php $i++;?>		
	@endforeach
  </tbody>
 </table>
</form>
</div>
    <div class="col-12">
      <div class="col-6">Forma de pago: {{ $lista['Describe_pago'] ??  '' }}</div>
      
    </div>
  </div>  
 </div>