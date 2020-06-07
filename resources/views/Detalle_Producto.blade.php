<style type="text/css">
	#contenido {
				    position: relative;
				    width: 340px;
				    height: auto;
				    margin: 220px auto;
				    border: 12px solid #fff;
				    border-radius: 10px;
				    box-shadow: 1px 1px 5px rgba(50,50,50 0.5);

			   }

	.marcoFoto {
					width: 70px;
					height: 70px;
					text-align: center;
					padding: 6px;
					margin-left: 2px;
					border: 2px solid gray;

					overflow: hidden;
					float: left;
			   }

	@supports(object-fit: cover){
    .marcoFoto img{
			      	height: 100%;
			      	object-fit: cover;
			      	object-position: center center;
			      	padding: 2px;
    			}}

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
</style>

<div>
	<?php 
	   // $info->descripcion   contiene la informacion extra del producto
	  $imagen=$info['fotos']['0'];
	 ?>

	 <div>
	   {{$info['descripcion']}}
	   <div id="imagenes" >
	   	<?php 
	   		for ($i=0; $i <	sizeof($info['fotos']) ; $i++) { 
	   			 
	echo "<a href='javascript:CambiaImagen(\"".$info['fotos'][$i]."\")'><div class='marcoFoto'><img src='".$info['fotos'][$i]."' /></div></a>";
	   		}

	   	 ?>

	   </div>

	 </div>	     
	   <div class="marcoFoto marcoModelos" >
	   	 <p>Modelos Compatibles</p>
	   	 <div class='cabeceraMode'><strong>Marca</strong></div><div class='cabeceraMode'><strong>Modelo</strong></div><br>
	   	 <div id="listModelos" class="ModLisContai"></div>
	   </div>

	<div id="contenido">
      <img id="botella" src="{{$imagen}}" alt="botella con zoom" data-big="{{$imagen}}" data-overlay="" />
	</div>
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

   
  if ((width*height)<136080) {return};


   $("#botella").mlens(
    {
        imgSrc: $("#botella").attr("data-big"),   // path of the hi-res version of the image
        lensShape: "circle",                // shape of the lens (circle/square)
        lensSize: 380,                  // size of the lens (in px)
        borderSize: 4,                  // size of the lens border (in px)
        borderColor: "#fff",                // color of the lens border (#hex)
        borderRadius: 0,                // border radius (optional, only if the shape is square)
        imgOverlay: $("#botella").attr("data-overlay"), // path of the overlay image (optional)
        overlayAdapt: true // true if the overlay image has to adapt to the lens size (true/false)
    });
}

$modelos="<?php  echo $info['modelo']  ?>";
$modelos=$modelos.split("<*>");
 
$Modtext="";

 for (var i = 1; i < $modelos.length; i++) {
 	if ($modelos[i]!="") 
 	{
 		$codMarca=$modelos[i].substring(0,3);
 		$codModel=$modelos[i].substring(3,6);
 		$nombreMarca=$('#'+$codMarca+'.caret');
 		$nombreModel=$('#'+$codModel+'.dmrc'+$codMarca);
 		nm='-';
 		nc='';

 		if (typeof $nombreMarca[0]== "undefined") {$nombreMarca=$('#'+$codMarca+'.xcaret');} 
 		
 		if ($nombreModel.length>0) {nm=$nombreModel[0]['innerText']};
 		if ($nombreMarca.length>0) {nc=$nombreMarca[0]['innerText']};    

 		$Modtext="<div style='width: 50%; float: left; text-align:left;'>"+nc+"</div><div style='width: 50%; float: left; text-align:left;'>"+nm+"</div><br>";
 		$('#listModelos').append($Modtext);
 	}
 }

function CambiaImagen(imagen)
{
  var cambio=" <img id='botella' src='"+imagen+"' alt='botella con zoom' data-big='"+imagen+"' data-overlay='' />";
  $('#contenido').empty();
  $('#contenido').append(cambio);
  
  activaLupa();
}
</script>

<script type="text/javascript" src="jquery.mlens-1.7.min.js"></script>
