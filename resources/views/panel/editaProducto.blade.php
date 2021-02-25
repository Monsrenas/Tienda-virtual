@extends('panel.menu')
@section('operaciones')
<div id="Centro" style="font-size: 0.8em;">
  <div class="header">
    
  </div>
 
  <form  id="RegProducto" method="POST"  action="javascript:GuardarProducto()" class="form-horizontal md-form" id="datosproducto" style="font-size: .85em;" accept-charset="UTF-8" enctype="multipart/form-data">
  @csrf
    <input id="fotoUpl" type="file" style="display:none" name="ImgsTL" accept="image/*">
    <input type="text" name="clase" value="Producto" hidden>
    <div class="card-header card">
     <div class="row">  
           <strong class="col-lg-9" style="font-size: 1.6em;" >Registro de productos</strong>
           <div class="col-lg-1"><a href="{{url('/productos')}}" class="btn fa fa-plus btn-success"></a></div>
           <div class="col-lg-1"> <button id="btGuardaProd" class="btn fa fa-save btn-success" disabled=""></button></div>
          <div class="col-lg-1"><a href="{{url('/Listas/Producto/panel.producto')}}" class="btn fa fa-list "></a></div>
     </div>
    </div>
    <div class="col-lg-12 card" style="background: white; padding: 20px; ">
      
        <div class="form-group row"  style="margin-bottom: 3px; ">
          <label class="col-lg-2 col-form-label text-md-left text-lg-right" for="codigo">Código Producto:</label>
          <div class="col-sm-3">
            <input type="text" class="form-control form-control-sm" id="codigo_producto" name="codigo" placeholder="Código" value="{{$lista->codigo ?? ''}}" required <?php if ($lista->codigo=='') { echo "autofocus";}?> >
            <div class="col-sm-12" id="grupocodigo">  </div>
          </div>

          <div class="col-sm-7" id="grupodescripcion">
                <input type="text" class="form-control form-control-sm" id="Xdescripcion" name="nombre" placeholder="Descripcion del producto" required value="{{$lista->nombre ?? ''}}" <?php if ($lista->codigo<>'') { echo "autofocus";}?>> 
          </div>
        </div>
  
        @include('modal')

        @include('panel.modal.codigos')
        @include('panel.modal.descripciones')
        @include('panel.modal.fotos') 

         
        @include('panel.modal.medidas')
        @include('panel.modal.modelos')
         
  
        <div class="form-group row NatJur" style="margin-bottom: 3px; ">
          <label class="col-lg-2 col-form-label text-md-left text-lg-right " for="codigo_adicionales">Códigos Adicionales:</label>
          <div class="col-sm-3 input-group" >
                <input type="text" class="form-control form-control-sm" id="codigo_adicionales" placeholder="(0)" disabled>
                    <div class="input-group-btn input-group-append">
                        <button  type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#CodAdicionales" >
                            <i class="fa fa-th"></i>
                        </button>
                    </div>
            </div>

            <div class="col-sm-7 input-group" >
              <input type="text" class="form-control form-control-sm" id="otras_descripciones" placeholder="Otras descripciones" disabled="">
                <div class="input-group-btn input-group-append">
                  <button  type="button" class="btn btn-info btn-sm"data-toggle="modal" data-target="#NomAdicionales" >
                      <i class="fa fa-th"></i>
                  </button>
                </div>
            </div>
        </div>

              <div class="form-group row NatJur" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-md-left text-lg-right " for="codigo_fabricante">Fabricante:</label>
            {{--       
                  <div class="col-sm-3 input-group" >
                    <input type="text" class="form-control form-control-sm" id="codigo_fabricante" name="fabricante" placeholder="..." value="{{$lista->fabricante ?? ''}}">
                    <div class="input-group-btn input-group-append">
                          <button  type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="Modal('codificador.ObtenCodigoFabricante','codigo_fabricante','descr_fabricante')"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
            --}}

              <div class="input-group col-sm-3">
                <input type="text" class="form-control form-control-sm " id="codigo_fabricante" name="fabricante" placeholder="..." value="{{$lista->fabricante ?? ''}}" >
                <div class="input-group-prepend" >
                  <span class="input-group-append form-control form-control-sm form-inline" id="descr_fabricante"  
                        style="width: 100%; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;" >
                     {{$lista->fabricantes->nombre ?? ''}}
                  </span>
                </div>
                <div class="input-group-btn input-group-append ">
                  <button  type="button" class="btn btn-info form-control form-control-sm btn-sm" data-toggle="modal" data-target="#myModal" onclick="Modal('codificador.ObtenCodigoFabricante','codigo_fabricante','descr_fabricante')"><i class="fa fa-search"></i></button>
                </div>
              </div>

              </div>

              <div class="form-group row NatJur" style="margin-bottom: 3px; ">
                 <label class="col-lg-2 col-form-label text-md-left text-lg-right" for="codigo_categoria">Categoría:</label>
             {{--    
                 <div class="col-sm-3 input-group">
                    <input type="text" class="form-control form-control-sm" id="codigo_categoria" name="categorias" placeholder="..." value="{{$lista->categorias ?? ''}}">
                    <div class="input-group-btn input-group-append">
                          <button type="button" class="btn btn-info btn-sm"data-toggle="modal" data-target="#myModal" onclick="Modal('codificador.ObtenCodigoCategoria','codigo_categoria','descr_categoria')"><i class="fa fa-search"></i></button>
                    </div>          
                 </div>
              --}}

              <div class="input-group col-sm-3">
                <input type="text" class="form-control form-control-sm " id="codigo_categoria" name="categorias" placeholder="..." value="{{$lista->categorias ?? ''}}" >
                <div class="input-group-prepend" >
                  <span class="input-group-append form-control form-control-sm form-inline" id="descr_categoria"  
                        style="width: 100%; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;" >
                     {{$lista->categoria_detalle->nombre ?? ''}}
                  </span>
                </div>
                <div class="input-group-btn input-group-append ">
                  <button  type="button" class="btn btn-info form-control form-control-sm btn-sm" data-toggle="modal" data-target="#myModal" onclick="Modal('codificador.ObtenCodigoCategoria','codigo_categoria','descr_categoria')"><i class="fa fa-search"></i></button>
                </div>
              </div>

              </div>

              <div class="form-group row NatJur " style="margin-bottom: 5px; ">
                  <label class="col-lg-2 col-form-label text-md-left text-lg-right " for="codigo_medida">Medidas:</label>
                  <div class="col-sm-3 input-group">
                    <input type="text" class="form-control form-control-sm" id="codigo_medida" placeholder="(0)">
                       <div class="input-group-btn input-group-append">
                          <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#xMedidas"><i class="fa fa-th"></i></button>
                    </div>
   
                  </div>
                   <label class="col-lg-2 col-form-label text-left" id="descr_modelo"></label><br>
              </div>
 
            <div id="foto" class="grupoDT">
             <div class="form-group row" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-md-left text-lg-right " for="foto">Fotos:</label>
                  <div class="col-sm-3 input-group">
                    <input id="fotoNombre" class="form-control form-control-sm" type="text" placeholder="(0)" disabled>
                    <div class="input-group-btn input-group-append">
                      <button type="button" class="btn btn-info btn-sm"data-toggle="modal" data-target="#xFotos">
                         <i class="fa fa-th"></i>
                      </button>
                    </div>
                  </div>
              </div>
             </div>

             <div class="grupoDT" id="modelo">
             <div class="form-group row NatJur " style="margin-bottom: 5px; ">
                  <label class="col-lg-2 col-form-label text-md-left text-lg-right " for="codigo_modelo">Valido para los Modelos:</label>
                  <div class="col-sm-3 input-group">
                    <input type="text" class="form-control form-control-sm" id="codigo_modelo" placeholder="(0)">
                       <div class="input-group-btn input-group-append">
                          <button type="button" class="btn btn-info btn-sm"data-toggle="modal" data-target="#xVersiones"><i class="fa fa-th"></i></button>
                    </div>
   
                  </div>
                   <label class="col-lg-2 col-form-label text-left" id="descr_modelo"></label><br>

              </div>
              </div>
            
            <div class="col-lg-10 text-md-left text-lg-right " id="espacioGuardar" hidden="">
            <button class="btn btn-success"  id="GuardarForm" type="submit" >Guardar <i class="fa fa-save"></i></button>
          </div> 
       </div>
     </form>
