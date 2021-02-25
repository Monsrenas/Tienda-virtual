<?php

 $roles=["","Super Administrador","Administrador de sistema","Administrador de Sucursal","Empleado"];
 $rol=Auth::user()->rol ?? 4;
?>

<script type="text/javascript">
  function abrirColapse(elemento)
  {
    $('#'+elemento).collapse('show');
  }

</script>
<div id="Centro" style="font-size: 0.8em;">
  <div class="header">
    <h4>Registro de Usuarios</h4>
  </div>
  <form  id="RegPersona" method="POST"  action="{{ url('RegistrarUsuario') }}" class="form-horizontal md-form" id="RegPersona" style="font-size: .85em;">
  @csrf
    <input type="text" name="clase" value="Usuario" hidden>

    @if (!isset($lista[0]->_id)) 
      <input type="password" name="password" value="clave123456789" hidden>
    @endif



    <div class="card-header card">
        <h5>Datos del usuario</h5>
      </div>
    <div class="col-lg-12 card" style="background: white; padding: 20px; ">

    <div class="col-lg-10 card-header">
              <div class="form-group row" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="estado">Estado:</label>
                  <div class="col-lg-2">
                    <select class="form-control" id="estado" name="estado" style="font-size: 1em;">
                      <option value="1" @if(($lista[0]->estado)??""=="1") selected  @endif>Activo</option>
                      <option value="0" @if(($lista[0]->estado)??""!="1") selected  @endif>Inactivo</option>
                    </select>
                  </div>
              </div>

              <div class="form-group row" style="margin-bottom: 3px; "> 
                  <label class="col-lg-2 col-form-label text-right" for="tipo">Rol:</label>
                  <div class="col-sm-3">
                    <select class="form-control" id="rol" name="rol" style="font-size: 1em;">
                     @for ($i = $rol; $i < count($roles); $i++) 
                      <option value="{{$i}}" @if ($i==($lista[0]->rol ?? '')) selected @endif  >{{$roles[$i]}}</option>
                     @endfor
                    </select>
                  </div>
              </div>
               
              <div class="form-group row" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="ruc">RUC/ Cédula:</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control form-control-sm" id="idpersonal" name="idpersonal" placeholder="" value="{{$lista[0]->idpersonal ?? ''}}" required  >
                  </div>
              </div>

             <div class="form-group row" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="nombre">Nombre:</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="" value="{{$lista[0]->nombre ?? ''}}" >
                  </div>
              </div>
 

             <div class="form-group row" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="telefono">Teléfono:</label>
                  <div class="col-sm-3">
                    <input type="tel" class="form-control form-control-sm" id="telefono" name="telefono" placeholder="" value="{{$lista[0]->telefono ?? ''}}" >
                  </div>
              </div>

              <div class="form-group row" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="direccion">Dirección:</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control form-control-sm" id="direccion" name="direccion" placeholder="" value="{{$lista[0]->direccion ?? ''}}">
                  </div>
              </div>

               <div class="form-group row" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="correo">Correo electrónico :</label>
                  <div class="col-sm-3">
                    <input type="email" class="form-control form-control-sm" id="correo" name="email" placeholder="" value="{{$lista[0]->email ?? ''}}">
                  </div>
              </div>
      </div>    
  </div>

<div class="card-header card">
        <h5>Nivel de acceso</h5>
