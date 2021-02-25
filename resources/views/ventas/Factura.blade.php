@include('provincias')
<?php 
  if(!isset($_SESSION)){ session_start();}

  if (!isset($lista)) {$lista= [];}

  $Importe=0;
  $cantItem=0; 
  $i=1;
  $provincia=prueba();
  $provincia=json_decode($provincia,JSON_PRETTY_PRINT); 
  $TipoDoc=(substr($lista->codigo, 0, 3)=="CAN") ? "CANCELACIÓN DE FACTURA" : "FACTURA";
?>
 
<style type="text/css">
  .drch { text-align: right; }
  .zqrd { text-align: left; }
  .dtos { color: gray; }
  .fnd { background: #EBEDEF;
         font-size: 0.8em;
         padding: 10px;}
  .ncbzd {background: white;  
          text-align: center; 
          margin: 0 auto; 
          display: inline-block; 
          padding-left: 4px;
          padding-right: 4px;
        }    

   .agua {
            position: absolute; 
            left: 30%; 
            top:350px;  
            color:gray;
            text-align: center;
            font-size: 6.5em;
            width: 150px;
            -webkit-transform: rotate(-45deg); 
              -moz-transform: rotate(-45deg); 
              -ms-transform: rotate(-45deg); 
              -o-transform: rotate(-45deg); 
              transform: rotate(-45deg); 
              
              -webkit-transform-origin: 50% 50%; 
              -moz-transform-origin: 50% 50%; 
              -ms-transform-origin: 50% 50%; 
              -o-transform-origin: 50% 50%; 
              transform-origin: 50% 50%; 
   }       
</style>
 
<link rel="stylesheet" href="{{asset('css/Principal.css')}}">       
 <div  style="width: 100%; padding: 1.2em;"> 

    <div class="row">
        <div class="col-lg-12 text-center" style="background: black; height: 28px;">
          <div class="ncbzd"><h4> {{{$TipoDoc}}} </h4></div>
        </div>
            
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
  @if (substr($lista->codigo, 0, 3)=="CAN")
    <div class="agua">Cancelada</div> 
    <div style="color: red; background: white; padding: 6px;">Motivo de candelación: {{$lista->motivo}}</div>
  @endif       
 
	<table class="col-lg-12" style="font-size: 0.9em;">
		<thead>
			<tr style="border: 1px solid black; padding: 10px;">
				<th>No.</th>
				<th></th>
				<th>Descripción</th>
        <th style="text-align: right;">Cantidad</th>
				<th style="text-align: right;">Precio U</th>
        <th style="text-align: right;">Descuento</th>
        <th style="text-align: right;">Precio</th>
				<th style="text-align: right;">Importe</th>
        <th></th>
			</tr>
		</thead>
	@foreach ($lista['productos'] as $key=>$item)
		<?php  
		$precio=(isset($item['precio']) ? floatval(str_replace(',', '.',  $item['precio'] ) ):1);
		$cantid=(isset($item['cantidad']) ? (double) $item['cantidad'] : 0);
		$itemImporte= sprintf('%.2f',(float)$precio*(float)$cantid);
		$Importe+=((float)$precio*(float)$cantid);
		$cantItem+=$cantid;
	  ?>	
		<tbody>
			<tr>
				<td>{{$i}}</td>
				<td><img class='carFoto' style="border: none;" src="{{asset($lista['detalles'][$key]['foto'] ??  'images/noimagen.jpg') }}" /></td>
			
				<td style="text-align: left; line-height: 0.8em; ">
          {{$lista['detalles'][$key]['nombre'] ?? ''}}<br> 
          <span style="font-size: .7em; color: gray;">Código: {{$lista['detalles'][$key]['codigo']}}</span>
        </td>
        <td style="text-align: right;">{{$item['cantidad']}}</td>
				<td style="text-align: right;">{{$item['precio_Origen']}}</td>
        <td style="text-align: right;">
          @if ($item['descuento']>0)
              {{$item['descuento']}}
          @endif    
        </td>			 
        <td style="text-align: right;">{{$item['precio']}}</td>
				<td style="text-align: right;">{{$itemImporte}}</td>
			</tr>
		</tbody>	
		<?php $i++;?>		
	@endforeach

  <?php 
    $IVA=(sprintf('%.2f',((float) $Importe*floatval( $_SESSION['empresa']['IVA']??0))/100 ));
    $Total=sprintf('%.2f',(float)$IVA+(float)$Importe);
  ?>
  	<tfoot>
  		<tr style="border-top: black 1px solid;">
  			<td></td>
        <td></td>
  			<td></td>
  			<td></td>
  			<td></td>
  			<td></td>
  			<th style="text-align: right;">Total</th>
  			<td style="text-align: right;">{{$Importe}}</td>
  		</tr>
  		<tr>
        <td></td>
  			<td></td>
  			<td></td>
  			<td></td>
  			<td></td>
  			<td></td>
        @if (isset($_SESSION['empresa']['IVA']))
  			     <th style="text-align: right;">{{$_SESSION['empresa']['IVA']??0}}% IVA</th>
        @endif     
  			<td style="text-align: right;">{{$IVA ?? ''}}</td>

  		</tr>
  		<tr>
        <td></td>
  			<td></td>
  			<td></td>
  			<td></td>
  			<td></td>
  			<td></td>
  			<th style="text-align: right;">A pagar</th>
  			<td style="text-align: right;">{{$Total  ?? ''}}</td>
  			
  		</tr>
  	</tfoot>
 </table>

    <div class="col-12">
      <div class="col-6">Forma de pago: {{ $lista['Describe_pago'] ??  '' }}</div>
      
    </div>
  </div>  
 </div>