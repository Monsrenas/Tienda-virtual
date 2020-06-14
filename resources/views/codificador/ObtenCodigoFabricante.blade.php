<style type="text/css">
  .listFabricamt {
      color: blue; 
      float: none; 
      height: 400px; 
      overflow: 
      scroll;
  }
  
</style>

<div class="container">
    <div class=""  style="background: white;margin-top: 5%;">
     @include('codificador.fabricante')
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

</script>