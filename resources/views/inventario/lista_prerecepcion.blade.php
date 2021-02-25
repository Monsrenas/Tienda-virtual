<?php if (!isset($lista[0])) {return;} 
?> 
<style type="text/css">
    table th {
        text-align: center;
    }
</style>
<div id="Centro"  style="font-size: 0.8em;">
  <div class="card card-sm">
    <div class="card-header  ">
        <div class="row">
                <h6 class="col-lg-10" >Pre-recepción</h6>
                <form action="{{url('Recepcionar')}}" method="post">
                    @csrf
                    <button  type="submit" class="btn btn-success btn-sm">
                          <i class="fa fa-save"></i>
                    </button>
                </form>
        </div>     
    </div>
    <div class="card-body">
       
          
                                               
                <!--Ejemplo tabla con DataTables-->
                
                    
                          
                                <div class="table-responsive">     
                                    <?php $i=1;?> 
                                    <table id="tablamarcas" class="table table-striped table-bordered" style="">
                                    <thead id="cuerpo">
                                        <tr HEIGHT="10">
                                            <th>Sec.</th>
                                            <th></th>
                                            <th>Código</th>
                                   
                                            <th>Cantidad</th>
                                            <th>Costo</th>
                                            <th>Precio U</th>
                                            <th>% Utilidad <br> bruta U</th>
                                            <th>Ganancia <br> bruta U</th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>    
                                        @foreach ($lista as $producto)
                                            <?php 

                                                $Utilidad=0;
                                                $Ganancia=0;  
                                                if (isset($producto->costo))
                                                    {
                                                        $Ganancia=$producto->precio-$producto->costo;
                                                        $Utilidad=($Ganancia*100)/$producto->costo;
                                                    }    
                                             ?> 
                                            <tr>
                                                <td width="5">{{$i++}}</td>
                                                <td width="60">  
                                                       
                                                    <button onclick="javascript:Editar('{{$producto}}')" type="button" class="btn btn-sm fa btn-outline-primary fa-pencil" style="font-size: .9em" ></button> 
                                                    
                                                   
                                                    <button onclick="javascript:borraItem('BorraItem', 'Pre_recepcion', ['_id','{{ $producto->_id}}'])" type="button"   class="btn btn-sm btn-outline-danger fa fa-trash-o" style="font-size: .9em"> </button>
                                                   
                                                    
                                                </td>
                                                <td style="text-align: left;">
                                                    {{ $producto->codigo}}<br>
                                                    <span style="color: blue; font-size: .8em;">
                                                        {{ $producto->producto->nombre}}
                                                    </span>
                                                </td>
                                               
                                                <td><a href="#">{{ $producto->cantidad }}</a></td>
                                                <td>{{ $producto->costo ?? ''}}</td>
                                                <td>{{ $producto->precio }}</td>
                                                <td>{{ $Utilidad ?? '' }}</td>
                                                <td>{{ $Ganancia ?? '' }}</td>
                                                
                                            </tr>
                                        @endforeach                  
                                    </tbody>        
                                   </table>
                                </div>
                            
                  
                   
          
      
    </div>
  </div>    
</div>

<script type="text/javascript" src="{{Request::root()}}/jquery/main.js"></script>

<script type="text/javascript">
    <?php
        $infoCabezera=$lista ?? [];
        if (isset($lista[0])) {  $infoCabezera=$lista[$i-2]; }
                                    
        $fecha=$infoCabezera->fecha ?? '';
        $proveedor=$infoCabezera->proveedor ?? '';
        $provDesc=$infoCabezera->proveedores->nombre ?? '';
        $documento=$infoCabezera->documento ?? '';
        $almacen=$infoCabezera->almacen ?? '';  
        $almaDes=$infoCabezera->almacenes->nombre ?? '';             
    ?>
   
    $('#fecha').val('{{$fecha}}');
    $('#proveedor').val('{{$proveedor}}');
    $('#proveeDesc').val('{{$provDesc}}');
    $('#documento').val('{{$documento}}');
    $("#almacen").val('{{$almacen}}');
    $("#almaDesc").val('{{$almaDes}}');
   
    function Editar($codigo)
    {
        $codigo=JSON.parse($codigo);    

        $('#codigo').val($codigo['codigo']);
        $('#cantidad').val($codigo['cantidad']);
        $('#precio').val($codigo['precio']);
        if (typeof $codigo['costo'] !== 'undefined')
         {
            $('#costo').val($codigo['costo']);
         } 

        if (typeof $codigo['utilidad'] !== 'undefined')
         {
            $('#utilidad').val($codigo['utilidad']);
         }    
    }



</script>

{{--
 <a href="javascript:Editar('{{$producto}}')"><i class="fa fa-pencil"> </i></a> <a href="javascript:borraItem('BorraItem', 'Pre_recepcion', ['codigo','{{ $producto->codigo}}'])"  class="btn btn-sm fa fa-trash-o"> </a>

--}}