<script type="text/javascript">
    function CadenaMarcaModelo(codigo)
  {
      $data="codigo="+codigo.substring(0,codigo.indexOf('N'));

      $.get('/CadenaMarcaModelo', $data, function(subpage){         
         NombraElemento(subpage[0], 'MRC'+codigo.substring(0,3)+codigo.substring(codigo.indexOf('N'))); 
         if ( subpage[1] ){ 
                            NombraElemento(subpage[1], 'MDL'+codigo);
                          }

        }).fail(function() {
           console.log('Error en carga de Datos');
      });

  }

</script>
<div class="modal" id="xVersiones" data-backdrop="false"  >
  <div class="modal-dialog" style="width: 1200px; max-width: 1000px;">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h6 class="modal-title">Modelos de vehiculos</h6>
        <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
        <button type="button" id="agregaVersion" class="btn btn-success fa fa-plus" ></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body row" id="VersionADC">
 
        <div class="row">
                      
 
        </div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="javascript:CerrarMedidas()">Cerrar</button>
      </div>

    </div>
  </div>
</div>


<script type="text/javascript">
	
  $seleccionado='';
  $CadDescr='';

  function CerrarMedidas()
  {
    //$('#agregaVersion').click();    
    ActNumero('VersionADC', 'codigo_modelo');
  }

  $('#agregaVersion').on('click', function(){
  	  if (! $seleccionado) {return;}
      var marca=$('#slctMarca option:selected').html();
      var modelo=$('#slctModelo option:selected').html();
      var motor=$('#motor option:selected').html();
       var campos='';

      NewCateg="<td>"+marca+"</td><td>"+modelo+"</td><td>"+$("#cilindraje").val()+"</td> <td>"+$("#tiempo").val()+"</td> <td>"+motor+"</td> <td>"+$("#observaciones").val()+"</td></tr>";


      var datos={ 'marca': $('#slctMarca').val(),
                  'modelo':$('#slctModelo').val(),
                  'motor':$('#motor').val(),
                  'cilindraje':$('#cilindraje').val(),
                  'tiempo':$('#tiempo').val(),
                  'observaciones':$('#observaciones').val() };

      for (const i in datos) {
        if (datos[i]!=''){
                          campos+="<input name='modelos["+i+"][]' value='"+datos[i]+"' hidden>";
                         }
      }           
     
      NewCateg="<tr><td><button type='button' class='btn btn-sm btn-outline-danger fa fa-trash-o' style='font-size: .9em'> </button>"+campos+"</td>"+NewCateg;



      $('#tablaMarMod tr:last').before(NewCateg);

      //$("#slctMarca").val('0');
      //$("#cilindraje").val('');
      //$('#motor').val('');
      $('#tiempo').val('');
      //$('#observaciones').val('');
      //vaciaSelecct('slctModelo');

       //$seleccionado='';
       //$CadDescr='';
       ActNumero('VersionADC', 'codigo_modelo'); 
  });

        


  $data="coleccion=Marca&columnas=nombre,id_marca";

  $.get('/Resgistro', $data, function(subpage){
      
     for (const indice in subpage)
      {
   
               AgregaOpcion('slctMarca', subpage[indice]['nombre'], subpage[indice]['id_marca'] )
      }

    }).fail(function() {
       console.log('Error en carga de Datos');
  });
  

  function cargaSeleccion(valor, campo)
  {       
        $CadDescr+=valor.options[valor.selectedIndex].text+" ";
        $seleccionado=valor.value;

        if (campo=='id_marca') { 
                                  casilla='slctModelo';
                                  columnas='nombre,id_modelo';
                                  coleccion='Modelo'; 
                                  ID='id_modelo';
                                } else {
                                          casilla='slctVersion';
                                          columnas='nombre,id_version';
                                          coleccion='Version'; 
                                          ID='id_version';
                                        }

        vaciaSelecct(casilla);
        $data="coleccion="+coleccion+"&columnas="+columnas+"&indice="+campo+"&ocurrencia="+valor.value;
        
        $.get('/Resgistro', $data, function(subpage){ 
           for (const indice in subpage)
            {
                     AgregaOpcion(casilla, subpage[indice]['nombre'], subpage[indice][ID] );
            }

          }).fail(function() {
             console.log('Error en carga de Datos');
        });
  }


     function AgregaOpcion($id, $opcion, $valor)
   {
      var x = document.getElementById($id);
      var option = document.createElement("option");    
      option.text = $opcion ;
      option.value= $valor;
      x.add(option);
    }

    function vaciaSelecct($id)
    {
       var x = document.getElementById($id);

        for (let i = x.options.length; i >= 1; i--) {
                                                          x.remove(i);
                                                    }
        



      
      $("#cilindraje").val('');
      $('#motor').val('');
      $('#tiempo').val('');
      $('#observaciones').val('');



        return x;
    }

   $(document).ready(function(){ ActNumero('VersionADC', 'codigo_modelo');  });
</script>



