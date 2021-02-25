@extends('panel.menu')
@section('operaciones')
@include('modal')
@include('panel.modal.Auxiliar')
<style type="">
  table {
   width: 100%;
}
th {
   padding-right: 10px;
   text-align: left;
}

td {
   padding-right: 20px;
   text-align: right;
}

</style>
<div id="Centro" style="font-size: 0.8em;">

	<form  method="POST"  action="{{url('AddProductoRecepcion')}}" class="form-horizontal md-form" id="datosrecepcion" style="font-size: .85em;">
  @csrf
  <div class="card"  >
    <input type="text" name="usuario" value="{{Auth::user()->_id}}" hidden>

    <div class="card-header ">
      <div class="row">
        <h6 class="col-lg-8 ">Ingreso de productos</h6>
       
        
          <div class="col-lg-2 text-md-left text-lg-right ">
            <button class="btn btn-success btn-sm" id="GuardarForm" type="submit"><i class="fa fa-plus"></i></button>
            
          </div> 
       
      </div>  
    </div>

    <div class="col-lg-12 card" style="background: white; padding: 20px; ">
         
         <div class="form-group row" style="margin-bottom: 3px; ">
          <label class="col-lg-2 col-form-label text-right" for="codigo_fabricante">Fecha: </label>
          <div class="col-sm-3 input-group">
            <input type="date" class="form-control-sm form-control" id="fecha" name="fecha" value="{{date("Y-m-d")}}" required>
          </div>
        </div>

        <div class="form-group row" style="margin-bottom: 3px; ">
            <label class="col-lg-2 col-form-label text-right" for="proveedor">Proveedor:</label> 
           <div class="col-sm-3 input-group" >
              <input type="text" class="form-control form-control-sm" id="proveedor" name="proveedor"  required hidden> 
              <input type="text" class="form-control form-control-sm" id="proveeDesc" placeholder="..." readonly>
              <div class="input-group-btn input-group-append">
                  <button  type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#ModalAuxiliar" onclick="javascript:Registros('codificador.ObtenCodigoProveedor', 'Persona', 'rol, 2','','modal-cuerpo-AUX')"><i class="fa fa-search"></i></button>
              </div>
           </div> 
        </div>

         <div class="form-group row" style="margin-bottom: 3px; ">
            <label class="col-lg-2 col-form-label text-right" for="almacen">Almacen:</label> 
           <div class="col-sm-3 input-group" > 
              <input type="text" id="almacen" name="almacen" required hidden>
              <input type="text" class="form-control form-control-sm" id="almaDesc" placeholder="..." readonly>               
              <div class="input-group-btn input-group-append">
                          <button  type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#ModalAuxiliar" onclick="javascript:Registros('codificador.ObtenCodigoAlmacen', 'Almacen','','','modal-cuerpo-AUX')"><i class="fa fa-search"></i></button>
              </div>
           </div> 
        </div>

        <div class="form-group row" style="margin-bottom: 30px; ">
          <label class="col-lg-2 col-form-label text-right" for="documento">No. Documento:</label>
          <div class="col-sm-3 input-group" >
            <input type="text" class="form-control form-control-sm" id="documento" name="documento"  required> 
          </div>
        </div>            

        <div class="form-group row" style="margin-bottom: 3px; ">
            <label class="col-lg-2 col-form-label text-right" for="codigo_fabricante">Código Producto:</label>
            <div class="col-sm-3 input-group" >
              <input type="text" class="form-control form-control-sm" id="codigo" name="codigo" required>
              <div class="input-group-btn input-group-append">
                <button  type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="Modal('codificador.ObtenCodigoProducto','codigo','descr_producto')"><i class="fa fa-search"></i></button>
              </div>
            </div>
            <label class="col-lg-6 col-form-label text-left" id="descr_producto" style="font-size: 1.2em; color:blue"></label>
       </div>
   
       <div class="form-group row"  style="margin-bottom: 3px; ">
          <label class="col-lg-2 col-form-label text-md-left text-lg-right" for="codigo">Cantidad:</label>
          <div class="col-sm-3">
            <input type="number" class="form-control form-control-sm" id="cantidad" name="cantidad"  required>
            <input type="number" class="form-control form-control-sm" id="existencia" name="existencia" hidden>
            <div class="col-sm-12" id="grupocodigo">  </div>
          </div>    
          <div class="col-sm-3" id="info">
            
          </div>       
        </div>

        <div class="form-group row"  style="margin-bottom: 3px; ">
            <label class="col-lg-2 col-form-label text-md-left text-lg-right" for="costo">Costo:</label>
            <div class="col-sm-3">
              <input type='number' placeholder='$0.00' step=".01" class="form-control form-control-sm" id="costo" name="costo">
            </div>
        </div>

        <div class="form-group row"  style="margin-bottom: 3px; ">
            <label class="col-lg-2 col-form-label text-md-left text-lg-right" for="utilidad">% Uilidad:</label>
            <div class="col-sm-3">
              <input type='number' placeholder='' step=".01" class="form-control form-control-sm" id="utilidad" name="utilidad">
            </div>
        </div>

        <div class="form-group row"  style="margin-bottom: 3px; ">
            <label class="col-lg-2 col-form-label text-md-left text-lg-right" for="precio">Precio:</label>
            <div class="col-sm-3">
              <input type='number' placeholder='$0.00' step=".01" class="form-control form-control-sm" id="precio" name="precio" required>
              <div class="col-sm-12" id="grupocodigo">  </div>
            </div>
        </div>
                             
        	  
    </div>
    </div>  
  </form>
