
<style type="text/css">
		.carHeader 
				  {
				  	  color: white;
				      display: block;      
				      width: 100%;
				      height: 36px;
				      padding: 4px;
				      background: blue;
				  }

		.carFoto {
					width: 20%;
					height: 60px;
					text-align: center;
					padding: 6px;
					margin-left: 2px;
					border: 2px solid gray;
					overflow: hidden;
					float: left;
					background: white;
			   }

	@supports(object-fit: cover){
    .carFoto img{
			      	height: 100%;
			      	object-fit: cover;
			      	object-position: center center;
			      	padding: 2px;
    			}}

    .contenInfo{
    				font-size: 0.8em;
					width: 72%;
					height: 60px;
					text-align: left;
					padding: 0px;
					margin-left: 2px;
					margin-top: 0px;
					 
					overflow: hidden;
					float: left;
			   }

    .carPrecio{ 
    			font-size: 1.4em;
    			text-align: right;
    			margin-right: 4px;
    			margin-top: -2px;
    			width: 58%;
    			height: 24px;
    			float: left;
    			
    		  }

    .carQuitar{	text-align: right;
    			margin-top: 1px;
    			width: 20%;
    			height: 18px;
    			float: right;
    			
    		  }
    .carInfLin{
    			margin-top: -2px;
    			width: 100%;
    			height: 20px;
    			float: left;
    			
    		  }
    .carItem {  height: 88px;
    			margin-top: 4px;
    			background: #dce7ff;
    			border: 2px solid #dce7ff;
    			  
    		 }

</style>

<div class="form-control carHeader">
  <div class="fa fa-shopping-cart" id="CarritoCuantos" style="float: left;"> 10 </div>
  <div class="fa fa-usd"  id="CarritoImporte" style="float: right;"> 100</div>
</div>

<div id="listaCarrito">
<?php 
  if(!isset($_SESSION)){
                 session_start();
                 if (!isset($_SESSION['MyCarrito'])) {$_SESSION['MyCarrito']= [];}
               } 
  $Importe=0;
  $cantItem=0;
  $carLista=$_SESSION['MyCarrito']; 
  

?>

<div>	
	@foreach ($carLista as $item)
    <div class="carItem" id="ITM{{$item['codigo']}}">
    	<a><div class='carFoto'><img src="{{$item['fotos'][0]}}" /></div></a>	
		<div class='contenInfo'>
			 <div style="float: left; width: 20%;"> 
			 	<input style="width: 50px;" type="number" id="{{$item['codigo']}}" class="cantidadItem" value="{{$item['cantidad']}}">
			 </div>
			 <div class='carPrecio'>{{$item['precio']}} $</div>
		<div class='carQuitar'>
		 <button class="btn btn-default fa fa-trash-o fa-lg" data-toggle='carDelItem' data-remoto="{{$item['codigo']}}"></button>
		</div>
			 <div class='carInfLin'>Código: {{$item['codigo']}}</div>
			 <div class='carInfLin'>Nombre del Fabricante</div>
		</div>
		<div class='carInfLin'>{{$item['descripcion']}}</div>
	</div> 
	<?php 
		$Importe+=	($item['precio']*$item['cantidad']);
		$cantItem+=($item['cantidad']);
	 ?>
	@endforeach
</div>
	
</div>

<script type="text/javascript">

	$('#CarritoImporte').html('{{$Importe}}');
	$('#CarritoCuantos').html(' {{$cantItem}}');
    
	$('body').on('click', 'button[data-toggle="carDelItem"]', function(){  	
	     $data='{{ csrf_token()}}&url=Carrito&campo=&descripcion=&codigo='+$(this).data("remoto");	
	     $.get('CarritoEliminaItem', $data, function(subpage){
	     	   $('#right_wind').empty(); 
	           $('#right_wind').append(subpage);
	     	   //$('#ITM'+subpage).remove();
	    }).fail(function() {
	       console.log('Error en carga de Datos');
	  	});  

	});

	$('.cantidadItem').change(function(){

		$data='{{ csrf_token()}}&url=Carrito&campo=&descripcion=&valor='+$(this)['0']['value']+'&codigo='+$(this)['0']['id'];	
	     $.get('CarritoCambiaCanti', $data, function(subpage){   
	     		     	   $('#right_wind').empty(); 
	           $('#right_wind').append(subpage);
	    }).fail(function() {
	       console.log('Error en carga de Datos');
	  	});  
	});

</script>
