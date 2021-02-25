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
            <table id="tablaMarMod" class="table table-striped">
              <thead>
                  <th></th>
                  <th>Marca</th>
                  <th>Modelo</th>
                  <th>Cilindraje</th>
                  <th>Año</th>
                  <th>Motor</th>
                  <th>Obervaciones</th>
              </thead>
              <tbody>
                @if (isset($lista->modelos['marca']))
                  @for ($i = 0; $i < count($lista->modelos['marca']); $i++)
                    <tr>  
                      <td>
                        <button type='button' class='btn btn-sm btn-outline-danger fa fa-trash-o' style='font-size: .9em'> </button>
                        
                        <input type="text" name="modelos[marca][]" value="{{$lista->modelos['marca'][$i]}}" hidden>
                        <input type="text" name="modelos[modelo][]" value="{{$lista->modelos['modelo'][$i] ?? ''}}" hidden>
                        
                      </td>
                      <td id="MRC{{$lista->modelos['marca'][$i] ?? ''}}N{{$i}}"></td>
                      <td id="MDL{{$lista->modelos['modelo'][$i] ?? ''}}N{{$i}}"></td>
                      <script type="text/javascript">
                          CadenaMarcaModelo('{{$lista->modelos['modelo'][$i] ?? $lista->modelos['marca'][$i]}}N{{$i}}');
                      </script>
                      <td><input type="number" size="2" class="form-control form-control-sm" name="modelos[cilindraje][]" value="{{$lista->modelos['cilindraje'][$i] ?? ''}}" ></td> 
                      <td><input type="number" name="modelos[tiempo][]" value="{{$lista->modelos['tiempo'][$i] ?? ''}}" class="form-control form-control-sm" size="2"></td> 
                      <td>
                        <input type="text" name="modelos[motor][]" value="{{$lista->modelos['motor'][$i] ?? ''}}" class="form-control form-control-sm" size="2" readonly>
                      </td> 
                      <td>
                        <input type="text" name="modelos[observaciones][]" value="{{$lista->modelos['observaciones'][$i] ??''}}" class="form-control form-control-sm" size="100">
                      </td>
                    </tr>
                  @endfor 
                @endif                 
                <tr>
                  <td></td>
                  <td>
                    <select class="form-control-sm form-control" id="slctMarca" onchange="cargaSeleccion(this, 'id_marca')" style="width: 110px;">
                      <option selected></option>
                    </select>
                  </td>
                  <td>
                    <select class="form-control-sm form-control" id="slctModelo" onchange="cargaSeleccion(this, 'id_modelo')" style="width: 110px;">
                      <option selected></option>
                    </select>                    
                  </td>
                  <td>
                     <input type="number" class="form-control form-control-sm" id="cilindraje" size="4" style="width: 80px;">
                  </td>
                  <td>
                    <input type="number" class="form-control form-control-sm" id="tiempo" size="4" style="width: 68px;">
                  </td>
                  <td>
                    <input type="motor" class="form-control form-control-sm" id="motor" size="50">
                    

                  </td>
                  <td>
                    <input type="text" class="form-control form-control-sm" id="observaciones" size="100">
                  </td>

                </tr>
              </tbody>
            </table>
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
      var motor=$('#motor').val();
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



