@include('provincias')
<?php 
  if(!isset($_SESSION)){ session_start();}

  if (!isset($_SESSION['MyCarrito'])) {$_SESSION['MyCarrito']= [];}

  $Importe=0;
  $cantItem=0;
  $carLista=$_SESSION['MyCarrito']; 
  $i=1;
  $provincia=prueba();
  $provincia=json_decode($provincia,JSON_PRETTY_PRINT); 
     
 
?>

<style type="text/css">
  .drch { text-align: right; }
  .zqrd { text-align: left; }
  .dtos { color: gray; }
</style>
<div class="card">
    <div class="card-header">
      <h4 class='modal-title'>Forma de pago</h4>

    </div>
        <div class="row" style="width: 600px; margin: 0 auto;">
        	<table class="col-12  table-responsive">
        	<thead>
            @if ((isset($_SESSION['cliente']))and($cliente))
            <tr style="background: #EBEDEF;">
              <th colspan="2" style="text-align: center; ">Información del Cliente</th>
            </tr>
            <tr>
              <td class="drch dtos">Cliente: </td>
              <td>{{$cliente->nombre ?? ''}}</td>
            </tr> 
            <tr>
              <td class="drch dtos">Dirección: </td>
              <td>{{$cliente->direccion ?? ''}}</td>
            </tr>
            <tr>
              <td></td>
              <td class="zqrd">
                @if (isset($cliente->provincia))
                {{ $provincia[$cliente->provincia]['provincia']  ?? ''}}, {{ $provincia[$cliente->provincia]['cantones'][$cliente->canton]['canton']  ?? ''}}
                @endif
              </td>
            </tr>
            <tr>
              <td class="drch dtos">Correo: </td>
              <td>{{$cliente->email ?? ''}}</td>
            </tr>
            <tr>
              <td class="drch dtos">Teléfono: </td>
              <td>{{$cliente->telefono ?? ''}}</td>
            </tr>
            @else
              <div class="col-12" style="color: white; background: red; text-align: center; vertical-align: middle;">
               <h6 >Inicie sección para completar el proceso de compra</h6>
               </div>
            @endif
          </thead>	 
        	@foreach ($carLista as $item)
        		<?php  
            		$precio=(isset($item['precio']) ? floatval(str_replace(',', '.',  $item['precio'] ) ):1);
            		$cantid=(isset($item['cantidad']) ? (double) $item['cantidad'] : 0);
            		$itemImporte= sprintf('%.2f',(float)$precio*(float)$cantid);
            		$Importe+=((float)$precio*(float)$cantid);
            		$cantItem+=$cantid;
            		$IVA=(sprintf('%.2f',((float) $Importe*floatval( $_SESSION['empresa']['IVA']??0))/100 ));
            		$Total=sprintf('%.2f',(float)$IVA+(float)$Importe);
        	  ?>	
        		<?php $i++;?>		
        	@endforeach
          	<tfoot>
              <tr><td><br></td></tr>
              <tr style="background: #EBEDEF;">
              <th colspan="2" style="text-align: center; ">Información del Pago</th>
            </tr>
          		<tr>
          			<th class="drch">Importe</th>
          			<td width="40" class="drch"> {{$Importe}}</td>
          		</tr>
          		<tr>
          		 
                @if (isset($_SESSION['empresa']['IVA']))
          			     <th class="drch">{{$_SESSION['empresa']['IVA']??0}}% IVA</th>
                     <td class="drch">{{$IVA ?? ''}}</td>
                @endif     
          		</tr>
          		<tr>
          			<th class="drch">Total a pagar</th>
          			<td class="drch">{{$Total  ?? ''}}</td>
          		</tr>
              
              <tr style="background: #EBEDEF;">
                <th>Forma de pago</th>
                <td class="drch">
                  <select class="form-control-sm form-control" id="comoPagoSLCT"  style="width: 140px;">
                    <option></option>
                    <option value='EF'>Efectivo</option>
                    <option value='CH'>Cheque</option>
                    <option value='TR'>Transferencia</option>
                    <option value='CR'>Crédito</option>
                    <option value='TD'>Tarjeta de Débito</option>
                    <option value='TC'>Tarjeta de Crédito</option> 
                  </select>    
                </td>
              </tr>
          	</tfoot>
         </table>

        @if (isset($_SESSION['cliente']))
              
             
          <button type="button" id="SendPedido" class="btn btn-success" disabled  style="margin: 0 auto; margin-top: 40px;">CERRAR COMPRA Y PAGAR

          </button>
              
                
           
        @endif
    </div> 
</div>