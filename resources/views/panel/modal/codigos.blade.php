<div class="modal" id="CodAdicionales" data-backdrop="false">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h6 class="modal-title">Codigos adicionales</h6>
        <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
        <button type="button" id="agregaCodigo" class="btn btn-success fa fa-plus" ></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="CodigosADC">
      @if (isset($lista->codigosAd))	
      	@foreach ($lista->codigosAd as $xCodigo)

			 <div class='col-lg-10' style='margin-bottom:2px'>
			  <div class='input-group'>
			    <input type='text' class='form-control' name='codigosAd[]' value='{{$xCodigo}}'  placeholder='Código'>
			    <span class="input-group-btn">
			      <button class='btn btn-default fa fa-trash-o' type='button'></button>
			    </span>
			  </div>
			</div>

        @endforeach 
      @endif  

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="ActNumero('CodigosADC', 'codigo_adicionales');">Cerrar</button>
      </div>

    </div>
  </div>
</div>


<script type="text/javascript">
	
  $('#agregaCodigo').on('click', function(){
  	  
      var NewCateg="<div class='col-lg-10' style='margin-bottom:2px'> <div class='input-group'> <input type='text' class='form-control' name='codigosAd[]' placeholder='Código'> <span class='input-group-btn'> <button class='btn btn-default fa fa-trash-o' type='button'></button> </span> </div> </div>";
      $('#CodigosADC').append(NewCateg);

      ActNumero('CodigosADC', 'codigo_adicionales');      
  });
  $(document).ready(function(){ ActNumero('CodigosADC', 'codigo_adicionales');  });
</script>