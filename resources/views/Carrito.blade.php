
@include('inventario.modal')
<div class="form-control carHeader" style="width: 240px; height: 62px;">
  <div class="fa fa-shopping-cart"  style="float: left; padding: 12px;">
  		<div id="CarritoCuantos" style="float: right; margin-left: 6px;"></div>
  </div>
  @if (count($_SESSION['MyCarrito'])>0)
  <div class="fa fa-usd carImporte" id="CarritoImporte"></div>
  <br>
  {{--
  	<button class="btn btn-sm  btn3d btn-outline-secondary" data-toggle="modal" data-target="#xPreFactura">
  	 <span id="PEPE" class="xpagar">Hacer pedido </span> 
  </button>
  	--}}
  <button class="btn btn-sm  btn3d btn-outline-secondary">
  	 <span id="PEPE" class="xpagar">Hacer pedido </span> 
  </button>
  @endif
   {{--<div class="xpagar"  id="pago"> <button class="btn btn-sm btn-success">Pagar</button> </div>--}}
</div>

<div id="listaCarrito" style="background: white;">
<?php 
  if(!isset($_SESSION)){
                 session_start();
                 
               } 
         
  if (!isset($_SESSION['MyCarrito'])) {$_SESSION['MyCarrito']= [];}             
  $Importe=0;
  $cantItem=0;
  $carLista=$_SESSION['MyCarrito']; 
?>
<div >	
	@foreach ($carLista as $item)
    <div class="carItem" id="ITM{{$item['indice']}}">
    	<a class=''  data-toggle='detalles'  data-remoto='{{$item['invcodigo'] ?? ''}}'><div class=''><img class='carFoto' src="{{($item['fotos']??"")!=""?$item['fotos']:asset('/images/noimagen.jpg') }}" /></div></a>	
		<div class='contenInfo'>
			 <div style="float: left; width: 30%;"> 
			 	<input size="16" style="width: 50px;  background: #EBEDEF; border: none;" type="number" id="{{$item['indice']}}" class="cantidadItem" value="{{$item['cantidad']}}">
			 </div>
			 <div class='carPrecio'>${{$item['precio']}}</div>
		<div class='carQuitar'>
		 <button class="btn btn-default fa fa-trash-o fa-lg" data-toggle='carDelItem' data-remoto="{{$item['indice']}}"></button>
		</div>
			@if (isset($_SESSION['config']['ccv']))	
			 <div class='carInfLin'>Código: {{$item['codigo']}}</div>
			@endif
			@if (isset($_SESSION['config']['cfv'])) 
			 <div class='carInfLin'>{{$item['fabricante'] ?? ''}}</div>
			@endif 
		</div>
		@if (isset($_SESSION['config']['cnv'])) 
			<div class='carInfLin' style="font-weight: bold; color: black;">{{$item['descripcion'] ?? ''}}</div>
		@endif
	</div> 
	<?php  
		$precio=isset($item['precio']) ?  floatval(str_replace(',', '.',  $item['precio'] ) ):1 ;
		$cantid=(isset($item['cantidad']) ? (FLOAT) $item['cantidad'] : 0);
		$Importe+= ((FLOAT)$precio*(FLOAT)$cantid);
		$cantItem+=$cantid;
	 ?>
	@endforeach
</div>
	
</div>

<script type="text/javascript">

	$('#CarritoImporte').html('{{$Importe}}');
	$('#CarritoCuantos').html('{{$cantItem}}');
 

</script>