</div>
<div class="col-lg-12" style="background: white; padding: 20px; ">
          

          <div class="card-header col-sm-12" id="headingOne" style="background: #e7e7e7;">
            <input type="checkbox" data-toggle="collapse" data-target="#collapsediv1"> Personas</>
          </div>
          <div id='collapsediv1' class='collapse p-4  border'>
                  <div class="col-lg-4">
                      <div class="form-group" style="margin-bottom: 3px; ">
                          <input type="checkbox" class="control-sm col-lg-1" id="personas" name="acceso[pp]">
                          <label class="col-lg-4 col-form-label" for="personas">Personas:</label>
                      </div>
                      <div class="form-group" style="margin-bottom: 3px; ">
                          <input type="checkbox" class="control-sm col-lg-1" id="usuarios" name="acceso[pu]">
                          <label class="col-lg-4 col-form-label" for="usuarios">Usuarios:</label>
                      </div>
                  </div>
          </div>

        
          <div class="card-header" id="headingOne" style="background: #e7e7e7;">
            <input type="checkbox" data-toggle="collapse" data-target="#collapsediv2">Catálogo</>
          </div>
          <div id='collapsediv2' class='collapse p-4  border  col-lg-12 row' style="margin-left:1px;">


          <div class="col-lg-4">         
                      <div class="form-group">
                          <input type="checkbox" class="control-sm col-lg-1" id="productos" name="acceso[cp]">
                          <label class="col-lg-4 col-form-label control-sm" for="productos">Productos:</label>
                      </div>
                                
                      <div class="form-group">
                          <input type="checkbox" class="control-sm col-lg-1" id="fabricantes" name="acceso[cf]">
                          <label class="col-lg-4 col-form-label" for="fabricantes">Fabricantes:</label>
                      </div>
                                
                      <div class="form-group">
                          <input type="checkbox" class="control-sm col-lg-1" id="marcas" name="acceso[cm]">
                          <label class="col-lg-8 col-form-label" for="marcas">Marcas y Modelos:</label>
                      </div>
                                
                      <div class="form-group">
                          <input type="checkbox" class="control-sm col-lg-1" id="categorias" name="acceso[cc]">
                          <label class="col-lg-4 col-form-label" for="categorias">Categorías:</label>
                      </div>
          </div>
        </div>

          <div class="card-header" id="headingOne" style="background: #e7e7e7;">
            <input type="checkbox" data-toggle="collapse" data-target="#collapsediv3"> Inventario</>
          </div>
          <div id='collapsediv3' class='collapse p-4  border  col-lg-12 row' style="margin-left:1px;">
            <div class="col-lg-4">  
              <div class="form-group">            
                <input type="checkbox" class="control-sm col-lg-1" id="ingreso" name="acceso[ii]">
                <label class="col-lg-4 col-form-label" for="ingreso">Ingreso:</label>
              </div>
              <div class="form-group t-1 b-1">
                <input type="checkbox" class="control-sm col-lg-1" id="movimientos" name="acceso[im]">
                <label class="col-lg-4 col-form-label control-sm" for="movimientos">Movimientos:</label>
              </div>
              <div class="form-group">
                <input type="checkbox" class="control-sm col-lg-1" id="existencias" name="acceso[ie]">
                <label class="col-lg-4 col-form-label control-sm" for="existencias">Existencias:</label>
              </div>
                <div class="form-group">
                <input type="checkbox" class="control-sm col-lg-1" id="almacenes" name="acceso[ia]">
                <label class="col-lg-4 col-form-label control-sm" for="almacenes">Almacénes:</label>
              </div>
            </div>
          </div>

          <div class="card-header" id="headingTre" style="background: #e7e7e7;">
            <input type="checkbox" data-toggle="collapse" data-target="#collapsediv4"> Ventas</>
          </div>
          <div id='collapsediv4' class='collapse p-4  border  col-lg-12 row' style="margin-left:1px;">
            <div class="col-lg-4">  
              <div class="form-group">            
                <input type="checkbox" class="control-sm col-lg-1" id="Facturar" name="acceso[vf]">
                <label class="col-lg-4 col-form-label" for="Facturar">Facturar pedido:</label>
              </div>
              <div class="form-group t-1 b-1">
                <input type="checkbox" class="control-sm col-lg-1" id="Despacho" name="acceso[vd]">
                <label class="col-lg-5 col-form-label control-sm" for="Despacho">Despacho de factura:</label>
              </div>
              <div class="form-group">
                <input type="checkbox" class="control-sm col-lg-1" id="Cancelación" name="acceso[vc]">
                <label class="col-lg-5 col-form-label control-sm" for="Cancelación">Cancelación de ventas:</label>
              </div>
              <div class="form-group">
                <input type="checkbox" class="control-sm col-lg-1" id="canclist" name="acceso[vl]">
                <label class="col-lg-6 col-form-label control-sm" for="canclist">Listado de cancelaciones:</label>
              </div>
              <div class="form-group">
                <input type="checkbox" class="control-sm col-lg-1" id="ofertas" name="acceso[vo]">
                <label class="col-lg-4 col-form-label control-sm" for="ofertas">Ofertas:</label>
              </div>
            </div>
          </div>

          <div class="card-header" id="headingTre" style="background: #e7e7e7;">
            <input type="checkbox" data-toggle="collapse" data-target="#collapsediv5"> Configuación</>
          </div>
          <div id='collapsediv5' class='collapse p-4  border  col-lg-12 row' style="margin-left:1px;">
            <div class="col-lg-4">  
              <div class="form-group">            
                <input type="checkbox" class="control-sm col-lg-1" id="datos" name="acceso[cd]">
                <label class="col-lg-5 col-form-label" for="datos">Datos de la empresa:</label>
              </div>
              <div class="form-group t-1 b-1">
                <input type="checkbox" class="control-sm col-lg-1" id="tienda" name="acceso[ct]">
                <label class="col-lg-4 col-form-label control-sm" for="tienda">Tienda virtual:</label>
              </div>

              {{--
              <div class="form-group">
                <input type="checkbox" class="control-sm col-lg-1" id="banners" name="acceso[cb]">
                <label class="col-lg-4 col-form-label control-sm" for="banners">Banners:</label>
              </div>
              --}}

            </div>
          </div>
