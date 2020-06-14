<div class="container">
    <div class=""  style="background: white;margin-top: 5%; max-height: 600px; overflow: scroll;">
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

$('body').on('click', '.rxcaret,.rcaret', function(){      
    
    if ($(this).hasClass("caret-down")||$(this).hasClass("xcaret")){   
                                                                      let $campo='{{$info->campo}}';
                                                                      let $descr='{{$info->descripcion}}'; 
                                                                        
                                                                      $('#'+$campo).val(($(this)[0].id).substring(3));
                                                                      $('#'+$descr).text($(this)[0].innerText);
                                                                    }



   // if ($(this).hasClass("caretX-down")||$(this).hasClass("xcaretX")){
   //   FiltrarCategoria($(this)['0']['id']);    }   
 });

    $('body').on('click', '.xModelo', function(){    
      let $campo='{{$info->campo}}';
      let $descr='{{$info->descripcion}}'; 
                                                                        
      console.log();
       $('#'+$campo).val($(this).parent().parent().attr('id').substring(3)+$(this)['0']['id']);
       $('#'+$descr).text($(this).parent().parent().siblings('.caret')[0]['innerText']+": "+$(this)[0]['innerText']);
       //$('#'+$descr).text($(this)[0].innerText);    
       $("[data-dismiss=modal]").trigger({ type: "click" }); /*Cierra ventana modal*/
    });

</script>