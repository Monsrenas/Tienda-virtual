 

    <main role="main" class="container my-auto" style="font-size: .8em;">
        <div class="row">
            <div id="login" class=" col-12">
    <form action="javascript: RegistrarCliente()" id="RegPersona"  method="POST" >
                    <div id='MnsgError' style="color:red;"></div>

                <input type="text" name="clase" value="Persona" hidden>
                <input type="text" name="externo" value="externo" hidden>
                <input type="text" id="rol" name="rol" value="1" hidden>
           
          <div class="form-group" style="margin-top: 30px; ">
              <label for="correo">Correo electrónico :</label>
              
                <input type="email" class="form-control form-control-sm" id="MIcorreo" name="email" required readonly value="{{$lista[0]->email ?? $_SESSION['cliente']??""}}">
              
          </div>

          <div class="form-group row" style="margin-bottom: 3px; ">
              <label class="col-lg-4 col-form-label text-right" for="ruc">RUC/ Cédula:</label>
              <div class="col-sm-6">
                <input type="text" class="form-control form-control-sm" id="idpersonal" name="idpersonal" required value="{{$lista[0]->idpersonal ?? ""}}" >
              </div>
          </div>

         <div class="form-group row" style="margin-bottom: 3px; ">
              <label class="col-lg-4 col-form-label text-right" for="nombre">Nombre:</label>
              <div class="col-sm-6">
                <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="" required value="{{$lista[0]->nombre ?? ""}}">
              </div>
          </div>


         <div class="form-group row" style="margin-bottom: 3px; ">
              <label class="col-lg-4 col-form-label text-right" for="telefono">Teléfono:</label>
              <div class="col-sm-6">
                <input type="tel" class="form-control form-control-sm" id="telefono" name="telefono" placeholder="" required value="{{$lista[0]->telefono  ?? ""}}">
              </div>
          </div>

          <div class="form-group row" style="margin-bottom: 3px; ">
              <label class="col-lg-4 col-form-label text-right" for="direccion">Dirección:</label>
              <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="direccion" name="direccion" required value="{{$lista[0]->direccion ?? ""}}">
              </div>
          </div>

           <div class="form-group row NatJur" style="margin-bottom: 3px; "> 
              <label class="col-lg-4 col-form-label text-right" for="provincia">Provincia:</label>
              <div class="col-sm-6">
                <select class="form-control form-control-sm" id="provincia" name="provincia" style="font-size: 1.11em;" onchange="Cantones(0)" required>
                    <option value="0"> </option>
                </select>
              </div>
          </div>

          <div class="form-group row NatJur" style="margin-bottom: 3px; "> 
              <label class="col-lg-4 col-form-label text-right" for="canton">Cantón:</label>
              <div class="col-sm-6">
                <select class="form-control form-control-sm" id="canton" name="canton" style="font-size: 1.11em;">
                </select>
              </div>
          </div>
    </form>
            </div>
        </div>
    </main>

@include('provincias')
<script type="text/javascript">
  $('input').attr("autocomplete","off");
  $("#RegPersona").on('change','input', function(){
    GuardarPersona();
    //$('#MnsgError').empty();
  });

  $("#RegPersona").on('change','select', function(){
    GuardarPersona();
    //$('#MnsgError').empty();
  });


function GuardarPersona()
{
  var data=$('#RegPersona').serialize();
     var data="_token={{ csrf_token()}}&"+data;
     
      $.post('RegistrarUsuario', data, function(){ 
   
              
    });
}

myJson=<?php echo prueba(); ?>  
@include('autenticacion.SelectProvincia')
 Provincias({{$lista[0]->provincia ?? ''}});
</script>