</div>
  
        <button id="btGuardaProd" class="btn fa fa-save btn-success float-right" disabled=""> Guardar</button>
     </form>
</div>


<?php $grp=[['pp'=>0,'pu'=>0],
            ['cp'=>0,'cf'=>0,'cm'=>0,'cc'=>0],
            ['ii'=>0, 'im'=>0,'ie'=>0,'ia'=>0],
            ['vf'=>0, 'vd'=>0,'vc'=>0,'vl'=>0,'vo'=>0],
            ['cd'=>0, 'ct'=>0]];  
?>

{{-- ,'cb'=>0 --}}

@if (isset($lista[0]->acceso))
  @foreach ($lista[0]->acceso as $key=>$opciones)      
       <script type="text/javascript">
         ($('input[type="checkbox"][name="acceso[{{$key}}]"]'))[0]['checked']='true';
       </script> 
  @endforeach
  @foreach ($grp as $opp=>$opciones) 
       @if ( count( array_intersect_key($lista[0]->acceso,$opciones) )>0 ) 
       <script type="text/javascript">
         ($('input[type="checkbox"][data-target="#collapsediv{{$opp+1}}"]'))[0]['checked']='true';
         abrirColapse('collapsediv{{$opp+1}}');       
       </script>
       @endif                
  @endforeach
@endif

<script type="text/javascript">
    $('body').on('click', '.fa-trash-o', function()  //Boton que borra categoria
{
    $(this).parent().parent().remove();  
    //$(this).parent().siblings().find('input').val()
    //$(this).parent().parent().attr('class')
 
});

$('input').attr("autocomplete","off");

$('body').on('change', '#email', function()
{
    $data="id="+$(this).val(); 
    $.get(' ', $data, function(subpage){
       $('#EspacioAccion').html(subpage);        
    }).fail(function() {
       console.log('Error en carga de Datos');
  });
});
 
function GuardarPersona()
{
  var data=$('#RegPersona').serialize();
     var data="_token={{ csrf_token()}}&"+data;
     console.log(data);
      $.post('RegistrarUsuario', data, function(subpage){  
        
              $('#btGuardaProd').attr("disabled",true);
              $("#codigo_producto").focus();
    });
}
</script>