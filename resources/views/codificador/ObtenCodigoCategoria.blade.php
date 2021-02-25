
<style type="text/css">

  .CatLista{
              background: white; 
              margin-top: 5%; 
              max-height: 600px; 
              overflow: scroll; 
              color: black;

              text-decoration-color: black;  
            }
  .arbol_categorias { color: black;
                      background: blue; }        
  ul, #catUL {
            /*list-style-type: none;*/
            color: black;
          }                      
</style>

<div class="container">
    <div class="CatLista">
     @include('codificador.categorias')
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

$('body').on('click', '.catRadio', function(){      
  
    let $campo='{{$info->campo}}';
    let $descr='{{$info->descripcion}}'; 
    
    var lmt="pdr"+($(this)[0].id).substring(3);
    $('#'+$campo).val(($(this)[0].id).substring(3));
    $('#'+$descr).text($("#"+lmt)[0].innerText);

    $("[data-dismiss=modal]").trigger({ type: "click" });
    
   // if ($(this).hasClass("caretX-down")||$(this).hasClass("xcaretX")){
   //   FiltrarCategoria($(this)['0']['id']);    }   

 });

</script>