<style>
ul, #myUL {
            list-style-type: none;
          }

#myUL {
        margin-left: 15px;
        padding: 0;
      }

.xModelo { margin: -24px;}
.xNmodel { color: black;}
.xNmodel :hover { color: white;
                  background: black; 
                }

.xcaret {
          cursor: pointer;
          -webkit-user-select: none; /* Safari 3.1+ */
          -moz-user-select: none; /* Firefox 2+ */
          -ms-user-select: none; /* IE 10+ */
          user-select: none;
        }

.xcaret::before {
  content: "\25B7";
  color: black;
  display: inline-block;
  margin-right: 6px;
}

.caret {
  cursor: pointer;
  -webkit-user-select: none; /* Safari 3.1+ */
  -moz-user-select: none; /* Firefox 2+ */
  -ms-user-select: none; /* IE 10+ */
  user-select: none;
}

.caret::before {
  content: "\25B6";
  color: black;
  display: inline-block;
  margin-right: 6px;
}

.caret-down::before {
  -ms-transform: rotate(90deg); /* IE 9 */
  -webkit-transform: rotate(90deg); /* Safari */'
  transform: rotate(90deg);  
}

.nested {
  display: none;
}

.active {
  display: block;
}

.carHeader 
{
    display: block;
    
    width: 100%;
    height: 24px;
    padding: 4px;
    background: #e6e6e6;
}

.left_wind 
{
  background: #f3f3f3; 
  padding: 5px
} 

.lista { font-size: 0.74em; }

.galeria_productos
{

  -webkit-box-shadow: inset 0px 0px 6px 0px rgba(32,73,144,1);
  -moz-box-shadow: inset 0px 0px 6px 0px rgba(32,73,144,1);
  box-shadow: inset 0px 0px 6px 0px rgba(32,73,144,1);
  height: 100%; background: white; border: 1px solid #9BAB8A; float: left;

}

.filtro {width: 29%;}

.oculto {visibility: hidden;
          display: none;
        }
</style>

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" href="{{'css/ToolTip.css'}}">
</head>
<body>
    <form class="form-grup" id="formBuscarModelo">
      @csrf
      
      <input type="text" name="busqueda" style="width: 100%; margin-bottom: 5%;" placeholder="Filtrar modelos" onkeyup="filtraMarcaModelo(this.value)">    
  </form>
  <ol id="myUL" class="lista">
  </ol>
</body>
</html>
<script type="text/javascript">
    /* carga el Arbol de marcas y modelos */
LoadDataList();

function activaMenu()
{

  console.log('Prueba de llamada');

     var toggler = document.getElementsByClassName("caret");
            var i;

            for (i = 0; i < toggler.length; i++) {
              toggler[i].addEventListener("click", function() { 
                this.parentElement.querySelector(".nested").classList.toggle("active");
                this.classList.toggle("caret-down");
              });
              }
}
  function loadArbolMarcas()
  {

    for (var i = 0; i < 100; i++) {
                                     insertItem('marcasLi','Bebida '+i);
                                  }
  }

function LoadDataList() { 
       
    $.get('Leerbase', '{{ csrf_token() }}', function(subpage){ 
        
          for (const prop in subpage)
                                    {
                                        insertItem('myUL', subpage[prop], prop);
                                        //AgregaOpcion('sMarca', subpage[prop]['nombre'], prop );
                                    }
         var toggler = document.getElementsByClassName("caret");
            var i;

            for (i = 0; i < toggler.length; i++) {
              toggler[i].addEventListener("click", function() { 
                this.parentElement.querySelector(".nested").classList.toggle("active");
                this.classList.toggle("caret-down");
              });
              }
 

    })  .fail(function() {
                            console.log('Error en carga de Datos');
                         })
}



  function insertItem($contenedor, $objeto, $id)
  {   
      $submenu=$objeto['modelos'];
      if ($submenu) { 

      $element="<li><span class='caret Xmarcas' id='"+$id+"' active>"+$objeto['nombre']+"</span><ul class='nested' id='mrc"+$id+"'>";
      
      for (const prop in $submenu)
          {
            var $burbuja="";
            var $año="";
          //   $element=$element+"<li id='mdl"+prop+"'><a  href='javascript:FiltrarModelo(\""+$id+prop+"\");' id='"+prop+"' class='dmrc"+$id+"'>"+$submenu[prop]['nombre']+"</a></li>" ;
          $modName="<b style='color: gray'>- "+$submenu[prop]['nombre']+"</b>";
          if (typeof $submenu[prop]['motor'] != "undefined") { $modName+=" "+$submenu[prop]['motor']}
          if (typeof $submenu[prop]['cilindraje'] != "undefined") { $modName+=" "+$submenu[prop]['cilindraje']}  
          if (typeof $submenu[prop]['inicio'] != "undefined") { $año+=$submenu[prop]['inicio']}

          if (typeof $submenu[prop]['final'] != "undefined") { $año+="-"+$submenu[prop]['final']}
          if (typeof $submenu[prop]['info'] != "undefined") { $burbuja=$submenu[prop]['info']}
             
          if ($año!="") { $modName+=" ( "+$año+" )"; }

          $element=$element+"<li id='mdl"+prop+"'><a href='#' id='"+prop+"' class='dmrc"+$id+" xModelo'><span tooltip='"+$burbuja+"'  >"+$modName+"</span></a></li>" ;
          }

      $element=$element+"</ul></li>";
      } else {
                $element="<li id='mrc"+$id+"'><a href='#' id='"+$id+"' class='xNmodel'><span id='"+$id+"' class='xcaret Xmarcas' active>"+$objeto['nombre']+"</span></a><ul class='nested'></ul></li>";
      }

      var txt = document.getElementById($contenedor);
      txt.insertAdjacentHTML('beforeend', $element); 
  }


  function filtraMarcaModelo(texto)
  {
    $('body').on('click', '.rxcaret,.rcaret', function(){      
    
    if ($(this).hasClass("caret-down")||$(this).hasClass("xcaret")){   
                                                                      let $campo='';
                                                                      let $descr=''; 
                                                                        
                                                                      $('#'+$campo).val(($(this)[0].id).substring(3));
                                                                      $('#'+$descr).text($(this)[0].innerText);
                                                                    }



   // if ($(this).hasClass("caretX-down")||$(this).hasClass("xcaretX")){
   //   FiltrarCategoria($(this)['0']['id']);    }   
 });

    $('body').on('click', '.xModelo', function(){    
      let $campo='';
      let $descr=''; 
                                                                        
      console.log();
       $('#'+$campo).val($(this).parent().parent().attr('id').substring(3)+$(this)['0']['id']);
       $('#'+$descr).text($(this).parent().parent().siblings('.caret')[0]['innerText']+": "+$(this)[0]['innerText']);
       //$('#'+$descr).text($(this)[0].innerText);    
       $("[data-dismiss=modal]").trigger({ type: "click" }); /*Cierra ventana modal*/
    });
  }

 
</script>