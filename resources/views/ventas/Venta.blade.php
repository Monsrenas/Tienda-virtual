@include('provincias')
<?php 
  if(!isset($_SESSION)){ session_start();}

  if (!isset($lista)) {$lista= [];}

  $Importe=0;
  $cantItem=0; 
  $i=1;
  $provincia=prueba();
  $provincia=json_decode($provincia,JSON_PRETTY_PRINT); 

?>
  

<style type="text/css">
  .drch { text-align: right; }
  .zqrd { text-align: left; }
  .dtos { color: gray; }
  .fnd { background: #EBEDEF;
         font-size: 0.8em;
         padding: 2px;
         margin-bottom: 2px;
       }
  .ncbzd {background: white; width: 100px; text-align: center; margin: 0 auto;}     

table.dataTable thead .sorting:after,
table.dataTable thead .sorting:before,
table.dataTable thead .sorting_asc:after,
table.dataTable thead .sorting_asc:before,
table.dataTable thead .sorting_asc_disabled:after,
table.dataTable thead .sorting_asc_disabled:before,
table.dataTable thead .sorting_desc:after,
table.dataTable thead .sorting_desc:before,
table.dataTable thead .sorting_desc_disabled:after,
table.dataTable thead .sorting_desc_disabled:before {
bottom: .5em;
}  
</style>
        
 <div  style="font-size: 0.8em; padding: 20px;"> 

    <div class="row">
        <div class="col-lg-12 text-center" style="background: black; height: 28px;"><div class="ncbzd"><h4>VENTA</h4></div></div>
            
        <div class="col-6 text-center">Fecha: {{$lista->created_at ?? ''}}</div>
        <div class="col-6 text-center">Pedido: <span style="color: blue;">{{$lista['codigo'] ?? ''}}</span> </div>
            
        <div class="fnd col-6">
          <h6>Pago</h6>
          Forma de pago: <span style="color: green;">{{ $lista['forma_pago'] ??  '' }}</span> 
        </div>

        <div class="fnd col-6">
            <h6>Cliente</h6>
            <p>
              <strong>{{$lista->Cliente->nombre ?? ''}}</strong><br>
              {{$lista->Cliente->direccion ?? ''}}, 
               @if (isset($lista->Cliente->provincia))
                  {{ $provincia[$lista->Cliente->provincia]['provincia']  ?? ''}}: {{ $provincia[$lista->Cliente->provincia]['cantones'][$lista->Cliente->canton]['canton']  ?? ''}} <br>
               @endif
                Tel. {{$lista->Cliente->telefono ?? ''}}, Correo: {{$lista->Cliente->email ?? ''}}
            </p>
        </div>

<div class="col-lg-12">
<form id="Factura">     
  <input type="text" name="id_pedido" value="{{$lista['_id'] ?? ''}}" hidden>      

	<table  id="tablaventas" class="table table-striped" style="width: 100%; min-width: 100%;">
		<thead>
			<tr style="border: 1px solid black; padding: 10px;">
				<th>No.</th>
			 
				<th>Descripción</th>
        <th>Ubicación</th>
        <th style="text-align: right;">Cantidad</th>
        <th style="text-align: right;">Existencia</th>
        <th style="text-align: center;">Facturar</th>
				<th style="text-align: right;">Precio U</th>
				<th style="text-align: right;">Importe</th>
   
			</tr>
		</thead>
    <tbody>
	@foreach ($lista['productos'] as $key=>$item)
		<?php  
		$precio=(isset($item['precio']) ? floatval(str_replace(',', '.',  $item['precio'] ) ):1);
		$cantid=(isset($item['cantidad']) ? (double) $item['cantidad'] : 0);
		$itemImporte= sprintf('%.2f',(float)$precio*(float)$cantid);
		$Importe+=((float)$precio*(float)$cantid);
		$cantItem+=$cantid;
    
	  ?>
		
			<tr>
				<td>{{$i}}</td>
				 
				<td style="text-align: left; line-height: 0.8em; ">
          {{$detalles[$key]['nombre'] ?? ''}}<br> 
          <span style="font-size: .7em; color: gray;">Código: {{$key}}</span>
        </td>
        <td>{{$detalles[$key]['almacen'] ?? ''}}</td>
        <td style="text-align: right;" >{{$item['cantidad']}}</td>
        <td style="text-align: right;">{{$detalles[$key]['INVstock']}}</td>
        <td style="text-align: right;" >
           <input style="width: 60px;" type="number" min="0" id="ctd{{$i}}" class="proCntd" name="productos[{{$key}}][cantidad]" value="{{$cantid}}">
        </td>
				<td style="text-align: right;" id="prc{{$i}}">{{$item['precio']}}</td>
			
				<td style="text-align: right;" id="imp{{$i}}" class="proImporte">{{$itemImporte}}</td>
			</tr>
			
		<?php $i++;?>		
	@endforeach
