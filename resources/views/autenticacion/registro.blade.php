        <main role="main" class="container my-auto">
            <div class="row">
                <div id="login" class=" col-12">
        <form action="javascript: RegistrarCliente()" id="RegPersona"  method="POST" >
                        <div id='MnsgError' style="color:red;"></div>

                    <input type="text" name="clase" value="Persona" hidden>
                    <input type="text" name="externo" value="externo" hidden>
                    <input type="text" id="rol" name="rol" value="1" hidden>
               
              <div class="form-group row" style="margin-bottom: 3px; ">
                  <label class="col-lg-4 col-form-label text-right" for="ruc">RUC/ Cédula:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-sm" id="idpersonal" name="idpersonal" placeholder="" required  >
                  </div>
              </div>

             <div class="form-group row" style="margin-bottom: 3px; ">
                  <label class="col-lg-4 col-form-label text-right" for="nombre">Nombre:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="" required>
                  </div>
              </div>
 

             <div class="form-group row" style="margin-bottom: 3px; ">
                  <label class="col-lg-4 col-form-label text-right" for="telefono">Teléfono:</label>
                  <div class="col-sm-6">
                    <input type="tel" class="form-control form-control-sm" id="telefono" name="telefono" placeholder="" required>
                  </div>
              </div>

              <div class="form-group row" style="margin-bottom: 3px; ">
                  <label class="col-lg-4 col-form-label text-right" for="direccion">Dirección:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-sm" id="direccion" name="direccion" required>
                  </div>
              </div>

               <div class="form-group row NatJur" style="margin-bottom: 3px; "> 
                  <label class="col-lg-4 col-form-label text-right" for="provincia">Provincia:</label>
                  <div class="col-sm-6">
                    <select class="form-control form-control-sm" id="provincia" name="provincia" style="font-size: 1.11em;" onchange="Cantones(0)" required>
                        <option> </option>
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


               <div class="form-group" style="margin-top: 30px; ">
                  <label for="correo">Correo electrónico :</label>
                  
                    <input type="email" class="form-control form-control-sm" id="MIcorreo" name="email" placeholder="" required>
                  
              </div>

                <div class="form-group">
                    <label for="palabraSecreta">Contraseña</label>
                    <input id="palabraSecreta" name="palabraSecreta"
                        class="form-control form-control-sm" type="password"
                        placeholder="Contraseña" required>
                </div>
                <div class="form-group">
                    <label for="repiteSecreta">Repetir Contraseña</label>
                    <input id="repiteSecreta" name="repiteSecreta"
                        class="form-control form-control-sm" type="password"
                        placeholder="Contraseña" required>
                </div> 

                <button id="seRegistra" type="submit" class="btn btn-success mb-2">
                    Registrarse
                </button>

        </form>
                </div>
            </div>
        </main>

@include('provincias')
<script type="text/javascript">
$('input').attr("autocomplete","off");  
    $("body").on('change','input', function(){
 
  $('#MnsgError').empty();
});

function RegistrarCliente() {
     
    if ($('#repiteSecreta').val()!=$('#palabraSecreta').val()) { $('#MnsgError').empty().append('La contraseña no coincide con la confirmación'); return; }
    
    var email = document.getElementById('MIcorreo').value;
    var pass = document.getElementById('palabraSecreta').value;
    firebase.auth().useDeviceLanguage();
     firebase.auth().createUserWithEmailAndPassword(email, pass)
    .then(function(){
      // VERIFICAMOS EL CORREO
      verificar();
      GuardarPersona();

      $("[data-dismiss=modal]").trigger({ type: "click" });
      
    })
    .catch(function(error) {
        var errorCode = error.code;
        var errorMessage = error.message;
        alert(errorMessage);
        //if (errorCode=='auth/email-already-in-use') { $('MnsgError').empty().append('Este correo electrónico ya está en uso');}
        $('#MnsgError').empty().append(errorMessage); 
    });

}

function GuardarPersona()
{
  var data=$('#RegPersona').serialize();
     var data="_token={{ csrf_token()}}&"+data;
     
      $.post('RegistrarUsuario', data, function(subpage){ 
   
       cerrar();        
    });
}
 myJson=<?php echo prueba(); ?>  
@include('autenticacion.SelectProvincia')
</script>
