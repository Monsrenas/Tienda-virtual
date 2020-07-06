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
                <a href="#"> Olvidé mi contraseña.</a>
                <br><br>
                <button id="seRegistra" class="btn btn-success mb-2" 
                    onclick="Modal('autenticacion.registro','anc','asd')" >
                    Registrarse
                </button>

            </form>
        </div>
    </div>
</main>


<script type="text/javascript">
    $("body").on('change','input', function(){
 
  $('#MnsgError').empty();
});

function pruebame()
{

    alert('no hay lio');
}    
</script>