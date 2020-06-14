@extends('menu')


@section('operaciones')

<style type="text/css">
  .grupoDT 
  {
   padding-top: 4px;
   border-style: ridge;
   border-color: #ced4da;
  }

.BrrCateg
{
  border: none;
  color: gray;
}
</style>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div id="Centro" style="font-size: 0.8em;">
	
	<form action="{{url('GuardaRegistro')}}" method="POST" class="form-horizontal md-form" style="font-size: .85em;">
  @csrf
    <div class="col-lg-10 card-header">

              <div class="form-group row NatJur" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="codigo_producto">Código Producto:</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control form-control-sm" id="codigo_producto" name="codigo_producto" placeholder="">
                  </div>
                  <div class="col-sm-3">
                    <input type="text" class="form-control form-control-sm" id="descripcion" name="descripcion" placeholder="Descripcion del producto" style="width: 500px;" required=''>
                  </div>
              </div>

              <div class="form-group row NatJur" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="codigo_catalogo">Código Catálogo:</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control form-control-sm" id="codigo_catalogo" name="codigo_catalogo" required=''>
                  </div>
              </div>

              <div class="form-group row NatJur" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="codigo_adicional">Código Adicional:</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control form-control-sm" id="codigo_adicional" name="codigo_adicional" required="">
                  </div>
              </div>

              <div class="form-group row NatJur" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="codigo_fabricante">Código Fabricante:</label>
                  <div class="col-sm-3 input-group" >
                    <input type="text" class="form-control form-control-sm" id="codigo_fabricante" name="codigo_fabricante" placeholder="">
                    <div class="input-group-btn input-group-append">
                          <button  type="button" class="btn btn-info btn-sm"data-toggle="modal" data-target="#myModal" onclick="Modal('codificador.ObtenCodigoFabricante','codigo_fabricante','descr_fabricante')"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                  <label class="col-lg-2 col-form-label text-left" id="descr_fabricante">Descripcion</label>
              </div>

              <div class="form-group row" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="estado">Unidad de Medida:</label>
                  <div class="col-lg-2">
                    <select class="form-control form-control-sm" id="codigo_unidad" name="codigo_unidad" style="font-size: 1em;">

                      <option>-</option>

                    </select>
                  </div>
              </div>

            <div id="categoria" class="grupoDT">    
              <div class="form-group row NatJur" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="codigo_categoria">Categorías:</label>
                  <div class="col-sm-3 input-group">
                    <input type="text" class="form-control form-control-sm" id="codigo_categoria" name="codigo_categoria" placeholder="">
                    <div class="input-group-btn input-group-append">
                          <button type="button" class="btn btn-info btn-sm"data-toggle="modal" data-target="#myModal" onclick="Modal('codificador.ObtenCodigoCategoria','codigo_categoria','descr_categoria')"><i class="fa fa-search"></i></button>
                    </div>
                    <div class="input-group-btn input-group-append">
                          <button type="button" class="btn btn-success btn-sm" onclick="agregaCategoria()"><i class="fa fa-plus"></i></button>
                    </div>                  
                 </div>
                  <label class="col-lg-2 col-form-label text-left" id="descr_categoria"></label>
              </div>

            </div>  

            <div id="precios" class="grupoDT">
             <div class="form-group row NatJur" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="precio_Venta">Precio de venta:</label>
                  <div class="col-sm-3 input-group">
                    <input type="text" class="form-control form-control-sm" id="precio_Venta" placeholder="">
                    <div class="input-group-btn input-group-append">
                      <button type="button" class="btn btn-success btn-sm" onclick="NuevoPrecio()"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>

              </div>
            </div>

            <div id="foto" class="grupoDT">
             <div class="form-group row" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="foto">Fotos:</label>
                  <div class="col-sm-3 input-group">
                    <input id="foto" type="file" style="display:none" name="fichero1" accept="image/*">

                    <div class="input-group-btn input-group-append">
                      <input id="fotoNombre" class="form-control form-control-sm" type="text">
                      <button type="button" class="btn btn-info btn-sm"data-toggle="modal" data-target="#myModal" onclick="Modal('codificador.ObtenNombreImagen','foto','foto')"><i class="fa fa-search"></i></button>
                      <a id="fotofile" class="btn btn-success btn-sm"><i class="fa fa-folder-open-o"></i></a>
                    </div>
                  </div>
              </div>
             </div>

              <div class="grupoDT" id="modelo">
             <div class="form-group row NatJur " style="margin-bottom: 5px; ">
                  <label class="col-lg-2 col-form-label text-right" for="codigo_modelo">Modelos:</label>
                  <div class="col-sm-3 input-group">
                    <input type="text" class="form-control form-control-sm" id="codigo_modelo" name="codigo_modelo" placeholder="">
                       <div class="input-group-btn input-group-append">
                          <button type="button" class="btn btn-info btn-sm"data-toggle="modal" data-target="#myModal" onclick="Modal('codificador.ObtenCodigoModelo','codigo_modelo','descr_modelo')"><i class="fa fa-search"></i></button>
                    </div>
                    <div class="input-group-btn input-group-append">
                          <button type="button" class="btn btn-success btn-sm" onclick="agregaModelo()"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
                   <label class="col-lg-2 col-form-label text-left" id="descr_modelo"></label><br>
              </div>
              </div>
      		  
      		  <div class="col-lg-10 text-right">
    				<button class="btn btn-success" type="submit">Guardar <i class="fa fa-save"></i></button>
 	  		  </div> 
       </div>

  	 </form>
