@extends('panel.menu')
@section('operaciones') 
<?php 
    use App\Descuento;
      if (isset($lista[0])) { $lista=$lista[0];} 
      if (!isset($lista)) {$lista=new Descuento;}
?>
 
<script type="text/javascript">

  var concepto={'codigo' : "Producto","categorias":"Categoria", "fabricante":"Fabricante"};  

function Registros(...args)
{
  const vista = (args.length > 0) ? args.shift() : null;
  const coleccion = (args.length > 0) ? args.shift() : null;
  const condiciones = (args.length > 0) ? args.shift() : null;
  const columnas = (args.length > 0) ? args.shift() : null;
  const destino = (args.length > 0) ? args.shift() : null;
  let aux=['',''];
  if (condiciones) {
                      aux=condiciones.split(',');
                    }

  $data="vista="+vista+"&coleccion="+coleccion+"&indice="+aux[0]+"&ocurrencia="+aux[1]+"&columnas="+columnas;
    
  $.get('/Resgistro', $data, function(subpage){ 
    
     if (columnas) { subpage=subpage[0][columnas]; }
          
     if (destino) {   $('#'+destino).html(subpage);       }
      else        {   $('#EspacioAccion').html(subpage);  }

  }).fail(function() {
       console.log('Error en carga de Datos');
  });
}

  function CadenaMotivo(clase, codigo, pos)
  {
       
      $data="codigo="+codigo;
      //$('#'+pos).empty().append('Prueba');
      if (clase=="modelos")
      {
              $.get('/CadenaMarcaModelo', $data, function(subpage){         
                 $("#"+pos).empty().append(subpage[0]); 
                 if ( subpage[1] ){ 
                                    $("#"+pos).empty().append(subpage[0]+" "+subpage[1]);
                                  }
                   
                }).fail(function() {
                   console.log('Error en carga de Datos');
              });

          return;


      }

       Registros("", concepto[clase], "codigo, "+codigo, "nombre", pos);


  }
</script>

<script type="text/javascript">
  var motivo={"codigo":"ObtenCodigoProducto","categorias":"ObtenCodigoCategoria","fabricante":"ObtenCodigoFabricante","modelos":"ObtenCodigoMarcaModelo"};
</script>

<form action="{{ url('/GuardaCodigo') }}" method="post">
 @csrf 
 <input type="text" name="clase" value="Descuento" hidden> 
<div class="card-deck"> 
<div class="card" style="font-size: 0.8em;">
    <div class="card-header ">
         <div class="row">
            <div class="col-lg-9">
              <h5>Ofertas</h5>
            </div>
            
            <div class="col-lg-1"> 
              <a href="{{url('/Listas/Descuento/panel.ofertas/_id,=,0')}}"  class="btn fa fa-plus btn-success"></a>
            </div>
            <div class="col-lg-1"> 
              <button  class="btn fa fa-save btn-success"></button>
            </div>
         </div>
    </div>
    <div class="card-body">
       
      <div class="row">
         
        <div class="col-lg-12 row">         
           <div class="col-lg-4 text-lg-right">
             <label>Descripción:</label>
           </div>
           <div class="col-lg-8 text-lg-left">
            <input type="text" name="_id" value="<?php if (isset($lista->_id)) echo $lista->_id ?>" hidden>
             <input type="text" style="width: 338px" name="nombre" value="<?php if (isset($lista->nombre)) echo $lista->nombre ?>" required>
           </div>

           <div class="col-lg-4 text-lg-right" > 
             <label>Fecha inicio:</label>
              
           </div>
           <div class="col-lg-8" > 
             <input type="date" name="inicio" value="<?php if (isset($lista->inicio)) echo $lista->inicio ?>" required>
           </div>

           <div class="col-lg-4 text-lg-right">
             <label style="margin-left: 20px">Fecha fin:</label>
           </div>
           <div class="col-lg-8">
             <input type="date" name="final" value="<?php if (isset($lista->final)) echo $lista->final ?>" required>
           </div>

           <div class="col-lg-4 text-lg-right">
             <label style="margin-left: 20px">Porcien de descuento:</label>
           </div>
           <div class="col-lg-8">
             <input type="number" style="width: 60px" name="valor" value="<?php if (isset($lista->valor)) echo $lista->valor ?>" required>
           </div>
            
              <div class="col-lg-4 text-lg-right" style="margin-top: 20px"> <label>Condiciones de la oferta:</label></div>          
               <div class="col-lg-12 text-lg-left">
                <table class="table table-striped" id="tablaCondicion">
                 <thead>
                   <th></th>
                   <th>Campo</th>
                   <th>Valor</th>
                   <th>
                     <button id="agregaCondicion"  type="button" class="btn btn-info form-control form-control-sm btn-sm fa fa-plus"></button>
                   </th>
                 </thead>
                 <tbody>
                  @if (isset($lista->condiciones))
                    @for ($i = 0; $i < count($lista->condiciones['campo']); $i++)
                    <tr>
                      <td><button type='button' class='btn btn-sm btn-outline-danger fa fa-trash-o' ></button></td>
                      <td><?php $cmpSLT=$lista->condiciones['campo'][$i]?>
                        <select name="condiciones[campo][]" id="slt{{$i}}" class="form-control form-control-sm" onchange="javascript:selecionado(this)" required>
                          <option  value=""></option>
                          <option  value="codigo" <?php if ($cmpSLT=='codigo') echo 'selected'?>>Código</option>
                          <option  value="categorias" <?php if ($cmpSLT=='categorias') echo 'selected'?>>Categoría</option>
                          <option  value="fabricante" <?php if ($cmpSLT=='fabricante') echo 'selected'?>>Fabricantes</option>
                          <option  value="modelos" <?php if ($cmpSLT=='modelos') echo 'selected'?>>Marca/modelo</option>
                              </select> 
                      </td>
                    
                      <td>
                        
                         <div class="form-group row" style="margin-bottom: 3px; ">  
                                      <div class="input-group col-sm-12">
                                        <input type="text" id="vlr{{$i}}" name="condiciones[valor][]" value="{{$lista->condiciones['valor'][$i] ?? ''}}"  hidden required >
                                        <div class="input-group-prepend " >
                                          <span class="input-group-append form-control form-control-sm form-inline" id="dcr{{$i}}"  
                                                style="width: 200px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;" >
                                              ...
                                              <script type="text/javascript">
                                                CadenaMotivo('{{$cmpSLT}}', "{{$lista->condiciones['valor'][$i] ?? ''}}", "dcr{{$i}}");
                                              </script>
                                          </span>
                                        </div>
                                        <div class="input-group-btn input-group-append ">
                                          <button  type="button" class="btn btn-info form-control form-control-sm btn-sm" data-toggle="modal" data-target="#myModal" onclick="javascript:entradato(this)"><i class="fa fa-search"></i></button>
                                        </div>
                                      </div>
                          </div>

                      </td>
                                                  
                    </tr>
                  @endfor
                 @endif 
                 </tbody>
               </table>
              </div>       
        </div>  
        
        <div class="col-lg-6 row">
              
        </div>
      </div>        
    </div>
