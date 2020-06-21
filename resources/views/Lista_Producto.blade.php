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
	
	var descripcion=subpage['descripcion'];
 	var flag=0;   //Deben cumplirse un numero determinado de condiciones para que se muestre la pieza
 	var indic=0;

  

	if (typeof condiciones['palabra'] != "undefined")  //1ra Que alguna palabra coincida con la descripcion
	{ 
		  for (var i = 0; i < condiciones['palabra'].length; i++) 
	          {	   
					for (const prop in descripcion) 
					{ 
						  	 $ind=(descripcion[prop]).toUpperCase().indexOf(condiciones['palabra'][i].toUpperCase());
					  	 if ($ind>-1) { flag++; }
					} 	 
			  }	 
		  var indic=i;	                                           
	}  else { indic=len(condiciones);}


	if (typeof condiciones['modelo'] != "undefined")
	{   
       for (const prop in modelos) 
			{ 
			  for (var i = 0; i < condiciones['modelo'].length; i++) 
	              {   
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

	if (typeof condiciones['fabricante'] != "undefined")
	{ 
     	console.log(indic);
	   if (subpage['codigo_fabricante']==condiciones['fabricante'])      {  flag++;  }				                  
		                      
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
						$condiciones[condicion['campo']]=[];
						$condiciones[condicion['campo']].push( condicion['codigo']);
					}
		}
	 

		if (enFiltro(subpage[0][prop] ,$condiciones)) {
			 
			if (len($condiciones)>0)	{$valor+=subpage[1][indice]['valor'];}}

	}

	return $valor;
}

function insertaProducto($subpage, $cod, $descuento)
{ 	
  var desIndice=(($subpage['descripcion']) ? Object.getOwnPropertyNames($subpage['descripcion']) : "");
  var preIndice=(($subpage['precios']) ? Object.getOwnPropertyNames($subpage['precios']) : "");
  var fotIndice=(($subpage['fotos']) ? Object.getOwnPropertyNames($subpage['fotos']) : "");	

  var $EtiquetaDescuento='';	

  var $foto=(($subpage['fotos']) ? $subpage['fotos'][fotIndice[0]] : "arbol.png");
  var $precio=(($subpage['precios']) ? $subpage['precios'][preIndice[0]] : "");
  var $descri=(($subpage['descripcion']) ? $subpage['descripcion'][desIndice[0]] : "");
  var $fabric=(($subpage['codigo_fabricante']) ? $subpage['codigo_fabricante'] : "");
  var $gale='';
  var $mods='';
  var $fabricante=($('#'+$fabric+'.guardados').length>0) ? 'Fabricante: '+$('#'+$fabric+'.guardados')[0]['innerText'] :'';
  var $EtiquetasPrecio="<div class='precViej'> </div><div class='precio'>"+$precio+"</div>";
  for (const prop in $subpage['fotos'])
            {  
 				$gale=$gale+"<*>"+$subpage['fotos'][prop];     
            }
  for (const prop in $subpage['modelo'])
            {  
 				$mods=$mods+"<*>"+$subpage['modelo'][prop];  
            }      
   
   if ($gale=='') {$gale='<*>arbol.png';}         
            
  var $precioDesc=$precio;
  if ($descuento>0) {   $EtiquetaDescuento="<div class='EtiDescuento'>-"+$descuento+" %</div>";    
  						$precioDesc=($precio-(($precio*$descuento)/100)).toFixed(2);
  						$EtiquetasPrecio="<div class='precViej'>"+$precio+"</div><div class='precio'>"+$precioDesc+"</div>";
  					  }

  
  var $paq=$cod+"<*>"+$fabricante+"<*>"+$precioDesc+"<*>"+$descri+$gale;
  var $ext=$mods;  // En esta variable, ademas de modelos, va codigo de fabricante y otros datos a mostrar

   	  
  
  


  $Marco="<div class='marco_producto'> "+$EtiquetaDescuento+" "+$EtiquetasPrecio+"<a class='btn btn-sm '  data-toggle='modal' data-target='#myModal' data-remoto='"+$paq+"' data-extra='"+$ext+"'><div class='marco_foto'><img class='foto' id='imagen' src='"+$foto+"' alt='Muestra partes'/></div><div class='descripcion'><p style='color: black; font-weight: bold; margin-bottom: -1px;'>"+$descri+"</p><p>"+$fabricante+"</p> </div></a><button class='boton_agregar btn btn-sm fa fa-shopping-cart'  data-toggle='carAdd'  data-remoto='"+$paq+"' data-extra='"+$ext+"' ><input class='cantCar' type'text'  placeholder='cantidad'> <div class='TextAgr'>Agregar</div></button> </div>";

      var txt = document.getElementById('Centro');
      txt.insertAdjacentHTML('beforeend', $Marco);
}
	
$('body').on('click', '.cantCar', function(eve)	
	{
		 $('.boton_agregar').preventDefault();
	});	

    $('body').on('click', 'a[data-toggle="modal"]', function(){
			  	
		      Modal('Detalle_Producto',$(this).data("remoto"),$(this).data("extra"));     
	});

$('body').on('click', 'button[data-toggle="carAdd"]', function(){

		 $cantidad=($(this).children('input')[0]['value']!='') ? $(this).children('input')[0]['value'] : 1;
		 $(this).children('input')[0]['value']='';

	     $data='{{ csrf_token()}}&url=Carrito&campo='+$(this).data("remoto")+'&descripcion='+$(this).data("extra");
	     $data+='&cantidad='+$cantidad;

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