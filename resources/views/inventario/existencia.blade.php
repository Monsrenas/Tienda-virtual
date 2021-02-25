@extends('panel.menu')
@section('operaciones')
@include('modal')
<?php if (!isset($lista)) {$lista=[];} 
?> 

<div id="Centro"  style="font-size: .7em;">
  <div class="card card-sm">
    <div class="card-header">
        <h6>Listado de Inventario</h6>
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
                                            <th>Código</th>
                                            <th>Nombre</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>En almacén</th>
                                            <th>Almacén</th>
                                        </tr>
                                    </thead>
                                    <tbody>    
                                        @foreach ($lista as $recp)
                                            <tr>
                                                <td width="5">{{$i++}}</td>
                                                <td>{{$recp->producto}}</td>
                                                <td >{{ $recp->detalles->nombre ?? '' }}</td>
                                                <td style="text-align: right;">{{ $recp->precio ?? ''}}</td>
                                                <td style="text-align: right;">{{ $recp->cantidad ?? ''}}</td>
                                                <td style="text-align: right;">{{ $recp->fisico ?? ''}}</td>
                                                <td style="text-align: center;">{{ $recp->almacenes->nombre ?? ''}}</td>
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