<style>
ul, #catUL {
            list-style-type: none;
          }

#catUL {
        margin-left: 15px;
        padding: 0;
        color: black;
      }
li .btn { 
          display: none; 
          font-size: .4em; 
          margin-left:6px;
        }
li:hover>.btn{ display: inline; }
.xNmodel { color: black; }
.xNmodel :hover { color: white;
                  background: black; 
                }

.xcaretX { font-size: 0.74em;
          cursor: pointer;
          -webkit-user-select: none; /* Safari 3.1+ */
          -moz-user-select: none; /* Firefox 2+ */
          -ms-user-select: none; /* IE 10+ */
          user-select: none;
        }

.xcaretX::before {
  content: "\25B7";
  color: black;
  display: inline-block;
  margin-right: 1px;
}

.caretX { font-size: 0.74em;
  cursor: pointer;
  -webkit-user-select: none; /* Safari 3.1+ */
  -moz-user-select: none; /* Firefox 2+ */
  -ms-user-select: none; /* IE 10+ */
  user-select: none;
  color: black;
}

.caretX::before {
  content: "\25B6";
  color: black;
  display: inline-block;
  margin-right: 1px;
  color: black;
}

.caretX-down::before {
  -ms-transform: rotate(90deg); /* IE 9 */
  -webkit-transform: rotate(90deg); /* Safari */'
  transform: rotate(90deg);  
   
}

.nestedX { margin-left: -28px;
  display: none;
  color: black;
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
             
            editables();
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

              return "<li><span id='pdr"+cod+"' class='xcaretX' >"+nombre+"</span><ul class='nestedX' id='cat"+cod+"' ></ul></li>";
            });
          } 
          else {          
                $('#catUL').append("<li><span id='pdr"+cod+"' class='xcaretX'>"+nombre+"</span><ul  class='nestedX' id='cat"+cod+"'></ul></li>");
               }
        }
      }
  }

  function editables( ) 
  {
    var $editar="<button data-toggle='modal' data-target='#ModalAuxiliar' type='button' class='btn btn-sm fa btn-outline-primary fa-pencil'></button>";
    var $agregar="<button data-toggle='modal' data-target='#ModalAuxiliar' type='button' class='btn btn-sm fa btn-outline-primary fa-plus'></button>";
    var $borrar="</button><button type='button' class='btn btn-sm fa btn-outline-danger fa fa-trash-o'></button>";

      var lmnts=$('.xcaretX');  

      for (var i = 0; i < lmnts.length; i++) {
        $('#'+lmnts[i]['id']).after( $editar+$agregar+$borrar);
      }

    var lmnts=$('.caretX');  

      for (var i = 0; i < lmnts.length; i++) {
        $('#'+lmnts[i]['id']).after( $editar+$agregar);
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

   $('body').on( 'click', 'li .fa-trash-o', function () {
      
       var data="_token={{ csrf_token()}}&clase=Categoria&condicion=codigo,"+($(this).parent().find('span')[0]['id']).substr(3);

            $.post('/BorraItem', data, function(subpage){  
              $('#catUL').empty();
              arbolCategorias();
            } );
    }); 

    $('body').on( 'click', 'li .fa-pencil', function () {
      $codigo=($(this).parent().find('span')[0]['id']).substr(3);
      Registros('panel.NuevaCategoria', 'Categoria', 'codigo,'+$codigo ,'','modal-cuerpo-AUX');

    }); 

    $('body').on( 'click', '.fa-plus', function () {
        nuevoCategoria('');
    });

   $('body').on( 'click', 'li .fa-plus', function () {
        $codigo=($(this).parent().find('span')[0]['id']).substr(3);
        nuevoCategoria($codigo);

    }); 

  


   function nuevoCategoria(codigo)
   {
        console.log('Va: '+codigo);
        $data='codigo='+codigo;

        $.get('/nuevaCategoria', $data, function(subpage){ 
             
             $('#modal-cuerpo-AUX').empty().append(subpage);
    

        }).fail(function() {
           console.log('Error en carga de Datos');
        });
   }

</script>

