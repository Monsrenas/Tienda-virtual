
@extends('panel.menu')
@section('operaciones')
 
<div id="Centro"  style="font-size: 0.68em;">
	 
  <div class="card card-sm">
        
    <div class="card-header">
        <h6>Listado de marcas y modelos</h6>
    </div>
    <div class="card-body">
      <div class="card-deck" >  

        <div class="card">
            <div class="card-header bg-primary" style="color: white; " >
              <div class="row">  
              <strong class="col-lg-10" style="font-size: 1.6em;" ><i class="fa fa-list"></i> Marcas </strong>
              <div class="col-lg-1"><a href="#" class="btn fa fa-plus btn-success" data-toggle="modal" data-target="#ModalAuxiliar" onclick="javascript:EditaMarca('', 'nuevaMarca')"></a></div>
              </div>
            </div>

            <div class="col-lg-12 card-body" style="background: white; padding: 20px; ">
                                          
                <!--Ejemplo tabla con DataTables-->
                <div class="container">
                    <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">     

                                    <table id="tablamarcas" class="table table-striped table-bordered">
                                    <thead id="cuerpo">
                                        <tr HEIGHT="10">
                                            <th></th>
                                            <th>Código</th>
                                            <th>Marca</th>
                                            <th>Modelos</th>
                                            <th style="text-align: center; font-size: 1.4em;">
                                                 <i class="fa fa-trash-o" ></i>
                                            </th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lista as $marca)
                                            <tr HEIGHT="10">
                                                <td><a href="#" class="btn btn-sm" style="font-size: 0.8em;" data-toggle="modal" data-target="#ModalAuxiliar" onclick="javascript:EditaMarca('{{ $marca->id_marca }}', 'nuevaMarca')"><i class="fa fa-pencil" style="font-size: 1.3em;"></i></a>  </td>
                                                <td>{{ $marca->id_marca }}</td>
                                                <td><a href="javascript:Muestra('{{$marca->modelos}}','{{ $marca->nombre }}','{{ $marca->id_marca }}')">{{ $marca->nombre }}</a></td>
                                                <td>{{ count($marca->modelos) }}</td>
                                                <td style="text-align: center;">
                                                   @if (!$marca->modelos->isNotEmpty()) 
                                                    <a href="#"  id="{{ $marca->_id }}" class="btn btn-sm fa fa-trash-o" ></a>
                                                     @else 
                                                      <i class="fa fa-chain" style="color: gray;"></i>  
                                                   @endif 
                                                </td>
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

        <div class="card">
            <div class="card-header bg-primary" style="color: white; " >
              <div class="row">  
                <strong class="col-lg-10" style="font-size: 1.6em;" ><i class="fa fa-list"></i><spam id='ModelosTLE'> Modelos</spam> </strong>
                <div class="col-lg-1" id="btnNewModelo"></div>
              </div> 
            </div>

            <div id="VistaModelos" class="col-lg-12 card-body" style="background: white; padding: 20px; ">
               <!-- Espacio para la tabla de modelos -->                                                        
            </div>
        </div>

      </div>    <!-- card-columns -->
    </div>
  </div>    
  
</div>
@include('panel.modal.Auxiliar')
     
<script type="text/javascript" src="/jquery/main.js"></script>

<script type="text/javascript">
    var $tableModelos='';
    var $tablaMarcas='';


    function CargaModelos()
    {
         $.get('ListaModelos', '', function(subpage){ 
                $('#VistaModelos').append(subpage);
         }).fail(function() {
                                console.log('Error en carga de Datos');
                            });
    }


    function Muestra($marca,$nombre,$idMarca)
    {
        $marca=JSON.parse($marca);
             
        $miTab=""; 
        $miTab+="<div class='container'>";
        $miTab+="<div class='row'>";
        $miTab+="<div class='col-lg-12'>";
        $miTab+="<div class='table-responsive'>";
        $miTab+="<table id='tablamodelos' class='table table-striped table-bordered' style='width:100%'>";
        $miTab+="<thead > <tr> <th WIDTH='10'></th><th WIDTH='10' >Código</th><th>Modelo</th> <th WIDTH='10' > </th> </tr> </thead> <tbody>";
        
        for (const prop in $marca)
        {
                $miTab+="<tr>";
                $miTab+="<td><a href='#' class='btn btn-sm' style='font-size: 0.8em;' data-toggle='modal' data-target='#ModalAuxiliar' onclick=\"javascript:EditaMarca('"+$marca[prop]['id_modelo']+"', 'nuevoModelo')\" ><i class='fa fa-pencil' style='font-size: 1.3em;'></i></a> </td>";
                $miTab+="<td>"+$marca[prop]['id_modelo']+"</td>";
                $miTab+="<td>"+$marca[prop]['nombre']+"</td>";
                $miTab+="<td><a href='#' id='"+$marca[prop]['_id']+"' class='btn btn-sm fa fa-trash-o'></a> </td>";
                $miTab+="</tr>";            
        }
                  
        $miTab+="</tbody>";        
        $miTab+="</table>";                  
        $miTab+="</div>";
        $miTab+="</div>";
        $miTab+="</div>";  
        $miTab+="</div>";
        $('#VistaModelos').empty(); 
        $('#VistaModelos').append($miTab);

        $('#ModelosTLE').empty(); 
        $('#ModelosTLE').append(' Modelos: '+$nombre);

         $('#btnNewModelo').empty(); 
        $('#btnNewModelo').append("<a href='#' class='btn fa fa-plus btn-success' data-toggle='modal' data-target='#ModalAuxiliar' onclick=\"javascript:EditaMarca('"+$idMarca+"', 'nuevoModelo')\"></a>");
        
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

      }


        $('#tablamodelos tbody').on( 'click', '.fa-trash-o', function () 
        {
            $tableModelos
                .row( $(this).parents('tr') )
                .remove()
                .draw();
              var data="_token={{ csrf_token()}}&clase=Modelo&condicion=_id,"+$(this)[0]['id'];
              $.post('/BorraItem', data, function(subpage){  
              } );   

        } );
    


 
 
    $('#tablamarcas tbody').on( 'click', '.fa-trash-o', function () {

        $tablaMarcas
            .row( $(this).parents('tr') )
            .remove()
            .draw();
           

         var data="_token={{ csrf_token()}}&clase=Marca&condicion=_id,"+$(this)[0]['id'];
             $.post('/BorraItem', data, function(subpage){  
                } );

    } );

    function EditaMarca($id, controlador)
    {
      $data="id="+$id;
      $.get(controlador, $data, function(subpage){ 
            $('#modal-cuerpo-AUX').html(subpage);

        }).fail(function() {
           console.log('Error en carga de Datos');
      });
    }

</script>

@endsection

