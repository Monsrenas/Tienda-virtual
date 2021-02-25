 

@extends('panel.menu')
@section('operaciones')
<div id="Centro" style="font-size: 0.8em;">
  <div class="header">
    <h4>Informacion del perfil</h4>
  </div>
  <form  id="RegPersona" method="POST"  action="javascript:GuardarPersona()" class="form-horizontal md-form" method="post" style="font-size: .85em;">
  @csrf
    <input type="text" name="clase" value="Usuario" hidden>
    <input type="password" name="password" value="clave123456789" hidden>
    <div class="card-header card">
    <h5>Datos de: <strong>{{ Auth::user()->nombre }}</strong> <sub> ({{$rol[$lista->rol-1]}})</sub></h5>
      </div>
    <div class="col-lg-12 card" style="background: white; padding: 20px; ">

    <div class="col-lg-10 card-header">
  
              <div class="form-group row" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="ruc">RUC/ Cédula:</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control form-control-sm" value="{{$lista->idpersonal ?? ''}}" required readonly >
                  </div>
              </div>

             <div class="form-group row" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="nombre">Nombre:</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control form-control-sm" value="{{$lista->nombre ?? ''}}"  readonly>
                  </div>
              </div>
 

             <div class="form-group row" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="telefono">Teléfono:</label>
                  <div class="col-sm-3">
                    <input type="tel" class="form-control form-control-sm" id="telefono" name="telefono"  value="{{$lista->telefono ?? ''}}" >
                  </div>
              </div>

              <div class="form-group row" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="direccion">Dirección:</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control form-control-sm" id="direccion" name="direccion" placeholder="" value="{{$lista->direccion ?? ''}}">
                  </div>
              </div>

               <div class="form-group row" style="margin-bottom: 30px; ">
                  <label class="col-lg-2 col-form-label text-right" for="correo">Correo electrónico :</label>
                  <div class="col-sm-3">
                    <input type="email" class="form-control form-control-sm" placeholder="" value="{{$lista->email ?? ''}}" name="email" readonly>
                  </div>
              </div>

              <div class="form-group row" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="Oldpassword">Contraseña actual:</label>
                  <div class="col-sm-3">
                    <input type="password" class="form-control form-control-sm" placeholder="" name="Oldpassword">
                  </div>
              </div>

                             <div class="form-group row" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="password">Nueva contraseña:</label>
                  <div class="col-sm-3">
                    <input type="password" class="form-control form-control-sm" placeholder="" name="password" id="password" >
                  </div>
              </div>

                             <div class="form-group row" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="repitepassword">Confirmación de contraseña:</label>
                  <div class="col-sm-3">
                    <input type="password" class="form-control form-control-sm" placeholder="" name="repitepassword" id="repitepassword">
                  </div>
                  <label class="col-lg-4 col-form-label text-right" id='error' style="color: red;" hidden >LOS DATOS DEBEN COINCIDIR</label>
              </div>
      </div>    
  </div>


  
        <button id="btGuardaProd" class="btn fa fa-save btn-success float-right" disabled=""> Actualizar</button>
     </form>
</div>

<script type="text/javascript">
 
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
 
  if (!($('#repitepassword').val()==$('#password').val())) {$('#error').attr("hidden",false); $('#password').focus(); return;}

  var data=$('#RegPersona').serialize();
     var data="_token={{ csrf_token()}}&"+data;
     
      $.post('/RegistrarUsuario', data, function(subpage){  
              
              $('#error').attr("hidden",true);
              $('#btGuardaProd').attr("disabled",true);
    });
}

$('body').on('change', 'input', function()
{
     
      $("#btGuardaProd").attr('disabled',false);
});
</script>
@endsection