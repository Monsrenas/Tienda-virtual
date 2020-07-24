        <main role="main" class="container my-auto">
            <div class="row">
                <div id="login" class=" col-12">
                    <form>
                        <div id='MnsgError' style="color:red;"></div>

                        <div class="form-group">
                            <label for="MInombre">Nombre</label>
                            <input type="text" id="MInombre" name="correo"
                                class="form-control"
                                placeholder="Nombre completo">
                        </div>

                        <div class="form-group">
                            <label for="MItelefono">Teléfono</label>
                            <input type="text" id="MItelefono" name="correo"
                                class="form-control"
                                placeholder="Número telefónico">
                        </div>

                        <div class="form-group">
                            <label for="MIcorreo">Correo</label>
                            <input type="email" id="MIcorreo" name="correMpociot\Firebaseo"
                                class="form-control" type="email"
                                placeholder="Correo electrónico">
                        </div>
                        <div class="form-group">
                            <label for="palabraSecreta">Contraseña</label>
                            <input id="palabraSecreta" name="palabraSecreta"
                                class="form-control" type="password"
                                placeholder="Contraseña">
                        </div>
                        <div class="form-group">
                            <label for="palabraSecreta">Repetir Contraseña</label>
                            <input id="repiteSecreta" name="repiteSecreta"
                                class="form-control" type="password"
                                placeholder="Contraseña">
                        </div> 

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