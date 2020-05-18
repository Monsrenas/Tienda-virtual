@extends('welcome')


@section('lista_productos')

<style type='text/css'>
	.marco_producto {
						border: 1px solid #C4C4C4;
						float: left;
						border-radius: 8px ;
						position: relative;
					    width: 240px;
					    height: 322px;
					    overflow: hidden;
					    box-shadow: 1px 1px 5px rgba(50,50,50 0.5);
					    text-align: center;

					    margin: 4px;
					}

  	 .marco_producto:hover {
  transform: scale(1.02); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
  -webkit-box-shadow: 1px 3px 12px 6px rgba(58,58,58,0.79); 
box-shadow: 1px 3px 12px 6px rgba(58,58,58,0.79);
transition-duration:0.6s;
    
}

	.marco_foto {
			width: 98%;
			height: 112px;
			text-align: center;
			padding: 6px;
			 
			overflow: hidden;
	}

	@supports(object-fit: cover){
    .marco_foto img{
      height: 100%;
      object-fit: cover;
      object-position: center center;
      padding: 2px;
    }

	.precio {  text-align: right;
				padding: 10px;
			   color: blue;
			   font-size: 2em;
			   height: 40px;
			   margin: 0px;
			    
			 }


	.boton_comprar { width: 90%;
					 margin: 0 auto;
					 height: 35px;
					 font-size: 1.2em; 
					 display: block; 
					 margin-bottom: 2px;
					}

	.boton_comprar:hover  {   background: blue; 
							color: white;	} 				

	.boton_agregar { margin: 0 auto;
					 width: 90%;
					 height: 35px;
					 font-size: 1.2em; 
					 display: block; }

	.boton_agregar:hover  {  background: green; 
							color: white	}			 

	.descripcion { 	padding: 5px;
					font-size: .8em;
					text-align: justify;
					
					height: 60px;
					overflow: hidden;
				 }
	.descripcion p { color: #0055ff; 
					 margin-top: 0px;}			 

	
 
</style>
 
<div id="Centro">
	
  

</div>


<script type="text/javascript">

for (var i = 1; i < 12; i++) {
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