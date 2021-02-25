	<table class="col-lg-12">
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
    $neto=(($item['descuento']??0)>0)?sprintf('%.2f',((float) (100*$precio)/(100-$item['descuento']))):"";
		$cantid=(isset($item['cantidad']) ? (double) $item['cantidad'] : 0);
		$itemImporte= sprintf('%.2f',(float)$precio*(float)$cantid);
		$Importe+=sprintf('%.2f', (float)$precio*(float)$cantid);
		$cantItem+=$cantid;
    $Importe=sprintf('%.2f',$Importe);
	  ?>

		
		<tbody>
			<tr>
				<td>{{$i}}</td>
				<td><img class='carFoto' style="border: none;" src="{{$lista['detalles'][$key]['foto'] ??  'images/noimagen.jpg' }}" /></td>
			
				<td style="text-align: left; line-height: 0.8em; ">
          {{$lista['detalles'][$key]['nombre'] ?? ''}}<br> 
          <span style="font-size: .7em; color: gray;">Código: {{$lista['detalles'][$key]['codigo']}}</span>
        </td>
        <td style="text-align: right;">{{$item['cantidad']}}</td>
        <td style="text-align: right;">{{$neto}}</td>
			  <td style="text-align: right;">{{($item['descuento']??0)>0?$item['descuento']." %":""}}</td>
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
  		<tr>
  			<td colspan="6"></td>
  			<th style="text-align: right;">Total</th>
  			<td style="text-align: right;">{{(float) $Importe}}</td>
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