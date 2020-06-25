        <main role="main" class="container my-auto">
            <div class="row">
                <div id="login" class=" col-12">
                    <form>
                        <div id='MnsgError' style="color:red;"></div>
                        <div class="form-group">
                            <label for="MIcorreo">Correo</label>
                            <input id="MIcorreo" name="correo"
                                class="form-control" type="email"
                                placeholder="Correo electrónico">
                        </div>
                        <div class="form-group">
                            <label for="palabraSecreta">Contraseña</label>
                            <input id="palabraSecreta" name="palabraSecreta"
                                class="form-control" type="password"
                                placeholder="Contraseña">
                        </div> 
                        <button id="seCierra" type="button" class="btn btn-primary mb-2"  onclick="xAutenticarse()">
                            Entrar
                        </button>
                        <br>
                        <a href="#"> Olvidé mi contraseña.</a>
                        <br><br>
                        <button id="seRegistra" type="button" class="btn btn-success mb-2"  onclick="xAutenticarse()">
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
</script>