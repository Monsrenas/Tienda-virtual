<!--@extends('welcome')


@section('lista_productos')-->
<!DOCTYPE html>
<html>
	<script src="jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="jquery.mlens-1.7.min.js"></script>
<head>
	<title>MAZ Partes</title>

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
	</style>
</head>
<body>
	<?php 
	  $imagen='Pieza 11.jpg';
	 
	 ?>
	<div id="contenido">
   <img id="botella" src="{{$imagen}}" alt="botella con zoom" data-big="{{$imagen}}" data-overlay="" />
</div>
</body>
</html>

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
</script>
<!--@endsection-->