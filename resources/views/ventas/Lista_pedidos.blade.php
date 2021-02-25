
@extends('panel.menu')
@section('operaciones')

<?php
    $lista=$lista->SortBy('created_at');
?> 

<div id="Centro"  style="font-size: 0.8em; width: 100%; margin-left: 0px;">

  <div class="card card-sm"> 
    <div class="card-header">
        <h6>Listado de pedidos</h6>
    </div>
    <div class="card-body">
    
      <div class="card">
        <div class="card-header bg-primary" style="color: white; " >
         
          <div class="row">  
           <strong class="col-lg-10"><i class="fa fa-list"></i> Pedidos </strong>
          
          </div>
        </div>

        <div class="card-body" style="background: white; padding: 10px; ">
            <div class="table-responsive">        
                <table id="tablamarcas" class="table table-striped table-bordered">
                <thead id="cuerpo">
                    <tr>
                        <th>Fecha</th>
                        <th>Número de Pedido</th> 
                        <th>Cliente</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($lista as $indice =>$patmt)

                  <?php 
                   $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                   $fecha = \Carbon\Carbon::parse($patmt->created_at);
                   $mes = $meses[($fecha->format('n')) - 1];
                  ?>
                    <tr>
                      <td>
                          {{$fecha->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y') ?? ""}}
                          @if ($patmt->estado==1)
                              / Parcialmente facturado
                          @endif
                      </td>
                      
                       <td width="150" >
                           <button data-toggle="modal" data-target="#myModal" onclick=" Vender('{{$patmt->codigo}}')" type="button" class="btn btn-outline-primary" style="font-size: 1em; height: 20px; padding: 1.4px;" >{{$patmt['codigo'] ?? ''}}</button> 
                      </td>
                      <td>{{$patmt->Cliente["nombre"] ?? $patmt->id_cliente }}</td>
                    </tr>
                  @endforeach                                      
                </tbody>        
               </table>                  
            </div>
        </div>
        </div>   {{-- Fin de Card izquierda --}}
   
    
    </div>
  </div>    
</div>
@include('panel.modal.Auxiliar')

<script type="text/javascript">

function Vender(pedido)
{

  $.get("/GestionaPedido/"+pedido, "", function(subpage){ 
        $('#modal-body').html(subpage);
    }).fail(function() {
       console.log('Error en carga de Datos');
  }); 
}


function Facturar(pedido)
{

  $data=$('#Factura').serialize();
  $.get("/Facturar", $data, function(subpage){ 
        $('#modal-body').html(subpage);
        $('#modalPie').empty().append("<button type='button' onclick='javascript: location.href=\"/Listas/Pedido/ventas.Lista_pedidos\"' class='btn btn-danger' data-dismiss='modal'>Cerrar</button>"); 
    }).fail(function() {
       console.log('Error en carga de Datos');
  }); 
}

</script>

<script type="text/javascript" src="{{Request::root()}}/jquery/main.js"></script>
@endsection