<div class="modal" id="xFotos" data-backdrop="false"  >
  <div class="modal-dialog" style="width: 1200px; max-width: 650px;">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h6 class="modal-title">Fotos del producto</h6>
        <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
      </div>
      
 
      <!-- Modal body -->
      <div class="card-deck" style="padding: 10px;">
      <div class="card"> 
        <div class="card-header">Imagenes seleccionadas</div>
      <div class="modal-body row" >
        <div class="card-body" id="FotoADC">
            <table id="tablaFotos" class="table table-striped">
              <thead>
                  <th></th>
                  <th></th>
                  <th>Ilustracion</th>
              </thead>
              <tbody>
            @if (isset($lista->fotos['nombre']))	

            	 @for ($i = 0; $i < count($lista->fotos['nombre']); $i++)
                <tr>
                  <td style="vertical-align: middle;">
                     <button type='button' class='btn btn-sm btn-outline-danger fa fa-trash-o' style='font-size: .9em'> </button>
                    <input type='text' class='col-md-8' name='fotos[nombre][]' value='{{$lista->fotos['nombre'][$i]}}' hidden>
                  </td>
                  
                  <td>
                    <div class='marco_foto'><img class='marco_foto' src='{{Request::root()}}/{{$lista->fotos['nombre'][$i]}}'></div>
                  </td>

                  <td style="vertical-align: middle; text-align: center;">
                    <?php $iluIndi=substr($lista->fotos['nombre'][$i], strrpos($lista->fotos['nombre'][$i], '.')-14,14); ?>
                    
                    <input type="checkbox" name="fotos[funcion][{{$iluIndi}}]" 
                    <?php if ( isset($lista->fotos['funcion'][ $iluIndi ]) ) {echo 'checked';}  ?>>
                  </td>  
                </tr>  
              @endfor

            @endif

            </tbody>
            </table>
            </div>
          </div>
        </div> 

      <div class="card"> 
       
          <div class="card-header"> Galeria de imagenes 
            <span style="float: right;">
            <button type="button" id="fotofile" class="btn btn-success btn-sm fa fa-folder" ></button>
            </span>  
          </div><div class="card-body" id="FotoGaleria" style="max-height: 500px; overflow: scroll;"></div>  
      </div>
      </div>  
  
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="ActNumero('FotoADC', 'fotoNombre')">Cerrar</button>
      </div>
    </div>
  </div>
</div>
 


<script type="text/javascript">

CargaGaleria();

$('body').on('click', '.foto', function(){      

    $camino=decodeURIComponent($(this)[0]['src']);
    $posicion=$camino.lastIndexOf("/"); 
    $fichero=($camino.substring($posicion+1));
    
    agregaFoto($fichero);
    //$('#'+$descr).text($(this)[0].innerText);
   // if ($(this).hasClass("caretX-down")||$(this).hasClass("xcaretX")){
   //   FiltrarCategoria($(this)['0']['id']);    }   

 });

$('body').on('click', '.fotoBorra', function(){      

    $camino=decodeURIComponent($(this).parent().parent().find('img')[0]['src']);
    $posicion=$camino.lastIndexOf("/"); 
    $fichero=($camino.substring($posicion+1));

      
    $data="fichero="+$fichero;  
    $.get('/delFiles', $data, function(subpage){ 

                                                  CargaGaleria();
                                              }).fail(function() {
                                                                    console.log('Error en carga de Datos');
                                                                  });

 });

  
   function agregaFoto(imagenName)
  {
      //20200902001907
      $ItmFoto=imagenName;
      $iluIndi=imagenName.substring( imagenName.lastIndexOf(".")-14,imagenName.lastIndexOf("."));
      
      var NewCateg="<tr><td style='vertical-align: middle;'><button type='button' class='btn btn-sm btn-outline-danger fa fa-trash-o' style='font-size: .9em'> </button><input type='text' class='col-md-8' name='fotos[nombre][]' value='"+$ItmFoto+"' hidden></td><td><div class='marco_foto'><img class='marco_foto' src='{{Request::root()}}/"+$ItmFoto+"'></div></td><td style='vertical-align: middle; text-align: center;'><input type='checkbox' name='fotos[funcion]["+$iluIndi+"]'></td></tr>"
    
      $('#tablaFotos tr:last').after(NewCateg);
      
      ActNumero('FotoADC', 'fotoNombre'); 
  }



function CargaGaleria()
{
  $data='{{ csrf_token()}}&url=panel.modal.galeria&campo=&descripcion=';
         $.get('/Vista', $data, function(subpage){ 
                                $('#FotoGaleria').empty().append(subpage);
                                    }).fail(function() {
                                           console.log('Error en carga de Datos');
                                       });
}
  // http://duckranger.com/2012/06/pretty-file-input-field-in-bootstrap/ 
  // Cuando se pulsa el falso manda el click al autentico
  $('#fotofile').on('click', function(){
    $('#fotoUpl').click();
  });
  
  // Cuando el autentico cambia hace cambiar al falso
  $('input[type=file]').on('change', function(e){
    $(this).next().find('input').val($(this).val());
  });

 $(document).ready(function(){ ActNumero('FotoADC', 'fotoNombre');  });




$('#fotoUpl').on('change', function(e){ 
    nombre=$(this).val();
    
    var NameGenerate=NewImgName(nombre);

    var miForm=document.getElementById('RegProducto');   

            var dataFile = new FormData(miForm);
            
            $.ajax({ 
                             url: "/saveFiles",
                            type: "post", 
                        dataType: "html",
                            data: dataFile,
                           cache: false,
                     contentType: false, 
                     processData: false 
                                                           
                  }).done(function(subpage){  
                           CargaGaleria();
                                            });
});    

function NewImgName(nombre){

    $prueba=Date().toString();
    $prueba=($prueba.substr(0,24));
    $ext=nombre.substr(nombre.indexOf('.'));
    while ($prueba.indexOf(' ')>0) {$prueba=$prueba.replace(" ","");
                                   $prueba=$prueba.replace(":","");}
      return 'img'+$prueba+$ext;    
}
</script>