</div> 
    {{--Columna derecha--}}
    <div class="card card-sm" style="font-size: 0.8em;">
        <div class="card-header ">
             <div class="row">
                <div class="col-lg-10">
                  <h5>Listado de ofertas</h5>
                </div>
                 
             </div>
        </div>
        <div class="card-body" id="ListadoOfertas">
        </div>
    </div> 

</div>
</form>

<div id="condiCampo" hidden>
      <select name="condiciones[campo][]" class="form-control form-control-sm" onchange="javascript:selecionado(this)" required>
        <option  value=""></option>
        <option  value="codigo">Código</option>
        <option  value="categorias">Categoría</option>
        <option  value="fabricante">Fabricantes</option>
        <option  value="modelos">Marca/modelo</option>
      </select>  
</div>
<div id="condiValor" hidden>
  <div class="form-group row" style="margin-bottom: 3px; ">  
              <div class="input-group col-sm-12">
                <input type="text" id="condi_codigo" name="condiciones[valor][]"  hidden required >
                <div class="input-group-prepend " >
                  <span class="input-group-append form-control form-control-sm form-inline" id="descr_cod"  
                        style="width: 100px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;" >
                      ...
                  </span>
                </div>
                <div class="input-group-btn input-group-append ">
                  <button  type="button" class="btn btn-info form-control form-control-sm btn-sm" data-toggle="modal" data-target="#myModal" onclick="javascript:entradato(this)"><i class="fa fa-search"></i></button>
                </div>
              </div>
  </div>
</div>

@include('modal')

<script type="text/javascript">

//Registros('panel.modal.listaOfertas','Descuento', '','','ListadoOfertas');

 $data="vista=panel.modal.listaOfertas&coleccion=Descuento";
   
  $.get('/Resgistro', $data, function(subpage){ 

      $('#ListadoOfertas').html(subpage);  

  }).fail(function() {
       console.log('Error en carga de Datos');
  });

function selecionado(quien){
     
    var ltr=(Math.random() * (500 - 10) + 10).toString().replace('.', '');
    $($(quien).attr("id","slt"+ltr));
    $($(quien).parent().parent().find('input')).attr("id","vlr"+ltr);

    $($(quien).parent().parent().find('span')).attr("id","dcr"+ltr);
  }

 
   function entradato(quien){
      ltr=$(quien).parent().parent().find('input').attr('id').substring(3);
      var campo=$('#slt'+ltr).val();   
               
      Modal("codificador."+motivo[campo],'vlr'+ltr,"dcr"+ltr); 
    };
       

  $('#agregaCondicion').on('click', function(){

      var htmlTags = "<tr width='50' ><td>"
      +"<button type='button' class='btn btn-sm btn-outline-danger fa fa-trash-o' ></button></td><td>"
      +$('#condiCampo').html()+"</td><td colspan='2'>"
      +$('#condiValor').html()+'</td></tr>';
   $('#tablaCondicion tr:last').after(htmlTags);

       
  });

$('body').on( 'click', '.fa-trash-o', function (event) {  
                                                     $(this).parents('tr').remove();
                                                                            } );
 
</script>
@endsection


