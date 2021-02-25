 
 
<style type="text/css">
.barra {
  background: #FFFFFF;
  height: 80px;
  margin-bottom: 20px;
  transition-duration:0.4s;
  color: gray;
  overflow: hidden;
  font-family: 'Open Sans', sans-serif;
  letter-spacing: 1px;
  font-size: .8em;
   border: 0px solid gray;
   padding: 10px;
   box-shadow: 8px 3px 6px 1px rgba(0, 0, 0, 0.20);
 
}

.barra:hover {        
                      height: 300px;
                      transition-duration:0.6s;
                      overflow: scroll;

 } 
         
 .filtros {
              font-weight: normal;
              margin-top: 4px;
              margin-left: 15px;
              color: black;
              font-family: Copperplate / Copperplate Gothic Light, sans-serif;
 }      

 .filEtiqueta {
                float: right; 
                background: white; 
                color: gray; 
                padding: 4px;
                margin-left: 10px;
                margin-bottom: 4px;
                margin-right: -2px; 
                text-align: right;
                vertical-align: middle;
                display: inline-flex;

              }

.filEtiqueta div {  float: left;
                    display: inline-flex;
                    overflow: hidden; 
                    font-size: .8em;
                    color: red;
                  }

.btn_busqueda { width: 100%; 
                margin-bottom: 2%; 
                background: #F5F4F4; 
                border: none;
              } 

             

</style>

<?php
  $xfiltro=session("filtro");
?>
<div class="row">
  <div class="col-sm-4 col-md-4 col-lg-12 col-xl-12" style="">
        <table style="width: 100%;">
          <tr>
            <td>
            <h6 class="filtros">CATEGORÍAS:</h6>
            </td>
          </tr>
          <tr>
            <td>
              <div class="filEtiqueta" style="display: none;" >
                <div id="filtxtcategoria"></div>
                <button id="DELcategoria" class="fa fa-times btn btn-sm delFiltro"></button>
              </div>  
            </td>
        </tr>
        </table>

       <div class="barra">
          <input type="text" id="bsqudCategoria" class="btn_busqueda" style="" placeholder="&#128270" autocomplete="off" >  
         @include('codificador.categorias')
      </div>
  </div>

  <div class="col-sm-4 col-md-4 col-lg-12 col-xl-12" style="">
       <table style="width: 100%;">
        <tr>
          <td>
          <h6 class="filtros">MARCAS/MODELOS:</h6>
          </td>
        </tr>
        <tr>    
          <td>
            <div class="filEtiqueta" style="display: none;" >
              <div id="filtxtmarca"></div>
              <button id="DELmarca" class="fa fa-times btn btn-sm delFiltro"></button>
            </div> 
             <div class="filEtiqueta" style="display: none;" >
              <div class="textFiltro" id="filtxtmodelo"></div>
              <button id="DELmodelo" class="fa fa-times btn btn-sm delFiltro"></button>
            </div>
          </td>
      </tr>
      </table>

      <div class="barra">
          <input type="text" id="bsqudModelos" class="btn_busqueda" style="" placeholder="&#128270" autocomplete="off" >  
         @include('codificador.Marcas_Modelos')
      </div>
  </div>

  @if (isset($_SESSION['config']['fg']))
    <div class="col-sm-4 col-md-4 col-lg-12 col-xl-12" style="">
         <table style="width: 100%;">
          <tr>
            <td>
            <h6 class="filtros" style="">FABRICANTES:</h6>
            </td>
           </tr>
          <tr>
            <td>
              <div class="filEtiqueta" style="display: none;" >
                <div id="filtxtfabricante">{{ $catFiltro??" "}} </div>
                <button id="DELfabricante" class="fa fa-times btn btn-sm delFiltro"></button>
              </div>  
            </td>
        </tr>
        </table>
        <div class=" barra">
           @include('codificador.fabricante')
        </div>
    </div>
  @endif
 
</div>
    
<!-- Initialize Bootstrap functionality -->
<script>
// Initialize tooltip component
 var $filtro=<?php echo json_encode($xfiltro) ?>;
  //$filtro.forEach(nombraFiltros);
  $( document ).ready(function() {
    nombraFiltros();
    });
  

  $('.panel-body').css("height", screen.height-510);
  $('.panel-body').css("max-height", screen.height-510);                          

  function SetDatos(id, nombre)
  {
      registraFiltro("fabricante","fbr"+id);
      /*
      var $resul=[];
      $resul['fabricante']=[]; 
          
      $resul['fabricante']=id;
      
      MuestraProductos($resul);
      */
  }


