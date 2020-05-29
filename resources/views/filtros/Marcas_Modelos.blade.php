<style>
ul, #myUL {
            list-style-type: none;
          }

#myUL {
        margin-left: 15px;
        padding: 0;
      }

.xNmodel { color: black; }
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
</head>
<body>
  <ol id="myUL" class="lista">
    <!--
    <li><span class="caret">Beverages</span>
      <ul class="nested">
        <li>Water</li>
        <li>Coffee</li>
        <li><span class="caret">Tea</span>
          <ul class="nested">
            <li>Black Tea</li>
            <li>White Tea</li>
            <li><span class="caret">Green Tea</span>
              <ul class="nested">
                <li>Sencha</li>
                <li>Gyokuro</li>
                <li>Matcha</li>
                <li>Pi Lo Chun</li>
              </ul>
            </li>
          </ul>
        </li>  
      </ul>
    </li>-->
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
                                        AgregaOpcion('sMarca', subpage[prop]['nombre'], prop );
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

      $element="<li><span class='caret' id='"+$id+"' active>"+$objeto['nombre']+"</span><ul class='nested' id='mrc"+$id+"'>";
      
      for (const prop in $submenu)
          {
             $element=$element+"<li id='mdl"+prop+"'><a  href='#' id='"+prop+"' class='dmrc"+$id+"'>"+$submenu[prop]['nombre']+"</a></li>" ;
          }

      $element=$element+"</ul></li>";
      } else {
                $element="<li id='mrc"+$id+"'><a href='#' id='"+$id+"' class='xNmodel'><span class='xcaret' active>"+$objeto['nombre']+"</span></a><ul class='nested'></ul></li>";
      }

      var txt = document.getElementById($contenedor);
      txt.insertAdjacentHTML('beforeend', $element); 
  }


 
</script>