</div>
<div class="card" id="ListaPrerecepcion"  style="margin-top: 20px;">
 
        </div>  
 <script type="text/javascript">
   

   $data="vista=inventario.lista_prerecepcion&coleccion=Pre_recepcion&indice=usuario&ocurrencia={{ Auth::user()->_id}}";
   
  $.get('Resgistro', $data, function(subpage){ 
     $('#ListaPrerecepcion').html(subpage);

    }).fail(function() {
       console.log('Error en carga de Datos');
  });

(function($){
    var originalVal = $.fn.val;
    $.fn.val = function(){
        var result =originalVal.apply(this,arguments);
        if(arguments.length>0)
            $(this).change(); // OR with custom event $(this).trigger('value-changed');
        return result;
    };
})(jQuery);

$('body').on('change blur', '#codigo', function(){ infoPrevia(); });
$('body').on('change', '#almacen', function(){ infoPrevia(); });

$('body').on('change blur', '#utilidad', function()
  { 
      $costo=parseFloat($('#costo').val());
      $utili=parseFloat($('#utilidad').val()); 

      if (($costo!=0)&&($utili!=0)){
            $precio=parseFloat($costo)+(($costo*$utili)/100);
            $('#precio').val($precio);}

  });


 function infoPrevia()
    { 
      if ($('#codigo').val()=='') {return;}
      $('#info').empty();
      $('#descr_producto').css('color','blue');
      $data="codigo="+$('#codigo').val()+"&almacen="+$('#almacen').val();
      $.get('InfoPrevioARecepcon', $data, function(subpage){ 
            
            if (subpage[0]) {
                              if (typeof subpage[0]['nombre'] !== 'undefined')
                                        {

                                          $('#descr_producto').text(subpage[0]['nombre']);
                                           
                                        } else {  
                                                  $('#info').empty();
                                                  $xst="<th>Existencia: </th>";
                                                  $prc="<th>Precios</th>";
                                                  $lmc="<th>Ubicación</th>";
                                                 for (const prop in subpage)
                                                 {
                                                   
                                                      $lmc+="<td>"+subpage[prop]['almacen']+"</td>";
                                                      $prc+="<td>"+subpage[prop]['precio']+"</td>";
                                                      $xst+="<td>"+subpage[prop]['cantidad']+"</td>";
                                                      if (subpage[prop]['almacen']==$('#almacen').val())
                                                        {
                                                          $('#precio').val(subpage[prop]['precio'].replace(",","."));
                                                          
                                                          $('#existencia').val(subpage[prop]['cantidad']);
                                                        }
                                                 }
                                                 $('#info').append("<table id='info'>");
                                                 $('#info').append("<tr>"+$lmc+"</tr>");
                                                 $('#info').append("<tr>"+$xst+"</tr>");
                                                 $('#info').append("<tr>"+$prc+"</tr></table>");   
                                                  
                                                 if (subpage[0]['detalles']!==null)
                                                  {
                                                    $('#descr_producto').text(subpage[0]['detalles']['nombre']);
                                                  } else {
                                                            $('#descr_producto').text('CÓDIGO DESCONOCIDO');
                                                            $('#descr_producto').css('color','red');  
                                                            $('#codigo').focus();
                                                            return;
                                                          }         
                                              }

                              $('#cantidad').focus();
                            }
                else { $('#descr_producto').text('CÓDIGO DESCONOCIDO');
                        $('#descr_producto').css('color','red');  
                        $('#codigo').focus();}

        }).fail(function() {
           console.log('Error en carga de Datos');
        });   
    }

/*
$('body').on('blur', '#codigo', function()
    { 
      $data="indice=codigo&ocurrencia="+this.value+"&columnas=codigo,nombre&coleccion=Producto";
      $.get('Resgistro', $data, function(subpage){ 
            if (subpage[0]) {  $('#descr_producto').text(subpage[0]['nombre']);
                              $('#descr_producto').css('color','blue'); 


                            }
                else { $('#descr_producto').text('CÓDIGO DESCONOCIDO');
                        $('#descr_producto').css('color','red');  
                        $('#codigo').focus();}

        }).fail(function() {
           console.log('Error en carga de Datos');
        });   
    });
*/
  
 </script>
  
@endsection