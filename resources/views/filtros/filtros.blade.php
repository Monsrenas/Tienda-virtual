<!DOCTYPE html>
<br>
<style type="text/css">
  .panel {
    margin-bottom: 12px;
    
  } 

.panel-body { max-height: 50%;
                height: 50%; 
                overflow: auto scroll; 
                background: white;  
             -webkit-box-shadow: inset 0px 0px 14px 0px rgba(32,73,144,1);
-moz-box-shadow: inset 0px 0px 14px 0px rgba(32,73,144,1);
box-shadow: inset 0px 0px 14px 0px rgba(32,73,144,1);}

.collapsed {
  outline: none;
}

.barra {
    background: #768AC2;

}

.IntHead {font-size: medium;
          width: 100%;
          text-align: center;
          color: blue;
          background: #dde6ff;
          border-radius: 7px 7px 7px 7px;
-moz-border-radius: 7px 7px 7px 7px;
-webkit-border-radius: 7px 7px 7px 7px;
border: 2px solid blue;
        }
         
</style>

<div class="container-fluid">
<div id="faq" role="tablist" aria-multiselectable="true">

<div class="panel panel-default">
<div class="panel-heading" role="tab" id="questionThree">
<h5 class="panel-title">
<a class="collapsed" data-toggle="collapse" data-parent="#faq" href="#answerThree" aria-expanded="false" aria-controls="answerThree">
    <div>
      <div class="IntHead">MARCAS / MODELOS</div>
    </div> 
</a>
</h5>
</div>
<div id="answerThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="questionThree">
<div class="panel-body" id="Interrogation">
  @include('codificador.Marcas_Modelos');
</div>
</div>
</div>


<div class="panel panel-default">
<div class="panel-heading" role="tab" id="questionOne">
<h5 class="panel-title">
<a data-toggle="collapse" data-parent="#faq" href="#answerOne" aria-expanded="true" aria-controls="answerOne">
  <div>
    <div class="IntHead" >CATEGORIAS</div>
  </div>  
</a>
</h5>
</div>
<div id="answerOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="questionOne">
<div class="panel-body" id="categorias">
      @include('codificador.categorias');
</div>
</div>
</div>

<div class="panel panel-default">
<div class="panel-heading" role="tab" id="questionTwo">
<h5 class="panel-title">
<a class="collapsed" data-toggle="collapse" data-parent="#faq" href="#answerTwo" aria-expanded="false" aria-controls="answerTwo" target='_blank'>
        <div class="IntHead">FABRICANTES</div> 
</a>
</h5>
</div>
<div id="answerTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="questionTwo">
<div class="panel-body" id="Laboratory"> 
       @include('codificador.fabricante');
</div>
</div>
</div> 

</div>
</div>
    
<!-- Initialize Bootstrap functionality -->
<script>
// Initialize tooltip component
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

// Initialize popover component
$(function () {
  $('[data-toggle="popover"]').popover()
})

  $('.panel-body').css("height", screen.height-510);
  $('.panel-body').css("max-height", screen.height-510);                          

  function SetDatos(id, nombre)
  {

      var $resul=[];
      $resul['fabricante']=[]; 
         
      
       $resul['fabricante']=id;
      
       cargarListaProductos($resul);

  }


  function FiltrarCategoria(id)
{
  var $resul=[];
  $resul['categoria']=[];
  $resul['categoria'][0]=id.substring(3);
  //$resul['palabra']=[];
  //$resul['palabra'].push('monsrenas');
  
  cargarListaProductos($resul);
}


$('body').on('click', '.xcaretX,.caretX', function(){      
  
    if ($(this).hasClass("caretX-down")||$(this).hasClass("xcaretX")){
      FiltrarCategoria($(this)['0']['id']);    }

});


function FiltrarModelo(id)
{
  var $resul=[];
  $resul['marca']=[]; 
  $resul['modelo']=[];
  //$resul['palabra']=[];
  //$resul['palabra'].push('monsrenas');
  if (id.length>3) {$resul['modelo'].push(id);} else {$resul['marca'].push(id);}
   cargarListaProductos($resul);
}

$('body').on('click', '.Xmarcas', function(){      
    if ($(this).hasClass("caret-down")||$(this).hasClass("xcaret")){
      FiltrarModelo($(this)['0']['id']);    }

});

$('body').on('click', '.xModelo', function(){      
      FiltrarModelo($(this).parent().parent().attr('id').substring(3)+$(this)['0']['id']);    
});

  /*PreLoadDataInView('#Interrogation', '&modelo=Interrogation&url=consultation.interrogation', 'flexlist');
   echo VIEW::make("consultation.PhysicalExamination")*/
</script>