</tbody>
  <?php 
    $IVA=(sprintf('%.2f',((float) $Importe*floatval( $_SESSION['empresa']['IVA']??0))/100 ));
    $Total=sprintf('%.2f',(float)$IVA+(float)$Importe);
  ?>
  	<tfoot>
  		<tr>
  			<td></td>
        <td></td>
  			<td></td>
  			
  			<td></td>
  			<th style="text-align: right;">Total</th>
  			<td style="text-align: right;" id="FacImporte">{{$Importe}}</td>
        <td></td>
       
  		</tr>
  		<tr>
  			<td></td>
  			 
  			<td></td>
  			<td></td>
  			<td></td>
        @if (isset($_SESSION['empresa']['IVA']))
  			     <th style="text-align: right;">{{$_SESSION['empresa']['IVA']??0}}% IVA</th>
        @endif     
  			<td style="text-align: right;" id="FacIVA">{{$IVA ?? ''}}</td>
        <td></td>
        
  		</tr>
  		<tr>
  			<td></td>
  		 
  			<td></td>
  			<td></td>
  			<td></td>
  			<th style="text-align: right;">A pagar</th>
  			<td style="text-align: right;" id="FacTotal">{{$Total  ?? ''}}</td>
  			<td></td>
        
  		</tr>
  	</tfoot>
 </table>
 </form>
 </div>
 
  </div>  
 </div>

 <script type="text/javascript">
   var $IVA=Number("{{ $_SESSION['empresa']['IVA'] ?? 0}}")/100;

   $('body').on('change', '.proCntd', function()  //Boton que borra categoria
    {
  
      $pos=($(this).attr("id")).substring(3);       
      $cantidad=$(this).val();
      $precio=($('#prc'+$pos)[0]['innerText']).replace(',', '.');
        
      $importe=$precio*$cantidad;
      $('#imp'+$pos)[0]['innerText']=parseFloat($importe).toFixed(2);
      total();
    });

   function total()
   {
      $total=0;
      $tCant=$(".proImporte");
      for (var i = 0; i < $tCant.length; i++) {
         $importe=Number($tCant[i]['innerText']);
         $total+=$importe; 
      }

          $TotIVA=parseFloat($total*$IVA).toFixed(2);
          $importe=Number($TotIVA)+Number($total);
          $('#FacImporte')[0]['innerText']=parseFloat($total).toFixed(2);
          $('#FacIVA')[0]['innerText']=parseFloat($TotIVA).toFixed(2);
          $('#FacTotal')[0]['innerText']=parseFloat($importe).toFixed(2);
   }

       
        $(document).ready(function() {    
            $tableModelos=$('#tablaventas').DataTable({
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
                },
                "scrollY": "50vh",
                "scrollCollapse": true,
            });
            $('.dataTables_length').addClass('bs-select');     
        });

       $('#modalPie').empty().append("<div style='margin: 0px; width:80%; text-align:left;'><button type='button' class='btn btn-danger' id='borraPedido' >Eliminar pedido</button></div>");
       $('#modalPie').append("<button type='button' class='btn btn-success' onclick='javascript:Facturar()'>Facturar</button>"); 
       $('#modalPie').append("<button type='button' class='btn btn-danger' data-dismiss='modal'>Salir</button>"); 
      
$('body').on( 'click', '#borraPedido', function () {
           var data="_token={{ csrf_token()}}&clase=Pedido&condicion=_id,{{$lista['_id'] ?? ''}}";
            $.post('/BorraItem', data, function(subpage){ 
                  location.href="/Listas/Pedido/ventas.Lista_pedidos"; 
            } );
      }); 
 </script>