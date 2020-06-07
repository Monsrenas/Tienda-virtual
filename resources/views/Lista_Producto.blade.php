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

     $.get('Info_Producto', $data, function(subpage){ 
        var $element='';  var $elemenX='';
         
        for (const prop in subpage[0])
            {  
 				if (enFiltro(subpage[0][prop], condiciones)) 
 					  {  
 					  	insertaProducto(subpage[0][prop],prop, descuentos(subpage, prop)); 
 					  }     
            }      
      $('#timer').modal('hide');
    }).fail(function() {
       console.log('Error en carga de Datos');
  });

  }

function enFiltro(subpage, condiciones)
{	
	var modelos=subpage['modelo'];
	var categoria=subpage['categoria'];
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
	} else {indic=len(condiciones); }

	if (typeof condiciones['modelo'] != "undefined")
	{   
       for (const prop in modelos) 
			{ 
			  for (var i = 0; i < condiciones['modelo'].length; i++) 
	              {   console.log(condiciones['modelo'][i]+" ----- "+modelos[prop]);
				  	 if (modelos[prop]==condiciones['modelo'][i])     { flag++; }
				  }				
			 }                                               
	}

	if (typeof condiciones['marca'] != "undefined")
	{  si=0;
       for (const prop in modelos) 
			{ 
			  for (var i = 0; i < condiciones['marca'].length; i++) 
	              {   
				  	 if (modelos[prop].substring(0,3)==condiciones['marca'][i])    {  si=1; }
				  }				
			 }
		flag +=si;		                                        
	}

	if (typeof condiciones['categoria'] != "undefined")
	{ 
       for (const prop in categoria) 
			{ 
				  	 if (categoria[prop]==condiciones['categoria'])      {  flag++;  }			
			}                  
		                      
	}
	 
	if (flag>=indic){return true} else {return false;}	

}  

function descuentos(subpage, prop)
{	var $valor=0;
	
	for (const indice in subpage[1])
	{	
		$condiciones=new Array();
		for (const cond in subpage[1][indice]['condiciones'])
		{	
			condicion=subpage[1][indice]['condiciones'][cond];
			 	
			if (condicion['campo']=='codigo') {
												if (condicion['codigo']==prop){
																                 $valor+=subpage[1][indice]['valor'];
																               }
			} else {
						$condiciones[condicion['campo']]=condicion['codigo'];
					}
		}
	 

		if (enFiltro(subpage[0][prop] ,$condiciones)) {
			 
			if (len($condiciones)>0)	{$valor+=subpage[1][indice]['valor'];}}

	}

	return $valor;
}

function insertaProducto($subpage, $cod, $descuento)
{ 	
  var $EtiquetaDescuento='';	
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


  if ($descuento>0) {   $EtiquetaDescuento="<div class='EtiDescuento'>"+$descuento+" %</div>";      }
  $Marco="<div class='marco_producto'> "+$EtiquetaDescuento+" <div class='precio'>"+$precio+"</div><a class='btn btn-sm '  data-toggle='modal' data-target='#myModal' data-remoto='"+$paq+"' data-extra='"+$ext+"'><div class='marco_foto'><img class='foto' id='imagen' src='"+$foto+"' alt='Muestra partes'/></div><div class='descripcion'><p>"+$descri+"</p> </div></a> <button class='boton_comprar'>Comprar</button> <button class='boton_agregar btn btn-sm '  data-toggle='carAdd'  data-remoto='"+$paq+"' data-extra='"+$ext+"' >Agregar</button> </div>";

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

function len(arr) {
  var count = -1;
  for (var k in arr) {
    if (arr.hasOwnProperty(k)) {
      count++;
    }
  }

  if (count<0) {count=0;}
  return count;
}

</script>

@endsection