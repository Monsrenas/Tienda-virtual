<style type="text/css">
	 #xcontenido {
				    position: relative;
				    width: 420px;
				    max-width: 420px;
				    max-height: 320px;
				   
				    margin: 100px auto;
				    border: 2px solid gray;
				    border-radius: 10px;
				    box-shadow: 1px 1px 5px rgba(50,50,50 0.5);
				    align-content: center;
				    text-align: center;
				    float: none;
				    display: inline-block;
				    margin-bottom: 10px;
				    padding: 20px;
				    overflow: scroll;
			   }

.ajusteimagen {width:100%;  height: 100%; overflow: hidden;
				
					padding: 6px;
					margin: 6px;
					margin-left: 2px;

			
					overflow: hidden;
				}


	 @supports(object-fit: cover){
    .ajusteimagen img{
			      	height: 100%;
			      	object-fit: cover;
			      	object-position: center center;
			      	padding: 2px;
			      	
    			}			
			   
    .ajusteimagen:hover { cursor: crosshair; }			
	.marcoFoto {
					width: 70%;
					height: 70px;
					text-align: center;
					padding: 6px;
					margin: 6px;
					margin-left: 2px;
					border: 1px solid gray;

					overflow: hidden;
					 
			   }

.lupa	tr { transition-duration: 0.8s; }		   

.lupa	tr:hover {
			 font-size: 1.5em;	
			 background: #D8DADB;
			 color: black;
			 transition-duration: 0.4s;
		  }		   

	.marcoFoto:hover {
						border: 3px solid black;	
						-webkit-box-shadow: 0px 0px 39px -11px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 0px 39px -11px rgba(0,0,0,0.75);
box-shadow: 0px 0px 39px -11px rgba(0,0,0,0.75);	
					}	

	@supports(object-fit: cover){
    .marcoFoto img{
			      	height: 100%;
			      	object-fit: cover;
			      	object-position: center center;
			      	padding: 2px;
    			}
    		

   
    .marcoModelos { display: block; 
    				width: 100%;  
    				margin-top: 10px; 
    				height: 120px; 
    				background: #e3e3e3; 
    				border: 1px solid #fff; 
    				font-size: 0.7em;
    			   }

    .marcoModelos p { font-size: 1.7em; margin-bottom: 1px; }			   

    .cabeceraMode {  background: #afafaf; width: 50%; float: left;  font-size: 1.5em; }	
    .ModLisContai {  height: 250px; max-height: 250px;  }	
    @media screen and (min-width:640px){
    	#imagenes {
    					margin-left: -5px;
    					margin-right: 20px;
    				}	
    }

    @media screen and (min-width:800px){
    	#imagenes {
    					margin-left: -5px;
    					margin-right: 2px;
    				}	
    }	   
</style>

<?php 
	if (isset($lista[0])){
							$info=$lista[0];
						 } 
	$unida=['unidad','Milimetro','Centimetro','Metro','Pulgada'];
?>	
<div  class="row" >
 	
 	  
   <div id="imagenes" class="col-1 col-sm-2" style="">
   	<?php 
   	   if (isset($info->detalles->fotos['nombre']))	
   	   {	
   	      		for ($i=0; $i <	sizeof($info->detalles->fotos['nombre']) ; $i++) { 
   	      			 
   	   			echo "<a href='javascript:CambiaImagen(\"".$info->detalles->fotos['nombre'][$i]."\")'><div style='width:100px;'><img style='background:white' class='marcoFoto'  src='".$info->detalles->fotos['nombre'][$i]."' /></div></a>";
   	      		}
   	   }
   	 ?>

   </div>	     
   

	<div id=" " class="col-sm-7 col-md-5 col-lg-5 col-xl-5" style="vertical-align:middle;  display:flex; align-items: center; background: white"  >
	 <div id="contenido" class="ajusteimagen" style="padding-top: 25%;">
      <img id="botella"  src="{{$info->detalles->fotos['nombre'][0] ?? ''}}"  alt="No hay imágenes de este producto" data-big="{{$info->detalles->fotos['nombre'][0] ?? ''}}" data-overlay="" />
      </div>

      	<div style="display: block; position: absolute; bottom: -95px; left: 25%; background: ">
       		<button class='boton_agregar btn btn-sm fa fa-shopping-cart'  data-toggle='carAdd'  data-remoto='{{$info->codigo ?? ''}}'	data-extra=''>
			<input class='cantCar' type='number'  placeholder='Stock: {{$info->cantidad}}'> 
			<div class='TextAgr'>Agregar</div>
		</button>
		</div>
	</div>

	<div class="col-5" style="margin-left: -12px;" >
		<div style="background: #EBEDEF; overflow: hidden; margin: 0px; padding: 16px; font-size: .7em; width: 520px">
		 <p>
		 	<div class="row">
			 	@if (isset($_SESSION['config']['dnv']))
			 		<div class="col-6">		
			 			<strong style="font-size: 1.4em"> Nombre:</strong> {{$info->detalles['nombre'] ?? ''}}
			 		</div>
			 	@endif

				@if ((isset($info->detalles->descripciones))and(isset($_SESSION['config']['dav'])))
					<div class="col-6"> 
			 			<strong style="font-size: 1.4em"> Otros nombres:</strong> <br>
			 			@foreach ($info->detalles->descripciones as $value)
			 				{{$value ?? ''}} <br>
			 			@endforeach
			 		</div>
			 	@endif
		 	</div>

		 	<div class="row" style="margin-top: 20px;">
		 	
			 	@if (isset($_SESSION['config']['dcv']))
			 	<div class="col-6" >
			 		<strong style="font-size: 1.4em"> Código:</strong> {{$info->producto ?? ''}}
			 	</div>	
			 	@endif
		 	
			
			 	@if ((isset($info->detalles->codigosAd))and(isset($_SESSION['config']['dav'])))
			 	<div class="col-6"> 
			 		<strong style="font-size: 1.4em"> Códigos adicionales:</strong> 
			 		@foreach ($info->detalles->codigosAd as $value)
			 			<br>{{$value ?? ''}} 
			 		@endforeach
			 	</div>	
			 	@endif
		 	
		 	</div>
		 </p>

		 <div class="row">
			@if ((isset($info->detalles->fabricantes['nombre']))and(isset($_SESSION['config']['dfv'])))
				 <div class="col-6"> 
				 <strong style="font-size: 1.4em"> Fabricante:</strong> {{$info->detalles->fabricantes['nombre'] ?? ''}}
				 </div>
				 @endif
			
				 @if (isset($info->detalles->categoria_detalle['nombre']))
				 <div class="col-6">
				 <p><strong style="font-size: 1.4em"> Categoría:</strong> {{$info->detalles->categoria_detalle['nombre'] ?? ''}}</p>
				 </div>
			@endif
				 
		 </div>

		 @if (isset($info->detalles->modelos['marca']))

	   	 <strong style="font-size: 1.4em">Modelos compatibles:</strong>
	   	 <table  class="table table-striped lupa" style="font-size: 0.9em;" id="tnlmrc">
	   	 	<thead>
	   	 		<th width="80">Marca</th>
	   	 		<th>Modelo</th>
	   	 		<th>Año</th>
	   	 		<th>Cilindraje</th>
	   	 		<th>Motor</th>
	   	 		<th>Observaciones</th>
	   	 	</thead>
	   	 	<tbody style="color: gray;">
	   	 	 	
	   	 		 @for ($i = 0; $i < count($info->detalles->modelos['marca']); $i++)
	   	 		 	<tr id='f{{$i}}'>

	   	 		 		 
	   	 		 	</tr>
	   	 		 	<script type="text/javascript">
		 				$iteem="{{$info->detalles->modelos['marca'][$i] ?? ''}}";		
		 				$sbite=('{{$info->detalles->modelos['modelo'][$i] ?? ''}}').substring(3);
	 		 			if ($("#tmar"+$iteem).length==0) { 
		 		 			 $('#f{{$i}}').append("<td class='yuyu' id='tmar"+$iteem+"'><strong>"+$('#mrc'+$iteem)[0]['innerHTML']+"</strong></td>");
		 		 			 $('#f{{$i}}').append("<td class='yuyu' id='tmod"+$iteem+"'></td><td class='yuyu' id='ttie"+$iteem+"'></td class='yuyu' ><td class='yuyu' id='tcil"+$iteem+"'></td><td class='yuyu' id='tmot"+$iteem+"'></td><td class='yuyu' id='tobs"+$iteem+"'></td>")	
		 		 		} 
						$("#tmod"+$iteem).append($('#'+$iteem+$sbite).find('b')[0]['innerHTML']+'<br>');
						$("#ttie"+$iteem).append('{{$info->detalles->modelos['tiempo'][$i] ?? ''}}<br>');
						$("#tcil"+$iteem).append('{{$info->detalles->modelos['cilindraje'][$i] ?? ''}}<br>');
						$("#tmot"+$iteem).append('{{$info->detalles->modelos['motor'][$i] ?? ''}}<br>');
						$("#tobs"+$iteem).append('{{$info->detalles->modelos['observaciones'][$i] ?? ''}}<br>');
	   	 		 	</script>
	   	 		 @endfor	 
	   	 	</tbody>
	   	 </table>
	   	 @endif
	   	 @if (isset($info->detalles->medidas['nombre']))
	   	 <strong style="font-size: 1.4em">Medidas:</strong>
	   	 <table  class="table-striped lupa" style="font-size: 1em">
	   	 	<tbody style="color: gray;">
	   	 		 @for ($i = 0; $i < count($info->detalles->medidas['nombre']); $i++)
	   	 		 	<tr>
	   	 		 		<td height="20">{{$info->detalles->medidas['nombre'][$i]}} = {{$info->detalles->medidas['valor'][$i]}} 
	   	 		 		 {{$unida[$info->detalles->medidas['unidad'][$i]]}}
	   	 		 		</td>
	   	 		 	</tr>
	   	 		 	<script type="text/javascript">
			 				 
	   	 		 	</script>
	   	 		 @endfor
	   	 	</tbody>
	   	 </table>
	   	 @endif	   	 
	   	 <div id="listModelos" class="ModLisContai"></div>
	</div>
  </div> <!-- Contenido de informacion -->

</div>
 
<script type="text/javascript">

$(document).ready(function()
{
	 activaLupa();
});

function activaLupa()
{
  img = document.getElementById('botella');
  var width = img.clientWidth;
  var height = img.clientHeight;
 
  if ((width*height)<240080) {return};


   $("#botella").mlens(
    {
        imgSrc: $("#botella").attr("data-big"),   // path of the hi-res version of the image
        lensShape: "square",                // shape of the lens (circle/square)
        lensSize: 200,                  // size of the lens (in px)
        borderSize: 4,                  // size of the lens border (in px)
        borderColor: "#fff",                // color of the lens border (#hex)
        borderRadius: 20,                // border radius (optional, only if the shape is square)
        imgOverlay: $("#botella").attr("data-overlay"), // path of the overlay image (optional)
        overlayAdapt: true // true if the overlay image has to adapt to the lens size (true/false)
    });
}

location.href="#tope";

function CambiaImagen(imagen)
{
  var cambio=" <img id='botella'  src='"+imagen+"' alt='botella con zoom' data-big='"+imagen+"' data-overlay='' />";
  $('#contenido').empty();
  $('#contenido').append(cambio);
  
  activaLupa();

}
</script>

<script type="text/javascript" src="jquery.mlens-1.7.min.js"></script>
