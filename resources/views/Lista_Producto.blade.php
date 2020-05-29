@extends('welcome')

@section('lista_productos')

<link rel="stylesheet" href="../css/listProducto.css">

<div id="Centro">
</div>

@INCLUDE('modal')
<script type="text/javascript">
/*
for (var i = 1; i < 12; i++) {
	insertaProducto('Pieza '+i,'19.99','Lugar donde se muestra la descripcion del producto');
}*/
  cargarListaProductos('');

  function cargarListaProductos(condiciones)
  {
     $data='{{ csrf_token()}}&referencia=productos';	

     $('#Centro').empty();

     $.get('DevuelveBase', $data, function(subpage){ 
        var $element='';  var $elemenX='';
        for (const prop in subpage)
            {  
 				if (enFiltro(subpage[prop], condiciones)) {  insertaProducto(subpage[prop],prop); }     
            }      

    }).fail(function() {
       console.log('Error en carga de Datos');
  });

  }

function enFiltro(subpage, condiciones)
{
	console.log(condiciones);
	var modelos=subpage['modelo'];
	var $descripcion=subpage['descripcion'];
 	var flag=0;   //Deben cumplirse un numero determinado de condiciones para que se muestre la pieza
 	var indic=0;
	if (typeof condiciones['palabra'] != "undefined")  //1ra Que alguna palabra coincida con la descripcion
	{ 
		  for (var i = 0; i < condiciones['palabra'].length; i++) 
	          {
			  	 $ind=($descripcion).toUpperCase().indexOf(condiciones['palabra'][i].toUpperCase());
			  	 if ($ind>-1) { flag++; } 
			  }	 
		  var indic=i;	                                           
	} 


	if (typeof condiciones['modelo'] != "undefined")
	{ 
       for (const prop in modelos) 
			{ 
			  for (var i = 0; i < condiciones['modelo'].length; i++) 
	              {
				  	 if (modelos[prop]==condiciones['modelo'][i]) 
				  	 	{ flag++; }
				  }	
			  			
			 }
                                                           
	}


	if (typeof condiciones['marca'] != "undefined")
	{ 
       for (const prop in modelos) 
			{ 
			  for (var i = 0; i < condiciones['marca'].length; i++) 
	              {   
				  	 if (modelos[prop].substring(0,3)==condiciones['marca'][i]) 
				  	 	{ flag++; }
				  }	
			  			
			 }
                                                           
	}

	if (flag>=indic){return true} else {return false;}	
}  

function insertaProducto($subpage, $cod)
{ 	
  var $foto=$subpage['fotos']['001'];
  var $precio=$subpage['precios']['001'];
  var $descri=$subpage['descripcion'];
  var $gale='';
  var $mods='';

  for (const prop in $subpage['fotos'])
            {  
 				$gale=$gale+"<*>"+$subpage['fotos'][prop];     
            }
  for (const prop in $subpage['modelo'])
            {  
 				$mods=$mods+"<*>"+$subpage['modelo'][prop];  
            }      

  var $paq=$cod+"<*>"+$precio+"<*>"+$descri+$gale;
  var $ext=$mods;  // En esta variable, ademas de modelos, va codigo de fabricante y otros datos a mostrar

  $Marco="<div class='marco_producto'> <div class='precio'>"+$precio+"</div><a class='btn btn-sm '  data-toggle='modal' data-target='#myModal' data-remoto='"+$paq+"' data-extra='"+$ext+"'><div class='marco_foto'><img class='foto' id='imagen' src='"+$foto+"' alt='Muestra partes'/></div><div class='descripcion'><p>"+$descri+"</p> </div></a> <button class='boton_comprar'>Comprar</button> <button class='boton_agregar' >Agregar</button> </div>";

      var txt = document.getElementById('Centro');
      txt.insertAdjacentHTML('beforeend', $Marco);
}


      $('body').on('click', 'a[data-toggle="modal"]', function(){
			  	
		      Modal('Detalle_Producto',$(this).data("remoto"),$(this).data("extra"));     
	});

</script>

@endsection