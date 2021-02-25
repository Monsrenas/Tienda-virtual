            <div class="table-responsive">        
                <table id="tablamarcas" class="table table-striped table-bordered">
                <thead id="cuerpo">
                    <tr>
                        
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Número de factura</th> 
                        <th>Cliente</th>
                        <th>Vendedor</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($lista as $indice =>$patmt)

                  <?php 
                   $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                   $fecha = \Carbon\Carbon::parse($patmt->created_at);
                   $mes = $meses[($fecha->format('n')) - 1];
                   $estado="Pendiente";
                   $color="blue";
                   if (isset($patmt->estado))
						                   {
						                   	$estado=($patmt->estado=="1")? "Parcial":"Despachada";
						                   	$color=($patmt->estado=="1")? "red":"green";	
						                   }
                  ?>
                    <tr>
                     
                      <td>{{$fecha->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y') ?? ""}}</td>
                       <td width="60" style="color:{{$color}}; text-align: center;">  
                       	 {{$estado}}
                      </td>
                      <td width="150" >
                      		 <button data-toggle="modal" data-target="#myModal" type="button" class="btn btn-outline-primary" onclick="javascript: MostrarFactura('{{$patmt['codigo'] ?? ''}}', '{{$patmt->estado}}')" style="font-size: 1em; height: 20px; padding: 1.4px;" >{{$patmt['codigo'] ?? ''}}</button> 
                      </td>
                      <td>{{$patmt->Cliente["nombre"] ?? $patmt->id_cliente }}</td>
                      <td>{{$patmt->Vendedor["nombre"] ?? $patmt->id_cliente }}</td>
                    </tr>
                  @endforeach                                      
                </tbody>        
               </table>                  
            </div>