</div>

@INCLUDE('modal')
<script type="text/javascript">

  $("#codigo_producto").focus();

  $('body').on('focusout', '#codigo_producto', function(){      
  
      if ($(this)[0].value=='') { $("#codigo_producto").focus(); return;}
      
     $data='{{ csrf_token()}}&referencia=productos/'+($(this)[0].value);  

     $.get('DevuelveBase', $data, function(subpage){ 
          //console.log(subpage);
          RellenaFormulario(subpage);
    }).fail(function() {
       console.log('Error en carga de Datos');
  });    

 });

function RellenaFormulario(subpage)
{
     $('.xGrupos').remove(); 
     for (const prop in subpage)
     { 
       if (typeof subpage[prop] !== 'undefined') { 
              if (typeof subpage[prop]!=='object')   {    
                                                        $("#"+prop).val(subpage[prop]);
                                                      }
              else {  
                      ubica(prop,subpage[prop]);
                   }                                        
       }      
     }
}

function ubica(prop,subpage)
{

   switch(prop) 
   {
      case 'categoria': 
                    for (const ind in subpage) { NuevaCategoria(subpage[ind],''); }
            break;

      case 'precios':
                    for (const ind in subpage) {agrElemento(subpage[ind], '','precios' ,'PrecioGrupo');} 
                    break;
      case 'modelo': 
                  for (const ind in subpage) {NuevoModelo(subpage[ind], '');} 
                  break;
      case 'fotos': 
                  for (const ind in subpage) {agrFoto(subpage[ind]);} 
                  break;

  }

}

function agregaCategoria()
{
  if ( datoValido('codigo_categoria', 'codigo_categoria','CateGrupo')) 
  {
    NuevaCategoria($('#codigo_categoria').val(),$('#descr_categoria').text());   
  }
  $('#codigo_categoria').val('');
  $('#descr_categoria').text('');  
}

function agregaModelo()
{

  if ( datoValido('codigo_modelo', 'descr_categoria','ModelGrupo')) 
  {
    NuevoModelo($('#codigo_modelo').val(),$('#descr_modelo').text());   
  }
  $('#codigo_modelo').val('');
  $('#descr_modelo').text('');  
}

