                <table id="tablamarcas" class="table table-striped table-bordered">
                <thead id="cuerpo">
                    <tr>
                        <th></th>
                        <th>Nombre</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Valor</th>                                                  
                    </tr>
                </thead>
                <tbody>
                  @foreach($lista as $indice =>$patmt)
                    <tr>
                      <td width="84"> 
                        <a href="/Listas/Descuento/panel.ofertas/_id,=,{{$patmt->_id ?? ''}}" type="button" class="btn btn-sm fa btn-outline-primary fa-pencil" style="font-size: .9em" ></a> 
                                                    
                                                   
                        <button onclick="javascript:borraItem('BorraItem', 'Descuento', ['_id','{{ $patmt->_id ?? ''}}'])" type="button"   class="btn btn-sm btn-outline-danger fa fa-trash-o" style="font-size: .9em"> </button>  
                      </td>
                      <td>{{$patmt['nombre'] ?? ''}}</td>
                      <td>{{$patmt['inicio'] ?? ''}}</td>
                      <td>{{$patmt['final'] ?? '' }}</td>
                      <td>{{$patmt['valor'] ?? '' }}</td>                             
                    </tr>
                  @endforeach                                      
                </tbody>        
               </table> 