</div>

<div id="MediaItem" hidden>
              <div id="medidaBorra">
                <button type="button" class="btn btn-sm btn-outline-danger fa fa-trash-o" style="font-size: .9em"> </button>
              </div>
              <div id="medidaNombre">
                <input type="text" class="form-control form-control-sm mds" size="80" name="medidas[nombre][]"   required>
              </div>
              <div id="medidaValor">
                <input type="text" class="form-control form-control-sm mds" size="10" name="medidas[valor][]" required>
              </div>
              <div id="medidaUnidad">
                 <select class="form-control form-control-sm mds" name="medidas[unidad][]" style="width: 110px">
                      <option  value=0>Unidad</option>
                      <option  value=1>Milimetro</option>
                      <option  value=2>Centimetro</option>
                      <option  value=3>Metro</option>
                      <option  value=4>Pulgada</option>
                  </select>
              </div>
</div>

<script type="text/javascript">

$('body').on('click', '.fa-trash-o', function()  //Boton que borra categoria
{
    $(this).parent().parent().remove();  
    $("#btGuardaProd").attr('disabled',false);
    //$(this).parent().siblings().find('input').val()
    //$(this).parent().parent().attr('class')
    
});

$('input').attr("autocomplete","off");
$('body').on('change paste', '#codigo_producto', function()
{
    location.href="/productos/"+$(this).val(); 
     
});

$('body').on('blur', '#codigo_producto', function()
{
    if ($(this).val()==''){ $(this).focus() } ; 
    
});

$('body').on('change paste', 'input, select', function()
{
      $("#btGuardaProd").attr('disabled',false);
});

$('body').on('click', '.fbct', function()
{
      $("#btGuardaProd").attr('disabled',false);
});

$('#RegProducto').on('input', function()
{
     
      $("#btGuardaProd").attr('disabled',false);
});

function GuardarProducto()
{
  var data=$('#RegProducto').serialize();
     var data="_token={{ csrf_token()}}&"+data;
      $.post('/GuardaCodigo', data, function(subpage){  
        
              $('#btGuardaProd').attr("disabled",true);
              $("#codigo_producto").focus();
    });
}

function NombraElemento(nombre, item)
{
   etiqt=$('#'+item);

   if (etiqt.length>0) {
                         etiqt[0]['textContent']=nombre; 
                        }
}

function ActNumero(elemento, visual)
{
  $d='';
  if (elemento=="NombresADC") {$d=" descripciones adicionales"}
    $c=$("#"+elemento+" .fa-trash-o");
      $('#'+visual).attr("placeholder", "("+$c.length+")"+$d);
}
</script>
@endsection