function FiltrarCategoria(id)
{
  var $resul=[];
  $resul['categoria']=[];
  $resul['categoria'][0]=id.substring(3);
  //$resul['palabra']=[];
  //$resul['palabra'].push('monsrenas');
  
  MuestraProductos($resul);
}


function registraFiltro($tipo, $id)
{
      $id=$id.substring(3);
      $.get("/filtro/"+$tipo+"/"+$id, '', function(subpage)
      {        
          $filtro=subpage;
  
          MuestraProductos("");
          nombraFiltros();
               
      }).fail(function() {
                            console.log('Error en carga de Datos');
                         });
}

$('body').on('click', '.catRadio', function(){      
     
    if ($(this).hasClass("caretX-down")||$(this).hasClass("xcaretX")){
      //FiltrarCategoria($(this)['0']['id']);
      registraFiltro("categoria",$(this)['0']['id']); 
    }
      //FiltrarCategoria($(this)['0']['id']);
      
});

$('body').on('click', '.modRadio,.marRadio', function(){      
     
      //FiltrarCategoria($(this)['0']['id']);
     
            var id=$(this)['0']['id'];
            if (id.length>6) 
            {
              $("#DELmarca").click();
                registraFiltro("modelo",$(this)['0']['id']);
            } else{   
                    $("#DELmodelo").click();
                    registraFiltro("marca",$(this)['0']['id']);
                  }
        
});


function FiltrarModelo(id)
{
  var $resul=[];
  $resul['marca']=[]; 
  $resul['modelo']=[];
  //$resul['palabra']=[];
  //$resul['palabra'].push('monsrenas');
  if (id.length>3) {$resul['modelo'].push(id);} else {$resul['marca'].push(id);}
   MuestraProductos($resul);
}

/*
$('body').on('click', '.Xmarcas', function(){      
    if ($(this).hasClass("caret-down")||$(this).hasClass("xcaret")){
      FiltrarModelo($(this)['0']['id']);    }

});

$('body').on('click', '.xModelo', function(){      
      //FiltrarModelo($(this)['0']['id']);
       //FiltrarModelo($(this).parent().parent().attr('id').substring(3)+$(this)['0']['id']);      
});
*/
$('body').on('keyup', '#bsqudCategoria', function(){      
     
      FiltraListado([$(this).val(), "caretX", "xcaretX","caretX-down","nestedX","activeX"]); 
});

$('body').on('keyup', '#bsqudModelos', function(){      
     
      FiltraListado([$(this).val(), "caret", "xModelo","caret-down","nested","active"]); 
});

function FiltraListado($itm) 
{  
      text=$itm[0];
      
      if (text=="") {
                        $("."+$itm[1]+", ."+$itm[2]).show(); 
                        //$( "."+$itm[1]+"."+$itm[3] ).click();
                        
                             $( "."+$itm[1] ).removeClass($itm[3]);
                            
                             $("."+$itm[4]).removeClass($itm[5]);
                        return; 
                    }

      
      $( "."+$itm[1]+":not(."+$itm[3]+")" ).addClass($itm[3]);
      //$(".nested:not(.caret-down)").show();
      $("."+$itm[4]+":not("+$itm[5]+")").addClass($itm[5]);
                 
      //$( "."+$itm[1]+":not(."+$itm[3]+")" ).click();
      lista=$("."+$itm[1]+", ."+$itm[2]);
      for (var i = 0; i < lista.length; i++)
      {

          if (lista[i].innerText.toUpperCase().indexOf(text.toUpperCase())<0)
          { 
              $("#"+lista[i].id).hide(); 
          } 
          else {
                    $("#"+lista[i].id).show(); 
                }
      }
}

$('body').on('click', '.delFiltro', function(){      
     categoria=($(this)[0].id).substring(3);
     registraFiltro(categoria, "");
     $("#filtxt"+categoria).parent().hide();
     $("."+categoria.substring(0,3)+"Radio").prop("checked", false);
});


function nombraFiltros()
{
    console.log($filtro);
    for (const property in $filtro) {
        pfj="";
        if (property=="categoria") {pfj="pdr"}
        if (property=="modelo") {pfj="mdl"}
          if (property=="marca") {pfj="mrc"}
        $("#filtxt"+property).empty().append($("#"+pfj+$filtro[property])[0].innerText);
        $("#filtxt"+property).parent().show();
    }
}


  /*PreLoadDataInView('#Interrogation', '&modelo=Interrogation&url=consultation.interrogation', 'flexlist');
   echo VIEW::make("consultation.PhysicalExamination")*/
</script>

