
<div id="Centro" style="font-size: 0.8em;">
  <form  id="Regpagos" method="POST"  action="{{ url('RegistrarPago') }}" class="form-horizontal md-form"  style="font-size: .85em;">
  @csrf
    
    <div class="card-header card">
        <h5>Registrar pago</h5>
    </div>

    <div class="col-lg-12 card" style="background: white; padding: 20px; ">

              <input type="text" name="id_cliente" value="{{$lista[0]->id_cliente}}" hidden>

              <div class="form-group row" style="margin-bottom: 3px; "> 
                  <label class="col-lg-4 col-form-label text-right" for="forma_pago">Pedido:</label>
                  <div class="col-sm-8">
                    <select class="form-control-sm form-control" id="pedidoSLCT" name="id_pedido"  style="width: 100%;">
                    @foreach($lista as $indice =>$patmt)
                        <option value="{{$patmt->_id}}">{{$patmt->codigo}} ({{$patmt->valor??""}})</option>
                    @endforeach
                  </select>

                  {{--<script type="text/javascript">$("#forma_pago").val('{{$lista[0]->forma_pago ?? ''}}');</script>--}}
                  </div>
              </div>
    	 	       <div class="form-group row" style="margin-bottom: 3px; "> 
                  <label class="col-lg-4 col-form-label text-right" for="transaccion">Tipo de transacción:</label>
                  <div class="col-sm-4">
                    <select class="form-control-sm form-control" id="transaccion" name="transaccion"  style="width: 160px;" required="">
                    <option></option>
                    <option value='TR'>Transferencia</option>
                    <option value='DE'>Depósito</option> 
                  </select>

                  <script type="text/javascript">$("#forma_pago").val('{{$lista[0]->forma_pago ?? ''}}');</script>
                  </div>
              </div>

               <div class="form-group row" style="margin-bottom: 3px; "> 
                  <label class="col-lg-4 col-form-label text-right" for="forma_pago">Banco:</label>
                  <div class="col-sm-4">
                    <select class="form-control-sm form-control" id="bancoSLCT" name="id_banco"  style="width: 160px;" required="">
                    <option></option>
                    <option value='TR'>Produbanco</option>
                    <option value='DE'>Pichincha</option> 
                  </select>

                  <script type="text/javascript">$("#forma_pago").val('{{$lista[0]->forma_pago ?? ''}}');</script>
                  </div>
              </div>

               <div class="form-group row" style="margin-bottom: 3px; ">
                  <label class="col-lg-4 col-form-label text-right" for="comprobante"0>Comprobante de pago:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-sm" id="comprobante" name="comprobante" placeholder="" value="{{$lista[0]->documento_pago ?? ''}}" required  >
                  </div>
              </div>

             

             <div class="form-group row" style="margin-bottom: 3px; ">
                  <label class="col-lg-4 col-form-label text-right" for="valor">Valor:</label>
                  <div class="col-sm-6">
                    <input type="numero" class="form-control form-control-sm" id="valor" name="valor" placeholder="" value="{{$lista[0]->valor ?? ''}}" required>
                  </div>
              </div>
 
              <div class="form-group row" style="margin-top: 16px; ">
                  <label class="col-lg-12 col-form-label text-center" for="imagen">Imagen del comprobante:</label>
                  <div class="col-sm-12">
                    <input type="file" class="form-control form-control-sm" id="imagen" name="imagen" placeholder="" value="{{$lista[0]->imagen ?? ''}}" required  >
                  </div>
              </div>
       
  </div>


 
  
        <button id="btGuardaProd" class="btn fa fa-save btn-success float-right" disabled=""> Registrar Pago</button>
     </form>
</div>


<script type="text/javascript">
     

$('input').attr("autocomplete","off");

$('body').on('change', '#email', function()
{
    $data="id="+$(this).val(); 
    $.get(' ', $data, function(subpage){
       $('#EspacioAccion').html(subpage);        
    }).fail(function() {
       console.log('Error en carga de Datos');
  });
});
 
$('body').on('change', 'input, select', function()
{
     
    $('#btGuardaProd').attr("disabled",false);
}); 

function GuardarPersona()
{
  var data=$('#RegPersona').serialize();
     var data="_token={{ csrf_token()}}&"+data;
     console.log(data);
      $.post('RegistrarUsuario', data, function(subpage){  
        
              $('#btGuardaProd').attr("disabled",true);
              $("#codigo_producto").focus();
    });
}
</script>