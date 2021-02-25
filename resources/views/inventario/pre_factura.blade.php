<?php 
  if(!isset($_SESSION)){ session_start();}

  if (!isset($_SESSION['MyCarrito'])) {$_SESSION['MyCarrito']= [];}

  $Importe=0;
  $cantItem=0;
  $carLista=$_SESSION['MyCarrito']; 
  $i=1;
?>
 
        
 <div  class="card"> 
  <div class="card-header">
    <div class="row">
      <h4 class='col-7'>Detalle de pedido</h4>
      @if (isset($_SESSION['cliente']))
        <button type='button' id='ProcesaPedido' class='btn btn-success col-4'>Continuar proceso de pedido</button>
      @endif
    </div>
  </div>
  <div class="card-body">
	<table class="col-lg-12 table table-responsive table-striped" style="font-size: .9em;">
		<thead>
			<tr>
				<th>No.</th>
				<th></th>
				 
				<th>Producto</th>
        <th style="text-align: right;">Cantidad</th>
				<th style="text-align: right;">Precio U</th>
        <th style="text-align: right;">Descuento</th>
        <th style="text-align: right;">Precio</th>
				<th style="text-align: right;">Importe</th>
			</tr>
		</thead>
  <tbody>  
	@foreach ($carLista as $item)
		<?php  
		$precio=sprintf('%.2f',isset($item['precio']) ? floatval(str_replace(',', '.',  $item['precio'] ) ):1);
		$cantid=(isset($item['cantidad']) ? (double) $item['cantidad'] : 0);
		$itemImporte= sprintf('%.2f',(float)$precio*(float)$cantid);
		$Importe+=sprintf('%.2f',(float)$precio*(float)$cantid);
		$cantItem+=$cantid;
		$IVA=(sprintf('%.2f',((float) $Importe*floatval( $_SESSION['empresa']['IVA']??0))/100 ));
		$Total=sprintf('%.2f',(float)$IVA+(float)$Importe);

    $neto=(($item['descuento']??0)>0)?sprintf('%.2f',((float) (100*$precio)/(100-$item['descuento']))):"";

    $Importe=sprintf('%.2f',$Importe);
	  ?>
			<tr>
				<td><span style="color: gray;">{{$i}}</span></td>
				<td>
          <img class='carFoto' style="width: 40px; height: 40px;  font-size: .8em;" src="{{$item['fotos'] ?? 'images/noimagen.jpg' }}"/>
        </td>
				<td style="text-align: left; font-size: .7em;">
            {{$item['descripcion'] ?? ''}} <br>
            <span style="color: gray;">Código: </span>{{$item['codigo']}}
        </td>
        <td style="text-align: right;">{{$item['cantidad']}}</td>
				<td style="text-align: right;">{{$neto}}</td>
        <td style="text-align: right;">{{(($item['descuento']??0)>0)?$item['descuento']."%":""}}</td>
        <td style="text-align: right;">{{$precio}}</td>			
				<td style="text-align: right;">{{$itemImporte}}</td>
			</tr>
			
		<?php $i++;?>		
	@endforeach
  </tbody>
  	<tfoot>
  		<tr>
        <td colspan="6"></td>
  			<th style="text-align: right;">Total</th>
  			<td style="text-align: right;">{{ $Importe}}</td>
  		</tr>
  		<tr>
  			<td colspan="6"></td>
        @if (isset($_SESSION['empresa']['IVA']))
  			     <th style="text-align: right;">{{$_SESSION['empresa']['IVA']??0}}% IVA</th>
        @endif     
  			<td style="text-align: right;">{{$IVA ?? ''}}</td>

  		</tr>
  		<tr>
  			<td colspan="6"></td>
  			<th style="text-align: right;">A pagar</th>
  			<td style="text-align: right;">{{$Total  ?? ''}}</td>
  			
  		</tr>
  	</tfoot>
 </table>
 </div>
 </div>

      