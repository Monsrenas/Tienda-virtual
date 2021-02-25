<div class="modal" id="NomAdicionales" data-backdrop="false">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h6 class="modal-title">Otras Descripciones</h6>
        <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
        <button type="button" id="agregaNombre" class="btn btn-success fa fa-plus" ></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="NombresADC">
      @if (isset($lista->descripciones))	
      	@foreach ($lista->descripciones as $xItem)

			 <div class='col-lg-10' style='margin-bottom:2px'>
			  <div class='input-group'>
			    <input type='text' class='form-control' name='descripciones[]' value='{{$xItem}}'  placeholder='Código'>
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="ActNumero('NombresADC', 'otras_descripciones')">Cerrar</button>
      </div>

    </div>
  </div>
</div>


<script type="text/javascript">
	
  $('#agregaNombre').on('click', function(){
  	  
      var NewCateg="<div class='col-lg-12' style='margin-bottom:2px'> <div class='input-group'> <input type='text' class='form-control' name='descripciones[]' placeholder='Descripción'> <span class='input-group-btn'> <button class='btn btn-default fa fa-trash-o' type='button'></button> </span> </div> </div>";
      $('#NombresADC').append(NewCateg);

      ActNumero('NombresADC', 'otras_descripciones');
  });
  $(document).ready(function(){ ActNumero('NombresADC', 'otras_descripciones');  });
</script>