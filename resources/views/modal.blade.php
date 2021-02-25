<script type="text/javascript">


function Modal($vista,$campo, $descripcion)
{ 	  		   
	 $data='{{ csrf_token()}}&url='+$vista+'&campo='+$campo+'&descripcion='+$descripcion;
     $.get('/Vista', $data, function(subpage){ 	
        									  $('#modal-body').empty().append(subpage);
                  							}).fail(function() {
      																 console.log('Error en carga de Datos');
  															   });
}

</script>

