<style>
ul, #catUL {
            list-style-type: none;
          }

#catUL {
        margin-left: 15px;
        padding: 0;
      }

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
}

.caretX::before {
  content: "\25B6";
  color: black;
  display: inline-block;
  margin-right: 1px;
}

.caret-down::before {
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
	 $data='{{ csrf_token()}}&referencia=categorias';	

     $.get('DevuelveBase', $data, function(subpage){ 
        
        for (const prop in subpage)
            {
              var xSub=prop.length/3;
              for (var i = 0; i < xSub; i++) {  var $element='';
              									var padre=prop.substring(0,((i-1)*3)+3);
              									cod=prop.substring(0,(i*3)+3);
              									var exist = document.getElementById("cat"+cod);
              	
              									if (exist==null){
              									  if (padre.length>0) {  	
              									  	$("ul#cat"+padre).append(function(n){  
              									  		$("#pdr"+padre).removeClass("xcaretX");
              									  		$("#pdr"+padre).addClass("caretX");
            	    									return "<li><span id='pdr"+cod+"' class='xcaretX' >"+subpage[prop]+"</span><ul class='nestedX' id='cat"+cod+"' ></ul></li>";
        											});
              									  			    } 
              									  else {	  		 
              									  		  $('#catUL').append("<li><span id='pdr"+cod+"' class='xcaretX'>"+subpage[prop]+"</span><ul  class='nestedX' id='cat"+cod+"' ></ul></li>");
              									  	   }
              	           					    }
              								}
            }      

          var toggler = document.getElementsByClassName("caretX");
            var i;

            for (i = 0; i < toggler.length; i++) {
              toggler[i].addEventListener("click", function() { 
                this.parentElement.querySelector(".nestedX").classList.toggle("activeX");
                this.classList.toggle("caretX-down");
              });
            }
          

    }).fail(function() {
       console.log('Error en carga de Datos');
  });
	}

</script>