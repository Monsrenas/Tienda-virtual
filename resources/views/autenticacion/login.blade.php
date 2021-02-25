
<main role="main" class="container my-auto">
    <div class="row">
        <div id="login" class=" col-12">
            <form action="javascript: xAutenticarse()">
                <div id='MnsgError' style="color:red;"></div>
                <div class="form-group">
                    <label for="MIcorreo">Correo</label>
                    <input type="email" id="MIcorreo" name="correo"
                        class="form-control" required 
                        placeholder="Correo electrónico">
                </div>
                <div class="form-group">
                    <label for="palabraSecreta">Contraseña</label>
                    <input id="palabraSecreta" name="palabraSecreta"
                        class="form-control" type="password"
                        placeholder="Contraseña" required> 
                </div> 
                <button id="seCierra" type="submit" class="btn btn-primary mb-2">
                    Entrar
                </button>
                <br>
                <a href="javascript: ResetPassword()"> Olvidé mi contraseña.</a>
                <br><br>
                <button id="seRegistra" class="btn btn-success mb-2" type="button" 
                    onclick="Modal('autenticacion.registro','anc','asd')" >
                    Registrarse
                </button>

            </form>
        </div>
    </div>
</main>


<script type="text/javascript">

$('input').attr("autocomplete","off");

$("body").on('keyup','input', function(){
 
  $('#MnsgError').empty();
});

function ResetPassword()
{

    firebase.auth().sendPasswordResetEmail($('#MIcorreo').val()).then(function() {
    // Email sent.
    $('#MnsgError').empty().append("<span style='color: blue;'>Se ha enviado un enlace de recuperación a su buzón de correos</span>");
    }).catch(function(error) {
      // An error happened.
      $('#MnsgError').empty().append("Escriba su dirección de correo, previamente registrada, en un formato correcto");
    });
}    
</script>