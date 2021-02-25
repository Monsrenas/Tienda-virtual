@extends('panel.menu')
@section('operaciones')

<?php
    //$lista=$lista->sortByDesc('created_at');
?> 

<div id="Centro"  style="font-size: 0.8em; width: 100%; margin-left: 0px;">

  <div class="card card-sm"> 
    <div class="card-header">
        <h6>Despacho de productos</h6>
    </div>
    <div class="card-body">
    
      <div class="card">
        <div class="card-header bg-primary" style="color: white; " >
         
          <div class="row">  
           <strong class="col-lg-10"><i class="fa fa-list"></i> Facturas </strong>
          
          </div>
        </div>

        <div class="card-body" style="background: white; padding: 10px; ">

        	@include('ventas.listaDetalladaFactura')

        </div>
        </div>   {{-- Fin de Card izquierda --}}
   
    
    </div>
  </div>    
</div>
@include('panel.modal.Auxiliar')

<script type="text/javascript">

function MostrarFactura($numero, $estado)
{
 		
  $.get("/DetalleFactura/"+$numero+"/ventas.Despacho_factura", "", function(subpage){ 
        $('#modal-body').html(subpage);

        if ($estado!="2")
         {
                $('#modalPie').empty().append("<div style='margin: 0px; width:80%; text-align:left;'><button type='button' class='btn btn-success' id='Despachar' >Efectuar despacho "+$estado+"</button></div>");
         } else { $('#modalPie').empty(); } 
        
       $('#modalPie').append("<button type='button' class='btn btn-danger' data-dismiss='modal'>Salir</button>"); 
    }).fail(function() {
       console.log('Error en carga de Datos');
  }); 
}

$('body').on( 'click', '#Despachar', function () {
      $data=$('#Despacho').serialize();
	  $.get("/Despachar", $data, function(subpage){ 
	        $('#modal-body').html(subpage);
	        $('#modalPie').empty().append("<button type='button' onclick='javascript: location.href=\"/Listas/Pedido/ventas.Lista_pedidos\"' class='btn btn-danger' data-dismiss='modal'>Cerrar</button>"); 
	    }).fail(function() {
	       console.log('Error en carga de Datos');
	  }); 
      }); 

</script>

<script type="text/javascript" src="{{Request::root()}}/jquery/main.js"></script>
@endsection