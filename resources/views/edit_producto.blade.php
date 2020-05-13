@extends('menu')


@section('operaciones')
 
<div id="Centro">
	
  

</div>


<script type="text/javascript">

for (var i = 1; i < 11; i++) {
	insertaProducto('Pieza '+i,'19.99','Lugar donde se muestra la descripcion del producto');
}

	
function insertaProducto($Imagen,$precio, $descripcion)
{ 	
  $Marco="<div class='marco_producto'> <div class='precio'>"+$precio+"</div><a href='Detalle?img="+$Imagen+"'><div class='marco_foto'><img class='foto' id='imagen' src='"+$Imagen+".jpg' alt='Muestra partes'/></div><div class='descripcion'><p>"+$descripcion+"</p> </div>  </a> <button class='boton_comprar'>Comprar</button> <button class='boton_agregar'>Agregar</button> </div>";

        var txt = document.getElementById('Centro');
        txt.insertAdjacentHTML('beforeend', $Marco);
}

 


</script>
@endsection