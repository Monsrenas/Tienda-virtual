
<div id="arbol_categorias">
	
            <ul id="catUL">
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
              									  	
                                              
              									  if (padre>0) {
              									    
              									  	$("ul#cat"+padre+" li").append(function(n){  
              									  		console.log(cod+" hijo de "+padre);
            	    									return "<li><span>Beverages</span></li><ul class='nested' id='cat"+cod+"' ></ul>";
        											});
              			
              									  			    } 
              									  else {
              									  		  console.log(cod);			 
              									  		 $('#catUL').append("<li><span>Beverages</span></li><ul  class='nested' id='cat"+cod+"' ></ul>");
              									  		 
              									  	   }
              	           					    }

              								}

            }      

         activarMenu()
          

    }).fail(function() {
       console.log('Error en carga de Datos');
  });
	}


</script>