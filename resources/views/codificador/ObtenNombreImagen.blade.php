
<div class="container">
    <div class=""  style="background: white;margin-top: 5%; max-height: 600px; overflow: scroll;">
     @include('codificador.galeria')
    </div>
</div>

<script type="text/javascript">

  function SetDatos($id, $text)
  { 
    let $campo='{{$info->campo}}';
    let $descr='{{$info->descripcion}}'; 
    
    $('#'+$campo).val($id);
    $('#'+$descr).text($text);
      /*  $('#'+$parCampos[0]),value=$parDatos[0];
        $('#'+$parCampos[1]),value=$parDatos[1];  */


    $("[data-dismiss=modal]").trigger({ type: "click" }); /*Cierra ventana modal*/
  }

$('body').on('click', '.foto', function(){      

    let $campo='{{$info->campo}}';
    let $descr='{{$info->descripcion}}';

    $camino=decodeURIComponent($(this)[0]['src']);
    $posicion=$camino.lastIndexOf("/"); 
    $fichero=($camino.substring($posicion+1));

    $('#fotoNombre').val($fichero);
    if (datoValido('fotoNombre', 'fotoNombre','fotoGrupo')){
        agrFoto($fichero);}
    //$('#'+$descr).text($(this)[0].innerText);
   // if ($(this).hasClass("caretX-down")||$(this).hasClass("xcaretX")){
   //   FiltrarCategoria($(this)['0']['id']);    }   

 });

</script>