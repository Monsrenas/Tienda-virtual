<style type="text/css">
  a:hover {
      background: white;
      display: inline-block;
  }

</style>

<div class="container">
    <div class=""  style="background: white; margin-top: 5%; max-height: 600px; overflow: scroll;">
     @include('codificador.Marcas_Modelos')
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

$('body').on('click', '.Xmarcas', function(){      
    if ($(this).hasClass("caret-down")||$(this).hasClass("xcaret")){
        
      let $campo='{{$info->campo}}';
      let $descr='{{$info->descripcion}}'; 
      
      $('#'+$campo).val($(this)['0']['id']);
      $('#'+$descr).text($(this)[0].innerText);
    }
});

$('body').on('click', '.xModelo', function(){      
      
      let $campo='{{$info->campo}}';
      let $descr='{{$info->descripcion}}'; 
      
      $('#'+$campo).val($(this)['0']['id']);
      $('#'+$descr).text($(this)[0].innerText); 
});

</script>