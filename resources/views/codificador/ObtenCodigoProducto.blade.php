<div class="container">
     @include('codificador.productos')
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

$('body').on('click', '.ProCod', function(){      
  
    let $campo='{{$info->campo}}';
    let $descr='{{$info->descripcion}}'; 
    console.log();
    $('#'+$campo).val($(this)[0].innerText);
    $('#'+$descr).text($(this).data('nombre'));
   // if ($(this).hasClass("caretX-down")||$(this).hasClass("xcaretX")){
   //   FiltrarCategoria($(this)['0']['id']);    }   
   $("[data-dismiss=modal]").trigger({ type: "click" }); /*Cierra ventana modal*/

 });

</script>