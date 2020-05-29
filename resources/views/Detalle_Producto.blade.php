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
					width: 80px;
					height: 80px;
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
</style>

<div>
	<?php 
	   // $info->descripcion   contiene la informacion extra del producto
	   $ProdData=explode ( '<*>' ,$info->campo , 10 );
	   $ProdExtr=explode ( '<*>' ,$info->descripcion , 10 );
	  $imagen=$ProdData[3];
	 ?>

	 <div>
	   {{$ProdData[2]}}
	   <div id="imagenes">
	   	<?php 
	   		for ($i=0; $i <	sizeof($ProdData)-3 ; $i++) { 
	   			 
	   			echo "<div class='marcoFoto'><img src='".$ProdData[$i+3]."' /></div>";
	   		}

	   	 ?>
	   </div>

	   <div id="listModelos">
	   	
	   </div>
	</div>

	<div id="contenido">
   <img id="botella" src="{{$imagen}}" alt="botella con zoom" data-big="{{$imagen}}" data-overlay="" />
</div>

</div>

<script type="text/javascript">
$(document).ready(function()
{
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
});

$modelos=("<?php echo $info->descripcion; ?>").split('<*>');
 for (var i = 0; i < $modelos.length; i++) {
 	if ($modelos[i]<>"") 
 	{
 		$nombreMarca=$('dmrc'+$modelos[i].substring(0,3));
 		
 	}
 }


</script>

<script type="text/javascript" src="jquery.mlens-1.7.min.js"></script>
