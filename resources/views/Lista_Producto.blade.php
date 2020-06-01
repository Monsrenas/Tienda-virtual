@extends('welcome')

@section('lista_productos')

<link rel="stylesheet" href="{{'css/listProducto.css'}}">
 

<div id="Centro">

</div>

@INCLUDE('modal')
@INCLUDE('reloj') 

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
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
     $('#timer').modal('show');

     $.get('DevuelveBase', $data, function(subpage){ 
        var $element='';  var $elemenX='';
        for (const prop in subpage)
            {  
 				if (enFiltro(subpage[prop], condiciones)) {  insertaProducto(subpage[prop],prop); }     
            }      
      $('#timer').modal('hide');
    }).fail(function() {
       console.log('Error en carga de Datos');
  });

  }

function enFiltro(subpage, condiciones)
{	
	var modelos=subpage['modelo'];
	var $descripcion=subpage['descripcion'];
 	var flag=0;   //Deben cumplirse un numero determinado de condiciones para que se muestre la pieza
 	var indic=0;

    console.log(modelos);

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
  var $fabric=$subpage['codigo_fabricante'];
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

  var $paq=$cod+"<*>"+$fabric+"<*>"+$precio+"<*>"+$descri+$gale;
  var $ext=$mods;  // En esta variable, ademas de modelos, va codigo de fabricante y otros datos a mostrar

  $Marco="<div class='marco_producto'> <div class='precio'>"+$precio+"</div><a class='btn btn-sm '  data-toggle='modal' data-target='#myModal' data-remoto='"+$paq+"' data-extra='"+$ext+"'><div class='marco_foto'><img class='foto' id='imagen' src='"+$foto+"' alt='Muestra partes'/></div><div class='descripcion'><p>"+$descri+"</p> </div></a> <button class='boton_comprar'>Comprar</button> <button class='boton_agregar btn btn-sm '  data-toggle='carAdd'  data-remoto='"+$paq+"' data-extra='"+$ext+"' >Agregar</button> </div>";

      var txt = document.getElementById('Centro');
      txt.insertAdjacentHTML('beforeend', $Marco);
}


      $('body').on('click', 'a[data-toggle="modal"]', function(){
			  	
		      Modal('Detalle_Producto',$(this).data("remoto"),$(this).data("extra"));     
	});



      $('body').on('click', 'button[data-toggle="carAdd"]', function(){
			 

	     $data='{{ csrf_token()}}&url=Carrito&campo='+$(this).data("remoto")+'&descripcion='+$(this).data("extra");	
	     $.get('CarritoAgregarItem', $data, function(subpage){
	     		   $('#right_wind').empty(); 
	               $('#right_wind').append(subpage);
	    }).fail(function() {
	       console.log('Error en carga de Datos');
	  	});  

	});  

</script>

@endsection