 
<div class="modal" id="xMedidas" data-backdrop="false"  >
  <div class="modal-dialog" style="width: 1200px; max-width: 600px;">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h6 class="modal-title">Medidas del producto</h6>
        <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
        <button type="button" id="agregaMedida" class="btn btn-success fa fa-plus" ></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="MedidaADC">
    
        <table id="tablaMedida" class="table table-striped">
          <tr>
            <thead>
              <th></th>
              <th style="with" >Descripcion </th>
              <th>Valor </th>
              <th>Unidad </th>
            </thead>
            <tbody>
            @if (isset($lista->medidas['nombre']))

    
              @for ($i = 0; $i < count($lista->medidas['nombre']); $i++)
              <tr>
                <td>
                  <button type="button" class="btn btn-sm btn-outline-danger fa fa-trash-o" style="font-size: .9em"> </button>
                </td>
                <td> 
                  <input type="text" class="form-control form-control-sm mds" size="80" name="medidas[nombre][]"  value="{{$lista->medidas['nombre'][$i]   ?? ''}}" required>
                </td>
                <td>
                  <input type="text" class="form-control form-control-sm mds" size="10" name="medidas[valor][]" value="{{$lista->medidas['valor'][$i]   ?? ''}}" required>
                </td>
                <td>
                  <select class="form-control form-control-sm mds" name="medidas[unidad][]" onready="javascript:Ponvalor(this,'Ejemplo')"  style="width: 110px">
                    <option  value=0 <?php if (isset(($lista->medidas['unidad'][$i]))and($lista->medidas['unidad'][$i]=='0')) {echo 'selected';} ?> >Unidad</option>
                    <option  value=1 <?php if (isset(($lista->medidas['unidad'][$i]))and($lista->medidas['unidad'][$i]=='1')) {echo 'selected';} ?>>Milimetro</option>
                    <option  value=2 <?php if (isset(($lista->medidas['unidad'][$i]))and($lista->medidas['unidad'][$i]=='2')) {echo 'selected';} ?>>Centimetro</option>
                    <option  value=3 <?php if (isset(($lista->medidas['unidad'][$i]))and($lista->medidas['unidad'][$i]=='3')) {echo 'selected';} ?>>Metro</option>
                    <option  value=4 <?php if (isset(($lista->medidas['unidad'][$i]))and($lista->medidas['unidad'][$i]=='4')) {echo 'selected';} ?> >Pulgada</option>
                  </select>
                </td>
              </tr>
              @endfor 
            @endif
            </tbody>
          </tr>
        </table> 
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" id="cierramedida" class="btn btn-secondary">Cerrar</button>
      </div>

    </div>
  </div>
</div>

<script type="text/javascript">

  $('#agregaMedida').on('click', function(){
      var htmlTags = '<tr><td>'
      +$('#medidaBorra').html()+'</td><td>'
      +$('#medidaNombre').html()+'</td><td>'
      +$('#medidaValor').html()+'</td><td>'
      +$('#medidaUnidad').html()+'</td></tr>';
   $('#tablaMedida tr:last').after(htmlTags);

       ActNumero('MedidaADC', 'codigo_medida'); 
  });


 $("#cierramedida").on('click', function() {
    $abc=$(".mds:visible");
     
    for (var i=0; i < $abc.length; i++) {  
                  if ($abc[i]['value'].length<1) {  
                     $itm=jQuery($abc[i]).get();
                     $itm[0]['style']=("border: 2px solid red");
                     return;
                  } 
    }   
      
    ActNumero('MedidaADC', 'codigo_medida');
    $("#xMedidas").modal('hide');
});


  function AgregaOpcion($id, $opcion, $valor)
   {
      var x = document.getElementById($id);
      var option = document.createElement("option");    
      option.text = $opcion ;
      option.value= $valor;
      x.add(option);
    }

$(document).ready(function(){ ActNumero('MedidaADC', 'codigo_medida');  });
</script>



