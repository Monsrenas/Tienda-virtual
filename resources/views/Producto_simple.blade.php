
<link rel="stylesheet" href="{{'css/listProducto.css'}}">
  
@foreach($lista as $indice =>$dat)
	<div class='marco_producto'> 
		<?php $precio=$dat->precio; ?>			 
		 @if ((isset($dat->descuento))and($dat->descuento>0))
		 <div class='EtiDescuento'>
		 	    -{{$dat->descuento ?? ''}}%
		 </div> 
		  <div class='precViej'>{{$dat->precio ?? ''}}</div>
		  <?php $precio=number_format(floatval($dat->precio)-((floatval($dat->precio)*floatval($dat->descuento)/100)), 2, '.', ''); ?>
		  @else
		  <div class='precViej' style="color:white;">.</div>
		 @endif

		 <div class='precio'>
		 		{{$precio ?? $dat->precio}}
		 </div>

		 <a class='btn btn-sm '  data-toggle='detalles'  data-remoto='{{$dat->codigo ?? ''}}'>
		 	 <div class='marco_foto'>
		 	 	  <img class='foto' id='imagen' src='{{$dat->detalles->fotos['nombre'][0]?? '/images/noimagen.jpg'}}' alt='Muestra partes'/>
		 	 </div>
			 <div class='descripcion'>
			 	<p style="color: black; margin-bottom: -1px; font-family: 'Open Sans', sans-serif; font-size: 14px;">
			 		@if (isset($_SESSION['config']['nv']))
			 			{{$dat->detalles->nombre ?? ''}}
			 		@endif
			 	</p>

			 	<p> 
			 		@if (isset($_SESSION['config']['fv']))
			 			Fabricante: {{$dat->detalles->fabricantes->nombre ?? ''}}  <br>
			 		@endif 
			 		@if (isset($_SESSION['config']['cv']))
			 			Código: {{$dat->detalles->codigo ?? ''}}
			 		@endif
			 	</p>
			 </div>
		</a>

		{{--var $paq=$cod+"<*>"+$fabricante+"<*>"+$precioDesc+"<*>"+$descri+$gale;
	  var $ext=$mods;  // En esta variable, ademas de modelos, va codigo de fabricante y otros datos a mostrar --}}

		<button class='boton_agregar btn btn-sm fa fa-shopping-cart'  data-toggle='carAdd'  data-remoto='{{$dat->codigo ?? ''}}'>
			<input class='cantCar' type='number'
					 @if (isset($_SESSION['config']['sv'])) 
					 		placeholder='Stock: {{$dat->fisico}}'
					 @endif		
					 		> 
			<div class='TextAgr'>Agregar</div>
		</button> 
	</div>
 @endforeach 
 
 <div style="bottom: 0;

        height: 44px;
        margin-left: 0px;
        position: fixed;     
        z-index: 5000; 
        justify-content: center;" class="col-md-7 col-4 d-flex justify-content-cente">

     	{{ $lista->links( '' ) }}      
</div> 	