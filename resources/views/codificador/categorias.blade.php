<style>
ul, #catUL {
            list-style-type: none;

          }

#catUL {
        margin-left: 15px;
        padding: 0;
         
      }

.xcaretX { /*font-size: medium;*/
          cursor: pointer;
          -webkit-user-select: none; /* Safari 3.1+ */
          -moz-user-select: none; /* Firefox 2+ */
          -ms-user-select: none; /* IE 10+ */
          user-select: none;
        }

.xcaretX::before {
  content: "\25B7";
  
  display: inline-block;
  margin-right: 1px;
}

.caretX { /*font-size: medium;*/
  cursor: pointer;
  -webkit-user-select: none; /* Safari 3.1+ */
  -moz-user-select: none; /* Firefox 2+ */
  -ms-user-select: none; /* IE 10+ */
  user-select: none;
  
}

.caretX::before {
  content: "\25B6";
  
  display: inline-block;
  margin-right: 1px;
}

.caretX-down::before {
  -ms-transform: rotate(90deg); /* IE 9 */
  -webkit-transform: rotate(90deg); /* Safari */'
  transform: rotate(90deg);  
   
}

.nestedX { margin-left: -28px;
  display: none;
  
}

.activeX {  
  display: block;
}
</style>

<div id="arbol_categorias">
	
            <ul id="catUL">

            </ul>
</div>

<script type="text/javascript">
	arbolCategorias();

	function arbolCategorias()
	{


    $data="coleccion=Categoria";

     $.get('/Resgistro', $data, function(subpage){ 
        for (const prop in subpage)
            {
             addCategoria(subpage[prop]['codigo'], subpage[prop]['nombre']);

            }
            activaCategoria();      
        
    }).fail(function() {
       console.log('Error en carga de Datos');
  });
	}

  function addCategoria(codigo, nombre)
  {
    var xSub=codigo.length/3;
    for (var i = 0; i < xSub; i++) 
     {  
        var $element='';
        var padre=codigo.substring(0,((i-1)*3)+3);
        cod=codigo.substring(0,(i*3)+3);
        var exist = document.getElementById("cat"+cod);

        if (exist==null)
        {
          if (padre.length>0) {   
            $("ul#cat"+padre).append(function(n)
            {  
              $("#pdr"+padre).removeClass("xcaretX");
              $("#pdr"+padre).addClass("caretX");
              return "<li><span id='pdr"+cod+"' class='xcaretX catRadio' > "+nombre+"</span><ul class='nestedX' id='cat"+cod+"' ></ul></li>";
              /*<input id='rdo"+cod+"' class='catRadio' type='radio' name='catRadio'>*/ 
            });
          } 
          else {         
                $('#catUL').append("<li><span id='pdr"+cod+"' class='xcaretX catRadio'>  "+nombre+"</span><ul  class='nestedX' id='cat"+cod+"'></ul></li>");
                /*<input id='rdo"+cod+"' class='catRadio' type='radio' name='catRadio'>*/
               }
        }
      }
  }

  function activaCategoria()
  {
     var toggler = document.getElementsByClassName("caretX");
            var i;

            for (i = 0; i < toggler.length; i++) {
              toggler[i].addEventListener("click", function() { 
                this.parentElement.querySelector(".nestedX").classList.toggle("activeX");
                this.classList.toggle("caretX-down");
              });
            }
  }

</script>

