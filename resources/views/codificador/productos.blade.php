<?php
    use App\Producto;
    $producto=Producto::get();
?>
<!--Ejemplo tabla con DataTables-->
                           
                            <div class="container" style="font-size: 0.8em;">
                                <div class="row">
                                        <div class="col-lg-12">
                                            <div class="table-responsive">        
                                                <table id="tablamodelos" class="table table-striped table-bordered">
                                                <thead id="cuerpo">
                                                    <tr>
                                                        <th>Código</th>
                                                        <th>Nombre</th>
                                                        <th>Fabricante</th>
                                                        <th>Categoria</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($producto as $indice =>$patmt)
                                                        <tr>
                                                            <td> 
                                                             <a href="#" data-nombre="{{$patmt['nombre'] ?? '' }}" class="ProCod">{{$patmt['codigo']}}</a> 
                                                            </td>
                                                            <td>{{$patmt['nombre'] ?? '' }}</td>                             
                                                            <td>{{$patmt['fabricante'] ?? '' }}</td>
                                                            <td>{{$patmt['categorias'] ?? '' }}</td>
                                                        </tr>
                                                    @endforeach                                      
                                                </tbody>        
                                               </table>                  
                                            </div>
                                        </div>
                                </div>  
                            </div>    

<script type="text/javascript">
    
            $(document).ready(function() {    
            $tableModelos=$('#tablamodelos').DataTable({
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