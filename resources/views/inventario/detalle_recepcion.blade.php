<?php
    use App\Recepcion;
    $lista=Recepcion::where('id',$info->campo)->get();
?>
<div id="Centro"  style="font-size: .7em;">
  <div class="card card-sm">
    <div class="card-header">
        <h6>Detalle de Recepción</h6>
    </div>
    <div class="card-body">
       <table style="width: 80%; font-size: 1.1em">
                <th>
                    <li> <strong>Recepción: </strong> {{ substr($info->campo ?? "",0,14)}}</li>  
                    <li><strong>fecha: </strong>{{$lista[0]->created_at ?? ""}} </li>
                    <li><strong>Realizada por: </strong>{{$lista[0]->persona->nombre ?? ""}}   </li>
                </th>
                <th>
                   <li> <strong>Destino: </strong> {{ $lista[0]->almacenes->nombre ?? ''}}</li>
                   <li> <strong>Proveedor: </strong> {{ $lista[0]->proveedores->nombre ?? ''}}</li> 
                </th>

                </table>     
            <div class="col-lg-12 card-body" style="background: white; padding: 20px; ">
                                    
                <!--Ejemplo tabla con DataTables-->
                <div class="container">
                    <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">     
                                    <?php $i=1;?> 
                                    <table id="tablamrecepcion" class="table table-striped table-bordered" style="">
                                    <thead id="cuerpo">
                                        <tr HEIGHT="10">
                                            <th>No.</th>
                                            <th>Producto</th>
                                            <th>Descripción</th>
                                            <th>Existencia</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                        </tr>
                                    </thead>
                                    <tbody>    
                                        @foreach ($lista as $recp)
                                            <tr>
                                                <td width="5">{{$i++}}</td>
                                                <td>{{ $recp->codigo ?? '' }}</td>
                                                <td >{{ $recp->detalles->nombre ?? '' }}</td>
                                                <td style="text-align: right;">{{ $recp->cantidad ?? 0}}</td>
                                                <td style="text-align: right;">{{ $recp->cantidad ?? ''}}</td>
                                                <td style="text-align: right;">{{ $recp->precio ?? ''}}</td>
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

<script type="text/javascript">
    
            $(document).ready(function() {    
            $tablamrecepcion=$('#tablamrecepcion').DataTable({
             //para cambiar el lenguaje a español
            "language": {
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Registros del _START_ al _END_ de _TOTAL_ registros",
                    "infoEmpty": "Registros del 0 al 0 de 0 registros",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sSearch": "Buscar:",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast":"Último",
                        "sNext":">",
                        "sPrevious": "<"
                     },
                     "sProcessing":"Procesando...",
                }
            });     
        });
</script>