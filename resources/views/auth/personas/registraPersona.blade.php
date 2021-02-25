
<script type="text/javascript">
  function abrirColapse(elemento)
  {
    $('#'+elemento).collapse('show');
  }
 
</script>
<div id="Centro" style="font-size: 0.8em;">
  <div class="header">
    <h4>Registro de Personas</h4>
  </div>
  <form  id="RegPersona" method="POST"  action="{{ url('RegistrarUsuario') }}" class="form-horizontal md-form" id="RegPersona" style="font-size: .85em;">
  @csrf
    <input type="text" name="clase" value="Persona" hidden>
    <div class="card-header card">
        <h5>Datos de la persona</h5>
      </div>
    <div class="col-lg-12 card" style="background: white; padding: 20px; ">

    <div class="col-lg-10 card-header">
              <div class="form-group row" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="estado">Estado:</label>
                  <div class="col-lg-2">
                    <select class="form-control" id="estado" name="persona[estado]" style="font-size: 1em;">
                      <option>Activo</option>
                      <option>Inactivo</option>
                    </select>
                  </div>
              </div>

              <div class="form-group row" style="margin-bottom: 3px; "> 
                  <label class="col-lg-2 col-form-label text-right" for="tipo">Rol:</label>
                  <div class="col-sm-3">
                    <select class="form-control" id="rol" name="rol" style="font-size: 1em;">
                      <option value=1 selected>Cliente</option>
                      <option value=2 >Proveedor</option>
                    </select>
                  </div>
              </div>
              <script type="text/javascript">$("#rol").val('{{$lista[0]->rol ?? ''}}');</script>
               
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

               <div class="form-group row NatJur" style="margin-bottom: 3px; "> 
                  <label class="col-lg-2 col-form-label text-right" for="provincia">Provincia:</label>
                  <div class="col-sm-3">
                    <select class="form-control form-control-sm" id="provincia" name="provincia" style="font-size: 1.11em;" onchange="Cantones(0)"S>
                        <option> </option>
                    </select>
                  </div>
              </div>

              <div class="form-group row NatJur" style="margin-bottom: 3px; "> 
                  <label class="col-lg-2 col-form-label text-right" for="canton">Cantón:</label>
                  <div class="col-sm-3">
                    <select class="form-control form-control-sm" id="canton" name="canton" style="font-size: 1.11em;">
                    </select>
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

        <button id="btGuardaProd" class="btn fa fa-save btn-success float-right" disabled=""> Guardar</button>
     </form>
</div>
@include('provincias')

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

   myJson=<?php echo prueba(); ?>

  Provincias({{$lista[0]->provincia ?? ''}});

  function Cantones(canton){

    xProv=document.getElementById("provincia");
    if (xProv.selectedIndex==0) { return;}
    xCant=document.getElementById("canton");   

    for (let i = xCant.options.length; i >= 0; i--) {
          xCant.remove(i);
      }
        
    for (const prop in myJson[xProv.selectedIndex]['cantones']){
                
        var option = document.createElement("option"); 
        option.text = myJson[xProv.selectedIndex]['cantones'][prop]['canton'] ;
        option.value= prop;
        if (canton==prop) {
                            option.selected=true; 
                            
                          }        
        xCant.add(option);
      }
  }

  function Provincias(selecion){

      var x = document.getElementById("provincia");
      
      for (var i = 1; i < (Object.keys(myJson).length); i++) {
        var option = document.createElement("option");    
        option.text = myJson[i]['provincia'] ;
        option.value= i;
        if (selecion==i) {
                            option.selected=true; 
                            
                          }
        x.add(option);
      }

      Cantones({{$lista[0]->canton ?? ''}});
  }

</script>