@extends('panel.menu')
@section('operaciones')
@include('modal')
<?php if (!isset($lista)) {$lista=[];} 
?> 

<div id="Centro"  style="font-size: .7em;">
  <div class="card card-sm">
    <div class="card-header">
        <h6>Listado de Movimientos</h6>
    </div>
    <div class="card-body">
       
            <div class="col-lg-12 card-body" style="background: white; padding: 20px; ">
                                               
                <!--Ejemplo tabla con DataTables-->
                <div class="container">
                    <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">     
                                    <?php $i=1;?> 
                                    <table id="tablamarcas" class="table table-striped table-bordered" style="">
                                    <thead id="cuerpo">
                                        <tr HEIGHT="10">
                                            <th>No.</th>
                                            <th></th>
                                            <th>Fecha</th>
                                            <th>Recepción</th>
                                            <th>Proveedor</th>
                                            
                                            <th>Realizada por</th>
                                            <th>Almacén</th>
                                        </tr>
                                    </thead>
                                    <tbody>    
                                        @foreach ($lista as $recp)
                                            <tr>

                                                 
                                                <td width="5">{{$i++}}</td>
                                                <td width="30"><button  type="button" class="btn btn-sm btn-outline-primary fa fa-eye" data-toggle="modal" data-target="#myModal" onclick="Modal('inventario.detalle_recepcion','{{ $recp->id ?? ''}}','descr_producto')"  style="font-size: .9em"></button>
                                                </td>
                                                <td >{{ $recp->created_at ?? '' }}</td>
                                                <td>{{ substr($recp->id,0,14) ?? ''}}</td>
                                                <td >{{ $recp->proveedores->nombre ?? ''}}</td>
                                                <td>{{ $recp->persona->nombre ?? ''}}</td>
                                                <td > {{ $recp->almacenes->nombre ?? ''}}</td>
                                            </tr>
                                        @endforeach                  
                                    </tbody>        
                                   </table>
                                </div>
                            </div>
                    </div>  
                </div>    
            </div>
      
    </div>
  </div>    
</div>

<script type="text/javascript" src="{{Request::root()}}/jquery/main.js"></script>
<script type="text/javascript">

    
</script>
@endsection