function datoValido($myInput, $myLabel,$clase)
{
  var $elDato=$('#'+$myInput).val();
  var $laDesc=$('#'+$myLabel).text();
  var $Grupo=$('.'+$clase);
  var valor=[];

  if ($elDato=='') { $flag=false; } else {$flag=true;}

  for (const ind in $Grupo) { if ($Grupo[ind]['value']==$elDato) {$flag=false;} }

  return $flag;
}

function NuevaCategoria($cod, $des)
{
     
    agrElemento($cod, $des, 'categoria','CateGrupo');

     if ($des.trim().length==0) {
                                     $data='{{ csrf_token()}}&referencia=categorias/'+($cod);  
                                     $.get('DevuelveBase', $data, function(subpage){ 
                                        if (subpage.trim().length==0) {   $('#CatDesc'+$cod).parent().remove();   } 
                                        else { $('#CatDesc'+$cod).text(subpage); }
                                          
                                      }).fail(function() {
                                       console.log('Error en carga de Datos');
                                      });  
                                 }
}

function NuevoModelo($cod, $des)
{
     
    agrElemento($cod, $des, 'modelo','CateGrupo');

     if ($des.trim().length==0) {
                                     $data='{{ csrf_token()}}&referencia=marcas/'+($cod.substring(0,3));  
                                     $.get('DevuelveBase', $data, function(subpage){ 
                                        console.log(subpage['nombre']);
                                        if (subpage.length==0) {   $('#CatDesc'+$cod).parent().remove();   } 
                                        else { $('#CatDesc'+$cod).text(subpage['nombre']+": "+subpage['modelos'][$cod.substring(3)]['nombre']); }
                                          
                                      }).fail(function() {
                                       console.log('Error en carga de Datos');
                                      });  
                                 }
}

function NuevoPrecio()
{
  if ( datoValido('precio_Venta', 'descr_categoria','PrecioGrupo')) 
  {
    agrElemento($('#precio_Venta').val(), '','precios' ,'PrecioGrupo');   
  }
  $('#precio_Venta').val('');
}


$('body').on('click', '.BrrCateg', function()  //Boton que borra categoria
{
    $(this).parent().parent().remove();  
    //$(this).parent().siblings().find('input').val()
    //$(this).parent().parent().attr('class')
});


// http://duckranger.com/2012/06/pretty-file-input-field-in-bootstrap/ 
  // Cuando se pulsa el falso manda el click al autentico
  $('#fotofile').on('click', function(){
    $(this).parent().prev().click();
  });
  
  // Cuando el autentico cambia hace cambiar al falso
  $('input[type=file]').on('change', function(e){
    $(this).next().find('input').val($(this).val());
  });

$('body').on('change', '#foto', function()  //Boton que borra categoria
{
    $('#fotoNombre').val($(this).val());
    if (datoValido('fotoNombre', 'fotoNombre','fotoGrupo')){
        agrFoto($(this).val());}
});

function agrElemento($cod, $des, $grupo,$clase)
{

   boton="<button class='btn btn-outline-danger BrrCateg btn-sm'><i class='fa fa-trash'></i></button>";
     var NewCateg="<div class='form-group row xGrupos' style='margin-bottom: 3px; '><div class='col-sm-2 text-right my-auto'>"+boton+"</div><div class='col-sm-3 input-group'><input type='text' class='form-control form-control-sm "+$clase+"' value='"+$cod+"' name='"+$grupo+"[]'></div><label class='col-lg-5 col-form-label text-left' id='CatDesc"+$cod+"'>"+$des+"</label></div>";

     $('#'+$grupo).append(NewCateg);
}

function agrFoto($camino)
{

   boton="<button class='btn btn-outline-danger BrrCateg btn-sm'><i class='fa fa-trash'></i></button>";
     var NewCateg="<div class='form-group row xGrupos' style='margin-bottom: 3px; '><div class='col-sm-2 text-right my-auto'>"+boton+"</div><div class='col-sm-6 input-group'><input type='text' class='form-control form-control-sm fotoGrupo' value='"+$camino+"' name='fotos[]'></div></div>";

     $('#foto').append(NewCateg);
}
</script>




@endsection